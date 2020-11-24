{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <a href="/pw2-grupo03/client/newClient" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Cliente</a>
        <div>
            <div class="w3-row-padding">
                {{#clientss}}
                <div class="w3-col s12 m6 l4 w3-center" style="margin-bottom: 2em;">
                    <div class="w3-card-4 w3-round">
                        <div class="w3-container w3-margin-bottom">
                            <div class="detalles-viaje w3-margin-bottom">
                                <div>
                                    <h3>Nombre:</h3>
                                    <p>{{nombre}}</p>
                                </div>
                                <div>
                                    <h3>Apellido:</h3>
                                    <p>{{apellido}}</p>
                                </div>
                            </div>
                            <a href="/pw2-grupo03/client/deleteClient?id={{id_cliente}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom delete-btn-travel">Eliminar</a>
                            <a href="/pw2-grupo03/client/editClient?id={{id_cliente}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom">Editar</a>
                        </div>
                    </div>
                </div>
                {{/clients}}
            </div>
        </div>
    </div>
</div>

{{> deleteAlert}}
{{> footerSidebarFixed}}