{{> header}}
<main>

    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-right" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Cerrar &times;</button>
        <h3 class="w3-bar-item">Menú</h3>
        <a href="#" class="w3-bar-item w3-button">Mis Viajes</a>
        <a href="#" class="w3-bar-item w3-button">Nuevo viaje</a>
        <a href="#" class="w3-bar-item w3-button">Facturacion</a>
    </div>
    <div class="w3-content w3-margin-top">
        <form action="addNewTravel" method="post" class="login-form">
            <div class="container-title"><p>Nuevo Viaje</p></div>
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
                <label for="departureDate"><b>Fecha de salida:</b></label>
                <input type="date" placeholder="Ingresar fecha de salida del viaje" name="departureDate" class="login-input" required>
                <label for="estimatedArrivalDate"><b>Fecha de llegada estimada:</b></label>
                <input type="date" placeholder="Ingresar fecha de llegada estimada del viaje" name="estimatedArrivalDate" class="login-input" required>
                <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Confirmar nuevo viaje</button>
            </div>
        </form>
    </div>
</main>
{{> footer}}