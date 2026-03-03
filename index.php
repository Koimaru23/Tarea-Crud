<?php
include('conexion.php');
$con = connection();
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

// Contamos el total para mostrarlo en el centro del círculo
$total_registros = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea CRUD - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .contenedor-principal { max-width: 1100px; padding-top: 20px; }
        .chart-container { width: 150px; height: 150px; position: relative; margin: 0 auto; }
        .chart-number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 28px;
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Sistema de Usuarios</span>
        </div>
    </nav>

    <div class="container contenedor-principal">

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-start px-4">
                        <h5 class="text-secondary text-uppercase small fw-bold">Estado de la Base de Datos</h5>
                        <h2 class="display-5 fw-bold text-dark"><?= $total_registros ?> <span class="fs-4 text-muted">Usuarios</span></h2>
                        <p class="text-muted small">Métrica actualizada en tiempo real según los registros activos.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-container text-center">
                            <canvas id="graficoCircular"></canvas>
                            <div class="chart-number"><?= $total_registros ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-body">
                <h4 class="card-title text-secondary mb-4">Agregar Nuevo Registro</h4>
                <form action="insertar.php" method="POST" class="row g-2">
                    <div class="col-md-2"><input type="text" name="name" class="form-control" placeholder="Nombre" required></div>
                    <div class="col-md-2"><input type="text" name="lastname" class="form-control" placeholder="Apellido" required></div>
                    <div class="col-md-2"><input type="text" name="username" class="form-control" placeholder="Usuario" required></div>
                    <div class="col-md-2"><input type="password" name="password" class="form-control" placeholder="Clave" required></div>
                    <div class="col-md-2"><input type="email" name="email" class="form-control" placeholder="Correo" required></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-primary w-100 fw-bold">Registrar</button></div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle bg-white shadow-sm">
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
                        <td class="text-muted small"><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><span class="badge bg-light text-dark border">@<?= $row['username'] ?></span></td>
                        <td><?= $row['email'] ?></td>
                        <td class="text-center">
                            <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                            <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar?')">Borrar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('graficoCircular');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [100], // Se mantiene "lleno" visualmente
                    backgroundColor: ['#0d6efd'], 
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '85%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                events: [] // Desactiva interacciones para que sea solo visual
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>