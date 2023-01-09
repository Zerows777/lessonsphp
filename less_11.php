<?php
session_start();
$text = $_POST['text'];

$pdo = new PDO("mysql:host=localhost; dbname=test_pdo;", "root", "");
$sql = "SELECT * FROM task_BD WHERE text=:text";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
   $message = "ВВЕДЕННАЯ ЗАПИСЬ УЖЕ ПРИСУТСТВУЕТ В БАЗЕ.";
   $_SESSION['danger'] = $message;
   header("Location: /task_11.php");
   exit;
}

$sql = "INSERT INTO task_BD (text) VALUE (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

$message = "ВВЕДЕННАЯ ЗАПИСЬ УЖЕ ПРИСУТСТВУЕТ В БАЗЕ.";
$_SESSION['success'] = $message;

header("location: /task_11.php");
