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
