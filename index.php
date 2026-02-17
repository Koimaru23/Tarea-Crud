<?php
include('conexion.php');
$con = connection();
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head><title>CRUD</title></head>
<body>

    <form action="insertar.php" method="POST">
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="lastname" placeholder="Apellido">
        <input type="text" name="username" placeholder="User">
        <input type="text" name="passowrd" placeholder="Pass">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" value="Agregar">
    </form>

    <hr>

    <?php while($row = mysqli_fetch_array($query)): ?>
        <?= $row['id'] ?> - <?= $row['name'] ?> - <?= $row['lastname'] ?> - <?= $row['username'] ?> - <?= $row['email'] ?> 
        [<a href="editar.php?id=<?= $row['id'] ?>">Editar</a>] 
        [<a href="eliminar.php?id=<?= $row['id'] ?>">Eliminar</a>]
        <br>
    <?php endwhile; ?>

</body>
</html>