{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    <form action="createProforma" method="post" class="login-form">
        <div class="container-title"><p>Generar Proforma</p></div>

        <div class="container">

            <label for="idClient"><b>Cliente<span style="color: red">*</span></b></label>
            <select name="idClient" class="login-input">
                {{#clients}}
                <option value="{{id_cliente}}">{{denominacion}}</option>
                {{/clients}}
            </select>

            <label for="idTravel"><b>ID Viaje <span style="color: red">*</span></b></label>
            <select name="idTravel" class="login-input">
                {{#travels}}
                <option value="{{id_viaje}}">{{id_viaje}}</option>
                {{/travels}}
            </select>
            <hr>

            <label for="" style="font-size: x-large"><b>Datos Carga</b></label>
            <br><br>
            <label for="typeLoad"><b>Tipo <span style="color: red">*</span></b></label>
            <select name="typeLoad" class="login-input">
                <option selected="true" disabled="disabled">----</option>
                <option value="Granel">Granel</option>
                <option value="Liquida">Liquida</option>
                <option value="20">20''</option>
                <option value="40">40''</option>
                <option value="Jaula">Jaula</option>
                <option value="CarCarrier">CarCarrier</option>
            </select>

            <label for="netWeight"><b>Peso Neto <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar peso neto de carga" name="netWeight" class="login-input">

            <label for="hazard"><b>Hazard</b></label>
            <select name="hazard" class="login-input">
                <option selected="true">NO</option>
                <option value="Granel">SI</option>
            </select>

            <label for="imoClass"><b>IMO Class</b></label>
            <select name="imoClass" class="login-input">
                <option selected="true" disabled="disabled">---</option>
                <option value="class1">Class 1</option>
                <option value="class2">Class 2</option>
                <option value="class3">Class 3</option>
                <option value="class41">Class 4.1</option>
                <option value="class42">Class 4.2</option>
                <option value="class43">Class 4.3</option>
                <option value="class51">Class 5.1</option>
                <option value="class52">Class 5.2</option>
                <option value="class61">Class 6.1</option>
                <option value="class62">Class 6.2</option>
                <option value="class7">Class 7</option>
                <option value="class8">Class 8</option>
                <option value="class9">Class 9</option>
            </select>

            <label for="reefer"><b>Reefer</b></label>
            <select name="reefer" class="login-input">
                <option selected="true">NO</option>
                <option value="Granel">SI</option>
            </select>

            <label for="temperature"><b>Temperatura</b></label>
            <input type="number" placeholder="Ingresar temperatura de carga" name="temperature" class="login-input">
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

            <br><br>
            <label for="driver"><b>ID Chofer Asignado <span style="color: red">*</span></b></label>
            <select name="driver" class="login-input">
                {{#drivers}}
                <option value="{{id_chofer}}">{{id_chofer}}</option>
                {{/drivers}}
            </select>

            <button class="form-button w3-round w3-green w3-margin-top" type="submit">Generar</button>
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/report" class="w3-button w3-blue w3-medium w3-block w3-round text-decoration-none">Volver</a>
            </div>
        </div>
    </form>
</div>
{{> footerSidebarFixed}}

