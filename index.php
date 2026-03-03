<?php
include('conexion.php');
$con = connection();
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

// Lógica para el gráfico: Contamos el total de filas
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
        .navbar { margin-bottom: 30px; }
        .contenedor-principal { max-width: 1100px; }
        th { background-color: #f8f9fa !important; }
        /* Estilo para que el gráfico no sea gigante */
        .chart-container { width: 150px; margin: 0 auto; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Sistema de Usuarios</span>
        </div>
    </nav>

    <div class="container contenedor-principal">

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-start px-4">
                        <h5 class="text-secondary">Resumen Operativo</h5>
                        <h1 class="display-4 fw-bold text-primary"><?= $total_registros ?></h1>
                        <p class="text-muted">Total de registros almacenados en la base de datos.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-container">
                            <canvas id="graficoCircular"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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

    <script>
        const ctx = document.getElementById('graficoCircular');
        new Chart(ctx, {
            type: 'doughnut', // Tipo "Dona" para que parezca un anillo
            data: {
                labels: ['Registros'],
                datasets: [{
                    label: 'Cantidad',
                    data: [<?= $total_registros ?>, 0], // Solo usamos el total
                    backgroundColor: ['#0d6efd', '#e9ecef'], // Azul Bootstrap y gris
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%', // Hace el círculo más delgado
                plugins: {
                    legend: { display: false } // Ocultamos las etiquetas para que sea simple
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>