{{> header}}

<main>

    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-right" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Cerrar &times;</button>
        <h3 class="w3-bar-item">Menú</h3>
        <a href="#" class="w3-bar-item w3-button">Mis Viajes</a>
        <a href="#" class="w3-bar-item w3-button">Nuevo viaje</a>
        <a href="#" class="w3-bar-item w3-button">Facturación</a>
    </div>
    <div class="w3-content">
        <div class="w3-margin">
            <input type="text" class="w3-bar-item w3-input w3-border w3-round w3-margin-bottom" style="margin-top: 2.5em;" placeholder="Buscar Viaje..">
            <a href="/pw2-grupo03/travel/newTravel" class="w3-button w3-green w3-padding-large w3-round w3-right" style="margin-bottom: 2.5em;">Nuevo Viaje</a>
            <div>
                <div class="w3-row-padding">
                    {#travels}
                    <div class="w3-col s12 m6 l4 w3-center" style="margin-bottom: 2em;">
                        <div class="w3-card-4 w3-round">
                            <header class="w3-container w3-light-grey d-flex-centrado">
                                <img src="../public/images/qr.png" alt="user" class="w3-left w3-image w3-margin-top" style="width:50%;">
                            </header>
                            <div class="w3-container w3-margin-bottom">
                                <div class="detalles-viaje w3-margin-bottom">
                                    <div>
                                        <h3>Desde:</h3>
                                        <p>{{origen}}</p>
                                    </div>
                                    <div>
                                        <h3>Hasta:</h3>
                                        <p>{{destino}}</p>
                                    </div>
                                </div>
                                <a href="/pw2-grupo03/travel/deleteTravel?id={{id_viaje}}" class="w3-button w3-red w3-tiny w3-round w3-margin-bottom">Eliminar</a>
                                <a href="/pw2-grupo03/travel/editTravel?id={{id_viaje}}" class="w3-button w3-blue w3-tiny w3-round w3-margin-bottom">Editar</a>
                            </div>
                        </div>
                        {/travels}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{> footer}}