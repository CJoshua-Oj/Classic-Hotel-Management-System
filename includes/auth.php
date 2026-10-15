<?php
declare(strict_types=1);
require_once __DIR__.'/db.php';
function e(mixed $v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function csrf(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function csrf_field(): string { return '<input type="hidden" name="csrf_token" value="'.e(csrf()).'">'; }
function verify_csrf(): void { if($_SERVER['REQUEST_METHOD']==='POST' && !hash_equals($_SESSION['csrf']??'',(string)($_POST['csrf_token']??''))){http_response_code(419);exit('Invalid security token.');}}
function logged_in(): bool { return !empty($_SESSION['employee_id']); }
function login_required(): void { if(!logged_in()) redirect('login.php'); }
function redirect(string $url): never { header('Location: '.$url); exit; }
function user(): ?array { static $u=false; if($u!==false)return $u; if(!logged_in())return null; $s=db()->prepare('SELECT e.*,d.department_name FROM employee e LEFT JOIN department d ON d.department_id=e.department_id WHERE e.employee_id=?');$s->execute([(int)$_SESSION['employee_id']]);return $u=$s->fetch()?:null; }
function flash(string $type,string $message): void { $_SESSION['flashes'][]=[$type,$message]; }
function flashes(): array {$f=$_SESSION['flashes']??[];unset($_SESSION['flashes']);return $f;}
function post(string $key,string $default=''): string {$v=$_POST[$key]??$default;return is_string($v)?trim($v):$default;}
function post_int(string $key,int $default=0): int {$v=filter_var($_POST[$key]??$default,FILTER_VALIDATE_INT);return $v===false?$default:(int)$v;}
function money(mixed $n): string {return number_format((float)$n,2);}
