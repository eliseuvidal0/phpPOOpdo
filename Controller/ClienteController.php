<?php

require_once("../DAO/ClienteDAO.php");
require_once("../Model/Cliente.php");

class ClienteController {

    private $clienteDAO;
    
    public function __construct() {
        $this->clienteDAO = new ClienteDAO();
    }

    public function salvar() {

        $cliente = new Cliente();
        $cliente->setNome($_POST['nome']);
        $cliente->setEmail($_POST['email']);
        $cliente->setCep($_POST['cep']);
        $cliente->setRua($_POST['rua']);
        $cliente->setBairro($_POST['bairro']);
        $cliente->setCidade($_POST['cidade']);
        $cliente->setUf($_POST['uf']);
        $cliente->setCelular($_POST['celular']);
        $cliente->setDataNascimento($_POST['data_nascimento']);

        if($this->clienteDAO->salvar($cliente)) {
            echo "<script>alert('Cliente cadastrado com sucesso!');document.location='../index.php'</script>";
        }else{
            echo "<script>alert('Erro ao cadastrar Cliente!');history.back()</script>";
        }
        
        
    }

    public function excluir($id) {
        $this->clienteDAO->excluir($id);
        echo "<script>alert('Cliente excluído com sucesso!');document.location='../View/listar.php'</script>";
    }

    public function editar() {
        $arrayEditados = array();
        $cli2 = array();
        
        $cli = new Cliente();

        foreach ($this->clienteDAO->carregar($_POST['id']) as $c){
            $cli2[] = $c;
        }
        $dataNasc = date('d/m/Y', strtotime($cli2[9]));

        $cli->setId($_POST['id']);
        $arrayEditados[] = $_POST['id'];

        if($cli2[1] != $_POST['nome']){
            $arrayEditados[] = $_POST['nome'];
        }
        if($cli2[2] != $_POST['email']){
            $arrayEditados[] = $_POST['email'];
        }
        if($cli2[3] != $_POST['cep']){
            $arrayEditados[] = $_POST['cep'];
        }
        if($cli2[4] != $_POST['rua']){
            $arrayEditados[] = $_POST['rua'];
        }
        if($cli2[5] != $_POST['bairro']){
            $arrayEditados[] = $_POST['bairro'];
        }
        if($cli2[6] != $_POST['cidade']){
            $arrayEditados[] = $_POST['cidade'];
        }
        if($cli2[7] != $_POST['uf']){
            $arrayEditados[7] = $_POST['uf'];
        }
        if($cli2[8] != $_POST['celular']){
            $arrayEditados[8] = $_POST['celular'];
        }
        if($dataNasc != $_POST['data_nascimento']){
            $arrayEditados[] = $_POST['data_nascimento'];
        }
        $cli->setNome($_POST['nome']);
        $cli->setEmail($_POST['email']);
        $cli->setCep($_POST['cep']);
        $cli->setRua($_POST['rua']);
        $cli->setBairro($_POST['bairro']);
        $cli->setCidade($_POST['cidade']);
        $cli->setUf($_POST['uf']);
        $cli->setCelular($_POST['celular']);
        $cli->setDataNascimento($_POST['data_nascimento']);

        if($this->clienteDAO->editar($cli, $arrayEditados)) {
            echo "<script>alert('Cliente atualizado com sucesso!');document.location='../View/listar.php'</script>";
        }else{
            echo "<script>alert('Erro ao atualizar Cliente!');history.back()</script>";
        }
        
    }
}

$clienteController = new ClienteController();

if(isset($_GET['action']) && $_GET['action'] == 'salvar') {
    $clienteController->salvar();
}

else if(isset($_GET['action']) && $_GET['action'] == 'editar') {
    $clienteController->editar();
}

else if(isset($_GET['action']) && $_GET['action'] == 'excluir') {
    $id = $_GET["id"];
    $clienteController->excluir($id);
}

?>