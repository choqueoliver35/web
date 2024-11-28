<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mudra</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top custom-nav sticky">
        <div class="container">
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a href="inicio.php" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="listar_Scada.php" class="nav-link">Monitoreo</a>
                    </li>
                    <li class="nav-item d-flex">
                        <?php 
                        session_start(); 
                        if (isset($_SESSION['user_id'])) {
                            echo "<a href='logout.php' class='nav-link'>Cerrar Sesión</a>";
                        } else {
                            echo "<a href='form-update-usuario.php' class='nav-link'>Login</a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="home-bg section h-100vh" id="home">
        <video class="bg-vid" autoplay loop muted>
            <source src="assets/video/video-bg.mp4" type="video/mp4">
        </video>
        <div class="bg-overlay"></div>
        <div class="container z-index">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="text-white text-center">
                        <h4>¡Bienvenido!</h4>
                        <h1 class="header_title mb-0 mt-3">
                            Gestion de Basura en Bolivia: <span class="element fw-bold" data-elements="Un lugar limpio es un lugar limbre de contaminacion."></span>
                        </h1>
                        <p class="mt-3">
                            Manten la Basura en su lugar
                        </p>
                        <ul class="social_home list-unstyled text-center pt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><i class="mdi mdi-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><i class="mdi mdi-dribbble"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><i class="mdi mdi-google-plus"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a></li>
                        </ul>
                        <div class="header_btn">
                            <button type="button" class="btn btn-outline-custom btn-rounded mt-4" data-bs-toggle="modal" data-bs-target="#loginModal">Comienza tu Aventura</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll_down">
            <a href="#about" class="scroll">
                <i class="mbri-arrow-down text-white"></i>
            </a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/typed.js"></script>
    <script>
        $(".element").each(function() {
            var $this = $(this);
            $this.typed({
                strings: $this.attr('data-elements').split(','),
                typeSpeed: 100,
                backDelay: 3000
            });
        });
    </script>
</body>
</html>
