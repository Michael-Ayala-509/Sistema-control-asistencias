<?php  
  require '../../sesiones/star.php';
  require '../php/funciones_admin.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contros de Asistenciase</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/logo-hosanna.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <?php require '../nav/header.php'; ?>

  <!-- ======= Sidebar ======= -->
  <?php require '../nav/sidebar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reporte de Asistencias</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../vistas/panel.php">Inicio</a></li>
          <li class="breadcrumb-item">Generacion de Reportes</li>
          <li class="breadcrumb-item active">Reporte de Asistencias</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reporte de Asistencias</h5>

              <!-- Reporte Asistencia -->
              <form class="row g-3" action="../php/Reportes/r_asistencia.php" method="POST">
                <div class="col-md-4">
                  <label for="validationDefault04" class="form-label">Generar Por</label>
                  <select name="m" class="form-select" id="validationDefault04" required>
                    <option selected disabled value="">Elige...</option>
                    <option value="ID_Maestro">Maestro</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="validationDefault04" class="form-label">Generar desde</label>
                  <input type="date" name="fi" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                </div>
                <div class="col-md-4">
                  <label for="validationDefault04" class="form-label">Generar hasta</label>
                  <input type="date" name="ff" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                </div>
                
                <div class="col-12">
                  <button class="btn btn-primary" type="submit">Generar</button>
                </div>
              </form>
              <!-- Fin de formulario reporte asistencia -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Colegio Hosanna</span></strong>. Reservados todos los derechos
    </div>
    <div class="credits">
     Diseñado por <a href="https://www.facebook.com/ColegioHosannaSantaAna/?locale=es_LA/">Colegio Hosanna</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>
</html>