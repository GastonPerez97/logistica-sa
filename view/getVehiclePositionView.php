{{> headerWithSidebar}}

<div class="container-80pct">
    <div class="w3-margin">
        <div class="my-2em">
            <table id="data-table" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="table-head">
                        <th class="vertical-align-middle">ID</th>
                        <th class="vertical-align-middle">Patente</th>
                        <th class="vertical-align-middle">Numero de chasis</th>
                        <th class="vertical-align-middle">Posición</th>
                    </tr>
                </thead>
                <tbody>
                    {{#transportUnits}}
                        <tr>
                            <td class="vertical-align-middle">{{id_unidad_de_transporte}}</td>
                            <td class="vertical-align-middle">{{patente}}</td>
                            <td class="vertical-align-middle">{{numero_chasis}}</td>
                            <td class="vertical-align-middle">
                                <a href="{{posicion_actual}}" target="_blank"
                                   class="w3-button w3-blue w3-small w3-round">Obtener última posición</a>
                            </td>
                        </tr>
                    {{/transportUnits}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{> dataTable}}
{{> footerSidebarFixed}}