<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gd3VXHhm7QJp9HJj2IzptMmNNz8+pdSu/XpvLklRz3g3tVvk5CxFY+DT00Fsqc1l" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Wave HeadShop</title>
    <style>
        /* Estilos adicionais */
        .product-card {
            margin-bottom: 20px;
        }
.bg-custom {
    background-color: rgb(5, 56, 5);
}
    </style>
  </head>
<body class="bg-custom text-white">
<main>
<?php
//Aqui monstamos o controller - saída de dados:
//iniciando sessão, onde session auxilia pegar dados de uma pagina para outra
session_start();
//Incluir a classe produto.class.php:
include '../model/produto.class.php';
//incluir a classe DAO:
include '../dao/produtodao.class.php';

//Testar a opção desejada do CRUD
switch($_GET['op']){
    //opção para cadastrar
    case 'cadastrar':
        //pega os dados do form:
            $nome = $_POST['txtnome'];
            $preco = $_POST['txtpreco'];
            $estoque = $_POST['txtestoque'];
            $descricao = $_POST['txtdescricao'];
            $img = $_POST ['fileimg'];

        //Valida os objetos vindo do form utilizando if - else if:
        if(empty($nome) || empty($preco) || empty($estoque) || empty($descricao) || empty($img)){
            echo 'Preencha os dados.';
               } else {
            $c1 = new Produto();
            //Mandando os dados para o objeto produto:
            $c1->nome = $nome;
            $c1->preco = $preco;
            $c1->estoque = $estoque;
            $c1->descricao = $descricao;
            $c1->img = $img;
            //Mostra produto na tela (toString mágico)
            echo $c1;

            //CONEXAO BANCO E CADASTRO
            $produtoDAO = new ProdutoDAO();
            $produtoDAO->adicionarProduto($c1);

            //Colocamos um link direto do php
            header('location:../view/confirmaproduto.html');

        }//Até aqui vai o cadastro
        break;
        case 'deletar';
        //Instanciar novamente a classe DAO - não usar a instancia anterios, da erro:
        $cDAO = new ProdutoDAO();
        //Vamos chamar a função que deleta:
        $cDAO->deletarProduto($_REQUEST['idproduto']);
        //Direcionar para uma página:
        header('location:../adminarea.php');
        break;
        case 'alterar':
			//Pegamos o idproduto:
			$idproduto = $_REQUEST['idproduto'];
			//mostrar a query de busca:
			$query = 'WHERE idproduto = '.$idproduto;
			//criar um objeto para acessar a classe DAO:
			$cDAO = new ProdutoDAO();
			//criamos uma variável para guardar o resultado da busca:
			$produtos = array();
			//Fazer a buscar e armazenar a resposta:
			$produtos = $cDAO->buscarProdutos($query);
			//Aqui utilizaremosd uma session para poder transportar o resultado da busca da página adminarea para a página alterarprodutos:
	$_SESSION['produtos'] = serialize($produtos);
			//direcionar o nosso usuário para uma página que permita a alteração:
header('location:../view/alterarproduto.php');
			break;
			//Case que realmente fará alteração do contato:
			case 'confirmaralteracao':
				//Instancia contato:
				$c = new Produto();
				//Pegando os dados no form
		$c->idproduto = $_POST['txtidproduto'];
		$c->nome = $_POST['txtnome'];
		$c->preco = $_POST['txtpreco'];
		$c->estoque = $_POST['txtestoque'];
		$c->descricao = $_POST['txtdescricao'];
		//Enviamos objeto para o DAO:
		$cDAO = new ProdutoDAO();
		//Chamamos a função de alterar o DAO
		$cDAO->alterarProduto($c);
		//Direciona o usuário para o buscar:
		header('location:../wave/adminarea.php');
		break;
		default;
		echo 'Não deu!';
}//Fecha switch

?>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
