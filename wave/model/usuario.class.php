<?php
//nome da classe
class Usuario{
    private $idusuario;
    private $email;
    private $password;
    private $nome;
    private $cpf;
    private $endereco;
    private $telefone;

//Gets e sets
public function __get($atributo) {
    return $this->$atributo;
}
public function __set($atributo, $valor){
    $this->$atributo = $valor;
}
// to string
public function __toString(){
    return"<br>Código: ".$this->idusuario;
          "<br>email: ".$this->email;
          "<br>senha: ".$this->password;
          "<br>nome: ".$this->nome;
          "<br>cpf: ".$this->cpf;
          "<br>endereço: ".$this->endereco;
          "<br>telefone: ".$this->telefone;
}

}

?>