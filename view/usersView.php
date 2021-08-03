{{> headerWithSidebar}}

<div class="container-80pct">
    <div class="w3-margin">
        <h1 class="w3-center w3-margin-bottom">{{userDeletedOk}}</h1>

        <div class="my-2em">
            <table id="data-table" class="w3-table w3-border w3-bordered w3-centered display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="table-head">
                        <th class="vertical-align-middle">ID</th>
                        <th class="vertical-align-middle">Nombre</th>
                        <th class="vertical-align-middle">Apellido</th>
                        <th class="vertical-align-middle">E-Mail</th>
                        <th class="vertical-align-middle">Editar</th>
                        <th class="vertical-align-middle">Ver Usuario</th>
                    </tr>
                </thead>
                <tbody>
                {{#users}}
                <tr>
                    <td class="vertical-align-middle">{{id_usuario}}</td>
                    <td class="vertical-align-middle">{{nombre}}</td>
                    <td class="vertical-align-middle">{{apellido}}</td>
                    <td class="vertical-align-middle">{{email}}</td>
                    <td class="vertical-align-middle">
                        <a href="/usuarios/editarUsuario?id={{id_usuario}}"
                           class="w3-button w3-blue w3-tiny w3-round">Editar</a>
                    </td>
                    <td class="vertical-align-middle">
                        <a href="/usuarios/verUsuario?id={{id_usuario}}"
                           class="w3-button w3-green w3-tiny w3-round">Ver Usuario</a>
                    </td>
                </tr>
                {{/users}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{> dataTable}}
{{> footerSidebarFixed}}