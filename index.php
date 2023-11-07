<?php include "include/header.php"?>
<?php include "view/contador.php";?>
    <div class="w3-container">
        <img src="img/deliverys.jpg" width="100%" class="w3-padding">
<?php
	include "classes/cConection_Simples.php";

	$delivery = "SELECT * FROM delivery ORDER BY RAND() LIMIT 4";
	$con_delivery = $mysqli->query($delivery) or die($mysqli->error);
	$conta_delivery = mysqli_num_rows($con_delivery);

?>
        <div class="w3-container w3-light-gray">
            <h3 class="w3-text-blue">+ Pedidos</h3>
            <?php while($dados = $con_delivery->fetch_array()) {?>
            <div class="w3-card w3-white" style="width:48%; float:left; margin-left:1px; margin-top:10px;">
                <img src="img/lanches/<?php echo $dados['imagem'];?>" alt="lanche" width="100%" title="" class="w3-padding">
                <span class="w3-text-black" style="font-size:15px; font-weight:bold;"><?php echo $dados['produto']?></span>
                <span class="w3-text-white w3-tag w3-red w3-round">R$ <?php echo number_format($dados['preco'], 2, ',', '.')?></span>
                <a href="carrinho.php?acao=add&id=<?php echo $dados['id']?>"><button class="w3-button w3-blue w3-padding" style="width:100%;"><i class="fa fa-cart-plus"></i> Carrinho</button></a>
            </div>
            <?php }?>
            
            <?php
	            include "classes/cConection_Simples.php";

	            $delivery = "SELECT * FROM delivery ORDER BY RAND() LIMIT 1";
	            $con_delivery = $mysqli->query($delivery) or die($mysqli->error);
	            $conta_delivery = mysqli_num_rows($con_delivery);
            ?>
            <?php while($dados = $con_delivery->fetch_array()) {?>
            <div class="w3-card w3-white" style="width:100%; margin-left:1px; margin-top:10px;">
                <img src="img/lanches/<?php echo $dados['imagem'];?>" alt="lanche" width="100%" title="" class="w3-padding">
                <span class="w3-text-black" style="font-size:15px; font-weight:bold;"><?php echo $dados['produto']?></span>
                <span class="w3-text-white w3-tag w3-red w3-round">R$ <?php echo number_format($dados['preco'], 2, ',', '.')?></span>
                <a href="carrinho.php?acao=add&id=<?php echo $dados['id']?>"><button class="w3-button w3-blue w3-padding" style="width:100%;"><i class="fa fa-cart-plus"></i> Carrinho</button></a>
            </div>
            <?php }?>
            <br>
        </div>
    </div>

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
                <h3>Deliverys DEMOSTRAÇÃO</h3>
                <p class="w3-tag w3-red w3-round w3-padding">ATENÇÃO:</p>
                <p>Este app é apenas uma demostração.</p>
                <p>Solicite o seu no nosso <a href="https://www.facebook.com/LUMATECHAPPSEGAMES/" target="_blank">site</a>.</p>
            </div>
        </div>
    </div>

<?php include "include/footer.php";?>