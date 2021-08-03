{{> headerWithSidebar}}

<div class="container-80pct">
    <div class="w3-margin">
        <a href="/client/newClient" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Cliente</a>

        <div class="my-2em">
            <table id="data-table" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="table-head">
                        <th class="vertical-align-middle">Denominación</th>
                        <th class="vertical-align-middle">E-Mail</th>
                        <th class="vertical-align-middle">CUIT</th>
                        <th class="vertical-align-middle">Telefono</th>
                        <th class="vertical-align-middle">Dirección</th>
                        <th class="vertical-align-middle">Contacto 1</th>
                        <th class="vertical-align-middle">Contacto 2</th>
                        <th class="vertical-align-middle">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    {{#clients}}
                        <tr>
                            <td class="vertical-align-middle">{{denominacion}}</td>
                            <td class="vertical-align-middle">{{email}}</td>
                            <td class="vertical-align-middle">{{cuit}}</td>
                            <td class="vertical-align-middle">{{telefono}}</td>
                            <td class="vertical-align-middle">{{direccion}}</td>
                            <td class="vertical-align-middle">{{contacto1}}</td>
                            <td class="vertical-align-middle">{{contacto2}}</td>
                            <td class="vertical-align-middle">
                                <a href="/client/editClient?id={{id_cliente}}"
                                   class="w3-button w3-blue w3-tiny w3-round">Editar</a>
                            </td>
                        </tr>
                    {{/clients}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{> dataTable}}
{{> footerSidebarFixed}}