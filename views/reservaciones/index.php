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