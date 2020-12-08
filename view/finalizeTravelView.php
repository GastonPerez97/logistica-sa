{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    {{#travel}}
    <form action="processFinalizeTravel" method="post" class="login-form">
        <div class="container-title"><p>Finalizar viaje</p></div>
        <div class="container">
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/travel" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver</a>
            </div>
            <label for="idTravel"><b>N° id:</b></label>
            <input type="number" placeholder="Ingresar numero del viaje" name="id_viaje" value="{{id_viaje}}" readonly="true" class="login-input" required>

            <label for="realFuel"><b>Consumo de combustible real:</b></label>
            <input type="number" placeholder="Ingresar consumo de combustible real" name="realFuel" value="{{consumo_combustible_real}}" class="login-input" required>

            <label for="realKilometers"><b>Kilometros reales:</b></label>
            <input type="number" placeholder="Ingresar kilometros reales" name="realKilometers" value="{{kilometros_reales}}" class="login-input" required>


            <label for="departureDate"><b>Fecha de salida:</b></label>
            <input type="datetime-local" placeholder="Ingresar fecha de salida del viaje" name="departureDate"
                   value="{{fecha_salida}}" class="login-input" required>

            <label for="arrivalDate"><b>Fecha de llegada:</b></label>
            <input type="datetime-local" placeholder="Ingresar fecha de llegada del viaje" name="arrivalDate" value="{{fecha_llegada}}" class="login-input" required>


            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Finalizar</button>
        </div>
    </form>
    {{/travel}}
</div>

{{> footerSidebarFixed}}