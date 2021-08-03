{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <form action="/usuarios/processEditUser" method="post" class="login-form">
            {{#user}}
                <input type="hidden" name="userId" value="{{id_usuario}}">
                <input type="hidden" value="{{id_tipo_licencia}}" id="type-of-licence-hidden">
                <input type="hidden" value="{{numero_licencia}}" id="licence-number-hidden">

                <div class="container-title"><p>Editar Usuario</p></div>

                <div class="container">
                    <div class="w3-margin-bottom d-flex justify-content-between align-items-center">
                        <a href="/usuarios" class="w3-button w3-green w3-small w3-round text-decoration-none">Volver a Usuarios</a>
                        <h4>ID: {{id_usuario}}</h4>
                    </div>

                    <label for="email"><b>E-Mail:</b></label>
                    <input type="text" value="{{email}}" name="email" class="login-input">

                    <div class="my-2em d-flex justify-content-between align-items-center">
                        <label for="active"><b>Activo:</b></label>
                        <input class="w3-check w3-margin-bottom" type="checkbox" name="active" {{#activado}}checked="checked"{{/activado}}>
                    </div>

                    <div class="my-2em">
                        <p for="roles" class="w3-margin-bottom"><b>Seleccionar roles:</b></p>

                        <ul>
                            {{#roles}}
                                <li>
                                    <div class="d-flex w3-margin-bottom justify-content-between align-items-center">
                                        <label for="roles">{{nombre}}</label>
                                        <input class="w3-check" type="checkbox" name="roles[]" value="{{id_rol}}" id="role-{{id_rol}}" {{checked}}>
                                    </div>
                                </li>
                            {{/roles}}
                        </ul>
                    </div>

                    <div class="my-2em" id="driver-form" style="display: none;">
                        <label for="licence-type-select"><b>Tipo de licencia <span style="color: red">*</span></b></label>
                        <select class="w3-select" name="licenceType" id="licence-type-select">
                            {{# typesOfLicence }}
                            <option value="{{ id_tipo_licencia }}">
                                {{ nombre }} - {{ descripcion }}
                            </option>
                            {{/ typesOfLicence }}
                        </select>

                        <label for="licence-number"><b>Nro. licencia:</b></label>
                        <input type="text" value="{{numero_licencia}}" name="licenceNumber" class="login-input" id="licence-number">
                    </div>

                    <button class="form-button w3-round w3-blue w3-margin-top" type="submit">Editar Usuario</button>
                </div>
            {{/user}}
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        isDriver();

        function isDriver() {
            if ($("#role-4").is(':checked')) {
                $("#driver-form").show();
                var typeOfLicence = $("#type-of-licence-hidden").val();
                var licenceNumber = $("#licence-number-hidden").val();
                $("#licence-type-select").val(typeOfLicence);
                $("#licence-number").val(licenceNumber);
            } else {
                $("#driver-form").hide();
                $("#licence-type-select").val("");
                $("#licence-number").val("");
            }
        };

        $("#role-4").on('click', function(){
            isDriver();
        });
    });
</script>

{{> footerSidebarFixed}}