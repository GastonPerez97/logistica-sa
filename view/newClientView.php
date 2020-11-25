{{> headerWithSidebar}}
<main>


    <div class="w3-content w3-margin-top">
        <form action="addNewClient" method="post" class="login-form">
            <div class="container-title"><p>Nuevo Cliente</p></div>
            <div class="container">
                <div class="w3-margin-bottom">
                    <a href="/pw2-grupo03/travel" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver al Inicio</a>
                </div>

                <label for="name"><b>Nombre:</b></label>
                <input type="text" placeholder="Ingresar nombre" name="name" class="login-input" required>

                <label for="surname"><b>Apellido:</b></label>
                <input type="text" placeholder="Ingresar apellido" name="surname" class="login-input" required>

                <label for="dni"><b>Dni:</b></label>
                <input type="number" placeholder="Ingresar dni" name="dni" class="login-input" required>

                <label for="phone"><b>Telefono:</b></label>
                <input type="number" placeholder="Ingresar telefono" name="phone" class="login-input" required>

                <label for="email"><b>Email:</b></label>
                <input type="email" placeholder="Ingresar email" name="email" class="login-input" required>

                <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Confirmar nuevo cliente</button>
            </div>
        </form>
    </div>
</main>
{{> footerSidebarFixed}}