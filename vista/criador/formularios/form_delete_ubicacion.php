<div class="content center">
    <div class="center">
        <h3>Eliminar ubicación:</h3>
        <form action="home.php" method="POST">
            <div class="row g-3">
                <div class="col-12">
                    <label for="id_ubicacion" class="form-label">ubicación:</label>
                    <select name="id_ubicacion" class="form-control" >
                        <?php
                            $html = "";
                            foreach($ubicaciones as $ubicacion){
                                $html.= "<option value='".$ubicacion['id_ubicacion']."' selected>".$ubicacion['nombre']."</option>";
                            }
                            //mostramos select
                            echo $html;
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <input class="btn btn-primary" type="submit" name="borrar ubicacion" value="eliminar">
                </div>
                <div class="col-4">
                    <input class="btn btn-secondary" type="submit" name="cancelar" value="cancelar" onClick="document.location.href='home.php';">
                </div>
            </div>

            <input type="hidden" name="form" value="ud"/>
        </form>
    </div>
</div>