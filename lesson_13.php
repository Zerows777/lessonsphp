<?php
session_start();

if (isset($_REQUEST['submit'])); {
   //Свормировать флеш сообщение!

   $_SESSION['text'] = $_REQUEST['text'];
   header("Location: /task_13.php");
   exit;
}

header("Location: /task_13.php");
