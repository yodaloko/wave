<?php
//Aqui monstamos o controller - saída de dados:
//Incluir a classe produto.class.php:
include '../model/produto.class.php';
//Incluir a classe util.class.php:
include '../util/util.class.php';
//incluir a classe DAO:
include '../dao/produtodao.class.php';

//Instancia a classe util:
$u1 = new Util();
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
        } else if(!$u1->testarExpressaoRegular('/^[A-Za-zÙ-Áù-á ]{2,30}$/',$nome)){
            echo 'Nome fora do padrão';
        } else if(!$u1->testarExpressaoRegular('/^[0.0-9.0]{1,20}$/',$preco)){
            echo 'Preço fora de padrão';
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
        header('location:../view/adminarea.php');
        break;
}//Fecha switch

?>