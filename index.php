<?php
include('conexion.php');
$con = connection();
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar { margin-bottom: 30px; }
        .contenedor-principal { max-width: 1100px; }
        th { background-color: #f8f9fa !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Sistema de Usuarios</span>
        </div>
    </nav>

    <div class="container contenedor-principal">
        
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-body">
                <h4 class="card-title text-secondary mb-4">Agregar Nuevo Registro</h4>
                <form action="insertar.php" method="POST" class="row g-2">
                    <div class="col-md-2">
                        <input type="text" name="name" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="lastname" class="form-control" placeholder="Apellido" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="username" class="form-control" placeholder="Usuario" required>
                    </div>
                    <div class="col-md-2">
                        <input type="password" name="password" class="form-control" placeholder="Clave" required>
                    </div>
                    <div class="col-md-2">
                        <input type="email" name="email" class="form-control" placeholder="Correo" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Registrar</button>
                    </div>
                </form>
            </div>
        </div>

        <h4 class="text-secondary mb-3">Lista de Usuarios</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td class="text-muted"><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><span class="badge bg-light text-dark border">@<?= $row['username'] ?></span></td>
                        <td><?= $row['email'] ?></td>
                        <td class="text-center">
                            <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                            <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Deseas eliminarlo?')">Borrar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>