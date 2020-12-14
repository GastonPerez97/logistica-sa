{{> headerWithSidebar}}

<div class="container-80pct">
    <div class="w3-margin">
        {{#_SESSION.supervisor}}
        <a href="/pw2-grupo03/travel/newTravel"
           class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2em;">Nuevo Viaje</a>
        {{/_SESSION.supervisor}}
        <h2 class="w3-center w3-margin-bottom">{{proformaError}}</h2>
        <h2 class="w3-center w3-margin-bottom">{{errorEditar}}</h2>
        <h2 class="w3-center w3-margin-bottom">{{travelFinished}}</h2>
        <div class="my-2em">
            <table id="data-table" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="table-head">
                        <th class="vertical-align-middle">ID</th>
                        <th class="vertical-align-middle">Origen</th>
                        <th class="vertical-align-middle">Destino</th>
                        <th class="vertical-align-middle">ETD</th>
                        <th class="vertical-align-middle">ETA</th>
                        <th class="vertical-align-middle">Chofer</th>
                        <th class="vertical-align-middle">Editar</th>
                        <th class="vertical-align-middle">Proforma</th>
                        <th class="vertical-align-middle">Finalizar Viaje</th>
                    </tr>
                </thead>
                <tbody>
                {{#travels}}
                        <tr>
                            <td class="vertical-align-middle">{{id_viaje}}</td>
                            <td class="vertical-align-middle">{{origen}}</td>
                            <td class="vertical-align-middle">{{destino}}</td>
                            <td class="vertical-align-middle">{{fecha_salida_estimada}}</td>
                            <td class="vertical-align-middle">{{fecha_llegada_estimada}}</td>
                            <td class="vertical-align-middle">{{apellido}}, {{nombre}}</td>
                            <td class="vertical-align-middle {{#fecha_llegada}}cursor-not-allowed{{/fecha_llegada}}">
                                <a href="/pw2-grupo03/travel/editTravel?id={{id_viaje}}"
                                   class="w3-button w3-blue w3-tiny w3-round
                                         {{#fecha_llegada}}disabled-btn{{/fecha_llegada}}">Editar</a>
                            </td>
                            <td class="vertical-align-middle">
                                <a href="/pw2-grupo03/travel/viewProforma?id={{id_viaje}}"
                                   class="w3-button w3-green w3-tiny w3-round">Ver Proforma</a>
                            </td>
                            <td class="vertical-align-middle {{#fecha_llegada}}cursor-not-allowed{{/fecha_llegada}}">
                                <a href="/pw2-grupo03/travel/finalizeTravel?id={{id_viaje}}"
                                   class="w3-button w3-black w3-tiny w3-round
                                         {{#fecha_llegada}}disabled-btn{{/fecha_llegada}}">Finalizar Viaje</a>
                            </td>
                        </tr>
                    {{/travels}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{> deleteAlert}}
{{> footerSidebarFixed}}