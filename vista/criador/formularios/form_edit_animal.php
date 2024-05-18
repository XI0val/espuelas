

<div class="content center">
                    <div class="center">
                        <h3>Editar Animal:</h3>
                        <!-- form upload fotos -->
                        <div class="d-flex justify-content-between">
                            <form action="home.php" method="POST" enctype="multipart/form-data">
                                <div class="row g-3 justify-items-center">
                                    <label for="imagen">elige imagenes:</label>
                                    <div class="justify-content-between">
                                        <input type="file" name="imagen"/>
                                        <input type="submit" class="btn btn-primary" name="confoto" value="Subir foto"/>
                                    </div>
                                </div>
                                <p style="font-size:x-small;color:blue"><?php
                                 global $resUpload; echo (isset($_SESSION['uploadMsj']) != null) ?  $_SESSION['uploadMsj'] : ""; 
                                 ?></p>
                                <input type="hidden" name="form" value="au"/>
                            </form>                        
                            <img src="<?php echo $_SESSION['datosAnimal']['imagen'] == '' ? IMAGEN_SIN_FOTO_ANIMAL : $_SESSION['datosAnimal']['imagen']; ?>" 
                            style="border-radius: 50%" alt="ups" width="100" height="100">
                        </div>
                        <form action="home.php" method="POST">
                            <div class="row g-3">
                                <div class="col-4">
                                <label for="nombre" class="form-label">Nombre:</label>
                                    <input name="nombre" type="text" class="form-control" value="<?php echo $_SESSION['datosAnimal']['nombre'];?>" required>
                                </div>
                                <div class="col-4">
                                <label for="raza" class="form-label">Raza:</label>
                                    <input name="raza" type="text" class="form-control" value="<?php echo $_SESSION['datosAnimal']['raza'];?>" required>
                                </div>
                                <div class="col-4">
                                    <label for="sexo" class="form-label">Sexo:</label>
                                    <select name="sexo" class="form-control" required>
                                        <?php
                                            $html = $_SESSION['datosAnimal']['sexo'] == 'macho' ?
                                                "<option value='macho' selected>macho</option>
                                                <option value='hembra'>hembra</option>"
                                                :
                                                "<option value='macho'>macho</option>
                                                <option value='hembra' selected>hembra</option>";
                                            //mostramos select
                                            echo $html;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="id_familia" class="form-label">Familia:</label>
                                    <select name="id_familia" id="id_familia" class="form-control" required>
                                        <?php
                                            $html = "";
                                            global $familias;
                                            foreach($familias as $familia){
                                                if($familia['id_familia'] == $_SESSION['datosAnimal']['id_familia']){
                                                    $html.= "<option value='".$familia['id_familia']."' selected>".$familia['nombre']."</option>";
                                                }else{
                                                    $html.= "<option value='".$familia['id_familia']."'>".$familia['nombre']."</option>";
                                                }
                                            }
                                            //mostramos select
                                            echo $html;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="fech_nacimiento" class="form-label">Fecha Nacimiento:</label>
                                    <input name="fech_nacimiento" type="date" class="form-control" 
                                    value="<?= $_SESSION['datosAnimal']['fech_nacimiento'] ?>" required>                              
                                </div>
                                <div class="col-4">
                                    <label for="esterilizado" class="form-label">¿Esterilizado?</label>
                                    <select name="esterilizado" id="esterilizado"  class="form-control" required>
                                        <?php
                                            $html = $_SESSION['datosAnimal']['esterilizado'] == 'no' ?
                                            "<option value='no' selected>NO</option>
                                                <option value='si'>SI</option>"
                                            :
                                            "<option value='no'>NO</option>
                                                <option value='si' selected>SI</option>"
                                            ;

                                            //mostramos select
                                            echo $html;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="objetivo" class="form-label">Objetivo:</label>
                                    <input name="objetivo" class="form-control" type="text" value="<?php echo $_SESSION['datosAnimal']['objetivo'];?>" required>
                                </div>
                                <div class="col-6">
                                    <label for="id_ubicacion" class="form-label">Ubicación:</label>
                                    <select name="id_ubicacion" class="form-control" required>
                                        <?php
                                            $html = "";
                                            foreach($ubicaciones as $ubicacion){
                                                if($ubicacion['id_ubicacion'] == $_SESSION['datosAnimal']['id_ubicacion']){
                                                    $html.= "<option value='".$ubicacion['id_ubicacion']."' selected>".$ubicacion['nombre']."</option>";
                                                }else{
                                                    $html.= "<option value='".$ubicacion['id_ubicacion']."'>".$ubicacion['nombre']."</option>";
                                                }
                                            }
                                            //mostramos select
                                            echo $html;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input class="btn btn-primary" type="submit" name="editar_animal" value="Actualizar">
                                </div>
                                <div class="col-4">
                                    <input class="btn btn-secondary" type="submit" name="cancelar" value="cancelar" onClick="document.location.href='home.php';">
                                </div>
                                <input type="hidden" name="form" value="au"/>
                            </div>
                        </form>
                    </div>
                </div><!-- fin form -->
