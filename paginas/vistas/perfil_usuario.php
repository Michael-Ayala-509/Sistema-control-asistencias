<?php require '../../sesiones/star.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contros de Asistencia</title>
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

  <!-- Estilos de Alertas -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include '../nav/header.php' ?>
  <!-- ======= Sidebar ======= -->
  <?php include '../nav/sidebar.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Perfil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="panel.php">Inicio</a></li>
          <li class="breadcrumb-item">Perfil</li>
          <li class="breadcrumb-item active">Perfil</li>
        </ol>
      </nav>

      <script>
        <?php

          if(isset($_SESSION['pass_exit'])){
            $m = $_SESSION['pass_exit'];
            
            echo "
              Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '$m',
                showConfirmButton: false,
                timer: 3000
              });
            ";

          }elseif(isset($_SESSION['pass_new'])){
            $m = $_SESSION['pass_new'];

            echo "
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '$m',
                showConfirmButton: false,
                timer: 3000
              });
            ";

          }

          unset($_SESSION['pass_exit']);
          unset($_SESSION['pass_new']);

        ?>
      </script>
        
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../../<?php echo $_SESSION['fp']; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></h2>
              <h3><?php echo $_SESSION['rol']; ?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Descripción General</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Contraseña</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Misión</h5>
                  <p class="small fst-italic">Construyendo vidas por medio de valores bíblicos, educación con exelencia y amor.</p>

                  <h5 class="card-title">Visión</h5>
                  <p class="small fst-italic">Ser una institución que brinde una <b>enseñanza integral</b>, con exelencia academica para educar, trasformar y <b>amar sin condicion;</b> fomentando valores morales y <b>espirituales</b> que contribuyan a la formacion de una sociedad productiva, justa y humana, bajo la cobertura de <b>Dios</b></p>

                  <h5 class="card-title">Detalles del perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Cargo</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['cargo']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Dirrecion</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['direc']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">N° Telefono</div>
                    <div class="col-lg-9 col-md-8">503 <?php echo $_SESSION['tel']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['correo']; ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Formulario editar perfil -->
                  <form>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto de Perfil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="../../<?php echo $_SESSION['fp']; ?>" alt="Profile">
                        <div class="pt-2">
                          <input type="file" id="uploadImage" style="display: none;" />
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" id="uploadButton"><i class="bi bi-upload" ></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" id="removeButton"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nick Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nick_name" type="text" class="form-control" id="fullName" value="<?php echo $_SESSION['user'] ?>" disabled>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Rol</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="rol" type="text" class="form-control" id="Job" value="<?php echo $_SESSION['rol'] ?>" disabled>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Cargo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="cargo" type="text" class="form-control" id="Address" value="<?php echo $_SESSION['cargo'] ?>" disabled>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Telefono</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tel" type="text" class="form-control" id="Phone" value="<?php echo $_SESSION['tel'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo $_SESSION['correo'] ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>

                  </form><!-- Fin Formulario editar perfil -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">

                  <!-- Formulario Cambiar Contraseña -->
                  <form  action="../php/funciones_admin.php" method="POST" id="form-pass">
                    <input name="id" type="hidden" value="<?php echo $_SESSION['id']; ?>">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva Contraseña</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Vuelva a ingresar la nueva contraseña</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" onclick="ValidarPass()">Cambiar Contraseña</button>
                    </div>
                    <script>
                      function ValidarPass(){
                        var cur_pass = document.getElementById("currentPassword");
                        var new_pass = document.getElementById("newPassword");
                        var renew_pass = document.getElementById("renewPassword");
                        var form = document.getElementById("form-pass");
                        var validar = true;

                        exp_M = /[A-Z]/;
                        exp_mn = /[a-z]/;
                        exp_n = /\d/;
                        exp_bl = /\s/;

                        //Validacion de contraseña Actual

                        if (cur_pass.value == "") {
                          cur_pass.focus();
                          Swal.fire({
                            text: "El campo contraseña no debe estar vacio",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(cur_pass.value.trim().length<8) {
                          cur_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe tener al menos 8 caracteres.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(exp_bl.exec(cur_pass.value)) {
                          cur_pass.focus();
                          Swal.fire({
                            text: "La contraseña no debe contener espacios en blanco.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_M.exec(cur_pass.value)) {
                          cur_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos una letra mayúscula.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_mn.exec(cur_pass.value)) {
                          cur_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos una letra minúscula.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_n.exec(cur_pass.value)) {
                          cur_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos un número.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }
                        
                        //Validacion de nueva contraseña

                        else if(new_pass.value == "") {
                          new_pass.focus();
                          Swal.fire({
                            text: " El campo nueva contraseña no debe estar vacio",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(new_pass.value.trim().length<8) {
                          new_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe tener al menos 8 caracteres.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(exp_bl.exec(new_pass.value)) {
                          new_pass.focus();
                          Swal.fire({
                            text: "La contraseña no debe contener espacios en blanco.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_M.exec(new_pass.value)) {
                          new_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos una letra mayúscula.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_mn.exec(new_pass.value)) {
                          new_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos una letra minúscula.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_n.exec(new_pass.value)) {
                          new_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos un número.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }
                        
                        //Validacion de Repetir la contraseña
                        
                        else if(renew_pass.value == "") {
                          renew_pass.focus();
                          Swal.fire({
                            text: " El campo contraseña no debe estar vacio",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(renew_pass.value.trim().length<8) {
                          renew_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe tener al menos 8 caracteres.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(exp_bl.exec(renew_pass.value)) {
                          renew_pass.focus();
                          Swal.fire({
                            text: "La contraseña no debe contener espacios en blanco.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_M.exec(renew_pass.value)) {
                          renew_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos una letra mayúscula.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_mn.exec(renew_pass.value)) {
                          renew_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos una letra minúscula.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }else if(!exp_n.exec(renew_pass.value)) {
                          renew_pass.focus();
                          Swal.fire({
                            text: "La contraseña debe contener al menos un número.",
                            icon: "warning",
                            confirmButtonText: "Okey"
                          });
                          validar = false;
                        }

                        //Validadcion de igualdad de contraseña
                        if (new_pass.value !== renew_pass.value){
                            new_pass.focus();
                            renew_pass.focus();
                            Swal.fire({
                              text: "La contraseña no coiden.",
                              icon: "error",
                              confirmButtonText: "Okey"
                            });
                            validar=false;
                        }

                        if (validar) {
                          Swal.fire({
                            title: "¿Estas seguro",
                            text: "De cambiar tu contraseña?.",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, estoy seguro."
                          }).then((result) => {
                            if (result.isConfirmed) {
                              var boton = document.createElement("input");
                              boton.setAttribute("type", "hidden");
                              boton.setAttribute("name", "Cambiar");
                              boton.setAttribute("value", "Cambiar");
                              form.appendChild(boton);
                              form.submit();
                            }
                          });
                        }
                      }
                    </script>
                  </form><!-- Final de Formulario Cambio de Contraseña -->

                </div>
              </div><!-- End Bordered Tabs -->

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