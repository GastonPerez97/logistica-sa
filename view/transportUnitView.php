{{> headerWithSidebar}}

<div class="container-90pct">
    <div class="w3-margin">
        <a href="/pw2-grupo03/transportUnit/newTrailer" class="w3-button w3-green w3-padding-large w3-round w3-right w3-margin" style="margin-bottom: 2.5em;">Nuevo Remolque</a>
        <a href="/pw2-grupo03/transportUnit/newVehicle" class="w3-button w3-green w3-padding-large w3-round w3-right w3-margin" style="margin-bottom: 2.5em;">Nuevo Vehículo</a>

        <div>
            <button onclick="collapse('vehicles')" class="w3-btn w3-block w3-blue w3-margin w3-round w3-xlarge">
                Vehículos</button>
            <div id="vehicles" class="w3-hide w3-center">
                <table id="data-table" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                    <thead>
                        <tr class="table-head">
                            <th class="vertical-align-middle">Unidad</th>
                            <th class="vertical-align-middle">Patente</th>
                            <th class="vertical-align-middle">Año fabricación</th>
                            <th class="vertical-align-middle">Motor</th>
                            <th class="vertical-align-middle">Chasis</th>
                            <th class="vertical-align-middle">Kilometraje</th>
                            <th class="vertical-align-middle">Marca</th>
                            <th class="vertical-align-middle">Modelo</th>
                            <th class="vertical-align-middle">Tipo</th>
                            <th class="vertical-align-middle">Estado</th>
                            <th class="vertical-align-middle">Editar</th>
                            <th class="vertical-align-middle">Des/Habilitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{#vehicles}}
                            <tr>
                                <td class="vertical-align-middle">{{id_unidad_de_transporte}}</td>
                                <td class="vertical-align-middle">{{patente}}</td>
                                <td class="vertical-align-middle">{{anio_fabricacion}}</td>
                                <td class="vertical-align-middle">{{numero_motor}}</td>
                                <td class="vertical-align-middle">{{numero_chasis}}</td>
                                <td class="vertical-align-middle">{{kilometraje}}</td>
                                <td class="vertical-align-middle">{{marca}}</td>
                                <td class="vertical-align-middle">{{modelo}}</td>
                                <td class="vertical-align-middle">{{tipo}}</td>
                                <td class="vertical-align-middle">{{estado_pretty}}</td>
                                <td class="vertical-align-middle">
                                    <a href="/pw2-grupo03/transportUnit/editTransportUnit?id={{id_unidad_de_transporte}}&type=0"
                                       class="w3-button w3-blue w3-tiny w3-round">Editar</a>
                                </td>
                                <td class="vertical-align-middle">
                                    <a href="/pw2-grupo03/transportUnit/enableTransportUnit?id={{id_unidad_de_transporte}}&actualState={{estado}}"
                                       class="w3-button w3-red w3-tiny w3-round">Des/Habilitar</a>
                                </td>
                            </tr>
                        {{/vehicles}}
                    </tbody>
                </table>
            </div>

            <button onclick="collapse('trailers')" class="w3-btn w3-block w3-blue w3-margin w3-round w3-xlarge">
                Remolques</button>
            <div id="trailers" class="w3-hide w3-center">
                <table id="data-table-2" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                    <thead>
                        <tr class="table-head">
                            <th class="vertical-align-middle">Unidad</th>
                            <th class="vertical-align-middle">Patente</th>
                            <th class="vertical-align-middle">Año fabricación</th>
                            <th class="vertical-align-middle">Chasis</th>
                            <th class="vertical-align-middle">Marca</th>
                            <th class="vertical-align-middle">Modelo</th>
                            <th class="vertical-align-middle">Tipo</th>
                            <th class="vertical-align-middle">Estado</th>
                            <th class="vertical-align-middle">Editar</th>
                            <th class="vertical-align-middle">Des/Habilitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{#trailers}}
                            <tr>
                                <td class="vertical-align-middle">{{id_unidad_de_transporte}}</td>
                                <td class="vertical-align-middle">{{patente}}</td>
                                <td class="vertical-align-middle">{{anio_fabricacion}}</td>
                                <td class="vertical-align-middle">{{numero_chasis}}</td>
                                <td class="vertical-align-middle">{{marca}}</td>
                                <td class="vertical-align-middle">{{modelo}}</td>
                                <td class="vertical-align-middle">{{tipo}}</td>
                                <td class="vertical-align-middle">{{estado_pretty}}</td>
                                <td class="vertical-align-middle">
                                    <a href="/pw2-grupo03/transportUnit/editTransportUnit?id={{id_unidad_de_transporte}}&type=1"
                                       class="w3-button w3-blue w3-tiny w3-round">Editar</a>
                                </td>
                                <td class="vertical-align-middle">
                                    <a href="/pw2-grupo03/transportUnit/enableTransportUnit?id={{id_unidad_de_transporte}}&actualState={{estado}}"
                                       class="w3-button w3-red w3-tiny w3-round">Des/Habilitar</a>
                                </td>
                            </tr>
                        {{/trailers}}
                    </tbody>
                </table>
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