<?php
//Aqui monstamos o controller - saída de dados:
//Incluir a classe usuario.class.php:
include '../model/usuario.class.php';
//Incluir a classe util.class.php:
include '../util/util.class.php';
//incluir a classe DAO:
include '../dao/usuariodao.class.php';

//Instancia a classe util:
$u1 = new Util();
//Testar a opção desejada do CRUD
switch($_GET['op']){
    //opção para cadastrar
    case 'cadastrar':
        //pega os dados do form:
            $email = $_POST['txtemail'];
            $password = $_POST['txtpassword'];
            $nome = $_POST['txtnome'];
            $cpf = $_POST['txtcpf'];
            $endereco = $_POST ['txtendereco'];
            $telefone = $_POST ['txttelefone'];

        //Valida os objetos vindo do form utilizando if - else if:
        if(empty($email) || empty($password) || empty($nome) || empty($cpf) || empty($endereco)  || empty($telefone)){
            echo 'Preencha os dados.';
        }else if(!$u1->validarEmail($email)){
            echo 'E-mail fora do padrão';
            }else if(!$u1->testarExpressaoRegular('/^[A-Za-zÙ-Áù-á ]{2,255}$/',$nome)){
            echo 'Nome fora do padrão';
            } else {
            $c1 = new Usuario();
            //Mandando os dados para o objeto produto:
            $c1->email = $email;
            $c1->password = $password;
            $c1->nome = $nome;
            $c1->cpf = $cpf;
            $c1->endereco = $endereco;
            $c1->telefone = $telefone;
            //Mostra produto na tela (toString mágico)
            echo $c1;

            //CONEXAO BANCO E CADASTRO
            $usuarioDAO = new UsuarioDAO();
            $usuarioDAO->cadastrarUsuario($c1);

            //Colocamos um link direto do php
            header('location:../view/confirmausuario.html');

        }//Até aqui vai o cadastro
        break;
        case 'deletar';
        //Instanciar novamente a classe DAO - não usar a instancia anterios, da erro:
        $cDAO = new UsuarioDAO();
        //Vamos chamar a função que deleta:
        $cDAO->deletarUsuario($_REQUEST['idusuario']);
        //Direcionar para uma página:
        header('location:../view/adminarea.php');
        break;
}//Fecha switch

?>