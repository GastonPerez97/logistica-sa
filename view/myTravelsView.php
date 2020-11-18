{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <a href="/pw2-grupo03/travel/newTravel" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Viaje</a>
        <div>
            <div class="w3-row-padding">
                {{#travels}}
                <div class="w3-col s12 m6 l4 w3-center" style="margin-bottom: 2em;">
                    <div class="w3-card-4 w3-round">
                        <div class="w3-container w3-margin-bottom">
                            <div class="detalles-viaje w3-margin-bottom">
                                <div>
                                    <h3>Desde:</h3>
                                    <p>{{origen}}</p>
                                </div>
                                <div>
                                    <h3>Hasta:</h3>
                                    <p>{{destino}}</p>
                                </div>
                            </div>
                            <a href="/pw2-grupo03/travel/deleteTravel?id={{id_viaje}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom">Eliminar</a>
                            <a href="/pw2-grupo03/travel/editTravel?id={{id_viaje}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom">Editar</a>
                        </div>
                    </div>
                    {{/travels}}
                </div>
            </div>
        </div>
    </div>
</div>

{{> footerSidebarFixed}}