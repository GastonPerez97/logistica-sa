{{> headerExternal}}
    
<div class="w3-content w3-margin-top">
    <form action="login/validarLogin" method="post" class="login-form">
        <div class="container-title w3-margin-top"><p>Bienvenido!</p></div>

        <div class="container">
            <label for="email"><b>E-Mail:</b></label>
            <input type="text" placeholder="Ingresar email" name="email" class="login-input" required>

            <label for="pass"><b>Contrase&ntildea</b></label>
            <input type="password" placeholder="************" name="pass" class="login-input" required>

            <button class="form-button w3-round" type="submit">Ingresar</button>

            <p class="w3-text-red">{{wrongMailOrPass}}</p>
            <p class="w3-text-red">{{userNotActive}}</p>
        </div>

        <div class="container-bottom">
            <p class="w3-margin-top">&iquestNuevo Usuario?</p>
            <a href="registrarse" class="w3-button register-btn form-button w3-round">Registrarse</a>
        </div>
    </form>
</div>

{{> footer}}