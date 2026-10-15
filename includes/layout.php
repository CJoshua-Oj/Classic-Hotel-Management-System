<?php
declare(strict_types=1);
require_once __DIR__.'/auth.php';
function page_header(string $title,string $active=''): void {
    $u=user();
    ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=e($title)?> | <?=e(APP_NAME)?></title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
 <a class="brand" href="index.php"><span class="brand-mark">CH</span><span><?=e(APP_NAME)?></span></a>
 <?php if($u): ?><div class="top-user"><?=e(($u['employee_firstname']??'').' '.($u['employee_lastname']??''))?> <a href="logout.php">Logout</a></div><?php endif; ?>
</header>
<div class="layout">
<aside class="sidebar">
 <nav>
 <?php $links=[
 ['Dashboard','index.php','dashboard'],['Customers','customers.php','customer'],['Employees','employees.php','employee'],
 ['Departments','departments.php','departments'],['Reservations','reservations.php','reservation'],['Rooms','rooms.php','room'],
 ['Room Types','room_types.php','room_type'],['Restaurants','restaurants.php','restaurant'],
 ['Medical Service','medical_services.php','medical'],['Sport Facility','sport_facilities.php','sport'],
 ['Massage Room','massage_rooms.php','massage'],['Room Service','room_services.php','room_service'],
 ['Laundry','laundry.php','laundry'],['Search','search.php','search'],['Reports','reports.php','reports']
 ]; foreach($links as $l): ?><a class="<?=$active===$l[2]?'active':''?>" href="<?=$l[1]?>"><?=$l[0]?></a><?php endforeach;?>
 </nav>
</aside>
<main class="content">
<?php foreach(flashes() as $f): ?><div class="alert <?=$f[0]?>"><?=e($f[1])?></div><?php endforeach; ?>
<?php
}
function page_footer(): void { ?>
</main></div>
<footer class="footer"><?=e(APP_NAME)?> v<?=e(APP_VERSION)?> · PHP 8.3</footer>
<script src="assets/js/app.js"></script>
</body></html>
<?php }
