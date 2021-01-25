<?php
require_once('../util/util.php');

class ClienteDao {

    private $conn = "";

    public function __construct() {   
        $this->conn = new PDO("mysql:host=localhost:3306;dbname=syscliente", "root", "root");
    }

    public function salvar ($cliente)
    {
        $utils = new Util();
        if(!$utils->validarEmail($cliente->getEmail())){
            echo "<script>alert('Email inválido!');document.location='../index.php'</script>";
            return;
        } else if (!$utils->validarCelular($cliente->getCelular())) {
            echo "<script>alert('Número de celular inválido!');document.location='../index.php'</script>";
            return;
        } else if(!$utils->validarData($cliente->getDataNascimento())){
            echo "<script>alert('Data inválida!');document.location='../index.php'</script>";
            return;
        }

        $dataFormatada = implode("-", array_reverse(explode("/", trim($cliente->getDataNascimento())))); 
        $cliente->setDataNascimento($dataFormatada);

        if (empty($cliente->getId())) {
            $stmt = $this->conn->prepare("INSERT INTO clientes (nome, email, cep, rua, bairro, cidade, uf, celular, data_nascimento) 
                                    values (:nome, :email, :cep, :rua, :bairro, :cidade, :uf, :celular, :data_nascimento)");
         
        $stmt->bindValue(":nome", $cliente->getNome());
        $stmt->bindValue(":email", $cliente->getEmail());
        $stmt->bindValue(":cep", $cliente->getCep());
        $stmt->bindValue(":rua", $cliente->getRua());
        $stmt->bindValue(":bairro", $cliente->getBairro());
        $stmt->bindValue(":cidade", $cliente->getCidade());
        $stmt->bindValue(":uf", $cliente->getUf());
        $stmt->bindValue(":celular", $cliente->getCelular());
        $stmt->bindValue(":data_nascimento", $cliente->getDataNascimento());

        }

        if ($stmt->execute()) {
            $utils->enviarEmailSalvar($cliente);
            echo "<script>alert('Cliente cadastrado com sucesso!');document.location='../index.php'</script>";
        } else {
            print_r($stmt->errorInfo());
            echo "<script>alert('Erro ao cadastrar Cliente!');history.back()</script>";
        }
    }

    public function editar($cliente, $arrayEditados) {

        $utils = new Util();
        if(!$utils->validarEmail($cliente->getEmail())){
            echo "<script>alert('Email inválido!');document.location='../index.php'</script>";
            return;
        } else if (!$utils->validarCelular($cliente->getCelular())) {
            echo "<script>alert('Número de celular inválido!');document.location='../index.php'</script>";
            return;
        } else if(!$utils->validarData($cliente->getDataNascimento())){
            echo "<script>alert('Data inválida!');document.location='../index.php'</script>";
            return;
        }
        
        $dataFormatada = implode("-", array_reverse(explode("/", trim($cliente->getDataNascimento())))); 
        $cliente->setDataNascimento($dataFormatada);

        $stmt = $this->conn->prepare("UPDATE clientes SET
                                        nome = :nome,
                                        email = :email,
                                        cep = :cep,
                                        rua = :rua,
                                        bairro = :bairro,
                                        cidade = :cidade,
                                        uf = :uf,
                                        celular = :celular,
                                        data_nascimento = :data_nascimento
                                        WHERE id = :id");

        $stmt->bindValue(":nome", $cliente->getNome());
        $stmt->bindValue(":email", $cliente->getEmail());
        $stmt->bindValue(":cep", $cliente->getCep());
        $stmt->bindValue(":rua", $cliente->getRua());
        $stmt->bindValue(":bairro", $cliente->getBairro());
        $stmt->bindValue(":cidade", $cliente->getCidade());
        $stmt->bindValue(":uf", $cliente->getUf());
        $stmt->bindValue(":celular", $cliente->getCelular());
        $stmt->bindValue(":data_nascimento", $cliente->getDataNascimento());                                
        $stmt->bindValue(":id", $cliente->getId());

        if ($stmt->execute()) {
            $utils->enviarEmailEditar($arrayEditados);
            echo "<script>alert('Cliente atualizado com sucesso!');document.location='../index.php'</script>";
        } else {
            print_r($stmt->errorInfo());
            echo "<script>alert('Erro ao atualizar Cliente!');history.back()</script>";
        }
    }

    public function consultar()
    {
        $stmt = $this->conn->prepare("SELECT * 
                    FROM clientes ORDER BY id");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
            return "Não foi possível realizar a consulta.";
        }
    }

    public function consultarPorNome()
    {
        $stmt = $this->conn->prepare("SELECT * 
                    FROM clientes ORDER BY nome asc");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
            return "Não foi possível realizar a consulta.";
        }
    }

    public function carregar($id)
    {
        $stmt = $this->conn->prepare("SELECT *
                        FROM clientes WHERE id = :id");
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
            return "Não foi possível realizar a consulta!";
        }
    }
    public function excluir($id) {
        $utils = new Util();
        $stmt = $this->conn->prepare("DELETE
                        FROM clientes WHERE id = :id");
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $utils->enviarEmailExcluir($id);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
            return "Não foi possível excluir o Cliente!";
        }
    }
}

?>