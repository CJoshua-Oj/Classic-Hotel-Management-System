<?php
declare(strict_types=1);
require_once __DIR__.'/config.php';
function h(mixed $v):string{return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
$msg='';$ok=false;
if($_SERVER['REQUEST_METHOD']==='POST'){
 try{
  $host=trim((string)($_POST['host']??DB_HOST));$port=trim((string)($_POST['port']??DB_PORT));$name=trim((string)($_POST['name']??DB_NAME));$dbuser=trim((string)($_POST['user']??DB_USER));$pass=(string)($_POST['pass']??DB_PASS);
  $pdo=new PDO("mysql:host=$host;port=$port;charset=utf8mb4",$dbuser,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
  $pdo->exec("CREATE DATABASE IF NOT EXISTS `".str_replace('`','``',$name)."` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
  $pdo=new PDO("mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4",$dbuser,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
  $sql=file_get_contents(__DIR__.'/database/database.sql');$sql=preg_replace('/^CREATE DATABASE.*?;\s*USE `hotel`;\s*/s','',$sql);
  $pdo->exec($sql);
  $u=trim((string)($_POST['admin_user']??'admin'));$pw=(string)($_POST['admin_pass']??'admin123');$fn=trim((string)($_POST['first_name']??'System'));$ln=trim((string)($_POST['last_name']??'Administrator'));$email=trim((string)($_POST['email']??'admin@example.com'));
  $s=$pdo->prepare("INSERT INTO employee(employee_username,employee_password,employee_firstname,employee_lastname,employee_telephone,employee_email,department_id,employee_type,employee_salary,employee_hiring_date) VALUES(?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE employee_password=VALUES(employee_password),employee_firstname=VALUES(employee_firstname),employee_lastname=VALUES(employee_lastname),employee_email=VALUES(employee_email)");
  $s->execute([$u,password_hash($pw,PASSWORD_DEFAULT),$fn,$ln,'',$email,null,'Administrator',0,date('Y-m-d')]);$ok=true;
 }catch(Throwable $e){$msg=$e->getMessage();}
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Install - Classic Hotel Management System</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body class="auth-page"><div class="auth-card wide"><h1>Classic Hotel Management System</h1><p>PHP 8.3 native installation</p>
<?php if($ok):?><div class="alert success">Installation completed. You can now sign in.</div><a class="btn primary" href="login.php">Open Login</a><?php else:?>
<?php if($msg):?><div class="alert error"><?=h($msg)?></div><?php endif;?>
<form method="post"><h2>Database</h2><div class="form-grid"><label>Host<input name="host" value="<?=h($_POST['host']??DB_HOST)?>"></label><label>Port<input name="port" value="<?=h($_POST['port']??DB_PORT)?>"></label><label>Database<input name="name" value="<?=h($_POST['name']??DB_NAME)?>"></label><label>Username<input name="user" value="<?=h($_POST['user']??DB_USER)?>"></label><label class="full">Password<input type="password" name="pass" value="<?=h($_POST['pass']??DB_PASS)?>"></label></div>
<h2>Administrator</h2><div class="form-grid"><label>First Name<input name="first_name" value="<?=h($_POST['first_name']??'System')?>" required></label><label>Last Name<input name="last_name" value="<?=h($_POST['last_name']??'Administrator')?>" required></label><label>Username<input name="admin_user" value="<?=h($_POST['admin_user']??'admin')?>" required></label><label>Email<input type="email" name="email" value="<?=h($_POST['email']??'admin@example.com')?>" required></label><label class="full">Password<input type="password" name="admin_pass" value="<?=h($_POST['admin_pass']??'admin123')?>" minlength="6" required></label></div><button class="btn primary">Install Database</button></form><?php endif;?></div></body></html>