<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Luis Arthur, Cauã nascimento, Rafael Pereira, Roger Pereira">
    <meta name="description" content="Projeto em PHP, um ecomerce criado em php, html, css, js">
    <meta name="Keywords" content="PHP, HTML, BD, CSS, JS">

    <link rel="shortcut icon" href="img/logo.png">
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

  <body class="bg-custom">

  <div class="container-fluid">
<br>    
    
    <div class="row justify-content-between">
    <div class="col-4">
    <a><img src="img/logo.png" class="img-fluid" alt="logo WaveHeadshop"></a>
    </div>
    <!-- Botões para abrir os modais -->
        <div class="col-2 align-self-start">
            <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#loginModal">Login</button>
            <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#signupModal">Criar Conta</button>
        </div>
    </div>
</div>

<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Conteúdo do formulário de login -->
            <form action="login.class.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Criar Conta -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Conteúdo do formulário de criar conta -->
            <form action="cadastro.class.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" >
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" >
                </div>

                <button type="submit" class="btn btn-primary">Criar Conta</button>
            </form>
        </div>
    </div>
</div>

<br>
    <!-- Filtros -->
    <!--<div class="mb-4">
        <button class="btn btn-success">Sedas</button>
        <button class="btn btn-success ml-2">Piteiras</button>
        <button class="btn btn-success ml-2">Dichavadores</button>
        <button class="btn btn-success ml-2">Vapes</button>
        <button class="btn btn-success ml-2">Isqueiros</button>
        <button class="btn btn-success ml-2">Bongs</button>
        <button class="btn btn-success ml-2">Acessórios</button>
    </div> -->

    <!-- Barra de pesquisa -->
    <div class="col-md-6 offset-md-3">
        <input type="text" class="form-control" placeholder="Pesquisar produto">
    </div>
    <br>

    <!-- Lista de produtos -->
<div class="row">
        <?php

        // Simulação de produtos (você deve substituir isso com seus próprios dados do banco de dados)
        $produtos = array(
            array("produto_id" => 1, "nome" => "Dichavador de Metal", "preco" =>50.40, "imagem" => "dichavador2.jpg"),
            array("produto_id" => 2, "nome" => "Dichavador de Plástico (4cm) SL MedTainer", "preco" =>10.80, "imagem" => "dichavador1.jpg"),
            array("produto_id" => 3, "nome" => "Inalador de Rapé em Acrilico - Bullet (Sortido)", "preco" =>19.90, "imagem" => "inalador.jpg"),
            array("produto_id" => 4, "nome" => "Isqueiro Maçarico Zengaz Royal Jet ZL-12 - Collection Pride", "preco" =>43.90, "imagem" => "macarico2.jpg"),
            array("produto_id" => 5, "nome" => "Isqueiro Maçarico Hit 8005 - Preto (2 Chamas)", "preco" =>99.90, "imagem" => "macarico1.jpg"),
            array("produto_id" => 6, "nome" => "Seda king size OCB Bamboo", "preco" =>9.90, "imagem" => "seda2.jpg"),
            array("produto_id" => 6, "nome" => "Seda king size ZOMO perfect", "preco" =>4.90, "imagem" => "seda1.jpg"),
        );

        foreach ($produtos as $produto) {
            echo '<div class="col-md-3">';
            echo '<div class="card product-card text-white bg-custom mb-3">';
            echo '<img src="img/'. $produto["imagem"]. '" class="card-img-top" alt="'. $produto["nome"] .'">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $produto["nome"] . '</h5>';
            echo '<p class="card-text">R$ ' . number_format($produto["preco"], 2, ',', '.') . '</p>';
            echo '<a href="detalhes_produto.php?id=' . $produto["produto_id"] . '" class="btn btn-warning">Saiba mais</a>';
            echo '</div></div></div>';
        }

        ?>
    </div>
</div>






    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>