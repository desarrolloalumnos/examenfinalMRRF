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
              Reservaciones
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenfinalMRRF/reservacionesadmin">Administrar Reservaciones</a></li>
            <!-- <li><a class="dropdown-item" href="/examenfinalMRRF/estadistica">Calendario de Reservaciones</a></li> -->
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reporte de Gráficas
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenfinalMRRF/lista/estadistica">Reporte de cantidad de Habitaciones Disponibles, Ocupadas y Limpieza</a></li>
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
<br><br><br>
<h1 class="text-center">Administrador de Habitaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioHabitaciones">
        <input type="hidden" name="habitacion_id" id="habitacion_id">
        <div class="row mb-3">
            <div class="col">
                <label for="habitacion_numero">Ingrese el numero de habitacion</label>
                <input type="number" name="habitacion_numero" id="habitacion_numero" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="habitacion_tipo">Ingrese el tipo de habitacion</label>
                <input type="text" name="habitacion_tipo" id="habitacion_tipo" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
                <div class="col">
                <label for="habitacion_descripcion">Descripcion de la habitacion</label>
                <input type="text" name="habitacion_descripcion" id="habitacion_descripcion" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="habitacion_tarifa">Tarifa de la habitacion</label>
                <input type="number" name="habitacion_tarifa" id="habitacion_tarifa" class="form-control" >
            </div>
            <div class="col">
                <label for="habitacion_disponibilidad">Disponibilidad de la habitacion</label>
                <input type="text" name="habitacion_disponibilidad" id="habitacion_disponibilidad" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioHabitaciones" id="btnGuardar" data-saludo="hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
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

<div class="row justify-content-center">
    <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaHabitaciones" class="table table-bordered table-hover">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/habitacionesempleados/index.js')  ?>"></script>