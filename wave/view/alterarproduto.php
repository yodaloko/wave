<?php
  session_start();
 ?>
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
      <section class="home container-fluid" id="home">
        <h1 class="text-center"> Alterar Produto </h1>
        <!--Aqui chamamos a sessão para pegar o resultado da busca lá do controller-->
        <?php
          //se houver uma sessão produtos - pega para mim a variável que guardou a busca:
          if(isset($_SESSION['produtos'])){
            //incluir se ainda não foi incluso o modelo:
            include_once '../model/produto.class.php';
            //criar uma variável para guardar o resultado que veio da sessão (busca):
            $c = array();
            //nesta variável de array eu coloco o que tinha guardado na session:
            $c = unserialize($_SESSION['produtos']);
          }
         ?>
        <form action="../controller/produto.controller.php?op=confirmaralteracao" method="post" name="form01">
          <div class="form-group">
            <label for="txtidproduto">
              Código:
            </label>
  <input type="text" name="txtidproduto" class="form-control" value="<?php echo $c[0]->idproduto ?>" readonly="readonly">
          </div>
          <div class="form-group">
            <label for="txtnome">
              Nome:
            </label>
            <input type="text" name="txtnome" class="form-control" value="<?php echo $c[0]->nome ?>">
          </div>
          <div class="form-group">
            <label for="txtpreco">
              Preço:
            </label>
            <input type="text" name="txtpreco" class="form-control" value="<?php echo $c[0]->preco ?>">
          </div>
          <div class="form-group">
            <label for="txtestoque">
              Estoque:
            </label>
            <input type="text" name="txtestoque" class="form-control" value="<?php echo $c[0]->estoque ?>">
          </div>
          <div class="form-group">
            <label for="txtdescricao">
              Descrição:
            </label>
            <textarea name="txtdescricao" rows="6" cols="30" class="form-control"><?php echo $c[0]->descricao ?></textarea>
          </div>
          <?php
            //Iremos fechar a sessão - garantindo segurança dos dados:
            unset($_SESSION['produtos']);
           ?>
          <a href="adminarea.php"><input type="button" name="cancela" value="Cancelar" class="btn btn-primary"></a>
          <input type="submit" name="altera" value="Alterar" class="btn btn-primary">
        </form>

     </section>
   </main>
 </body>
</html>
