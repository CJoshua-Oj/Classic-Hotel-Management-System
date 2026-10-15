<?php
declare(strict_types=1);
require_once __DIR__.'/db.php';
function available_rooms(string $type,string $in,string $out): array {
    $s=db()->prepare("SELECT r.* FROM room r WHERE r.room_type=? AND NOT EXISTS (
        SELECT 1 FROM reservation x WHERE x.room_id=r.room_id AND x.checkout_date>=? AND x.checkin_date<=? AND x.status<>0
        UNION ALL SELECT 1 FROM room_sales y WHERE y.room_id=r.room_id AND y.checkout_date>=? AND y.checkin_date<=?
    ) ORDER BY r.room_id");
    $s->execute([$type,$in,$out,$in,$out]);return $s->fetchAll();
}
function add_room_sale(int $customer,int $room,string $in,string $out,int $employee): void {
    $s=db()->prepare('SELECT rt.room_price FROM room r JOIN room_type rt ON rt.room_type=r.room_type WHERE r.room_id=?');$s->execute([$room]);$price=(float)($s->fetchColumn()?:0);
    db()->prepare('INSERT INTO room_sales(customer_id,room_id,checkin_date,checkout_date,employee_id,room_sales_price,total_service_price) VALUES(?,?,?,?,?,?,0)')->execute([$customer,$room,$in,$out,$employee,$price]);
}
function service_total(string $date,int $customer): void {
    $sql="UPDATE room_sales rs SET total_service_price=(SELECT COALESCE(SUM(v.price),0) FROM (
      SELECT book_price price,customer_id,book_date date FROM restaurant_booking
      UNION ALL SELECT dosport_price,customer_id,dosport_date FROM do_sport
      UNION ALL SELECT medicalservice_price,customer_id,medicalservice_date FROM get_medicalservice
      UNION ALL SELECT massage_price,customer_id,massage_date FROM massage_service
      UNION ALL SELECT roomservice_price,customer_id,roomservice_date FROM get_roomservice
      UNION ALL SELECT laundry_price,customer_id,laundry_date FROM laundry_service
    ) v WHERE v.customer_id=rs.customer_id AND v.date BETWEEN rs.checkin_date AND rs.checkout_date) WHERE rs.customer_id=? AND ? BETWEEN rs.checkin_date AND rs.checkout_date";
    try{db()->prepare($sql)->execute([$customer,$date,$customer]);}catch(Throwable $e){}
}
