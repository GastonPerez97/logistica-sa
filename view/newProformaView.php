{{> headerWithSidebar}}

<div class="w3-container w3-margin-top">
    <form action="createProforma" method="post" class="login-form container">
        <div class="container-title"><p>Generar Proforma</p></div>
        <div>
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/report" class="w3-button w3-blue w3-small w3-round text-decoration-none">Volver</a>
            </div>
            <label for="idProforma"><b>N° Proforma <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar número de unidad" name="idProforma" class="login-input" required>
            <label for="actualDate"><b>Fecha<span style="color: red">*</span></b></label>
            <input type="date" name="actualDate" class="login-input" required>
            <label for="idTravel"><b>ID Viaje <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar número de viaje" name="idTravel" class="login-input" required>
            <hr>
            <label for="" style="font-size: x-large"><b>Datos Cliente</b></label>
            <br><br>
            <label for="denominacion"><b>Denominación <span style="color: red">*</span></b></label>
            <input type="text" placeholder="Ingresar la denominación del cliente" name="denominacion" class="login-input" required>
            <label for="cuit"><b>CUIT <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar CUIT del cliente" name="cuit" class="login-input" required>
            <label for="address"><b>Dirección <span style="color: red">*</span></b></label>
            <input type="text" placeholder="Ingresar dirección del cliente" name="address" class="login-input" required>
            <label for="phone"><b>Teléfono <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar teléfono del cliente" name="phone" class="login-input" required>
            <label for="email"><b>Email <span style="color: red">*</span></b></label>
            <input type="email" placeholder="Ingresar email del cliente" name="email" class="login-input" required>
            <label for="contact1"><b>Contacto <span style="color: red">*</span></b></label>
            <input type="text" placeholder="Ingresar contacto del cliente" name="contact1" class="login-input" required>
            <label for="contact2"><b>Contacto 2</b></label>
            <input type="text" placeholder="Ingresar segundo contacto del cliente" name="contact2" class="login-input">
            <hr>
            <label for="" style="font-size: x-large"><b>Datos Viaje</b></label>
            <br><br>
            <label for="origin"><b>Origen <span style="color: red">*</span></b></label>
            <input type="text" placeholder="Ingresar origen del viaje" name="origin" class="login-input" required>
            <label for="destination"><b>Destino <span style="color: red">*</span></b></label>
            <input type="text" placeholder="Ingresar destino del viaje" name="destination" class="login-input">
            <label for="uploadDate"><b>Fecha de Carga<span style="color: red">*</span></b></label>
            <input type="date" name="uploadDate" class="login-input" required>
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
            <label for="netWeight"><b>ETA <span style="color: red">*</span></b></label>
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
            <label for="expectedKilometers"><b>Kilometros Estimados:<span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar kilometros previstos" name="expectedKilometers" class="login-input" required>
            <label for="expectedFuel"><b>Consumo de Combustible Estimado:<span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar consumo de combustible previsto" name="expectedFuel" class="login-input" required>
            <label for="expectedEtd"><b>ETD <span style="color: red">*</span></b></label>
            <input type="time" placeholder="Ingresar tiempo estimado de partida" name="expectedEtd" class="login-input" required>
            <label for="expectedEta"><b>ETA <span style="color: red">*</span></b></label>
            <input type="time" placeholder="Ingresar tiempo estimado de arribo" name="expectedEta" class="login-input" required>
            <label for="expectedViaticos"><b>Viaticos <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar gastos de viaticos estimados" name="expectedViaticos" class="login-input" required>
            <label for="expectedToll"><b>Peajes y Pesajes</b></label>
            <input type="number" placeholder="Ingresar gastos de peaje y pesajes estimados" name="expectedToll" class="login-input">
            <label for="expectedExtras"><b>Extras </b></label>
            <input type="number" placeholder="Ingresar gastos extras estimados" name="expectedExtras" class="login-input">
            <label for="expectedHazardCost"><b>Hazard </b></label>
            <input type="number" placeholder="Ingresar gastos estimados" name="expectedHazardCost" class="login-input">
            <label for="expectedReeferCost"><b>Reefer </b></b></label>
            <input type="number" placeholder="Ingresar gastos estimados" name="expectedReeferCost" class="login-input">
            <label for="expectedFeeCost"><b>Fee <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar gastos estimados" name="expectedFeeCost" class="login-input" required>
            <hr>
            <label for="" style="font-size: x-large"><b>Dato Personal</b></label>
            <br><br>
            <label for="driver"><b>Chofer Asignado <span style="color: red">*</span></b></label>
            <input type="number" placeholder="Ingresar chofer asignado" name="driver" class="login-input" required>
            <button class="form-button w3-round w3-green w3-margin-top" type="submit">Generar</button>
        </div>
    </form>
</div>
{{> footerSidebarFixed}}

