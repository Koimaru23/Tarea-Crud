<?php
include('conexion.php');
$con = connection();

$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

$total_registros = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f8f9fa; font-family: sans-serif; }
        .navbar { background-color: #212529; color: white; padding: 10px 0; }
        .card { border: none; border-radius: 8px; margin-top: 20px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .chart-container { width: 140px; height: 140px; position: relative; margin-left: auto; }
        .chart-number {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            font-size: 28px; font-weight: bold; color: #0d6efd;
        }
        .table thead th { background-color: #fff; color: #333; border-top: none; }
        .badge-user { background-color: #f1f3f5; color: #495057; border: 1px solid #dee2e6; font-weight: normal; }
        .btn-action { padding: 0.25rem 0.75rem; font-size: 0.875rem; }
    </style>
</head>
<body>

    <nav class="navbar shadow-sm">
        <div class="container">
            <span class="fw-bold">Sistema de Usuarios</span>
        </div>
    </nav>

    <div class="container" style="max-width: 1100px;">
        
        <div class="card p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="text-muted small fw-bold text-uppercase mb-3" style="letter-spacing: 1px;">ESTADO DE LA BASE DE DATOS</h6>
                    <h1 class="display-5 fw-bold text-dark mb-0"><?= $total_registros ?> <span class="fs-3 fw-normal text-muted">Usuarios</span></h1>
                    <p class="text-muted mt-1">Total de todos los registrados.</p>
                </div>
                <div class="col-md-4">
                    <div class="chart-container">
                        <canvas id="graficoDona"></canvas>
                        <div class="chart-number"><?= $total_registros ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-4 mt-4">
            <h4 class="text-secondary mb-4">Agregar Nuevo Registro</h4>
            <form action="insertar.php" method="POST" class="row g-2">
                <div class="col-md-2"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
                <div class="col-md-2"><input type="text" name="apellido" class="form-control" placeholder="Apellido" required></div>
                <div class="col-md-2"><input type="text" name="username" class="form-control" placeholder="Usuario" required></div>
                <div class="col-md-2"><input type="password" name="password" class="form-control" placeholder="Clave" required></div>
                <div class="col-md-2"><input type="email" name="email" class="form-control" placeholder="Correo" required></div>
                <div class="col-md-2"><button type="submit" class="btn btn-primary w-100 fw-bold">Registrar</button></div>
            </form>
        </div>

        <div class="card mt-4 overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID</th>
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
                        <td class="ps-3 text-muted"><?= $row['id'] ?></td>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['apellido'] ?></td>
                        <td><span class="badge badge-user">@<?= $row['username'] ?></span></td>
                        <td><?= $row['email'] ?></td>
                        <td class="text-center">
                            <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm btn-action mx-1">Editar</a>
                            <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm btn-action mx-1" onclick="return confirm('¿Deseas borrarlo?')">Borrar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('graficoDona');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [100],
                    backgroundColor: ['#0d6efd'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '82%',
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                events: []
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>