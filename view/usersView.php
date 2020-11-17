{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
<!--        <input type="text" class="w3-bar-item w3-input w3-border w3-round w3-margin-bottom" style="margin-top: 2.5em;" placeholder="Buscar Usuario..">-->

        <div>
            <div class="w3-row-padding">
                    {{#users}}
                        <div class="w3-col s12 m6 l4 w3-center" style="margin-bottom: 2em;">
                            <div class="w3-card-4 w3-round">
                                <header class="w3-container w3-light-grey w3-margin-bottom">
                                    <h3>{{apellido}}, {{nombre}}</h3>
                                    <h4>{{email}}</h4>
                                </header>

                                <a class="w3-button w3-red w3-tiny w3-round w3-margin-bottom">Eliminar</a>
                                <a href="/pw2-grupo03/usuarios/editarUsuario?id={{id_usuario}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom">Editar</a>
                                <a href="/pw2-grupo03/usuarios/verUsuario?id={{id_usuario}}" class="w3-button w3-green w3-tiny w3-round w3-margin-bottom">Ver Usuario</a>
                            </div>
                        </div>
                    {{/users}}
            </div>
        </div>
    </div>
</div>

{{> footerSidebarFixed}}