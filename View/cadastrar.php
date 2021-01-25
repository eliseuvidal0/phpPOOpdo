<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>CADASTRO</title>
</head>

<body style="background: #808080">

    <h3 style="text-align: center; margin-top: 40px; font-style: italic; color: white">Cadastro de Clientes</h3>

    <form action="../Controller/ClienteController.php?action=salvar" id="form" method="POST" style="margin-top: 60px">
        
            <div class="container" style="background: #c0c0c0; padding: 20px; border-radius: 5px">
                
                <div class="form-row">
                    <div class="col-md-4">
                        <label>Nome:</label>
                        <input type="text" class="form-control" name="nome" placeholder=" "required>
                    </div>
                    <div class="col-md-4">
                        <label>Data de Nascimento:</label>
                        <input type="text" class="form-control data_nascimento" name="data_nascimento" placeholder=" "required>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="cep">CEP:</label>
                        <input id="cep" type="text" class="form-control cep" name="cep" placeholder=" " required>
                    </div>
                    <div class="col-md-4">
                        <label for="rua">Endereço:</label>
                        <input id="rua" type="text" class="form-control rua" name="rua" placeholder=" " required>
                    </div>
                    <div class="col-md-4">
                        <label for="bairro">Bairro:</label>
                        <input id="bairro" type="text" class="form-control bairro" name="bairro" placeholder=" " required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="cidade">Cidade:</label>
                        <input id="cidade" type="text" class="form-control cidade" name="cidade" placeholder=" " required>
                    </div>
                    <div class="col-md-4">
                        <label for="uf">Estado:</label>
                        <input type="text" id="uf" class="form-control uf" name="uf" placeholder=" " required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label>Celular:</label>
                        <input type="text" class="form-control celular" name="celular" placeholder=" "required>
                    </div>
                    <div class="col-md-4">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" name="email" placeholder=" "required>
                    </div>
                </div>

            <input type="submit" value="Salvar" class="btn btn-outline-success" style="margin-top: 40px" />

    </form>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Via Cep para completar os campos do endereço -->
    <script type="text/javascript">
        $("#cep").focusout(function() {
            
            $.ajax({
                url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/unicode/',

                dataType: 'json',

                success: function(resposta) {

                    $("#rua").val(resposta.logradouro);
                    $("#bairro").val(resposta.bairro);
                    $("#cidade").val(resposta.localidade);
                    $("#uf").val(resposta.uf);
                }
            });
        });
    </script>

    <!-- Jquery validando campos no front -->
    <script src="../js/jquery.validate.min.js"></script>
    <script>
        $(function(){
            $("#form").validate({
                roles: {
                    nome:{
                        required:true
                    } 
                    data_nascimento:{
                        required:true
                    } 
                    cep:{
                        required:true
                    } 
                    rua: {
                        required:true
                    } 
                    bairro:{
                        required:true
                    } 
                    cidade: {
                        required:true
                    } 
                    uf:{
                        required:true
                    } 
                    celular:{
                        required:true
                    } 
                    emai: {
                        required:true
                    }
                }
            });
        });
    </script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Másscaras do formulário -->
    <script src="../js/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {
            $('.data_nascimento').mask('00/00/0000');
            $('.cep').mask('00000-000');
            $('.celular').mask('(00) 00000-0000');
        });
    </script>
</body>

</html>