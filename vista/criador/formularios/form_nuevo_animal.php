        <div class="content center forms">
                    <div class="text-center title-form">
                        <h1>Nuevo Animal:</h1>
                        <!-- form upload fotos -->
                        <div class="row">
                         <div class="d-flex justify-content-between">
                            <form action="home.php" method="POST" enctype="multipart/form-data">
                                <div class="row g-3 justify-items-center photo-form">
                                    <label for="imagen"><h3>Elige una imagen:</h3></label>
                                    <div class="justify-content-between btn-upph">
                                        <input type="file" name="imagen"/>
                                        <input type="submit" class="btn btn-primary" name="confoto" value="Subir foto"/>
                                    </div>
                                </div>
                                <p style="font-size:x-small;color:blue"><?php
                                 global $resUpload; echo (isset($_SESSION['uploadMsj']) != null) ?  $_SESSION['uploadMsj'] : ""; 
                                 ?></p>
                                <input type="hidden" name="form" value="ac"/>
                            </form> 
                            <?php if(!isset($_SESSION["datosAnimal"]) || isset($_SESSION["datosAnimal"]['id_animal']) > 0) {
                                echo '<img src=' . IMAGEN_SIN_FOTO_ANIMAL . ' alt="ups" width="100" height="100">';
                            }else{ echo '<img src=' . $_SESSION['datosAnimal']['imagen'] . ' alt="ups" width="100" height="100">';}?>

                        </div>    
                        </div> <!-- fin row -->  

                    <div class="row">
                      <div class="col-12 formularios">                                                
                        <form action="home.php" method="POST">
                            <div class="row g-3">
                                <div class="col-4">
                                <label for="nombre" class="form-label"><h4>Nombre:</h4></label>
                                    <input class="form-control" type="text" name="nombre" placeholder="nombre" required>
                                </div>
                                <div class="col-4">
                                <label for="raza" class="form-label"><h4>Raza:</h4></label>
                                    <select name="raza" class="form-control" required>
                                        <?php
                                            $html = "";
                                            foreach(RAZAS as $key => $value){
                                                $html.= "<option value='".$value."' >".$value."</option>";
                                            }
                                            //mostramos select
                                            echo $html;
                                        ?>
                                    </select>

                                </div>
                                <div class="col-4">
                                    <label for="sexo" class="form-label">Sexo:</label>
                                    <select name="sexo" class="form-control" required>
                                        <?php
                                            $html = "
                                                <option value='macho' selected>macho</option>
                                                <option value='hembra'>hembra</option>
                                            ";

                                            //mostramos select
                                            echo $html;
                                        ?>
                                    </select>
                                </div>

                                <div class="col-4">
                                <label for="id_familia" class="form-label">Familia:</label>
                                    <select name="id_familia" id="id_familia" class="form-control" required>
                                        <?php
                                            global $familias;
                                            $html = "";
                                            foreach($familias as $familia){
                                                $html.= "<option value='".$familia['id_familia']."'>".$familia['nombre']."</option>";
                                            }
                                            //mostramos select
                                            echo $html;
                                            ?>
                                    </select>
                                </div>
                                
                                <div class="col-4">
                                    <label for="fech_nacimiento" class="form-label">Fecha Nacimiento:</label>
                                    <input type="date" id="fech_nacimiento" name="fech_nacimiento" class="form-control" required/>                               
                                </div>
                                <div class="col-4">
                                    <label for="esterilizado" class="form-label">¿Esterilizado?</label>
                                    <select name="esterilizado" id="esterilizado" class="form-control" required>
                                        <?php
                                            $html = "
                                            <option value='no' selected>NO</option>
                                            <option value='si'>SI</option>
                                            ";

                                            //mostramos select
                                            echo $html;
                                            ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="objetivo" class="form-label">Objetivo:</label>
                                    <input type="text" id="objetivo" name="objetivo" class="form-control"/>
                                </div>
                                <div class="col-6">
                                    <label for="id_ubicacion" class="form-label">Ubicación:</label>
                                    <select name="id_ubicacion" class="form-control" required>
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

                            
                                <div class="col-2">
                                    <input type="submit" class="btn btn-primary" name="nuevo_animal" value="Añadir">
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="btn btn-secondary" class="form-control" name="cancelar" value="cancelar" onClick="document.location.href='home.php';">
                                </div>
                                <input type="hidden" name="form" value="ac"/>                            
                            </div>
                        </form>
                        </div>
                        </div> <!-- fin row --> 
                    </div>
                </div><!-- fin form -->