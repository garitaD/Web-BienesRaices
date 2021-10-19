<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    <header class="header <?php echo /*isset*/ ($inicio) ? 'inicio' : ''; ?>"> <!--se  evalua va variable inicio con un operador ternario, 
                                                                si está agrega el sting de "inicio" que es la clase que da estilos al inicio
                                                        isset-> funcion de php que nos permite revisar si una variable está definida, con eso evitamos que se muestren errores con info comprometedora
                                                    isset se vio eliminado gracias a que con las funciones de php podemos setear como verdadero o falso ese dato-->
        <div class="contenedor contenido-header">
            <div class="barra">

                <a href="/">
                    <img src="build/img/logo.svg" alt="Logotipo">
                </a>
                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="Icono Menú Responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-btn" src="build/img/dark-mode.svg" alt="Dark mode">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>
            </div> <!--.barra-->
        </div>
    </header>