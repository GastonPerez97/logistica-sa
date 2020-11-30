{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    <div class="container">
        <div class="container-title w3-margin-bottom"><p>Informar carga de combustible de viaje con ID {{idTravel}}</p></div>

        <form action="processRefuel" method="post" class="login-form w3-padding">
            <div class="w3-margin-bottom w3-margin-top">
                <a href="/pw2-grupo03/travel/loadData?id={{idTravel}}" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver</a>
            </div>

            <input type="hidden" name="travelId" value="{{idTravel}}">

            <label for="place"><b>Lugar:</b></label>
            <input type="text" placeholder="Ingresar ubicación" name="place" class="login-input w3-margin-bottom" required>

            <label for="quantity"><b>Cantidad:</b></label>
            <input type="number" step=".01" placeholder="Ingresar cantidad de litros cargados" name="quantity" class="login-input w3-margin-bottom" required>

            <label for="amount"><b>Importe:</b></label>
            <input type="number" step=".01" placeholder="Ingresar importe" name="amount" class="login-input w3-margin-bottom" required>

            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Confirmar carga de combustible</button>
        </form>
    </div>
</div>

{{> footerSidebarFixed}}