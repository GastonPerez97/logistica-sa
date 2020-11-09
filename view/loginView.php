{{> headerExternal}}
    
<div class="w3-content w3-margin-top">
    <form action="action-page.php" method="post" class="login-form">
        <div class="container-title"><p>Bienvenido!</p></div>

        <div class="container">
            <label for="email"><b>E-Mail:</b></label>
            <input type="text" placeholder="Ingresar email" name="email" class="login-input" required>

            <label for="pass"><b>Contrase&ntildea</b></label>
            <input type="password" placeholder="************" name="pass" class="login-input" required>

            <button class="form-button w3-round" type="submit">Ingresar</button>

            <input type="checkbox" checked="checked" name="remember"> Recordarme
            <span class="forgot-pass"> <a href="#"> &iquestOlvidaste tu contrase&ntildea?</a></span>
        </div>

        <div class="container-bottom" >
            <p class="new-user">&iquestNuevo Usuario?</p>
            <a href="registrarse" class="w3-button register-btn form-button w3-round">Registrarse</a>
        </div>
    </form>
</div>

{{> footer}}