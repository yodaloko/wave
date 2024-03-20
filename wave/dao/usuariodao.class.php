<?php
  //Requerindo a classe de conexão com o banco:
  require '../persistence/conexao.class.php';

  class UsuarioDAO { //DAO Acesso a dados do objeto
    //Atributo de conexao:
    private $conexao = null; 
  

    //Método construtor:
    public function __construct(){
      //Quando pedir conexao - iremos acessar a pesistência e pegar a conexão do banco lá: getInstance()
      $this->conexao = ConexaoBanco::getInstance();
    }
    //Método para sair do banco - destruir a conexao:
    public function __destruct(){

    }

    //A PARTIR DAQUI FAREMOS UMA POR UMA DAS FUNÇÕES DO CRUD:
    //**Create - INSERT (banco) - Cadastrar
    //**Read - SELECT (banco) - ler - pesquisar - listar
    //Update - UPDATE (banco) - editar - atualizar
    //Delete - DELETE (banco) - excluir - deletar

    //Função para cadastrar:
public function cadastrarUsuario($c){
  try{ //Tratando excessões de erros - Vê onde não está funcionando o banco
    //Lembrando que BD não é caso sensitivo
     $stat = $this->conexao->prepare("INSERT INTO usuario(idusuario,email,password,nome,cpf,endereco,telefone)VALUES(NULL,?,?,?,?,?,?)");
    //Pegando os atributos da classe Usuario e colocando no lugar dos ? - ?-bind
    $stat->bindValue(1,$c->email);
    $stat->bindValue(2,$c->password);
    $stat->bindValue(3,$c->nome);
    $stat->bindValue(4,$c->cpf);
    $stat->bindValue(4,$c->endereco);
    $stat->bindValue(4,$c->telefone);
    //Mandamos executar a linha de comando do prepare:
    $stat->execute();
  }catch(PDOException $e){
    echo "Erro ao cadastrar Usuario." .$e;
  }
}
    //Função para listar todos os cadastros:
    //Busca abrangente - retornar nenhum - um ou muitos resultado
   public function buscarUsuario(){//try catch para tratar os erros vindos do banco
   try{
    //Variavél stat para acessar o banco, utilizamos sempre Query para SELECT
    $stat = $this->conexao->query("SELECT * FROM Usuario");
    //Criamos uma variavél para receber a lista de resultados - array
    $array = array();
    //Na linha abaixo ele irá percorrer toda a lista (fetchAll)
    $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario'); 
    //Finalizar a conexão 
    $this->conexao = null;
    //Retorna o que encontrou 
    return $array;
  }catch(PDOException $e){
   echo "Erro ao buscar contatos." .$e;
  }
   }//fim de função buscarusuario


    //Função para deletar usuario:
  public function deletarUsuario($idusuario){
  //Tratando as excessões 
  try{
    //Criamos uma variavel que acessa o banco e cria script
    $stat = $this->conexao->prepare("DELETE FROM usuario WHERE idusuario=?");
  //Definindo o valor do bind:
  $stat->bindValue(1,$idusuario);
  //Executamos o script:
  $stat->execute();
  //finalizamos a execução
  $this->conexao= null;
  }catch(PDOException $e){
    echo "Erro ao deletar usuario." .$e;
  }//fim da dunção deletar

  }


    //Função para editar usuario:
    public function buscar($query){
      //Tratando excessões
      try{
        //Variável que fará a busca no BD
        $stat = $this->conexao->query("SELECT * FROM usuario".$query);
        //Guardar em uma variavél  o resultado da busca
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
        //Finalizando a conexão
        $this->conexao = null;
        //Retornar o resultado     
        return $array;
      }catch(PDOException $e){
       echo "Erro ao buscar usuario." .$e;
      }
    }//fim da função buscar usuario
   
    public function alterarUsuario($c){
      //tratando as excessões
      try{
     $stat = $this->conexao->prepare("UPDATE usuario SET email = ?, password= ?, nome =?, cpf = ?, endereco = ?, telefone = ?,  WHERE idusuario = ?");
     //Definir o valor dos bind(?)
     $stat->bindValue(1,$c->email);
     $stat->bindValue(2,$c->password); 
     $stat->bindValue(3,$c->nome); 
     $stat->bindValue(4,$c->cpf); 
     $stat->bindValue(5,$c->endereco);
     $stat->bindValue(6,$c->telefone);
     //Executamos o script do BD
     $stat->execute();
     //fim da conexão
     $this->conexao = null;
      }catch(PDOException $e){
        echo "Erro ao alterar usuario." .$e;
      }
    }


  }//Final da classe
 
?>