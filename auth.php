<?php

session_start(); //Подключаем сессию
$email      = $_POST['email']; // Получаем email из формы
$password   = $_POST['password']; // Получаем пароль из формы



// 1. Нужно получить пользователя по эл. адресу

$pdo = new PDO('mysql:host=localhost; dbname=test_pdo', 'root', ''); // Подключаемся к базе данных test_pdo

$sql = "SELECT * FROM users WHERE  email=:email"; //Написали наш запрос и закинули в переменную $sql - ЕСТЬ ЛИ ТАКОЙ ПОЛЬЗОВАТЕЛЬ С ТАКИМ ЕМЕЙЛОМ+
$statement = $pdo->prepare($sql); //Подготовили - результат переносим в $statement
$statement->execute(['email' => $email]); //на statemente выполняем execute. Передаем в метку execute нужное значение (ассоциативный массив где emeil будет присвоено переменная $tmail, 
// которая имеет значение email  в нашей таблице)
$user = $statement->fetch(PDO::FETCH_ASSOC); //




// 2. Нужно проверить результат запроса (пункт1)
// 2.1. Если пользователь отсутствует, пишем флеш - сообщение: неверный логин или пароль и возвращаем пользователя назад
//создаем условие Если пользователь есть, то выводим флеш сообщение: - пользователь с таким емаилом существует
if (!empty($user)) {
   //Сформируем флеш сообщение
   $_SESSION['error'] = "Пользователь с таким емейлом есть";
   header("Location: /task_15.php"); // Переводим пользователя обратно
   exit;
}



// 3. Если есть пользователь: Сравниваем пароли
// 3.1. Если пароли не совпадают, то пишем флеш - сообщение: неверный логин или пароль
if (!password_verify($password, $user['password'])) {
   $_SESSION['error'] = "Неверный логин или пароль";
   header("Location: /task_15.php"); // Переводим пользователя обратно
   exit;
}
// 4. Записываем пользователя в сессию
$_SESSION['user'] = ["email" => $user['email'], "id" => $user['id']];
// 5. Возвращаем пользователя на страницу Index.php
header("Location /task_15.php");
exit;
//var_dump($user);
//die;




/*/ Если пользователя в базе нет то код пойдет дальше и создаст пользователя в базе

$hashed_password  = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password) VALUE (:email, :password)";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email, 'password' => $hashed_password]);
header("Location: /task_15.php");

if (empty($user)) {
   //Сформируем флэш сообщение
   $_SESSION['error'] = "Пользователь зарегестрирован";
   header("Location /task_15.php");
}
