<?php

?>
<div class="content center forms">
    <div class="text-center title-form">
        <h1>Actualizar ubicación:</h1>
        <div class="row">
        <form action="home.php" method="POST">
            <div class="row g-3">
                <div class="col-6">
                    <label for="ubicacion" class="form-label">Ubicación:</label>
                    <input class="form-control" type="text" name="ubicacion" value="<?php echo $_SESSION['datosUbicacion']['nombre'];?>" required>
                </div>
                <div class="col-6">
                    <label for="nombre" class="form-label">Nuevo nombre:</label>
                    <input class="form-control" type="text" name="nombre" placeholder="nuevo nombre" required>
                </div>
                <div class="col-6">
                    <label for="latitud" class="form-label">Latitud:</label>
                    <input class="form-control" type="text" name="latitud" value="<?php echo $_SESSION['datosUbicacion']['latitud'];?>" required>
                </div>
                <div class="col-6">
                    <label for="longitud" class="form-label">Longitud:</label>
                    <input class="form-control" type="text" name="longitud" value="<?php echo $_SESSION['datosUbicacion']['longitud'];?>" required>
                </div>
                <div class="col-4">
                    <input class="btn btn-primary" type="submit" name="editar_ubicacion" value="Actualizar">
                </div>
                <div class="col-4">
                    <input class="btn btn-secondary" type="submit" name="cancelar" value="cancelar" onClick="document.location.href='home.php';">
                </div>
                <input type="hidden" name="form" value="uu"/>
            </div>
        </form>
        </div> <!-- fin row -->
    </div>
</div>