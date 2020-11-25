{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">

        <a href="/pw2-grupo03/transportUnit/newTrailer" class="w3-button w3-green w3-padding-large w3-round w3-right w3-margin" style="margin-bottom: 2.5em;">Nuevo Remolque</a>
        <a href="/pw2-grupo03/transportUnit/newVehicle" class="w3-button w3-green w3-padding-large w3-round w3-right w3-margin" style="margin-bottom: 2.5em;">Nuevo Vehículo</a>

        <div>
            <div class="w3-row">
                <button onclick="collapse('vehicles')" class="w3-btn w3-block w3-blue w3-margin w3-round w3-xlarge">
                    Vehículos</button>
                <div id="vehicles" class="w3-hide w3-center">
                    {{#vehicles}}
                    <div class="w3-col s12 m6 l4 w3-center" style="margin-bottom: 2em;">
                        <div class="w3-card-4 w3-round w3-margin">
                            <header class="w3-container w3-light-grey d-flex-centrado">
                                <h3>Unidad N° {{id_vehiculo}}</h3>
                            </header>

                            <div class="w3-container w3-margin-bottom">
                                <div class="detalles-viaje w3-margin-bottom">
                                    <div>
                                        <h3>Patente:</h3>
                                        <p>{{patente}}</p>
                                    </div>
                                    <div>
                                        <h3>Año fabricación:</h3>
                                        <p>{{anio_fabricacion}}</p>
                                    </div>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Número de motor:</h3>
                                    <p class="margin-0">{{numero_motor}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Número de chasis:</h3>
                                    <p class="margin-0">{{numero_chasis}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Kilometraje:</h3>
                                    <p class="margin-0">{{kilometraje}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Marca:</h3>
                                    <p class="margin-0">{{marca}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Modelo:</h3>
                                    <p class="margin-0">{{modelo}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Tipo de vehículo:</h3>
                                    <p class="margin-0">{{tipo}}</p>
                                </div>

                                <!--<a href="/pw2-grupo03/transportUnit/enableTransportUnit?id={{id_vehiculo}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom delete-btn-service">Des/Habilitar</a>
                                <a href="/pw2-grupo03/transportUnit/editTransportUnit?id={{id_vehiculo}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom">Editar</a>-->
                            </div>
                        </div>
                    </div>
                    {{/vehicles}}
                </div>

                <button onclick="collapse('trailers')" class="w3-btn w3-block w3-blue w3-margin w3-round w3-xlarge">
                    Remolques</button>
                <div id="trailers" class="w3-hide w3-center">
                    {{#trailers}}
                    <div class="w3-col s12 m6 l4 w3-center" style="margin-bottom: 2em;">
                        <div class="w3-card-4 w3-round w3-margin">
                            <header class="w3-container w3-light-grey d-flex-centrado">
                                <h3>Unidad N° {{id_remolque}}</h3>
                            </header>

                            <div class="w3-container w3-margin-bottom">
                                <div class="detalles-viaje w3-margin-bottom">
                                    <div>
                                        <h3>Patente:</h3>
                                        <p>{{patente}}</p>
                                    </div>
                                    <div>
                                        <h3>Año fabricación:</h3>
                                        <p>{{anio_fabricacion}}</p>
                                    </div>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Número de chasis:</h3>
                                    <p class="margin-0">{{numero_chasis}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Marca:</h3>
                                    <p class="margin-0">{{marca}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Modelo:</h3>
                                    <p class="margin-0">{{modelo}}</p>
                                </div>
                                <div class="detalles-viaje w3-margin-bottom">
                                    <h3 class="margin-0">Tipo:</h3>
                                    <p class="margin-0">{{tipo}}</p>
                                </div>

                                <!--<a href="/pw2-grupo03/transportUnit/enableTransportUnit?id={{id_remolque}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom delete-btn-service">Des/Habilitar</a>
                                <a href="/pw2-grupo03/transportUnit/editTransportUnit?id={{id_remolque}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom">Editar</a>-->
                            </div>
                        </div>
                    </div>
                    {{/trailers}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function collapse(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>

{{> deleteAlert}}
{{> footerSidebarFixed}}