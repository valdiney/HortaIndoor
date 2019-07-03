<?php 

try {
	$pdo = new PDO("mysql:host=localhost;dbname=horta", "root", "");
} catch (PDOException $e) {
	echo $e->getMessage();
 }
