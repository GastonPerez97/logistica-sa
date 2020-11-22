{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <form action="/pw2-grupo03/usuarios/processEditUser" method="post" class="login-form">
            {{#user}}
                <input type="hidden" name="userId" value="{{id_usuario}}">
                <div class="container-title"><p>Editar Usuario</p></div>

                <div class="container">
                    <div class="w3-margin-bottom d-flex justify-content-between align-items-center">
                        <a href="/pw2-grupo03/usuarios" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver a Usuarios</a>
                        <h4>ID: {{id_usuario}}</h4>
                    </div>

                    <label for="email"><b>E-Mail:</b></label>
                    <input type="text" value="{{email}}" name="email" class="login-input">

                    <div class="my-2em d-flex justify-content-between align-items-center">
                        <label for="active"><b>Activo:</b></label>
                        <input class="w3-check w3-margin-bottom" type="checkbox" name="active" {{#activado}}checked="checked"{{/activado}}>
                    </div>

                    <div class="my-2em">
                        <p for="roles" class="w3-margin-bottom"><b>Seleccionar roles:</b></p>

                        <ul>
                            {{#roles}}
                                <li>
                                    <div class="d-flex w3-margin-bottom justify-content-between align-items-center">
                                        <label for="roles">{{nombre}}</label>
                                        <input class="w3-check" type="checkbox" name="roles[]" value="{{id_rol}}" {{checked}}>
                                    </div>
                                </li>
                            {{/roles}}
                        </ul>
                    </div>

                    <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Editar Usuario</button>
                </div>
            {{/user}}
        </form>
    </div>
</div>

{{> footerSidebarFixed}}