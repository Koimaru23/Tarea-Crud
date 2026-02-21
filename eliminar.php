<?php
include('conexion.php');
$con = connection();
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM usuarios WHERE id='$id'");
header("Location: index.php");
?>