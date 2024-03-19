<?php
//nome da classe
class produto{
    //Atribitos - dados para cadastro de produtos
    private $idproduto;
    private $nome;
    private $preco;
    private $estoque;
    private $descricao;
    private $img;

     //Gets e Sets - mágicos (serve para qualquer atributo acima, reduz código):
     public function __get($atributo) {
        return $this->$atributo;
    }
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    //Função toString:
    public function __toString(){
        return "<br>Código: ".$this->idproduto.
               "<br>Nome: ".$this->nome.
               "<br>Preço: ".$this->preco.
               "<br>Estoque: ".$this->estoque.
               "<br>Descrição: ".$this->descricao.
               "<br>Imagem: ".$this->img;
      }
}


?>