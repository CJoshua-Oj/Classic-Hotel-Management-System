<?php
declare(strict_types=1);
require_once __DIR__.'/includes/layout.php';
login_required();$pdo=db();
$today=date('Y-m-d');
$stats=[];
foreach(['customer'=>'Customers','employee'=>'Employees','room'=>'Rooms','reservation'=>'Reservations'] as $t=>$label){$stats[$t]=(int)$pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();}
$serviceTables=['restaurant_booking'=>'Restaurant','do_sport'=>'Sport','get_medicalservice'=>'Medical','massage_service'=>'Massage','get_roomservice'=>'Room Service','laundry_service'=>'Laundry'];
$todayStats=[];foreach($serviceTables as $t=>$label){$dateCol=['restaurant_booking'=>'book_date','do_sport'=>'dosport_date','get_medicalservice'=>'medicalservice_date','massage_service'=>'massage_date','get_roomservice'=>'roomservice_date','laundry_service'=>'laundry_date'][$t];$s=$pdo->prepare("SELECT COUNT(*) FROM `$t` WHERE `$dateCol`=?");$s->execute([$today]);$todayStats[$label]=(int)$s->fetchColumn();}
$current=(int)$pdo->query("SELECT COUNT(*) FROM room_sales WHERE checkin_date<=CURDATE() AND checkout_date>=CURDATE()")->fetchColumn();
$frequent=$pdo->query("SELECT c.customer_firstname,c.customer_lastname,c.customer_TCno,COUNT(*) checkin_count,COALESCE(SUM(rs.room_sales_price+rs.total_service_price),0) total_paid FROM room_sales rs JOIN customer c ON c.customer_id=rs.customer_id GROUP BY rs.customer_id ORDER BY checkin_count DESC,total_paid DESC LIMIT 10")->fetchAll();
$most=$pdo->query("SELECT c.customer_firstname,c.customer_lastname,c.customer_TCno,COALESCE(SUM(rs.room_sales_price+rs.total_service_price),0) total_paid FROM room_sales rs JOIN customer c ON c.customer_id=rs.customer_id GROUP BY rs.customer_id ORDER BY total_paid DESC LIMIT 1")->fetch();
$next=[];for($i=1;$i<=7;$i++){ $d=date('Y-m-d',strtotime("+$i day"));$s=$pdo->prepare("SELECT COUNT(*) FROM reservation WHERE checkin_date<=? AND checkout_date>=? AND status<>0");$s->execute([$d,$d]);$next[]=['date'=>$d,'count'=>(int)$s->fetchColumn()];}
page_header('Dashboard','dashboard');
?>
<div class="page-head"><div><h1>Dashboard</h1><p class="muted">Hotel operations overview</p></div><a class="btn primary" href="reservation.php">New Reservation</a></div>
<div class="stats"><?php foreach([['Customers',$stats['customer']],['Employees',$stats['employee']],['Rooms',$stats['room']],['Reservations',$stats['reservation']],['Current Guests',$current]] as $x):?><div class="stat"><span><?=e($x[0])?></span><strong><?=e($x[1])?></strong></div><?php endforeach;?></div>
<div class="grid2"><section class="card"><h2>Today's Stats</h2><div class="mini-grid"><?php foreach($todayStats as $k=>$v):?><div><b><?=$v?></b><span><?=e($k)?></span></div><?php endforeach;?></div></section>
<section class="card"><h2>Hotel's Next Week Customers</h2><div class="next-list"><?php foreach($next as $n):?><div><span><?=e(date('D, M j',strtotime($n['date'])))?></span><b><?=$n['count']?></b></div><?php endforeach;?></div></section></div>
<div class="grid2"><section class="card"><h2>Most Favorite Customer</h2><?php if($most):?><div class="favorite"><strong><?=e($most['customer_firstname'].' '.$most['customer_lastname'])?></strong><span><?=e($most['customer_TCno'])?></span><b><?=money($most['total_paid'])?> total paid</b></div><?php else:?><p class="muted">No customer history yet.</p><?php endif;?></section>
<section class="card"><h2>Important Shortcuts</h2><div class="shortcut-grid"><a href="rooms.php">Rooms</a><a href="employees.php">Employees</a><a href="reservations.php">Reservations</a><a href="customers.php">Customers</a><a href="restaurant.php">Restaurant</a><a href="reports.php">Reports</a></div></section></div>
<section class="card"><h2>Most Frequent Customers</h2><div class="table-wrap"><table><thead><tr><th>Customer</th><th>TC No</th><th>Check-ins</th><th>Total Paid</th></tr></thead><tbody><?php foreach($frequent as $r):?><tr><td><?=e($r['customer_firstname'].' '.$r['customer_lastname'])?></td><td><?=e($r['customer_TCno'])?></td><td><?=$r['checkin_count']?></td><td><?=money($r['total_paid'])?></td></tr><?php endforeach;?><?php if(!$frequent):?><tr><td colspan="4" class="empty">No records.</td></tr><?php endif;?></tbody></table></div></section>
<?php page_footer(); ?>
