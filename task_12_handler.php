<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO('mysql:host=localhost; dbname=test_pdo', 'root', '');

$sql = "SELECT * FROM lesson_12 WHERE  email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!empty($user)) {
   //Свормировать флеш сообщение!
   $_SESSION['error'] = "Пользователь уже существует!";
   header("Location: /task_12.php");
   exit;
}


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `lesson_12` (email, password) VALUES (:email, :password)";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email, 'password' => $hashed_password]);
