<?php
  // Inclui o arquivo de configuração
  include('util/config.php');

  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
  else{
    header ('Location: index.php');
  }

  $pdo_query = $conexao_pdo->query('SELECT * FROM cursos WHERE idCursos = '.$id);
  $res = $pdo_query->fetch();
  $idCursos = $res['idCursos'];
  $titulo = $res['titulo'];
  $descricao = $res['descricao'];
  $capa = $res['capa'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cursos - ezoom</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto">
        <img src="http://localhost/ezoom/assets/img/logo-ezoom-branca.png" alt="Logo">
      </h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Voltar</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="background: url(<?php echo $capa ?>) !important;">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column align-items-center">
          <h1><?php echo $titulo ?></h1>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cursos ======= -->
    <section id="curso">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 pt-4 pt-lg-0 content">
            <p class="font-italic"><?php echo $descricao ?></p>
          </div>
          <?php
            $pdo_query_galeria = $conexao_pdo->query('SELECT * FROM galeria WHERE cursos_id = '.$id);
            while($res_galeria = $pdo_query_galeria->fetch()){
              $url = $res_galeria['url'];
            
              echo'
                <div class="col-lg-4 col-md-6">
                  <img src="'.$url.'" class="img-fluid" alt="">
                </div>
              ';
            }
          ?>
        </div>

      </div>
    </section><!-- End Cursos -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        <?php echo date( 'Y' ); ?> &copy; Copyright <strong><span>ezoom</span></strong>. Todos os direitos reservados.
      </div>
      <div class="credits">
        Desenvolvido por <strong>Igor Polese</strong>.
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>