<?php
//Requerindo a classe de conexão com o banco:
require '../persistence/conexao.class.php';

class ProdutoDAO { //DAO acesso a dados do objeto
    //Atributo de conexão:
    private $conexao = null;

    //Método construtor:
    public function __construct(){
        //Quando pedir conexão - iremos acessar a persistência e pegar a conexão do banco lá: getInstance()
      $this -> conexao = ConexaoBanco::getInstance();       
    }
    //Método para sair do banco - destruir a conexão:
    public function __destruct(){
        
    }

    //A PARTIR DAQUI FAREMOS UMA POR UMA DAS FUNÇÕES DO CRUD:
    //**Create - INSERT (banco) - Cadastrar */
    //**Read - SELECT (banco) - ler - pesquisar - listar */
    //Update - UPDATE (banco) - editar - atualizar
    //Delete - DELETE (banco) - excluir - deletar

    //Função para cadastrar:
    public function adicionarProduto($produto) {
    try{
        //Tratando excessões de erros - Vê onde não está funcionando no banco
        $stat = $this->conexao->prepare("INSERT INTO produto(idproduto,nome,preco,estoque,descricao,img)VALUES(NULL,?,?,?,?,?)");
        //Pegando os atributos da classe Produto e colocando no lugar dos "?" - ?=bind
        $stat->bindValue(1,$produto->nome);
        $stat->bindValue(2,$produto->preco);
        $stat->bindValue(3,$produto->estoque);
        $stat->bindValue(4,$produto->descricao);
        $stat->bindValue(5,$produto->img);
        //Mandamos executar a linha de comando do prepare:
        $stat->execute();
       }catch(PDOEXception $e){
        echo "ERRO ao adicionar Produto." .$e;
       }
    }//Fim adicionarProduto

    //Função para listar todos os produtos:
    //Buscar abrangente - retornar nenhum - um ou muitos resultados
    public function buscarProdutos(){
        //Try catch para tratar os erros vindo do banco
        try{
            //Variavel stat para acessar o banco, utilizamos sempre QUERY para SELECT
            $stat = $this->conexao->query("SELECT * FROM produto");
            //Criamos uma variavel para receber toda a lista (fatchALL)
            $array = $stat->fetchAll(PDO::FETCH_CLASS, 'produto');
            //Finalizar a conexão
            $this->conexao = null;
            //Retorna o que encontrou
            return $array;
        }catch(PDOException $e){
            echo "ERRO ao buscar produtos." .$e;
        }
    }//Fim da função buscarProduto

    //Função para deletar produto:
    public function deletarProduto($idproduto){
        //Tratando as excessões
        try{
            //Criamos uma variavel que acessa o banco e cria scrip
            $stat = $this->conexao->prepare("DELETE FROM produto WHERE idproduto=?");
            //Definindo valor do bind:
            $stat->bindValue(1,$idproduto);
            //Executamos o Script:
            $stat->execute();
            //finalizamos a execução
            $this->conexao = null;
        } catch (PDOException $e){
            echo "ERRO ao deletar produto." .$e;
        }
    }//Fim da função deletar

    //Função para editar produto:


}//Final da classe
?>