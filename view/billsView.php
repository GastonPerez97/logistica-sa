{{> headerWithSidebar}}

<div class="container-80pct">
    <div class="w3-margin">
        <div class="my-2em">
            <table id="data-table" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="table-head">
                        <th class="vertical-align-middle">Factura de viaje con ID</th>
                        <th class="vertical-align-middle">Cliente</th>
                        <th class="vertical-align-middle">Dirección</th>
                        <th class="vertical-align-middle">Telefono</th>
                        <th class="vertical-align-middle">CUIT</th>
                        <th class="vertical-align-middle">Fecha de facturación</th>
                        <th class="vertical-align-middle">Ver Factura</th>
                    </tr>
                </thead>
                <tbody>
                    {{#bills}}
                        <tr>
                            <td class="vertical-align-middle">{{id_viaje}}</td>
                            <td class="vertical-align-middle">{{denominacion}}</td>
                            <td class="vertical-align-middle">{{direccion}}</td>
                            <td class="vertical-align-middle">{{telefono}}</td>
                            <td class="vertical-align-middle">{{cuit}}</td>
                            <td class="vertical-align-middle">{{fecha_facturacion}}</td>
                            <td class="vertical-align-middle">
                                <a href="/pw2-grupo03/bill/viewBill?id={{id_viaje}}"
                                   class="w3-button w3-green w3-round w3-small">Ver Factura</a>
                            </td>
                        </tr>
                    {{/bills}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{> dataTable}}
{{> footerSidebarFixed}}