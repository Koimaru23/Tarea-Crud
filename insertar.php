<?php
include('conexion.php');
$con = connection();

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$sql = "INSERT INTO usuarios (name, lastname, username, password, email) 
        VALUES ('$name', '$lastname', '$username', '$password', '$email')";

$query = mysqli_query($con, $sql);

if($query){
    header("Location: index.php");
}
?>