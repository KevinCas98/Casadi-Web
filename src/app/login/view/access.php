<link href="../../src/app/login/web/css/access.css" rel="stylesheet">
<?php require "../src/app/login/controller/access.php" ?>
<div id="login">
    <div id="login-container" class="container">
        <div id="login-row" class="row justify-content-center align-items-center mt-5">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="position col-md-10">
                    <form id="login-form" class="form" action="" method="post">
                        <div class="text-center pb-12 form-group">    
                            <img src="../img/logo_casadi.png" style="width: 100%; margin-bottom: -80px;">
                        </div>    
                        <br/>
                        <br/>
                        <?php if($errorLogin): ?>
                            <br/>
                            <div class="alert alert-danger" role="alert">
                                Usuario o Contraseña incorrectos
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="font-login">Usuario</div>
                            <input type="text" name="username" placeholder="Usuario" id="username" class="form-control input-login" required="">
							<br/>
                            <div class="font-login">Contraseña</div>
							<input type="password" name="password" placeholder="Contraseña" id="password" class="form-control input-login" required>
                        </div>
                        <br/>
                        <div class="text-center pb-12 form-group">
                            <input type="submit" name="submit" class="btn button-login" value="INGRESAR">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>