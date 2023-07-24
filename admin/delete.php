<?php 
include("../database/db.php");
$id=$_GET['id'];
$result = $conn->prepare("DELETE FROM menu WHERE id=?");
$result->bindValue(1,$id);
$result->execute();
header("location:menu.php");
if($_SESSION['role'] != 2){
    header('location:../');

}

?>