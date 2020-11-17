{{> headerExternal}}

<div class="w3-content w3-margin-top">
    <form action="service/newserviceresult" method="post" class="login-form">
        <div class="container-title"><p>Nuevo Servicio</p></div>

        <div class="container">


            <label for="numberVehicle"><b>N° Unidad:</b></label>
            <input type="number" placeholder="Ingresar número de unidad" name="numberVehicle" class="login-input" required>

            <label for="serviceDate"><b>Fecha Service:</b></label>
            <input type="date" name="serviceDate" class="login-input" required>

            <label for="kilometers"><b>Kilometros:</b></label>
            <input type="number" placeholder="Ingresar kilometros de la unidad" name="kilometers" class="login-input" required>

            <label for="mechanic"><b>ID Mecánico</b></label>
            <input type="number" placeholder="Ingresar ID del mecánico" name="mechanic" class="login-input" required>

            <label for="description"><b>Descripción</b></label>
            <input type="text" placeholder="Ingresar detalle del service" name="description" class="login-input" required>

            <label for="cost"><b>Costo</b></label>
            <input type="number" placeholder="Ingresar costo" name="cost" class="login-input" required>

            <button class="form-button w3-round w3-green w3-margin-top" type="submit">Registrar</button>

            <div class="w3-margin-bottom">
                <a href="service" class="w3-button w3-blue w3-medium w3-block w3-round text-decoration-none">Volver</a>
            </div>
        </div>
    </form>
</div>

{{> footer}}
