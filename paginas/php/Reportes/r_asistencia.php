<?php
    
    require '../../modelo/conexion.php';
    require('../fpdf/fpdf.php');

class PDF extends FPDF
{

    // Cabecera de página
    function Header()
    {
        $gpor=$_POST['m'];
        $fini=$_POST['fi'];
        $ffin=$_POST['ff'];
        // Logo (ajustar tamaño automáticamente)
        $this->Image('../../../assets/img/logo-hosanna.png', 10, 10, 40); 
        
        // Título del colegio
        $this->SetFont('Arial','B',12);
        $this->Cell(190,10,utf8_decode('COLEGIO HOSANNA'),0,1,'C');

        // Título principal
        $this->SetFont('Arial','B',14);
        $this->Cell(190,10,utf8_decode('Reporte Mensual de Asistencias'),0,1,'C');

        // Subtítulo
        $this->SetFont('Arial','B',12);
        $this->Cell(190,10,utf8_decode('Control de Asistencias'),0,1,'C');

        // Salto de línea
        $this->Ln(5);

        // Celdas con información (con variables para fechas)
        $this->SetFont('Arial','',10);
        $fecha_inicio = $fini;
        $fecha_fin = $ffin;
        $this->Cell(66,10,utf8_decode("FECHA: $fecha_inicio al $fecha_fin"),1,0,'L');
        $this->Cell(38,10,utf8_decode('Control de Asistencias'),1,0,'L');
        $this->Cell(86,10,utf8_decode('Fecha de Creación: '.date('Y-m-d')),1,1,'L');

        // Celda con el nombre del docente
        /*$this->Cell(190,10,utf8_decode('NOMBRE DEL DOCENTE: Carlos Lisandro Martínez Sandoval.'),1,1,'L');*/

        // Salto de línea antes de la tabla
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

// Aquí puedes agregar la tabla con los datos debajo del encabezado
$pdf->Cell(25,10,'Nombre',1,0,'C');
$pdf->Cell(25,10,'Apellido',1,0,'C');
$pdf->Cell(25,10,'Fecha',1,0,'C');
$pdf->Cell(25,10,'Asistencias',1,0,'C');
$pdf->Cell(25,10,'Inasistencias',1,0,'C');
$pdf->Cell(65,10,'Inasistencias con Permiso',1,1,'C');

    $gpor=$_POST['m'];
    $fini=$_POST['fi'];
    $ffin=$_POST['ff'];

// Datos de ejemplo en la tabla
$key = conectar();

$consulta = "SELECT m.Nombre n, m.Apellido ape, a.Fecha AS Fecha, SUM(CASE WHEN a.Tipo_Asistencia = 'presente' THEN 1 ELSE 0 END) AS Asistencias, SUM(CASE WHEN a.Tipo_Asistencia = 'ausente' THEN 1 ELSE 0 END) AS Inacistencias, SUM(CASE WHEN a.Tipo_Asistencia = 'permiso' THEN 1 ELSE 0 END) AS Inacistencias_Con_Permiso FROM asistencias a, maestros m WHERE a.ID_Maestro = m.ID_Maestro AND a.Fecha BETWEEN '$fini' AND '$ffin' GROUP BY m.$gpor";
$resultado = $key->query($consulta);
mysqli_set_charset($key, "utf8");


while ($datos=$resultado->fetch_assoc()) {
    /*$pdf->Cell(25,10,'Nombre '.$i,1,0,'C');
    $pdf->Cell(25,10,'Apellido '.$i,1,0,'C');
    $pdf->Cell(25,10,'2024-09-'.$i,1,0,'C');
    $pdf->Cell(25,10,'5',1,0,'C');
    $pdf->Cell(25,10,'1',1,0,'C');
    $pdf->Cell(65,10,'Con permiso '.$i,1,1,'C');*/

    $pdf->Cell(25,10,utf8_decode($datos['n']),1,0,'C',0);
    $pdf->Cell(25,10,utf8_decode($datos['ape']),1,0,'C',0);
    $pdf->Cell(25,10,$datos['Fecha'],1,0,'C',0);
    $pdf->Cell(25,10,$datos['Asistencias'],1,0,'C',0);
    $pdf->Cell(25,10,$datos['Inacistencias'],1,0,'C',0);
    $pdf->Cell(65,10,$datos['Inacistencias_Con_Permiso'],1,1,'C',0);
}

// Salida del PDF
$pdf->Output();
?>
