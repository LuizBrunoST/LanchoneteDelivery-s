<?php 
    include "classes/sys.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo $nomeSite;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body onload="document.getElementById('id01').style.display='block'">
    <header>
        <div class="w3-bar w3-yellow w3-xlarge">
            <div class="w3-center">
                <a href="./" class="w3-bar-item w3-button w3-red w3-hover-red"><i class="fa fa-home"></i></a>
                <a href="cardapio.php" class="w3-bar-item w3-button w3-hover-red">Cardápio</a>
                <a href="carrinho.php" class="w3-bar-item w3-button w3-hover-red"><i class="fa fa-cart-plus"></i> Carrinho</a>
            </div>
        </div>
    </header>