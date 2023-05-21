
<div class="container">
    <div class="row">
        <div class="col">
            <form class="form animated zoomIn" id="formLogin" method="POST" action="<?=ROuter::getRouteURL('login/login')?>">
                <div class="icono">
                    <span class="radius">
                        <i class="fas fa-star fa-3x fa-spin"></i>
                    </span>
                </div>
                <h1 class="text-center">Iniciar Sesión</h1>
                <div class="form-control">
                    <label for="usuarioID">
                        <i class="fas fa-user fa-2x"></i>
                    </label>
                    <input type="text" id="usuarioID" name="usuarioID" placeholder="ID de usuario" required>
                </div>
                <div class="form-control">
                    <label for="password" class="password-label">
                        <i class="fas fa-lock fa-2x"></i>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="form-control display-none animated" id="alert-danger">
                    <div class="alert-danger">
                        <p>Usuario y/o contraseña invalidos</p>
                    </div>
                </div>
                <div class="form-control">
                    <button type="submit" >Ingresar</button>
                </div>
            </form>     
        </div>
    </div>
</div>
<script src="<?=Router::getScriptRoute('axios.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('login.js')?>"></script>

