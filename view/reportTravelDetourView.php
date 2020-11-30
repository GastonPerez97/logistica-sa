{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    <div class="container">
        <div class="container-title w3-margin-bottom"><p>Informar desvío de viaje con ID {{idTravel}}</p></div>

        <form action="processDetour" method="post" class="login-form w3-padding">
            <div class="w3-margin-bottom w3-margin-top">
                <a href="/pw2-grupo03/travel/loadData?id={{idTravel}}" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver</a>
            </div>

            <input type="hidden" name="travelId" value="{{idTravel}}">

            <label for="time"><b>Tiempo:</b></label>
            <input type="time" placeholder="Ingresar tiempo de desvío" name="time" class="login-input w3-margin-bottom" required>

            <label for="reason" class="w3-margin-top"><b>Razón:</b></label>
            <textarea name="reason" id="reason" rows="3" maxlength="99" style="resize:none" class="w3-block w3-padding rounded login-input"></textarea>

            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Confirmar desvío</button>
        </form>
    </div>
</div>

{{> footerSidebarFixed}}