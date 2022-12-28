                                  <form action="config.php" method="post">
                                        <label class="form-label" for="simpleinput">Text</label>
                                        <input type="text" id="simpleinput" class="form-control" name="text">
                                        <button class="btn btn-success mt-3" type = "submit">Submit</button>
                                    </form>
//обработчик
<?php

$text = $_POST['text'];

$pdo = new PDO("mysql:host=localhost;dbname=test_pdo;", "root", "");
$sql = "INSERT INTO lesson_10 (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement -> execute(['text' => $text]);



header("location:/task_10.php");
//var_dump($_POST);


?>
