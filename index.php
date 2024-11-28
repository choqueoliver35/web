<?php
require_once('config/config.php');
?>

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

    
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="formContent">
                        <form id="loginForm" action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                <div class="mt-3">
                                    <a href="#" class="text-decoration-none" id="createAccount">Crear cuenta</a> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Crear cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_tur_usuario.php" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apllPat" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apllPat" name="apllPat" placeholder="Ingrese su apellido paterno" required>
                        </div>
                        <div class="mb-3">
                            <label for="apllMat" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="apllMat" name="apllMat" placeholder="Ingrese su apellido materno" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="contasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contasena" name="contasena" placeholder="Ingrese su contraseña" required>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success">Crear cuenta</button>
                            <button type="button" id="backToLogin" class="btn btn-link">Volver a Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/typed.js"></script>
    <script>
        $(".element").each(function () {
            var $this = $(this);
            $this.typed({
                strings: $this.attr('data-elements').split(','),
                typeSpeed: 100,
                backDelay: 3000
            });
        });

        document.getElementById('createAccount').addEventListener('click', function () {
            var loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
            loginModal.hide();

            var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.show();
        });

        document.getElementById('backToLogin').addEventListener('click', function () {
            var registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
            registerModal.hide();

            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    </script>
</body>

</html>
