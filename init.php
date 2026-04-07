<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
	$pdo = new PDO('mysql:host=localhost;dbname=cart;port=3309', 'root', 'root');
} catch (PDOException $e) {
	die('Error: ' . $e->getMessage());
}

session_set_cookie_params([
	'lifetime' => 3600 * 24 * 31,
	'path' => '/',
	'domain' => $_SERVER['HTTP_HOST'],
	'secure' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
	'httponly' => true,
	'samesite' => 'Lax'
]);

session_start();
?>
