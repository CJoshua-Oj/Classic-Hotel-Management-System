<?php
declare(strict_types=1);
require_once __DIR__.'/includes/layout.php';
require_once __DIR__.'/includes/helpers.php';
login_required();
$pdo=db();
if($_SERVER['REQUEST_METHOD']==='POST'){
    verify_csrf();
    $type=post('type');
    $cid=post_int('customer');
    $date=post('date',date('Y-m-d'));
    $price=(float)($_POST['price']??0);
    try{
        if($type==='restaurant'){
            $name=post('restaurant');$table=post_int('table_num');
            $pdo->prepare('INSERT INTO restaurant_booking(restaurant_name,customer_id,book_date,table_number,book_price) VALUES(?,?,?,?,?)')->execute([$name,$cid,$date,$table,$price]);
        }elseif($type==='massage_room'){
            $id=post_int('massage');$details=post('details');
            $pdo->prepare('INSERT INTO massage_service(customer_id,massageroom_id,employee_id,massage_date,massage_details,massage_price) VALUES(?,?,?,?,?,?)')->execute([$cid,$id,(int)user()['employee_id'],$date,$details,$price]);
        }elseif($type==='sport_facility'){
            $id=post_int('sport');$details=post('details');
            $pdo->prepare('INSERT INTO do_sport(customer_id,sportfacility_id,employee_id,dosport_date,dosport_details,dosport_price) VALUES(?,?,?,?,?,?)')->execute([$cid,$id,(int)user()['employee_id'],$date,$details,$price]);
        }elseif($type==='medical'){
            $id=post_int('medical');$details=post('details');
            $pdo->prepare('INSERT INTO get_medicalservice(customer_id,medicalservice_id,employee_id,medicalservice_date,getmedicalservice_details,medicalservice_price) VALUES(?,?,?,?,?,?)')->execute([$cid,$id,(int)user()['employee_id'],$date,$details,$price]);
        }else{throw new RuntimeException('Select a valid service type.');}
        service_total($date,$cid);flash('success','Service successfully added.');
    }catch(Throwable $e){flash('error',$e->getMessage());}
    redirect('index.php');
}
page_header('Services','dashboard');?>
<div class="page-head"><h1>Hotel Services</h1><p class="muted">Select a service module.</p></div>
<div class="shortcut-grid"><a href="restaurant.php">Restaurant</a><a href="medical.php">Medical Service</a><a href="sport.php">Sport Facility</a><a href="massage.php">Massage Room</a><a href="room_service.php">Room Service</a><a href="laundry.php">Laundry</a></div>
<?php page_footer();?>
