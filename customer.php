<?php
declare(strict_types=1);
require_once __DIR__.'/includes/layout.php';login_required();$pdo=db();$reference=post('reference')?:($_GET['reference']??'reservation');
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();if(post('action')==='save'){ $d=[post('customer_firstname'),post('customer_lastname'),post('customer_TCno'),post('customer_city'),post('customer_country'),post('customer_telephone'),post('customer_email')];if($d[0]&&$d[1]&&$d[2]&&$d[6]){$pdo->prepare('INSERT INTO customer(customer_firstname,customer_lastname,customer_TCno,customer_city,customer_country,customer_telephone,customer_email) VALUES(?,?,?,?,?,?,?)')->execute($d);flash('success','Customer added successfully.');redirect($reference==='reservation'?'reservation.php':'customers.php');}flash('error','First name, last name, TC number and email are required.');}}
page_header('Add Customer','customer');?>
<div class="page-head"><h1>Add Customer</h1><a class="btn" href="<?=$reference==='reservation'?'reservation.php':'customers.php'?>">Back</a></div>
<form class="card form-grid" method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="reference" value="<?=e($reference)?>">
<label>First name<input name="customer_firstname" required></label><label>Last name<input name="customer_lastname" required></label><label>TC no<input name="customer_TCno" required></label><label>Telephone<input name="customer_telephone"></label><label>Email<input type="email" name="customer_email" required></label><label>City<input name="customer_city"></label><label>Country<input name="customer_country"></label><div class="full"><button class="btn primary">Save Customer</button></div></form>
<?php page_footer();?>
