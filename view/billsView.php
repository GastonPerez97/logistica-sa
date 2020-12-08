{{> headerWithSidebar}}

<div class="w3-content">
    <div class="w3-margin">
        <div class="w3-row-padding my-2em">
            {{#bills}}
                <div class="w3-col s12 m6 l6 w3-center" style="margin-bottom: 2em;">
                    <div class="w3-card-4 w3-round">
                        <header class="w3-container w3-light-grey w3-margin-bottom">
                            <div class="d-flex justify-content-center">
                                <h3>Factura de Viaje con ID {{id_viaje}}</h3>
                            </div>
                        </header>

                        <div class="w3-container w3-margin-bottom">
                            <div class="d-flex justify-content-around">
                                <div>
                                    <h3>Cliente:</h3>
                                    <p>{{denominacion}}</p>
                                </div>
                                <div>
                                    <h3>CUIT:</h3>
                                    <p>{{cuit}}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around my-1em">
                                <div>
                                    <h3>Nro. Factura:</h3>
                                    <p>{{numero_factura}}</p>
                                </div>
                                <div>
                                    <h3>Fecha de Facturación:</h3>
                                    <p>{{fecha_facturacion}}</p>
                                </div>
                            </div>

                            <a href="/pw2-grupo03/bill/viewBill?id={{id_viaje}}" class="w3-button w3-green w3-round w3-margin-bottom w3-margin-top">Ver Factura</a>
                        </div>
                    </div>
                </div>
            {{/bills}}
        </div>
    </div>
</div>

{{> deleteAlert}}
{{> footerSidebarFixed}}