{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    {{#client}}
    <form action="processEditClient" method="post" class="login-form">
        <div class="container-title"><p>Modificar cliente</p></div>
        <div class="container">
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/client" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver</a>
            </div>

            <label for="idClient"><b>N° ID:</b></label>
            <input type="number" name="idClient" value="{{id_cliente}}" readonly="true" class="login-input" required>

            <label for="email"><b>E-Mail:</b></label>
            <input type="email" placeholder="Modificar" name="email" value="{{email}}" class="login-input" required>

            <label for="cuit"><b>CUIT:</b></label>
            <input type="number" placeholder="Modificar CUIT" name="cuit" value="{{cuit}}" class="login-input" required>

            <label for="phone"><b>Telefono:</b></label>
            <input type="phone" placeholder="Modificar telefono" name="phone" value="{{telefono}}" class="login-input" required>

            <label for="address"><b>Dirección:</b></label>
            <input type="text" placeholder="Modificar dirección" name="address" value="{{direccion}}" class="login-input" required>

            <label for="denomination"><b>Denominación:</b></label>
            <input type="text" placeholder="Modificar denominación" name="denomination" value="{{denominacion}}" class="login-input" required>

            <label for="contact1"><b>Contacto 1:</b></label>
            <input type="text" placeholder="Modificar contacto 1" name="contact1" value="{{contacto1}}" class="login-input" required>

            <label for="contact2"><b>Contacto 2:</b></label>
            <input type="text" placeholder="Modificar contacto 2" name="contact2" value="{{contacto2}}" class="login-input" required>

            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Modificar</button>
        </div>
    </form>
    {{/client}}
</div>

{{> footerSidebarFixed}}