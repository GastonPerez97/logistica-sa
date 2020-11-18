{{> headerExternal}}

<div class="w3-content w3-margin-top">
    {{#service}}
    <form action="processeditservice" method="post" class="login-form">
        <div class="container-title"><p>Editar Servicio </p></div>

        <div class="container">

            <label for="idService"><b>N° id:</b></label>
            <input type="number" placeholder="Ingresar número de unidad" name="idService" value="{{id_service}}" readonly="true" class="login-input" required>

            <label for="numberVehicle"><b>N° Unidad:</b></label>
            <input type="number" placeholder="Ingresar número de unidad" name="numberVehicle" value="{{id_unidad_de_transporte}}" readonly="true" class="login-input" required>

            <label for="serviceDate"><b>Fecha Service:</b></label>
            <input type="date" name="serviceDate" class="login-input" value="{{fecha_service}}" required>

            <label for="kilometers"><b>Kilometros:</b></label>
            <input type="number" placeholder="Ingresar kilometros de la unidad" name="kilometers" value="{{kilometraje_actual_unidad}}" class="login-input" required>

            <label for="mechanic"><b>ID Mecánico</b></label>
            <input type="number" placeholder="Ingresar ID del mecánico" name="mechanic" value="{{id_usuario}}" readonly="true" class="login-input" required>

            <label for="description"><b>Descripción</b></label>
            <input type="text" placeholder="Ingresar detalle del service" name="description" value="{{detalle}}" class="login-input" required>

            <label for="cost"><b>Costo</b></label>
            <input type="number" placeholder="Ingresar costo" name="cost" value="{{costo}}" class="login-input" required>

            <button class="form-button w3-round w3-green w3-margin-top" type="submit">Editar</button>

            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/service" class="w3-button w3-blue w3-medium w3-block w3-round text-decoration-none">Volver</a>
            </div>
        </div>
    </form>
    {{/service}}
</div>

{{> footer}}

