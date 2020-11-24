{{> header}}

<div class="w3-content my-3em">
    {{#_SESSION.chofer}}
    <div class="w3-content w3-section">
        <div class="w3-container">
            <a href="/pw2-grupo03/travel" class="w3-button w3-block w3-amber w3-padding-large w3-round-large" ><b>Mis Viajes (Chofer)<b></a>
        </div>
    </div>
    {{/_SESSION.chofer}}
    {{#_SESSION.encargado}}
    <div class="w3-content w3-section">
        <div class="w3-container ">
            <a href="/pw2-grupo03/service" class="w3-button w3-block w3-amber w3-padding-large w3-round-large" ><b>Mantenimiento de Vehiculos (Encargado de Taller)<b></a>
        </div>
    </div>
    {{/_SESSION.encargado}}
    {{#_SESSION.admin}}
    <div class="w3-content w3-section">
        <div class="w3-container ">
            <a href="/pw2-grupo03/usuarios" class="w3-button w3-block w3-amber w3-padding-large w3-round-large" ><b>Usuarios (Administrador)<b></a>
        </div>
    </div>
    <div class="w3-content w3-section">
        <div class="w3-container ">
            <a href="/pw2-grupo03/report" class="w3-button w3-block w3-amber w3-padding-large w3-round-large" ><b>Reportes (Administrador)<b></a>
        </div>
    </div>
    {{/_SESSION.admin}}
</div>

{{> footer}}