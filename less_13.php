<?php
session_start();
$text = $_POST['text'];
/*
$pdo = new PDO("mysql:host=localhost; dbname=repead;", "root", "");
$sql = "INSERT INTO less_13 (text) VALUE (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);
*/
$messege = $text;
$_SESSION['danger'] = $messege;
header("Location: /task_13.php");
exit;
