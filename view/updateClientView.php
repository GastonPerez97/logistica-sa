{{> headerWithSidebar}}

<div class="w3-content w3-margin-top">
    {{#client}}
    <form action="processEditClient" method="post" class="login-form">
        <div class="container-title"><p>Modificar cliente</p></div>
        <div class="container">
            <div class="w3-margin-bottom">
                <a href="/pw2-grupo03/client" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver al Inicio</a>
            </div>

            <label for="idClient"><b>N° id:</b></label>
            <input type="number" placeholder="Ingresar numero del cliente" name="idClient" value="{{id_cliente}}" readonly="true" class="login-input" required>

            <label for="name"><b>Nombre:</b></label>
            <input type="text" placeholder="Ingresar nombre" name="name" value="{{nombre}}" class="login-input" required>

            <label for="surname"><b>Apellido:</b></label>
            <input type="text" placeholder="Ingresar apellido" name="surname" value="{{apellido}}" class="login-input" required>

            <label for="dni"><b>Dni:</b></label>
            <input type="number" placeholder="Ingresar dni" name="dni" value="{{dni}}" class="login-input" required>

            <label for="phone"><b>Telefono:</b></label>
            <input type="number" placeholder="Ingresa telefono" name="phone" value="{{telefono}}" class="login-input" required>

            <label for="email"><b>Email:</b></label>
            <input type="email" placeholder="Ingresar email" name="email" value="{{email}}" class="login-input" required>

            <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Modificar</button>
        </div>
    </form>
    {{/client}}
</div>

{{> footerSidebarFixed}}