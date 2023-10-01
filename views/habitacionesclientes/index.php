<nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg">
    <a class="navbar-brand" href="/examenfinalMRRF/menu">Menú Principal</a>

    <!-- Enlaces del menú -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/examenfinalMRRF/habitaciones">Tabla de datos</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="/examenfinalMRRF/habitaciones/estadistica">Estadistica</a>
            </li>
        </ul>
    </div>
    <a href="/examenfinalMRRF/logout" class="btn btn-danger">Cerrar sesión</a>
</nav>
<h1 class="text-center">Buscar Habitaciones</h1>
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
            <!-- <div class="col">
                <button type="submit" form="formularioHabitaciones" id="btnGuardar" data-saludo="hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
            </div> -->
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

<script src="<?= asset('./build/js/habitacionesclientes/index.js')  ?>"></script>