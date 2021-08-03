{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    <h2 class="w3-center w3-margin-bottom">{{createProforma}}</h2>

    <form action="createProforma" method="post" class="login-form">
        <div class="container-title"><p>Generar Proforma</p></div>

        <div class="container">

            <label for="idTravel"><b>ID Viaje <span style="color: red">*</span></b></label>
            <select name="idTravel" class="login-input">
                {{#travels}}
                <option value="{{id_viaje}}">{{id_viaje}}</option>
                {{/travels}}
            </select>
            <hr>

            <label for="" style="font-size: x-large"><b>Datos Carga</b></label>
            <br><br>
            <label for="idTypeLoad"><b>Tipo <span style="color: red">*</span></b></label>
            <select name="idTypeLoad" class="login-input">
                {{#typeLoad}}
                <option value="{{id_tipo_carga}}">{{nombre}}</option>
                {{/typeLoad}}
            </select>

            <label for="netWeight"><b>Peso Neto <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar peso neto de carga" name="netWeight" class="login-input" required>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="hazard" id="hazard" onchange="javascript:showContentHazard()">
                <label class="form-check-label" for="hazard">
                    <b>Carga Peligrosa </b>
                </label>
            </div>

            <br>
            <label for="imoClass" style="display: none;"><b>IMO Class - IMO SubClass</b></label>
            <select name="imoClass" id="imoClass" class="login-input" style="display: none;">
                {{#typeDanger}}
                <option value="{{id_tipo_peligro}}">{{descripcion}}</option>
                {{/typeDanger}}
            </select>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="reefer" id="reefer" onchange="javascript:showContentReefer()">
                <label class="form-check-label" for="reefer">
                    <b>Carga Refrigerada</b>
                </label>
            </div>

            <input type="number" placeholder="Ingresar temperatura de carga" name="numberTemperature" id="numberTemperature" class="login-input" style="display: none;">
            <hr>

            <label for="" style="font-size: x-large"><b>Costos</b></label>
            <br><br>
            <label for="expectedViaticos"><b>Viaticos <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar gastos de viaticos estimados" name="expectedViaticos" class="login-input" required>

            <label for="expectedToll"><b>Peajes y Pesajes <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar gastos de peaje y pesajes estimados" name="expectedToll" class="login-input" required>

            <label for="expectedExtras"><b>Extras <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar gastos extras estimados" name="expectedExtras" class="login-input" required>

            <label for="expectedHazardCost"><b>Hazard <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar gastos estimados" name="expectedHazardCost" class="login-input" required>

            <label for="expectedReeferCost"><b>Reefer <span style="color: red">*</span></b></b></label>
            <input type="number" placeholder="Ingresar gastos estimados" name="expectedReeferCost" class="login-input" required>

            <label for="expectedFeeCost"><b>Fee <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar gastos estimados" name="expectedFeeCost" class="login-input" required>
            <hr>

            <button class="form-button w3-round w3-green w3-margin-top" type="submit">Generar</button>
            <div class="w3-margin-bottom">
                <a href="/report" class="w3-button w3-blue w3-medium w3-block w3-round text-decoration-none">Volver</a>
            </div>
        </div>
    </form>
</div>


{{> footerSidebarFixed}}

