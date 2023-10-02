<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 56px;
      position: relative;
      min-height: 100vh;
    }
    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      text-align: center;
      padding: 10px 0;
      background-color: #f8f9fa;
    }
  </style>
  <title>Navbar con Bootstrap</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <a class="navbar-brand" href="#">
  <img src="<?= asset('images/cit.png') ?>" alt="Logotipo" style="max-width: 40px; height: auto;">
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<a class="navbar-brand" href="#">Examen Final</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Habitaciones Del Hotel
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenfinalMRRF/habitacionesclientes">Administrar Habitaciones</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reservaciones
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenfinalMRRF/reservacionescliente">Administrar Reservaciones</a></li>
            <!-- <li><a class="dropdown-item" href="/examenfinalMRRF/estadistica">Calendario de Reservaciones</a></li> -->
            </ul>
          </li>

        </ul>
        </div>
    <div class="d-flex">
      <a href="/examenfinalMRRF/menuCliente" class="btn btn-info me-2">Menu Principal</a>
      <a href="/examenfinalMRRF/logout" class="btn btn-danger">Cerrar Sesión</a>
    </div>
  </div>
</nav>

<h1>DISPONIBILIDAD DE HABITACIONES</h1>
<div class="row">
    <div class="col-lg-9">
        <canvas id="chartdisponibilidad" width="100%"></canvas>
    </div>
</div>
<button id="regresarBtn" style="background-color: red; color: white;">Regresar</button>
<script src="<?=asset('./build/js/disponibilidad/estadistica.js')?>"></script>
<script>
    document.getElementById('regresarBtn').addEventListener('click', function() {
        window.location.href = '/examenfinalMRRF/menuAdministrador';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>