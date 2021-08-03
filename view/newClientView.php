{{> headerWithSidebar}}
<main>
    <div class="w3-content w3-margin-top">
        <form action="addNewClient" method="post" class="login-form">
            <div class="container-title"><p>Nuevo Cliente</p></div>
            <div class="container">
                <div class="w3-margin-bottom">
                    <a href="/travel" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver al Inicio</a>
                </div>

                <label for="email"><b>E-Mail:</b></label>
                <input type="email" placeholder="Ingresar E-Mail" name="email" class="login-input" required>

                <label for="cuit"><b>CUIT:</b></label>
                <input type="number" placeholder="Ingresar CUIT" name="cuit" class="login-input" required>

                <label for="phone"><b>Telefono:</b></label>
                <input type="phone" placeholder="Ingresar telefono" name="phone" class="login-input" required>

                <label for="address"><b>Direccion:</b></label>
                <input type="text" placeholder="Ingresar dirección" name="address" class="login-input" required>

                <label for="denomination"><b>Denominacion:</b></label>
                <input type="text" placeholder="Ingresar denominación" name="denomination" class="login-input" required>

                <label for="contact1"><b>Contacto 1:</b></label>
                <input type="text" placeholder="Ingresar contacto 1" name="contact1" class="login-input" required>

                <label for="contact2"><b>Contacto 2:</b></label>
                <input type="text" placeholder="Ingresar contacto 2" name="contact2" class="login-input" required>

                <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Confirmar nuevo cliente</button>
            </div>
        </form>
    </div>
</main>

{{> footerSidebarFixed}}