<?php

include 'conexao.php';
// Verifica se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos de email e senha foram preenchidos
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Obtém as credenciais do formulário
        $email = $_POST['email'];
        $password = $_POST['password'];
        //echo "email e senha fornecidos";

        
        

        // Prepara a consulta SQL para selecionar o usuário com base no nome de usuário e senha
        $sql = "SELECT id FROM usuario WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();

        // Verifica se o usuário foi encontrado
        if ($stmt->num_rows > 0) {
            // Obtém o ID do usuário
            $stmt->bind_result($id);
            $stmt->fetch();
            echo "usuario encontrado";

            // Redireciona para a página inicial ou para admin_area com base no id do usuário
            if ($id == 1) {
                header("Location: adminarea.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else  {
            echo "Usuário não encontrado ou senha incorreta.";
        }
        $stmt->close();

        $conn->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
