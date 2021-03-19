<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> HW-I: To Do List App </title>
</head>

<body>
<h1>Homework-I: Building Simple To Do List App</h1>
<h2>Create Your To Do List</h2>

<?php
/*Kodluyoruz Path PHP Talent Bootcamp, Feb 2021
@author: Volkan Şengül
@student: Gamze Yazgeldi
Homework I: Building To Do List Application */

//Takes config.php and todolist.php files' codes (classes, methods, variables) and copies into this files:
include('config.php');
include('todolist.php');

$app = new TodoList( date('Ymd') );  //TodoList file is created by date format.

$todolist = $app->getTodos();
$reqMethod = $_SERVER['REQUEST_METHOD'];   //Request methods which are get, post, file, delete..

// Turn off error reporting.
error_reporting(0);

switch($reqMethod){
    case 'POST':    //In POST case
        $app->add();
        break;
    case 'GET':     //In GET case
        if ($_GET['action']==='delete' && !empty($_GET['id'])){
            $app->delete($_GET['id']);
        }
        break;
}

$todolist = $app->getTodos();
?>

<form action="index.php" method="post">
    <label for="To Do Name">To Do Name:</label>
    <input id="To Do Name" name="mytodo" type="text" required placeholder="Type your todo here.">
    <br\>
    <label for="Created Date">Created Date:</label>
    <input id="Created Date" name="todo_date" type="datetime-local">
    <br\>
    <label for="Priority Level">Priority Level:</label>
    <input id="Priority Level" name="todo_priority_level" type="number" required min="1" max="5">

    <input type="submit" value="Add">
</form>

<ul>
    <?php
    foreach($todolist as $k=>$v){   //Each element of todolist array as key and value.
        echo '<li><div style="display:inline-block">'.$v.'</div> <form action="/index.php" style="display:inline-block" >
            <input type="hidden" value="delete" name="action" />
            <input type="hidden" value="'.($k+1).'" name="id" />
            <input type="submit" value="Mark your todo as done." />
            </form>
            </li>';
    }
    ?>
</ul>
</body>
</html>
