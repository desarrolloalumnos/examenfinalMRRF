<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 56px;
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
            <a class="nav-link dropdown-toggle" href="#" id="usuariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuarios Pendientes
            </a>
            <ul class="dropdown-menu" aria-labelledby="usuariosDropdown">
              <li><a class="dropdown-item" href="/examenfinalMRRF/activacion">Solicitud de Usuarios Pendientes</a></li>
              <li><a class="dropdown-item" href="/examenfinalMRRF/lista">Lista de Usuarios Activos</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Habitaciones Del Hotel
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenfinalMRRF/habitacionesadmin">Administrar Habitaciones</a></li>
            </ul>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reporte de Gráficas
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenfinalMRRF/graficaAdmin">Reporte de cantidad de Habitaciones Disponibles, Ocupadas y Limpieza</a></li>
            </ul>
          </li>
        </ul>
        </div>
    <div class="d-flex">
      <a href="/examenfinalMRRF/menuAdministrador" class="btn btn-info me-2">Menu Principal</a>
      <a href="/examenfinalMRRF/logout" class="btn btn-danger">Cerrar Sesión</a>
    </div>
  </div>
</nav>

<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioClientes">
        <h1 class="text-center">RESERVACIONES</h1>
        <input type="hidden" name="reserva_id" id="reserva_id">

        <div class="row mb-4 mt-3">
            <div class="col-lg-12">
                <label for="select">CLIENTES</label>
                <select class="form-control" name="reserva_cliente_id" id="reserva_cliente_id">
                    <option id="cliente" value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cliente) { ?>
                        <option value="<?= $cliente['usu_id']  ?>"><?= $cliente['usu_nombre']  ?></option>
                    <?php  }  ?>
                </select>
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-12">
                <label for="select">HABITACIONES</label>
                <select class="form-control" name="reserva_habitacion_id" id="reserva_habitacion_id">
                    <option id="habitacion" value="">Seleccione una habitacion</option>
                    <?php foreach ($habitaciones as $habitacion) { ?>
                        <option value="<?= $habitacion['habitacion_id']  ?>"><?= $habitacion['habitacion_numero']  ?></option>
                    <?php  }  ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cliente_fecha">ENTRADA</label>
                <input type="datetime-local" name="reserva_fecha_inicio" id="reserva_fecha_inicio" class="form-control mb-3">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cliente_fecha">SALIDA</label>
                <input type="datetime-local" name="reserva_fecha_fin" id="reserva_fecha_fin" class="form-control mb-3">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="button"  id="btnGuardar" data-saludo="hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>


<div class="row justify-content-center ">
    <div class="col table-responsive" style="max-width: 70%; padding: 10px;">

        <table id="tablaClientes" class="table table-bordered table-hover  ">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/reservaciones/index.js')  ?>"></script>