{{> headerWithSidebar}}

<div class="w3-content w3-margin-top w3-margin-bottom">
    <form action="addNewTravel" method="post" class="login-form">
        <div class="container-title w3-margin-top"><p>Nuevo Viaje</p></div>
        <div class="container">
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/travel" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver al Inicio</a>
            </div>


            <label for="expectedFuel"><b>Consumo de combustible previsto:</b></label>
            <input type="number" placeholder="Ingresar consumo de combustible previsto" name="expectedFuel" class="login-input" required>
            <label for="expectedKilometers"><b>Kilometros previstos:</b></label>
            <input type="number" placeholder="Ingresar kilometros previstos" name="expectedKilometers" class="login-input" required>
            <label for="origin"><b>Origen:</b></label>
            <input type="text" placeholder="Ingresa origen del viaje" name="origin" class="login-input" required>
            <label for="destination"><b>Destino:</b></label>
            <input type="text" placeholder="Ingresar destino del viaje" name="destination" class="login-input" required>
            <label for="estimatedDepartureDate"><b>Fecha de salida estimada:</b></label>
            <input type="date" placeholder="Ingresar fecha de salida estimada del viaje" name="estimatedDepartureDate" class="login-input" required>
            <label for="estimatedArrivalDate"><b>Fecha de llegada estimada:</b></label>
            <input type="date" placeholder="Ingresar fecha de llegada estimada del viaje" name="estimatedArrivalDate" class="login-input" required>
            <label for="idClient"><b>Seleccione el cliente:</b></label>
            <select class="w3-select w3-margin-bottom" name="idClient">
                {{#clients}}
                    <option value="{{id_cliente}}">{{denominacion}}</option>
                {{/clients}}
            </select>
            <label for="driver-select"><b>Chofer <span style="color: red">*</span></b></label>
            <select class="w3-select" name="idDriver" id="driver-select">
                {{# drivers }}
                    <option value="{{ id_chofer }}">
                        {{ nombre }}, {{ apellido }} - Licencia: {{numero_licencia}}-{{tipo_licencia}}
                    </option>
                {{/ drivers }}
            </select>
            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Confirmar nuevo viaje</button>
        </div>
    </form>
</div>

{{> footerSidebarFixed}}