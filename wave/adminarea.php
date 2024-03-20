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
      <header id="topo" class="jumbotron text-center" style="margin-bottom:0">
        <h1>WAVE HEADSHOP</h1>
      </header>

      <nav class="navbar navbar-inverse" style="margin-bottom: 0; border-radius: 0;">
        <ul class="nav navbar-nav">
          <li><a href="../wave/index.php">Home</a></li>
        </ul>
      </nav>

<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAdicionarProduto">
    Adicionar Produto
</button>

<!-- Modal Adicionar Produto -->
<div class="modal fade" id="modalAdicionarProduto" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdicionarProdutoLabel">Adicionar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-dark">
        <!-- Formulário de adição de produto -->
        <form action="controller/produto.controller.php?op=cadastrar" method="post" name="form01">
          <div class="form-group">
            <label for="txtnome">Nome do Produto:</label>
            <input type="text" class="form-control" id="txtnome" name="txtnome" required>
          </div>
          <div class="form-group">
                    <label for="txtpreco">Preço:</label>
                    <input type="number" class="form-control" id="txtpreco" name="txtpreco" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="txtestoque">Estoque:</label>
                    <input type="number" class="form-control" id="txtestoque" name="txtestoque" required>
                </div>
                <div class="form-group">
                    <label for="txtdescricao">Descrição:</label>
                    <textarea class="form-control" id="txtdescricao" name="txtdescricao" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="fileimg">Imagem:</label>
                    <input type="file" class="form-control-file" id="fileimg" name="fileimg" accept="image/*" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <input type="submit" name="cadastra" value="Cadastrar" class="btn btn-primary">
                </div>
        </form>
      </div>
   </div>
  </div>
</div>

</div>
<section class="home container-fluid" id="home">

<h1 class="text-center">Lista de Produtos</h1>
<!--AQUI FAREMOS A BUSCA ATRAVÈS DO BD--> 
<?php
//incluir a classe produto
include '../wave/model/produto.class.php';
//incluir a classe produtoDAO
include '../wave/dao/produtodao.class.php';
//Intanciar a classe DAO:
$produtoDAO = new ProdutoDAO();
//Criamos um objero para pegar o resultado da busca:
$produtos = $produtoDAO->buscarProdutos();
?>
<!--Montando uma tabela para mostrar os produtos cadastrados: --> 
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Código</th>
      <th>Nome</th>
      <th>Preço</th>
      <th>Estoque</th>
      <th>Descrição</th>
      <th>Imagem</th>
      <th>Editar/Excluir</th>
    </tr>
  </thead>
  <tbody>
<!--AQUI PREENCHEREMOS A TABELA COM DADOS DO BANCO-->
<?php
//foreach é um laço de repetição para percorrer e pegar um por um do registro do banco
foreach ($produtos as $c){
  echo "<tr>";
  echo "<td>".$c->idproduto."</td>";
  echo "<td>".$c->nome."</td>";
  echo "<td>".$c->preco."</td>";
  echo "<td>".$c->estoque."</td>";
  echo "<td>".$c->descricao."</td>";
  echo "<td>".$c->img."</td>";
  echo "<td>
  <a href='../wave/controller/produto.controller.php?op=alterar&idproduto=$c->idproduto'>
  <img src='../wave/img/edita.png' alt='Icone Editar'>
  </a>
  <a href='../wave/controller/produto.controller.php?op=deletar&idproduto=$c->idproduto'>
  <img src='../wave/img/exclui.png' alt='Icone Excluir'>
  </a>
  </td>";
  echo "</tr>";
}
?>
  </tbody>
</table>

</section>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
