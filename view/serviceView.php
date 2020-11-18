{{> headerExternal}}

        <div class="w3-content">
            <div class="w3-margin">
                <input type="text" class="w3-bar-item w3-input w3-border w3-round w3-margin-bottom" style="margin-top: 2.5em;" placeholder="Buscar Service...">

                <a href="/pw2-grupo03/service/newService" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Servicio</a>

                <div>
                    <div class="w3-row-padding">
                        {{#services}}
                        <div class="w3-col s12 m6 l4 w3-center" style="margin-bottom: 2em;">
                            <div class="w3-card-4 w3-round">
                                <header class="w3-container w3-light-grey d-flex-centrado">
                                    <h3>Service N° {{id_service}}</h3>
                                </header>
                                
                                <div class="w3-container w3-margin-bottom">
                                    <div class="detalles-viaje w3-margin-bottom">
                                        <div>
                                            <h3>N° Unidad:</h3>
                                            <p>{{id_unidad_de_transporte}}</p>
                                        </div>
                                        <div>
                                            <h3>Fecha:</h3>
                                            <p>{{fecha_service}}</p>
                                        </div>
                                    </div>
                                    <div class="detalles-viaje w3-margin-bottom">
                                        <h3 class="margin-0">Kilometros:</h3>
                                        <p class="margin-0">{{kilometraje_actual_unidad}}</p>
                                    </div>
                                    <div class="detalles-viaje w3-margin-bottom">
                                        <h3 class="margin-0">Service Interno:</h3>
                                        <p class="margin-0">Sí</p>
                                    </div>
                                    <div class="detalles-viaje w3-margin-bottom">
                                        <h3 class="margin-0">ID Mecánico:</h3>
                                        <p class="margin-0">{{id_usuario}}</p>
                                    </div>
                                    <div class="detalles-viaje w3-margin-bottom">
                                        <h3 class="margin-0">Descripción:</h3>
                                        <p class="margin-0">{{detalle}}</p>
                                    </div>
                                    <div class="detalles-viaje w3-margin-bottom">
                                        <h3 class="margin-0">Costo:</h3>
                                        <p class="margin-0">$ {{costo}}</p>
                                    </div>

                                    <a href="/pw2-grupo03/service/deleteService?id={{id_service}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom">Eliminar</a>
                                    <a href="/pw2-grupo03/service/editService?id={{id_service}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom">Editar</a>
                                </div>
                            </div>
                        </div>
                        {{/services}}
                    </div>
                </div>
            </div>
        </div>
    </div>

{{> footer}}