<?php

class BillModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getBills() {
        $sql = "SELECT * FROM factura F JOIN viaje V ON F.id_viaje = V.id_viaje
                                        JOIN cliente C ON V.id_cliente = C.id_cliente
                                        JOIN proforma P ON F.id_viaje = P.id_viaje";
        return $this->database->query($sql);
    }

    public function getBillBy($travelId) {
        $sql = "SELECT F.id_factura, F.numero_factura, F.fecha_facturacion,
                       F.fecha_pago, C.id_cliente, F.id_viaje,
                       P.viatico_real, P.peaje_y_pesaje_real, P.extras_real,
                       P.hazard_real, P.reefer_real, P.fee_real,
                       C.cuit, C.telefono, C.direccion, C.denominacion
                FROM factura F JOIN viaje V ON F.id_viaje = V.id_viaje
                               JOIN cliente C ON V.id_cliente = C.id_cliente
                               JOIN proforma P ON F.id_viaje = P.id_viaje
                WHERE F.id_viaje = '$travelId'";

        $result = $this->database->query($sql);
        return $result[0];
    }

    public function checkIfBillExistsOf($travelId) {
        $sql = "SELECT * FROM factura WHERE id_viaje = '$travelId'";
        $result = $this->database->query($sql);

        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function createBillOf($billData) {
        $travelId = $billData["travelId"];
        $billDate = $billData["billDate"];

        $sql = "INSERT INTO factura (fecha_facturacion, id_viaje) VALUES ('$billDate', '$travelId')";
        $this->database->execute($sql);
    }

    public function generateBillOf($travelId) {
        require('third-party/fpdf/fpdfBill.php');

        $bill = $this->getBillBy($travelId);

        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',20);

        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(71 ,5,'Logistica S.A.',0,0);
        $pdf->Cell(59 ,5,'Cliente: ' . $bill["denominacion"],0,1);

        $pdf->SetFont('Arial','',10);

        $pdf->Cell(71 ,10,'logistica-sa@gmail.com',0,0);
        $pdf->Cell(40 ,10,'ID de Cliente:',0,0);
        $pdf->Cell(25 ,10, $bill["id_cliente"],0,0);
        $pdf->Cell(22 ,10, 'CUIT:',0,0);
        $pdf->Cell(0 ,10, $bill["cuit"],0,1);

        $pdf->Cell(71 ,2,'4684-1747',0,0);
        $pdf->Cell(40 ,2,'Fecha de facturacion:',0,0);
        $pdf->Cell(25 ,2,$bill["fecha_facturacion"],0,0);
        $pdf->Cell(22 ,2, 'Direccion:',0,0);
        $pdf->Cell(0 ,2, $bill["direccion"],0,1);

        $pdf->Cell(71 ,10,'',0,0);
        $pdf->Cell(40 ,10,'Nro Factura:',0,0);
        $pdf->Cell(25 ,10,$bill["numero_factura"],0,0);
        $pdf->Cell(22 ,10, 'Telefono:',0,0);
        $pdf->Cell(0 ,10, $bill["telefono"],0,1);


        $pdf->Cell(50 ,10,'',0,1);

        $pdf->SetFont('Arial','B',10);

        $pdf->Cell(10 ,6,'Item',1,0,'C');
        $pdf->Cell(150 ,6,'Descripcion',1,0,'C');
        $pdf->Cell(28 ,6,'Total',1,1,'C');

        $pdf->SetFont('Arial','',10);

        $pdf->Cell(10, 6, 1, 1, 0);
        $pdf->Cell(150, 6, 'Viaticos', 1, 0);
        $pdf->Cell(28, 6, '$' . $bill["viatico_real"], 1, 1, 'R');
        $pdf->Cell(10, 6, 2, 1, 0);
        $pdf->Cell(150, 6, 'Peajes y pesaje', 1, 0);
        $pdf->Cell(28, 6, '$' . $bill["peaje_y_pesaje_real"], 1, 1, 'R');
        $pdf->Cell(10, 6, 3, 1, 0);
        $pdf->Cell(150, 6, 'Fee', 1, 0);
        $pdf->Cell(28, 6, '$' . $bill["fee_real"], 1, 1, 'R');
        $pdf->Cell(10, 6, 4, 1, 0);
        $pdf->Cell(150, 6, 'Hazard', 1, 0);
        $pdf->Cell(28, 6, '$' . $bill["hazard_real"], 1, 1, 'R');
        $pdf->Cell(10, 6, 5, 1, 0);
        $pdf->Cell(150, 6, 'Reefer', 1, 0);
        $pdf->Cell(28, 6, '$' . $bill["reefer_real"], 1, 1, 'R');
        $pdf->Cell(10, 6, 6, 1, 0);
        $pdf->Cell(150, 6, 'Extras', 1, 0);
        $pdf->Cell(28, 6, '$' . $bill["extras_real"], 1, 1, 'R');


        $subtotal = $bill["viatico_real"]
                    + $bill["peaje_y_pesaje_real"]
                    + $bill["fee_real"]
                    + $bill["hazard_real"]
                    + $bill["reefer_real"]
                    + $bill["extras_real"];

        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(42, 7, 'Subtotal', 0, 0, 'R');
        $pdf->Cell(28, 6, '$' . $subtotal, 1, 0, 'R');


        $pdf->Output();
    }

}