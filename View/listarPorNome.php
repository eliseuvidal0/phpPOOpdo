<?php
require_once '../DAO/ClienteDAO.php';

$cliDAO = new ClienteDAO();

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>LISTA DE CLIENTES</title>
</head>

<body style="background: #808080">

    <h3 style="text-align: center; margin-top: 40px; font-style: italic; color: white">Lista de Clientes - Ordenado por nomes</h3>

    <div class="container" style="position: absolute; top: 150px; left: 100px; background: #c0c0c0; padding: 20px; border-radius: 5px">

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>TELEFONE</th>
                    <th>CIDADE</th>
                    <th>UF</th>
                    <th>DATA</th>

                    <th>&nbsp;</th>
                    <th>&nbsp;</th>

                </tr>
                <?php
                foreach ($cliDAO->consultarPorNome() as $clientes) {
                    $data = $clientes['data_nascimento'];
                    $data = date('d/m/Y', strtotime($data));
                ?>
                    <tr class="bg-light">
                        <td><?= $clientes['id'] ?></td>
                        <td><?= $clientes['nome'] ?></td>
                        <td><?= $clientes['email'] ?></td>
                        <td><?= $clientes['celular'] ?></td>
                        <td><?= $clientes['cidade'] ?></td>
                        <td><?= $clientes['uf'] ?></td>
                        <td><?= $data ?></td>

                        <td><a class="btn btn-outline-warning" href="editar.php?acao=carregar&id=<?= $clientes['id'] ?>">Carregar</td>
                        <td><a class="btn btn-danger" href="../Controller/ClienteController.php?action=excluir&id=<?= $clientes['id'] ?>">Excluir</td>

                    </tr>
                    
                <?php
                }
                ?>
        </table>
        <button type="submit" class="btn btn-danger" onclick="window.location.href='http://localhost:8080/View/listar.php';">Voltar</button>
    </div>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</body>

</html>