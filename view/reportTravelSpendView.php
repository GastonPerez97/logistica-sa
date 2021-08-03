{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    <div class="container">
        <div class="container-title w3-margin-bottom"><p>Informar gasto de viaje con ID {{idTravel}}</p></div>

        <form action="processSpend" method="post" class="login-form w3-padding">
            <div class="w3-margin-bottom w3-margin-top">
                <a href="/travel/loadData?id={{idTravel}}" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver</a>
            </div>

            <input type="hidden" name="travelId" value="{{idTravel}}">

            <div class="w3-margin-bottom">
                <label for="spendType"><b>Tipo de gasto:</b></label>
                <select class="w3-select" name="spendType" required>
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="viatico_real">Viatico</option>
                    <option value="peaje_y_pesaje_real">Peaje</option>
                    <option value="hazard_real">Hazard</option>
                    <option value="reefer_real">Reefer</option>
                    <option value="fee_real">Fee</option>
                    <option value="extras_real">Extras</option>
                </select>
            </div>

            <label for="amount"><b>Importe:</b></label>
            <input type="number" step=".01" placeholder="Ingresar importe" name="amount" class="login-input w3-margin-bottom" required>

            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Confirmar gasto</button>
        </form>
    </div>
</div>

{{> footerSidebarFixed}}