<?php
declare(strict_types=1);
require_once __DIR__.'/auth.php';
function service_config(string $key): array {
 $c=[
 'restaurant'=>['title'=>'Restaurant','table'=>'restaurant','pk'=>'restaurant_name','open'=>'restaurant_open_time','close'=>'restaurant_close_time','details'=>'restaurant_details','service_table'=>'restaurant_booking','service_id'=>'restaurant_name','date'=>'book_date','price'=>'book_price','extra'=>'table_number'],
 'medical'=>['title'=>'Medical Service','table'=>'medical_service','pk'=>'medicalservice_id','open'=>'medicalservice_open_time','close'=>'medicalservice_close_time','details'=>'medicalservice_details','service_table'=>'get_medicalservice','service_id'=>'medicalservice_id','date'=>'medicalservice_date','price'=>'medicalservice_price','extra'=>'getmedicalservice_details'],
 'sport'=>['title'=>'Sport Facility','table'=>'sport_facilities','pk'=>'sportfacility_id','open'=>'sportfacility_open_time','close'=>'sportfacility_close_time','details'=>'sportfacility_details','service_table'=>'do_sport','service_id'=>'sportfacility_id','date'=>'dosport_date','price'=>'dosport_price','extra'=>'dosport_details'],
 'massage'=>['title'=>'Massage Room','table'=>'massage_room','pk'=>'massageroom_id','open'=>'massageroom_open_time','close'=>'massageroom_close_time','details'=>'massageroom_details','service_table'=>'massage_service','service_id'=>'massageroom_id','date'=>'massage_date','price'=>'massage_price','extra'=>'massage_details'],
 'room_service'=>['title'=>'Room Service','table'=>'room_service','pk'=>'roomservice_id','open'=>'roomservice_open_time','close'=>'roomservice_close_time','details'=>'roomservice_details','service_table'=>'get_roomservice','service_id'=>'roomservice_id','date'=>'roomservice_date','price'=>'roomservice_price','extra'=>'getroomservice_details'],
 'laundry'=>['title'=>'Laundry','table'=>'laundry','pk'=>'laundry_id','open'=>'laundry_open_time','close'=>'laundry_close_time','details'=>'laundry_details','service_table'=>'laundry_service','service_id'=>'laundry_id','date'=>'laundry_date','price'=>'laundry_price','extra'=>'laundry_amount'],
 ]; return $c[$key]??throw new InvalidArgumentException('Unknown module');
}
function active_customers():array{return db()->query("SELECT DISTINCT c.* FROM room_sales rs JOIN customer c ON c.customer_id=rs.customer_id WHERE rs.checkin_date<=CURDATE() AND rs.checkout_date>=CURDATE() ORDER BY c.customer_firstname,c.customer_lastname")->fetchAll();}
