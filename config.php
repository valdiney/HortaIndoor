<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

date_default_timezone_set('America/Bahia');

require_once('helpers.php');

require_once('database/database.php');
$db = $pdo;