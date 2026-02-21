<?php 
include("conexion.php");
$con = connection();
$id = $_GET['id'];

if ($_POST) {
    $name = $_POST['name']; 
    $lastname = $_POST['lastname']; 
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    $email = $_POST['email'];
    
    mysqli_query($con, "UPDATE usuarios SET name='$name', lastname='$lastname', username='$username', password='$password', email='$email' WHERE id='$id' ");
    header("Location: index.php");
}

$row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM usuarios WHERE id='$id'"));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Editar Datos del Usuario</h2>
                
                <form method="POST" class="border p-4 rounded bg-light">
                    <div class="mb-3">
                        <label>Nombre:</label>
                        <input type="text" name="name" class="form-control" value="<?= $row['name']?>">
                    </div>
                    
                    <div class="mb-3">
                        <label>Apellido:</label>
                        <input type="text" name="lastname" class="form-control" value="<?= $row['lastname']?>">
                    </div>

                    <div class="mb-3">
                        <label>Usuario:</label>
                        <input type="text" name="username" class="form-control" value="<?= $row['username']?>">
                    </div>

                    <div class="mb-3">
                        <label>Contraseña:</label>
                        <input type="text" name="password" class="form-control" value="<?= $row['password']?>">
                    </div>

                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="<?= $row['email']?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="index.php" class="btn btn-link text-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>