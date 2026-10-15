<?php
declare(strict_types=1);

const APP_NAME = 'Classic Hotel Management System';
const APP_VERSION = '2.0.0';
const DB_HOST = '127.0.0.1';
const DB_PORT = '3306';
const DB_NAME = 'hotel';
const DB_USER = 'root';
const DB_PASS = '';
const APP_TIMEZONE = 'Africa/Lagos';

date_default_timezone_set(APP_TIMEZONE);
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('classic_hotel');
    session_start();
}
