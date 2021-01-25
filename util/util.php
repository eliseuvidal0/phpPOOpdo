<?php
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Util{
    
    //Enviar email ao salvar
    function enviarEmailSalvar($cliente) {
        $mail = new PHPMailer(true);
        $data = date('d/m/Y', strtotime($cliente->getDataNascimento()));

        try {
            //linha para debugar o phpmailer
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'emailtestedesafiophp@gmail.com';
            $mail->Password = 'php123456';
            $mail->Port = 587; //ou 465
        
            $mail->setFrom('emailtestedesafiophp@gmail.com');
            $mail->addAddress('info@bruc.com.br');
            $mail->addAddress('eliseuvidal0@hotmail.com');
        
            $mail->isHTML(true);
            $mail->Subject = '- Desafio Estagio PHP - Novo Cliente ';
            $mail->Body = "Email teste PHP <strong>Eliseu Vidal</strong> <br>
                            Novo cliente INSERIDO em sua base de Dados! Segue os detalhes:
                            <table>
                            <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                    <th>CEP</th>
                                    <th>RUA</th>
                                    <th>BAIIRO</th>
                                    <th>CIDADE</th>
                                    <th>UF</th>
                                    <th>CELULAR</th>
                                    <th>DATA DE NASCIMENTO</th>

                                </tr>
                                <tr >
                                    <td>{$cliente->getNome()}</td>
                                    <td>{$cliente->getEmail()}</td>
                                    <td>{$cliente->getCep()}</td>
                                    <td>{$cliente->getRua()}</td>
                                    <td>{$cliente->getBairro()}</td>
                                    <td>{$cliente->getCidade()}</td>
                                    <td>{$cliente->getUf()}</td>
                                    <td>{$cliente->getCelular()}</td>
                                    <td>{$data}</td>
                                </tr>
                            </thead>
                            </table>";

            $mail->AltBody = "Email teste PHP  - Eliseu Vidal -  Novo cliente INSERIDO em sua base de Dados! Segue os detalhes:  - Nome: {$cliente->getNome()} - Email: {$cliente->getEmail()} - Cep: {$cliente->getCep()} - Rua: {$cliente->getRua()} - Bairro: {$cliente->getBairro()} - Cidade: {$cliente->getCidade()} - Estado: {$cliente->getUf()} - Celular: {$cliente->getCelular()} - Data de nascimento: {$data}";
        
            if($mail->send()) {
                echo 'Email enviado com sucesso';
            } else {
                echo 'Email nao enviado';
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }

    //Enviar email ao editar
    function enviarEmailEditar($arrayEditados) {
        $mail = new PHPMailer(true);

        try {
            //linha para debugar o phpmailer
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'emailtestedesafiophp@gmail.com';
            $mail->Password = 'php123456';
            $mail->Port = 587; //ou 465
        
            $mail->setFrom('emailtestedesafiophp@gmail.com');
            $mail->addAddress('info@bruc.com.br');
            $mail->addAddress('eliseuvidal0@hotmail.com');
        
            $mail->isHTML(true);
            $mail->Subject = '- Desafio Estagio PHP - Cliente Atualizado';
            $mail->Body = "Cliente Atualizado ID: <strong>{$arrayEditados[0]}</strong> <br>
                            Dados alterado no cliente: "; foreach($arrayEditados as $i){
                                $mail->Body .= $i . "<br>";
                            } 
            $mail->AltBody ="Um Cliente foi atualizado em sua basde de dados ID: {$arrayEditados[0]} ";
                            foreach($arrayEditados as $i){$mail->Body .= $i . " - ";}
        
            if($mail->send()) {
                echo 'Email enviado com sucesso';
            } else {
                echo 'Email nao enviado';
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }

    //Enviar email ao excluir
    function enviarEmailExcluir($id) {
        $mail = new PHPMailer(true);

        try {
            //linha para debugar o phpmailer
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'emailtestedesafiophp@gmail.com';
            $mail->Password = 'php123456';
            $mail->Port = 587; //ou 465
        
            $mail->setFrom('emailtestedesafiophp@gmail.com');
            $mail->addAddress('info@bruc.com.br');
            $mail->addAddress('eliseuvidal0@hotmail.com');
        
            $mail->isHTML(true);
            $mail->Subject = '- Desafio Estagio PHP - Cliente EXCLUIDO ';
            $mail->Body = "Email teste PHP <strong>Eliseu Vidal</strong> <br>
                           Cliente ID <strong>{$id}</strong> foi EXCLUIDO de sua base de Dados! ";
            $mail->AltBody = "Email teste PHP  - Eliseu Vidal -  Cliente ID: {$id} foi EXCLUIDO de sua base de Dados!";
        
            if($mail->send()) {
                echo 'Email enviado com sucesso';
            } else {
                echo 'Email nao enviado';
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }
    

    // validando e-mails usando regex
    function validarEmail($email) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }

    //Validando Celular usando regex
    function validarCelular($celular){
    return (!preg_match("/\(?\d{2}\)?\s?\d{5}\-?\d{4}/", $celular)) ? FALSE : TRUE;
    }

    //validando data com regex
    function validarData($data){
        return (!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $data)) ? FALSE : TRUE;
    }
    /*
    validar com calendario gregoriano

    function validarData($data){
            $valores = explode('/', $data);

            return (!count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])) ? FALSE : TRUE;
    }
               
    */
}

?>

