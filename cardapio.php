<?php include "include/header.php";?>
<?php
	include "classes/cConection_Simples.php";

	$delivery = "SELECT * FROM delivery WHERE categoria='PIZZA'";
	$con_delivery = $mysqli->query($delivery) or die($mysqli->error);
	$conta_delivery = mysqli_num_rows($con_delivery);

?>
    <div class="w3-container">
        <h3 class="w3-text-blue" style="text-shadow:-1px 1px 2px #000; font-weight:bold;">Pizza</h3>
        <div class="w3-container w3-light-gray" style="overflow:auto; height:360px;">
        <?php while($dados = $con_delivery->fetch_array()) {?>
            <div class="w3-bar w3-white">
                <img src="img/lanches/<?php echo $dados['imagem'];?>" class="w3-left" width="100">
                <span class="w3-text-black w3-left"><?php echo $dados['produto']?> <br> <span class="w3-tag w3-red">R$<?php echo number_format($dados['preco'], 2, ',', '.')?></span></span>
                <a href="carrinho.php?acao=add&id=<?php echo $dados['id']?>"><span class="w3-button w3-right w3-round w3-blue" id="adicionar1" id="produto1"><i class="fa fa-cart-plus"></i></span></a>
                <p class="w3-left w3-block"><?php echo $dados['descricao']?></p>
            </div>
        <?php }?>
            
        </div>
<?php
	include "classes/cConection_Simples.php";

	$deliveryl = "SELECT * FROM delivery WHERE categoria='LANCHE'";
	$con_deliveryl = $mysqli->query($deliveryl) or die($mysqli->error);
	$conta_deliveryl = mysqli_num_rows($con_deliveryl);

?>
        <h3 class="w3-text-blue" style="text-shadow:-1px 1px 2px #000; font-weight:bold;">Lanches</h3>
        <div class="w3-container w3-light-gray" style="overflow:auto; height:360px;">
        <?php while($dados = $con_deliveryl->fetch_array()) {?>
            <div class="w3-bar w3-white">
                <img src="img/lanches/<?php echo $dados['imagem'];?>" class="w3-left" width="100">
                <span class="w3-text-black w3-left"><?php echo $dados['produto']?> <br> <span class="w3-tag w3-red">R$<?php echo number_format($dados['preco'], 2, ',', '.')?></span></span>
                <a href="carrinho.php?acao=add&id=<?php echo $dados['id']?>"><span class="w3-button w3-right w3-round w3-blue" id="adicionar1" id="produto1"><i class="fa fa-cart-plus"></i></span></a>
                <p class="w3-left w3-block"><?php echo $dados['descricao']?></p>
            </div>
        <?php }?>

        </div>

<?php
	include "classes/cConection_Simples.php";

	$deliveryb = "SELECT * FROM delivery WHERE categoria='BEBIDAS'";
	$con_deliveryb = $mysqli->query($deliveryb) or die($mysqli->error);
	$conta_deliveryb = mysqli_num_rows($con_deliveryb);

?>
        <h3 class="w3-text-blue" style="text-shadow:-1px 1px 2px #000; font-weight:bold;">Bebidas</h3>
        <div class="w3-container w3-light-gray" style="overflow:auto; height:360px;">
        <?php while($dados = $con_deliveryb->fetch_array()) {?>
            <div class="w3-bar w3-white">
                <img src="img/lanches/<?php echo $dados['imagem'];?>" class="w3-left" width="100">
                <span class="w3-text-black w3-left"><?php echo $dados['produto']?> <br> <span class="w3-tag w3-red">R$<?php echo number_format($dados['preco'], 2, ',', '.')?></span></span>
                <a href="carrinho.php?acao=add&id=<?php echo $dados['id']?>"><span class="w3-button w3-right w3-round w3-blue" id="adicionar1" id="produto1"><i class="fa fa-cart-plus"></i></span></a>
                <p class="w3-left w3-block"><?php echo $dados['descricao']?></p>
            </div>
        <?php }?>
            
        </div>
    </div>
<?php include "include/footer.php"?>