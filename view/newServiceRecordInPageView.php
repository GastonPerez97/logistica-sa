{{> headerWithSidebar}}

<div class="container-80pct">
    <div class="w3-margin">
        <a href="/report/newServiceRecord" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Exportar PDF</a>

        <div class="my-2em">
            <table id="data-table-services" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="table-head">
                        <th class="vertical-align-middle">N° Service</th>
                        <th class="vertical-align-middle">N° Unidad</th>
                        <th class="vertical-align-middle">Fecha</th>
                        <th class="vertical-align-middle">Kilometros</th>
                        <th class="vertical-align-middle">Descripción</th>
                        <th class="vertical-align-middle">Costo</th>
                    </tr>
                </thead>
                <tbody>
                    {{#servicesByDate}}
                        <tr>
                            <td class="vertical-align-middle">{{id_service}}</td>
                            <td class="vertical-align-middle">{{vehiculo}}</td>
                            <td class="vertical-align-middle">{{fecha_service}}</td>
                            <td class="vertical-align-middle">{{KM}}</td>
                            <td class="vertical-align-middle">{{detalle}}</td>
                            <td class="vertical-align-middle">{{costo}}</td>
                        </tr>
                    {{/servicesByDate}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{> dataTable}}
{{> footerSidebarFixed}}
