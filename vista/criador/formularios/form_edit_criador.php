                <div class="content center forms">
                   
                    <div class="text-center title-form">
                        <h1>Editar Perfil:</h1>
                        <!-- form upload foto -->
                        <div class="row">
                        <div class="d-flex justify-content-between">
                            <form action="home.php" method="POST" enctype="multipart/form-data">
                                <div class="row g-3 justify-items-center photo-form">
                                    <label for="imagen"><h3>Elige una imagen de perfil:</h3></label>
                                    <div class="justify-content-between btn-upph">
                                        <input type="file" name="imagen"/>
                                        <input type="submit" class="btn btn-primary" name="confoto" value="Subir foto"/>
                                    </div>
                                </div>
                                <p style="font-size:x-small;color:blue"><?php
                                 global $resUpload; echo (isset($_SESSION['uploadMsj']) != null) ?  $_SESSION['uploadMsj'] : ""; 
                                 ?></p>
                                <input type="hidden" name="form" value="cu"/>
                            </form>                        
                            <img  class="img-fluid userform-img"  src="<?php echo $_SESSION['criador']['imagen'] == '' ? IMAGEN_SIN_FOTO : $_SESSION['criador']['imagen']; ?>" 
                             alt="foto de usuario">
                        </div>
                        </div> <!-- fin row -->
                        <!-- form datos criador -->
                        <div class="row">
                            <div class="col formularios">
                        <form action="home.php" method="POST">
                            <div class="row g-3">
                                <div class="col-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                    <input name="nombre" type="text" class="form-control" value="<?php echo $_SESSION['criador']['nombre'];?>" required>
                                </div>
                                <div class="col-6">
                                <label for="primer_apellido" class="form-label">Primer apellido:</label>
                                    <input name="primer_apellido" type="text" class="form-control" value="<?php echo $_SESSION['criador']['primer_apellido'];?>" required>
                                </div>
                                <div class="col-4">
                                <label for="segundo_apellido" class="form-label">Segundo apellido:</label>
                                    <input name="segundo_apellido" type="text" class="form-control" value="<?php echo $_SESSION['criador']['segundo_apellido'];?>" required>
                                </div>
                                <div class="col-4">
                                <label for="dni" class="form-label">Dni:</label>
                                    <input name="dni" type="text" class="form-control" style="background-color: lightgrey" 
                                    value="<?php echo $_SESSION['criador']['dni'];?>" readonly>
                                </div>
                                <div class="col-4">
                                <label for="ciudad" class="form-label">Ciudad:</label>
                                    <input name="ciudad" type="text" class="form-control" value="<?php echo $_SESSION['criador']['ciudad'];?>" required>
                                </div>

                                <div class="col-12 d-flex flex-row-reverse">
                                    <input class="btn btn-primary m-2" type="submit" name="editar_perfil" value="Actualizar">
                                    <input class="btn btn-secondary m-2" type="submit" name="cancelar" value="Cancelar" onClick="document.location.href='home.php';">
                                </div>
                                <input type="hidden" name="form" value="cu"/>
                            </div>
                        <hr style="color: rgba(255, 255, 255, 0);">    
                        </form>
                        </div>
                        </div> <!-- fin row -->
                    </div>
                </div>



                <hr style="color: rgba(255, 255, 255, 0);">
                <hr class="hr hr-blurry" />
                <hr style="color: rgba(255, 255, 255, 0);">

                <!-- form cambio password -->
                <div class="content center forms">
                    <div class="text-center">
                    <h2>Cambiar password:</h2>
                    </div>
                    <div class="row">
                     <div class="col formularios">
                      <form action="home.php" method="POST">
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="pass" class="form-label">Nueva contraseña:</label>
                                <input type="password" class="form-control" name="pass" required>
                            </div>
                            <div class="col-6">
                                <label for="pass2" class="form-label">Repite contraseña:</label>
                                <input type="password" class="form-control" name="pass2" required>

                            </div>
                            <div class="col-12 d-flex flex-row-reverse">
                                <input type="submit" class="btn btn-primary" name="cambiar_pass" value="Cambiar">
                            </div>
                        </div>
                        <input type="hidden" name="form" value="pu"/>
                      </form>
                      </div>
                    </div>
                </div>

