<?php
 if(isset ($_GET["id"])){
$id=$_GET['id'];
$servername='localhost';
$username='root';
$password='melvin123';
$database='students';

$connection=new mysqli($servername,$username,$password,$database);
$sql="DELETE FROM class WHERE id=$id";
$connection->query($sql);
 }

 header("location:/class_CRUD/index.php");
 exit;
?>