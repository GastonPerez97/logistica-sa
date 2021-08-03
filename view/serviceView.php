{{> headerWithSidebar}}

<div class="container-80pct">
    <div class="w3-margin">
        <a href="/service/newService" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Servicio</a>

        <div class="my-2em">
            <table id="data-table" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="table-head">
                        <th class="vertical-align-middle">N° Service</th>
                        <th class="vertical-align-middle">N° Unidad</th>
                        <th class="vertical-align-middle">Fecha</th>
                        <th class="vertical-align-middle">Kilometros</th>
                        <th class="vertical-align-middle">Service interno</th>
                        <th class="vertical-align-middle">Descripción</th>
                        <th class="vertical-align-middle">Costo</th>
                        <th class="vertical-align-middle">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    {{#services}}
                        <tr>
                            <td class="vertical-align-middle">{{id_service}}</td>
                            <td class="vertical-align-middle">{{id_unidad_de_transporte}}</td>
                            <td class="vertical-align-middle">{{fecha_service}}</td>
                            <td class="vertical-align-middle">{{kilometraje_actual_unidad}}</td>
                            <td class="vertical-align-middle">{{interno}}</td>
                            <td class="vertical-align-middle">{{detalle}}</td>
                            <td class="vertical-align-middle">{{costo}}</td>
                            <td class="vertical-align-middle">
                                <a href="/service/editService?id={{id_service}}"
                                   class="w3-button w3-blue w3-tiny w3-round">Editar</a>
                            </td>
                        </tr>
                    {{/services}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{> dataTable}}
{{> footerSidebarFixed}}