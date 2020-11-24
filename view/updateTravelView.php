{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    {{#travel}}
    <form action="processEditTravel" method="post" class="login-form">
        <div class="container-title"><p>Modificar viaje</p></div>
        <div class="container">
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/travel" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver al Inicio</a>
            </div>
            <label for="idTravel"><b>N° id:</b></label>
            <input type="number" placeholder="Ingresar numero del viaje" name="idTavel" value="{{id_viaje}}" readonly="true" class="login-input" required>
            <label for="expectedFuel"><b>Consumo de combustible previsto:</b></label>
            <input type="number" placeholder="Ingresar consumo de combustible previsto" name="expectedFuel" value="{{consumo_combustible_previsto}}" class="login-input" required>
            <label for="realFuel"><b>Consumo de combustible real:</b></label>
            <input type="number" placeholder="Ingresar consumo de combustible real" name="realFuel" value="{{consumo_combustible_real}}" class="login-input" required>
            <label for="expectedKilometers"><b>Kilometros previstos:</b></label>
            <input type="number" placeholder="Ingresar kilometros previstos" name="expectedKilometers" value="{{kilometros_previstos}}" class="login-input" required>
            <label for="realKilometers"><b>Kilometros reales:</b></label>
            <input type="number" placeholder="Ingresar kilometros reales" name="realKilometers" value="{{kilometros_reales}}" class="login-input" required>
            <label for="origin"><b>Origen:</b></label>
            <input type="text" placeholder="Ingresa origen del viaje" name="origin" value="{{origen}}" class="login-input" required>
            <label for="destination"><b>Destino:</b></label>
            <input type="text" placeholder="Ingresar destino del viaje" name="destination" value="{{destino}}" class="login-input" required>
            <label for="departureDate"><b>Fecha de salida:</b></label>
            <input type="date" placeholder="Ingresar fecha de salida del viaje" name="departureDate" value="{{fecha_salida }}" class="login-input" required>
            <label for="estimatedArrivalDate"><b>Fecha de llegada estimada:</b></label>
            <input type="date" placeholder="Ingresar fecha de llegada estimada del viaje" name="departureDate" value="{{fecha_llegada_estimada}}" class="login-input" required>
            <label for="arrivalDate"><b>Fecha de llegada:</b></label>
            <input type="date" placeholder="Ingresar fecha de llegada" name="arrivalDate" value="{{fecha_llegada}}" class="login-input" required>
            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Modificar</button>
        </div>
    </form>
    {{/travel}}
</div>

{{> footerSidebarFixed}}