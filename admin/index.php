<?php
    include "../classes/sys.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>..:: Administração ::..</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="w3-bar w3-yellow">
            <a href="#" class="w3-bar-item w3-button w3-mobile w3-red w3-hover-red">Home</a>
            <a href="#" class="w3-bar-item w3-button w3-mobile w3-hover-red">Add produtos</a>
            <a href="pedido.php" class="w3-bar-item w3-button w3-mobile w3-hover-red">Pedidos</a>
            <a href="../" class="w3-bar-item w3-button w3-mobile w3-hover-red"><?php echo $nomeSite;?></a>
        </div>
    </header>
    <br>
    <div class="w3-container w3-padding">
        <div class="w3-card-2" style="width:50%; float:left;">
            <header class="w3-bar w3-yellow w3-padding">
                <span>View</span>
                <span class="w3-right w3-tag w3-red w3-round">
                    <?php
                        $arquivo = fopen('../view/view.txt', 'r');
                        while(!feof($arquivo)){
                            $linha = fgets($arquivo, 1024);
                            echo $linha;
                        }
                        fclose($arquivo);
                    ?>
                </span>
            </header>
        </div>
        <div class="w3-card-2" style="width:50%; float:left;">
            <header class="w3-bar w3-yellow w3-padding">
            <?php
	            include "../classes/cConection_Simples.php";

	            $delivery = "SELECT * FROM delivery";
	            $con_delivery = $mysqli->query($delivery) or die($mysqli->error);
	            $conta_delivery = mysqli_num_rows($con_delivery);

            ?>
                <span>Produtos</span>
                <span class="w3-right w3-tag w3-red w3-round"><?php echo $conta_delivery;?></span>
            </header>
        </div>

        <div class="w3-card-2" style="width:50%; float:left;">
            <header class="w3-bar w3-yellow w3-padding">
                <span>Pedidos</span>
                <span class="w3-right w3-tag w3-red w3-round">0</span>
            </header>
        </div>
    </div>

    <footer class="w3-blue">
        <div class="w3-container">
            <p><?php echo $nomeSite;?> <?php echo date("Y");?> <i>Powered by LUMATECH</i></p>
        </div>
    </footer>
</body>
</html>