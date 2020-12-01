{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <a href="/pw2-grupo03/client/newClient" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Cliente</a>
        <div>
            <div class="w3-row-padding">
                {{#clients}}
                <div class="w3-col s12 m12 l6 w3-center" style="margin-bottom: 2em;">
                    <div class="w3-card-4 w3-round">
                        <div class="w3-container w3-margin-bottom">
                            <div class="w3-margin-bottom">
                                <div>
                                    <h3>Denominación:</h3>
                                    <p>{{denominacion}}</p>
                                </div>
                                <div class="d-flex justify-content-around w3-margin-top">
                                    <div>
                                        <h3>E-Mail:</h3>
                                        <p>{{email}}</p>
                                    </div>
                                    <div>
                                        <h3>CUIT:</h3>
                                        <p>{{cuit}}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around w3-margin-top">
                                    <div>
                                        <h3>Telefono:</h3>
                                        <p>{{telefono}}</p>
                                    </div>
                                    <div>
                                        <h3>Dirección:</h3>
                                        <p>{{direccion}}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around w3-margin-top">
                                    <div>
                                        <h3>Contacto 1:</h3>
                                        <p>{{contacto1}}</p>
                                    </div>
                                    <div>
                                        <h3>Contacto 2:</h3>
                                        <p>{{contacto2}}</p>
                                    </div>
                                </div>
                            </div>
                            <a href="/pw2-grupo03/client/deleteClient?id={{id_cliente}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom delete-btn-client">Eliminar</a>
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