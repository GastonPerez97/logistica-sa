{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <div>
            <div class="w3-row-padding">
                <a href="/pw2-grupo03/usuarios" class="w3-button w3-green w3-round w3-margin-top">Volver a Usuarios</a>
                <h1 class="w3-center">{{userEditedOk}}</h1>
                    {{#user}}
                        <div class="w3-col l12 w3-center" style="margin-top: 2em;">
                            <div class="w3-card-4 w3-round">
                                <header class="w3-container w3-light-grey w3-margin-bottom d-flex justify-content-between">
                                    <h2>{{apellido}}, {{nombre}}</h2>
                                    <h2>ID: {{id_usuario}}</h2>
                                </header>

                                <div class="d-flex flex-column user-container">
                                    <div class="user-container-item">
                                        <h4><b>E-Mail:</b></h4>
                                        <h4>{{email}}</h4>
                                    </div>
                                    <div class="user-container-item">
                                        <h4><b>DNI:</b></h4>
                                        <h4>{{dni}}</h4>
                                    </div>
                                    <div class="user-container-item">
                                        <h4><b>Fecha de nacimiento:</b></h4>
                                        <h4>{{birthdate}}</h4>
                                    </div>
                                    <div class="user-container-item">
                                        <h4><b>Fecha de alta:</b></h4>
                                        <h4>{{fecha_alta}}</h4>
                                    </div>
                                    <div class="user-container-item">
                                        <h4><b>Activo:</b></h4>
                                        <h4>{{#activado}}
                                                Si
                                            {{/activado}}
                                            {{^activado}}
                                                No
                                            {{/activado}}
                                        </h4>
                                    </div>

                                    <h4><b>Roles actuales:</b></h4>
                                    {{#rolesOfUser}}
                                        <p class="w3-margin-bottom">- {{nombre}}</p>
                                    {{/rolesOfUser}}
                                </div>

                                <div class="w3-margin-top">
                                    <a href="/pw2-grupo03/usuarios/editarUsuario?id={{id_usuario}}" class="w3-button w3-blue w3-round w3-margin-bottom">Editar</a>
                                </div>
                            </div>
                        </div>
                    {{/user}}
            </div>
        </div>
    </div>
</div>

{{> deleteAlert}}
{{> footerSidebarFixed}}