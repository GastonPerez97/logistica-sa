{{> headerWithSidebar}}

<div class="w3-content my-3em">
    <h1 class="w3-center my-1em">{{detourReportedOk}}</h1>
    <h1 class="w3-center my-1em">{{refuelReportedOk}}</h1>

    <div class="w3-content w3-section">
        <div class="w3-container w3-margin-top">
            <a href="/pw2-grupo03/travel/reportDetour?id={{idTravel}}" class="w3-button w3-block w3-amber w3-padding-large w3-round-large">
                <b>Informar desvío<b>
            </a>
        </div>
    </div>
    <div class="w3-content w3-section">
        <div class="w3-container">
            <a href="/pw2-grupo03/travel/reportRefuel?id={{idTravel}}" class="w3-button w3-block w3-amber w3-padding-large w3-round-large">
                <b>Informar carga de combustible<b>
            </a>
        </div>
    </div>
    <div class="w3-content w3-section">
        <div class="w3-container">
            <a href="/pw2-grupo03/travel/reportPosition?id={{idTravel}}" class="w3-button w3-block w3-amber w3-padding-large w3-round-large">
                <b>Informar posición<b>
            </a>
        </div>
    </div>
</div>

{{> footerSidebarFixed}}