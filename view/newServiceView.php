{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    <form action="addNewService" method="post" class="login-form">
        <div class="container-title"><p>Nuevo Servicio</p></div>

        <div class="container">
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/service" class="w3-button w3-blue w3-small w3-round text-decoration-none">Volver</a>
            </div>

            <label for="numberVehicle"><b>N° Unidad <span style="color: red">*</span></b></label>
            <select name="numberVehicle" class="login-input">
                {{#vehicles}}
                <option value="{{id_vehiculo}}">{{id_vehiculo}}</option>
                {{/vehicles}}
            </select>

            <label for="serviceDate"><b>Fecha Service <span style="color: red">*</span></b></label>
            <input type="date" name="serviceDate" class="login-input" required>

            <label for="kilometers"><b>Kilometros <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar kilometros de la unidad" name="kilometers" class="login-input" required>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="internal" id="internal" onchange="javascript:showContentMechanic()">
                <label class="form-check-label" for="internal">
                    <b>Mecánico Interno</b>
                </label>
            </div>

            <label for="mechanic" id="labelMechanic" style="display: none;"><b>ID Mecánico </b></label>
            <select name="mechanic" id="mechanic" class="login-input" style="display: none;">
                {{#mechanics}}
                <option value="{{id_usuario}}">{{id_usuario}}</option>
                {{/mechanics}}
            </select>

            <br>
            <label for="description"><b>Descripción <span style="color: red">*</span></b></label>
            <input type="text" placeholder="Ingresar detalle del service" name="description" class="login-input" required>

            <label for="cost"><b>Costo <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar costo" name="cost" class="login-input" required>

            <button class="form-button w3-round w3-green w3-margin-top" type="submit">Registrar</button>
        </div>
    </form>
</div>

{{> footerSidebarFixed}}
