{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <a href="/pw2-grupo03/travel/newTravel" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Viaje</a>
        <div>
            <div class="w3-row-padding">
                {{#travels}}
                    <div class="w3-col s12 m6 l6 w3-center" style="margin-bottom: 2em;">
                        <div class="w3-card-4 w3-round">
                            <header class="w3-container w3-light-grey w3-margin-bottom">
                                <div class="d-flex justify-content-center">
                                    <h3>ID: {{id_viaje}}</h3>
                                </div>
                            </header>

                            <div class="w3-container w3-margin-bottom">
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <h3>Desde:</h3>
                                        <p>{{origen}}</p>
                                    </div>
                                    <div>
                                        <h3>Hasta:</h3>
                                        <p>{{destino}}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around my-1em">
                                    <div>
                                        <h3>Fecha salida:</h3>
                                        <p>{{fecha_salida}}</p>
                                    </div>
                                    <div>
                                        <h3>ETA:</h3>
                                        <p>{{fecha_llegada_estimada}}</p>
                                    </div>
                                </div>

                                <a href="/pw2-grupo03/travel/deleteTravel?id={{id_viaje}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom w3-margin-top delete-btn-travel">Eliminar</a>
                                <a href="/pw2-grupo03/travel/editTravel?id={{id_viaje}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom w3-margin-top">Editar</a>
                            </div>
                        </div>
                    </div>
                {{/travels}}
            </div>
        </div>
    </div>
</div>

{{> deleteAlert}}
{{> footerSidebarFixed}}