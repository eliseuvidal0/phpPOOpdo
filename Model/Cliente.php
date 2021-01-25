<?php

class Cliente {

    private $id;
    private $nome;
    private $email;
    private $cep;
    private $rua;
    private $bairro;
    private $cidade;
    private $uf;
    private $celular;
    private $data_nascimento;

    public function setId($id) {
        $this->id = $id;
    } 

    public function getId() {
        return $this->id;
    }


    public function setNome($nome) {
        $this->nome = $nome;
    } 

    public function getNome() {
        return $this->nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    } 

    public function getEmail() {
        return $this->email;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    } 

    public function getCep() {
        return $this->cep;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    } 

    public function getRua() {
        return $this->rua;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    } 

    public function getBairro() {
        return $this->bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    } 

    public function getCidade() {
        return $this->cidade;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    } 

    public function getUf() {
        return $this->uf;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    } 

    public function getCelular() {
        return $this->celular;
    }

    public function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    } 

    public function getDataNascimento() {
        return $this->data_nascimento;
    }
}

?>