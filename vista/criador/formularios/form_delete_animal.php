<div class="content center">
    <div class="center">
        <h3>Eliminar animal:</h3>
        <form action="home.php" method="POST">
            <div class="row g-3">
                <div class="col-12">
                    <label for="id_animal" class="form-label">animal:</label>
                    <select name="id_animal" class="form-control" >
                        <?php
                            $html = "";
                            foreach($animales as $animal){
                                $html.= "<option value='".$animal['id_animal']."' selected>".$animal['nombre']."</option>";
                            }
                            //mostramos select
                            echo $html;
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <input class="btn btn-primary" type="submit" name="borrar animal" value="eliminar">
                </div>
                <div class="col-4">
                    <input class="btn btn-secondary" type="submit" name="cancelar" value="cancelar" onClick="document.location.href='home.php';">
                </div>
            </div>

            <input type="hidden" name="form" value="ad"/>
        </form>
    </div>
</div>