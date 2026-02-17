<?php 
include("conexion.php");
$con = connection();
$id = $_GET['id'];

if ($_POST) {
    $name = $_POST['name']; $last = $_POST['lastname']; $user = $_POST['username']; $pass = $_POST['passowrd']; $mail = $_POST['email'];
    mysqli_query($con, "UPDATE usuarios SET name='$name', lastname='$last', username='$user', passowrd='$pass', email='$mail' WHERE id='$id'");
    header("Location: index.php");
}

$row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM usuarios WHERE id='$id'"));
?>
<form method="POST">
    <input type="text" name="name" value="<?= $row['name']?>">
    <input type="text" name="lastname" value="<?= $row['lastname']?>">
    <input type="text" name="username" value="<?= $row['username']?>">
    <input type="text" name="passowrd" value="<?= $row['passowrd']?>">
    <input type="text" name="email" value="<?= $row['email']?>">
    <input type="submit" value="Guardar">
</form>