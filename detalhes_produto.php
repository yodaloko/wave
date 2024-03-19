<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="my-4">Detalhes do Produto</h1>


    <?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o ID do produto foi fornecido na URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Prepara a declaração SQL para selecionar o produto com base no ID
    $sql = "SELECT * FROM produto WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o produto foi encontrado
    if($result->num_rows > 0) {
        // Recupera os detalhes do produto
        $row = $result->fetch_assoc();
        $nome_produto = $row['nome'];
        $preco_produto = $row['preco'];
        $descricao_produto = $row['descricao'];

        // Exibe os detalhes do produto na página
        echo "<h2>$nome_produto</h2>";
        echo "<p>Preço: R$ $preco_produto</p>";
        echo "<p>Descrição: $descricao_produto</p>";

        // Adicione o botão "Adicionar ao Carrinho" aqui
    } else {
        echo "Produto não encontrado.";
    }

    // Fecha a declaração preparada
    $stmt->close();
} else {
    echo "ID do produto não fornecido.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

    <div class="row">
        <div class="col-md-6">
            <img src="??" class="img-fluid" alt="??">
        </div>
        <div class="col-md-6">
            <h2>$nome_produto</h2>
            <p><strong>Preço: </strong>$preco_produto</p>
            <p><strong>Descrição:</strong> $descricao_produto</p>

<form action="adicionar_carrinho.php" method="post">
    <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
    <input type="hidden" name="nome_produto" value="<?php echo $nome_produto; ?>">
    <input type="hidden" name="preco_produto" value="<?php echo $preco_produto; ?>">
    <input type="submit" class="btn btn-primary" value="Adicionar ao Carrinho">
</form>

        </div>
    </div>
</div>

</body>
</html>
