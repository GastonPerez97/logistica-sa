{{> headerExternal}}

<div class="w3-content w3-margin-top">
    <form action="registrarse/resultadoRegistro" method="post" class="login-form">
        <div class="container-title"><p>Registrarse</p></div>

        <div class="container">
            <div class="w3-margin-bottom">
                <a href="/" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver al Inicio</a>
            </div>

            <label for="name"><b>Nombre:</b></label>
            <input type="text" placeholder="Ingresar nombre" name="name" class="login-input" required>

            <label for="surname"><b>Apellido:</b></label>
            <input type="text" placeholder="Ingresar apellido" name="surname" class="login-input" required>

            <label for="dni"><b>DNI:</b></label>
            <input type="number" placeholder="Ingresar DNI" name="dni" class="login-input" required>

            <label for="birthdate"><b>Fecha de nacimiento:</b></label>
            <input type="date" placeholder="Ingresar fecha de nacimiento" name="birthdate" class="login-input" required>

            <label for="email"><b>E-Mail:</b></label>
            <input type="text" placeholder="Ingresar email" name="email" class="login-input" required>

            <label for="pass"><b>Contrase&ntildea</b></label>
            <input type="password" placeholder="************" name="pass" class="login-input" required>

            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Registrarse</button>
        </div>
    </form>
</div>

{{> footer}}