<?php include "include/header.php";?>
<?php
    require_once "php/cart.php";
    require_once "php/product.php";
    $pdoConnection = require_once "classes/pdo_carrinho.php";
?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<style>
.img-cart {
    display: block;
    max-width: 50px;
    height: auto;
    margin-left: auto;
    margin-right: auto;
}
table tr td{
    border:1px solid #FFFFFF;    
}

table tr th {
    background:#eee;    
}

.panel-shadow {
    box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
}
.img-thumbnail{
	width:100px;
	height:auto;
}

#postar{
	padding:10px;
	border:2px solid blue;
	background:transparent;
	border-radius:7px;
}
#cancelarformrecado{
	padding:10px;
	border:2px solid red;
	background:transparent;
	border-radius:7px;
}
.btn-Ccomprando{
	background-color: #4CAF50;
	text-align:center;
	text-decoration: none;
	font-size:16px;
	padding:10px;
	cursor: pointer;
	color:#fff;
	border:2px solid #4CAF50;
}
.btn-Ccomprando:hover{border:2px solid #4CAF50; background:transparent; color:#000;}
.btn-entregar{
	background-color: #008CBA;
	text-align:center;
	text-decoration: none;
	font-size:16px;
	padding:10px;
	cursor: pointer;
	color:white;
	border:2px solid #008CBA;
}
.btn-entregar:hover{border:2px solid #008CBA; background:transparent; color:#000;}
.btn-atualizar{
	background-color: #555555;
	text-align:center;
	text-decoration: none;
	font-size:16px;
	padding:10px;
	cursor: pointer;
	color:white;
	border:2px solid #555555;
}
.btn-atualizar:hover{border:2px solid #555555; background:transparent; color:#000;}

.estrelas input[type=radio]{
	display: none;
}.estrelas label i.fa:before{
	content: '\f005';
	color: #f00;
	width:50px;
	height:50px;
}.estrelas  input[type=radio]:checked  ~ label i.fa:before{
	color: #CCC;
	height:50px;
}
</style>
<?php
    if(isset($_GET['acao']) && in_array($_GET['acao'], array('add', 'del', 'up', 'entregar', 'pedir' , 'chama_no_doce'))) {
		
		if($_GET['acao'] == 'add' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])){ 
			addCart($_GET['id'], 1);			
		}

		if($_GET['acao'] == 'del' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])){ 
			deleteCart($_GET['id']);
		}

		if($_GET['acao'] == 'up'){ 
			if(isset($_POST['prod']) && is_array($_POST['prod'])){ 
				foreach($_POST['prod'] as $id => $qtd){
					updateCart($id, $qtd);
				}
			}
		}
		//########################## ENTREGAR ##########################//
		if($_GET['acao'] == 'entregar'){
			$resultsCarts = getContentCart($pdoConnection);
			$totalCarts  = getTotalCart($pdoConnection);
			echo '<style>.container{display:none;}</style>';
			echo '<div class="w3-card-4">';
			echo '<h3 class="w3-text-blue">Vamos Pedir</h3>';
			echo '<form action="carrinho.php?acao=pedir" method="POST">';
			foreach($resultsCarts as $result){
				$id_produto = $result['id'];
				$nome_produto = $result['name'];
				$valor_produto = $result['price'];
				$quantidade_produto = $result['quantity'];
				echo '<input type="hidden" value="'.$id_produto.'" name="id_produto">';
				echo '<input type="hidden" vlaue="'.$nome_produto.'" name="nomeProduto">';
				echo '<input type="hidden" vlaue="'.$valor_produto.'" name="valorProduto">';
				echo '<input type="hidden" vlaue="'.$quantidade_produto.'" name="quantidadeProduto">';
			}
			$total_preco_produtos = number_format($totalCarts, 2, ',', '.');
			echo '<input type="hidden" value="'.$total_preco_produtos.'" name="total">';
			echo '<input class="w3-button w3-round w3-hover-red w3-blue" type="submit" value="Pedir">';
			echo '</form>';
			echo '</div>';
		}


		if($_GET['acao'] == 'pedir'){
			$resultsCarts = getContentCart($pdoConnection);
			$totalCarts  = getTotalCart($pdoConnection);
			echo '<form action="carrinho.php?acao=chama_no_doce" method="POST">';
			echo '<style>.container{display:none;}</style>';
			echo '<div class="w3-card-4 w3-padding">';
			foreach($resultsCarts as $result){
				$id_produto = $result['id'];
				$nome_produto = $result['name'];
				$valor_produto = $result['price'];
				$quantidade_produto = $result['quantity'];
				echo '<input type="hidden" value="'.$id_produto.'" name="id_produto">';
				
				echo '<input type="hidden" vlaue="'.$nome_produto.'" name="nomeProduto">';
				echo '<input type="hidden" vlaue="'.$valor_produto.'" name="valorProduto">';
				echo '<input type="hidden" vlaue="'.$quantidade_produto.'" name="quantidadeProduto">';
				echo '<p>Produto: '.$nome_produto.' :: Valor:'.$valor_produto.'</p><hr>';

			}
			$total_preco_produtos = number_format($totalCarts, 2, ',', '.');
			echo '<p>Total: '.$total_preco_produtos.'</p><hr style="border:1px solid red;">';
			echo '<input type="hidden" value="'.$total_preco_produtos.'" name="total">';
			echo 'Nome: <input required="required" class="w3-input" type="text" value="" name="user_nome"><br>';
			echo 'Endereço: <input required="required" class="w3-input type="text" value="" name="user_endereco">';
			echo 'N°: <input required="required" class="w3-input" type="text" value="" name="user_nCasa"><br>';
			echo 'Telefone: <input required="required" class="w3-input" type="text" value="" name="user_contato"><br>';
			echo 'Ponto de referencia: <input class="w3-input" required="required" class="w3-input" type="text" name="referencia">';
			echo 'Forma de pagamento:<select class="w3-select w3-border" name="forma"><option value="dinheiro">Dinheiro</option><option value="cartao">Cartão</option></select>';
			echo '<br>Troco para: <input class="w3-input" required="required" type="number" name="troco">';
			echo '<input class="w3-button w3-blue w3-round w3-hover-red" type="submit" value="Confirmar">';
			echo '</form>';
			echo '</div>';
		}


		if($_GET['acao'] == 'chama_no_doce'){
			$resultsCarts = getContentCart($pdoConnection);
			$totalCarts  = getTotalCart($pdoConnection);
			echo '<form name="dexar-recado" action="" method="post" enctype="multipart/form-data">';
			echo '<style>.container{display:none;}</style>';
			echo '<div class="w3-card-4 w3-padding">';
			//echo '<textarea style="width:100%; height:360px;" class="text-msg" name="txtrecado" id="txtrecado">';
			//whatsapp API
			echo '<a class="w3-button w3-green w3-hover-yellow w3-round" href="';
			echo 'https://api.whatsapp.com/send?phone=';
			$text = '&text=*Pedido%20Online%20'.$nomeSite .'*%0d%0a%0d%0a';
			foreach($resultsCarts as $result){
				$id_produto = $result['id'];
				$nome_produto = $result['name'];
				$valor_produto = $result['price'];
				$quantidade_produto = $result['quantity'];
				
				echo $numero;
			break;
				//echo 'Código: '.$id_produto.' :: ';
				//echo $quantidade_produto.' - ';
				//echo $nome_produto.' - R$'.$valor_produto.'&#13;&#10;';
			}
			echo $text;
			echo '*Cliente:*%20'.htmlspecialchars($_POST['user_nome']).'%0d%0a%0d%0a';//Nome
			echo '*Endereço:*%20'.htmlspecialchars($_POST['user_endereco']).', N°:'.htmlspecialchars($_POST['user_nCasa']).'%0d%0a%0d%0a';
			echo '*Telefone:*%20'.htmlspecialchars($_POST['user_contato']).'%0d%0a%0d%0a';
			echo '*Pto Referência:*%20'.htmlspecialchars($_POST['referencia']).'%0d%0a%0d%0a';
			echo '*Forma de pagamento:*%20'.htmlspecialchars($_POST['forma']).'%0d%0a%0d%0a';
			echo '*Troco para:*%20'.htmlspecialchars($_POST['troco']).'%0d%0a%0d%0a';
			foreach($resultsCarts as $result){
				$id_produto = $result['id'];
				$nome_produto = $result['name'];
				$valor_produto = $result['price'];
				$quantidade_produto = $result['quantity'];

				echo '*Produto:*%20%0d%0a%0d%0a'.$quantidade_produto.'%20-%20'.$nome_produto.'%20-%20R$'.$valor_produto.'%20-%20SubTt:%20'.number_format($result['subtotal'], 2, ',', '.').'%0d%0a%0d%0a';//Produto
			}
			/*
			$link_pedido_Online = 
				"https://api.whatsapp.com/send?phone="
				.$whatsapp_produto.//Numero do comercio
				"&text=*Pedido%20Online%20MEU%20_SHOP_*%0d%0a%0d%0a%20*Nome:*%20"//nome do site
				.htmlspecialchars($_POST['user_nome']).//nome do usuario
				"%0d%0a%0d%0a*Endereço:*%20"
				.htmlspecialchars($_POST['user_endereco']).//endereco do usuario
				","
				.htmlspecialchars($_POST['user_nCasa']).//numero da casa
				"%0d%0a%0d%0a*Telefone:*%20"
				.htmlspecialchars($_POST['user_contato']).//contato do usuario
				"%0d%0a%0d%0a*Referencia:*%20"
				.htmlspecialchars($_POST['referencia']).//Referencia
				"%0d%0a%0d%0a*Forma de pagamento:*%20"
				.htmlspecialchars($_POST['forma']).//Forma de pagamento
				"%0d%0a%0d%0a*Troco para:*%20".htmlspecialchars($_POST['troco']);
				*/
			/*
				$total_preco_produtos = number_format($totalCarts, 2, ',', '.');
			echo 'Total: R$'.$total_preco_produtos.'&#13;&#10;&#13;&#10;';
			echo 'Cliente: '.htmlspecialchars($_POST['user_nome']).'&#13;&#10;';
			echo 'Endereço: '.htmlspecialchars($_POST['user_endereco']).', N°:'.htmlspecialchars($_POST['user_nCasa']).'&#13;&#10;';
			echo 'Contato: '.htmlspecialchars($_POST['user_contato']).'&#13;&#10;';
			echo 'Ponto de referencia: '.htmlspecialchars($_POST['referencia']).'&#13;&#10;';
			echo 'Forma de pagamento: '.htmlspecialchars($_POST['forma']).'&#13;&#10;';
			echo 'Troco para: '.htmlspecialchars($_POST['troco']).'';
			
			*/
			//echo '<a href="'.$link_pedido_Online.'" title="ZAP">Enviar Pedido</a><br>';
			//echo '*SubTotal:*%20R$'.number_format($result['subtotal'], 2, ',', '.').'%0d%0a%0d%0a';
			echo '*Total:*%20R$'.$total_preco_produtos = number_format($totalCarts, 2, ',', '.').'%0d%0a%0d%0a';
			echo '" title="enviar no ZAP?" target="_blank"><i class="fa fa-whatsapp"></i> Enviar pedido no Whatsapp</a>';
			//echo '</textarea>';
			//echo '<div class="bloco-btns-pedido"><!-- bloco-btns-pedido -->';
			//echo '<input id="postar" name="postarrecado" type="submit" value="Postar">';
			//echo '<input id="postar" name="postarrecado" type="submit" value="Postar">';
			//echo '<a id="cancelarformrecado" href="javascript:void(0);"><button id="cancelar">Cancelar</button></a>';
			//echo '</div><!-- bloco-btns-pedido -->';
			echo '<br><br>Vamos avisar sobre o seu pedido?<br>Basta clicar em <span style="font-size:18px; font-weight:bold;">Enviar no Whatsapp</span><br>';
			echo '</form>';
			/*
			echo '<h3>Avalie o sistema</h3>';
			echo '<form method="POST" action="php/AvalieSistema.php" enctype="multipart/form-data">';
			
			echo '<div class="estrelas">';
			echo '<input type="hidden" value="'.$idDaSessao.'" name="uid">';
			echo '<input type="radio" id="vazio" name="estrela" value="" checked>';

			echo '<label for="estrela_um"><i class="fa"></i></label>';
			echo '<input type="radio" id="estrela_um" name="estrela" value="1">';
			echo '<label for="estrela_dois"><i class="fa"></i></label>';
			echo '<input type="radio" id="estrela_dois" name="estrela" value="2">';
			echo '<label for="estrela_tres"><i class="fa"></i></label>';
			echo '<input type="radio" id="estrela_tres" name="estrela" value="3">';
			echo '<label for="estrela_quatro"><i class="fa"></i></label>';
			echo '<input type="radio" id="estrela_quatro" name="estrela" value="4">';
			echo '<label for="estrela_cinco"><i class="fa"></i></label>';
			echo '<input type="radio" id="estrela_cinco" name="estrela" value="5">';

			echo '<br><textarea maxlength="50" name="feedback" style="resize:vertical; width:250px; border:2px solid #c1c1c1; height:200px;"></textarea>';
			echo '<input type="submit" name="salvarNota" value="enviar">';

			echo '</div>';
			*/
			echo '</form>';
			echo '</div>';
			
			
		}
		//header('location: carrinho.php');
    }
    $resultsCarts = getContentCart($pdoConnection);
    $totalCarts  = getTotalCart($pdoConnection);
    
?>
<div class="princial" id="main">
<div class="container bootstrap snippet">
    <div class="col-md-9 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info panel-shadow">
                    <div class="panel-heading">
						<a href="cardapio.php">Lista de produtos</a>
                    </div>
                    <div class="panel-body"> 
                        <div class="table-responsive">
						<?php if($resultsCarts) : ?>
						<form action="carrinho.php?acao=up" method="post">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Descrição</th>
                                <th>Qt</th>
                                <th>Preço</th>
                                <th>SubTotal</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach($resultsCarts as $result) : ?>
                                <tr>
                                    <td><img src="upload/produtos/<?php echo $result['imagem']?>" class="img-cart"></td>
                                    <td><strong><?php echo $result['name']?></strong><p>Size : 26</p></td>
                                    <td>
										<input type="text" name="prod[<?php echo $result['id']?>]" value="<?php echo $result['quantity']?>" size="1" />
                                        <button rel="tooltip" class="btn btn-default"><i class="fa fa-pencil"></i></button>
                                        <a href="carrinho.php?acao=del&id=<?php echo $result['id']?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    <td>R$<?php echo number_format($result['price'], 2, ',', '.')?></td>
                                    <td>R$<?php echo number_format($result['subtotal'], 2, ',', '.')?></td>
                                </tr>
								<?php endforeach;?>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total</strong></td>
                                    <td>R$<?php echo number_format($totalCarts, 2, ',', '.')?></td>
                                </tr>
                            </tbody>
                        </table>
						</form>
						<?php endif?>
                    </div>
                </div>
                </div>
                <a href="cardapio.php" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Continue Comprando</a>
                <a href="carrinho.php?acao=entregar" class="btn btn-primary pull-right">Próximo<span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>
	</div>

<?php include "include/footer.php";?>