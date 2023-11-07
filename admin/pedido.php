<?php
    include "../classes/sys.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pedidos - <?php echo $nomeSite;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        window.print();
    </script>
<style>
div.bloco-imprenssao{
    width:80mm;
    background:#feffa7;
}
h2, h5{text-align:center;}
</style>
</head>
<body>
    <header>
        <div class="w3-bar w3-yellow">
            <a href="#" class="w3-bar-item w3-button w3-mobile w3-hover-red">Home</a>
            <a href="#" class="w3-bar-item w3-button w3-mobile w3-hover-red">Add produtos</a>
            <a href="pedido.php" class="w3-bar-item w3-button w3-mobile w3-red w3-hover-red">Pedidos</a>
            <a href="../" class="w3-bar-item w3-button w3-mobile w3-hover-red"><?php echo $nomeSite;?></a>
        </div>
    </header>

    <div class="w3-container">
        <header>
            <div class="w3-bar w3-yellow">
            </div>
        </header>
        <div class="w3-card-4">
            <?php
	            include "../classes/cConection_Simples.php";

	            $delivery = "SELECT * FROM pedidos_deliverys";
	            $con_delivery = $mysqli->query($delivery) or die($mysqli->error);
	            $conta_delivery = mysqli_num_rows($con_delivery);
            ?>
            <?php while($dados = $con_delivery->fetch_array()) {
                $hora = date("H:i:s", strtotime($dados['data']));
                $data = date('d/m/Y', strtotime($dados['data']));
            ?>
            <div class="bloco-imprenssao">
                <code>
                    <h2 id="nomeSite"><?php echo $nomeSite;?></h2>
                    ====================================
                    <h4><b>Cliente:</b> <?php echo $dados['nome_cliente']?></h4>
                    <h4><b>End:</b> <?php echo $dados['endereco']?></h4>
                    <h6><?php echo $dados['pedido'];?></h6>
                    ====================================
                    
                    <h5>Emitido em <?php echo $data . ' às ' . $hora; ?></h5>
                </code>
            </div>
            <?php }?>
        </div>
    </div>

    <footer class="w3-blue">
        <div class="w3-container">
            <p><?php echo $nomeSite;?> <?php echo date("Y");?> <i>Powered by LUMATECH</i></p>
        </div>
    </footer>
</body>
</html>