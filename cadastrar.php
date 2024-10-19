<?php 
    include_once('class/classes.php');

    $Usuario = new Usuario();

    if(isset($_POST['btnCadastrar'])){
        $Usuario->cadastrar($_POST);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cadastro</title>
    <style>
        .invalid-cpf {
            border: 2px solid red !important;
        }
        .valid-cpf {
            border: 2px solid green !important;
        }
        .disabled {
            background-color: #ccc;  /* Cor de fundo acinzentada para indicar que está desabilitado */
            color: #666;             /* Cor do texto mais clara */
            border: 1px solid #999;  /* Borda acinzentada */
            cursor: not-allowed;     /* Cursor indicando que a ação não é permitida */
            pointer-events: none;    /* Impede o clique no botão */
            opacity: 0.6;            /* Botão parcialmente transparente */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="assets/img/doadores.png" alt="">
        </div>
        <div class="form">
            <form action="?" method="post">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastre-se</h1>
                    </div>
                    <div class="login-button">
                        <a href="logar"><button type="button" style="color: white">Entrar</button></a>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome *</label>
                        <input id="nome" type="text" name="nome" placeholder="Digite seu nome" required>
                    </div>
                    <div class="input-box">
                        <label for="email">E-mail *</label>
                        <input id="email" type="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>
                    
                    <div class="input-box">
                        <label for="cpf">CPF *</label>
                        <input id="cpf" type="text" name="cpf" placeholder="000.000.000-00" required>
                    </div>

                    <div class="input-box">
                        <label for="celular">Celular *</label>
                        <input id="celular" type="tel" name="celular" placeholder="(xx) 9xxxx-xxxx" required>
                    </div>
                    
                    <div class="input-box">
                        <label for="senha">Senha *</label>
                        <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    
                    
                    <div class="input-box">
                        <label for="confirma_senha">Confirmar Senha *</label>
                        <input id="confirma_senha" type="password" name="confirma_senha" placeholder="Confirme sua senha" required>
                    </div>
                    
                    <div class="input-box">
                        <label for="cep">CEP *</label>
                        <input id="cep" type="text" name="cep" placeholder="00000-000" required>
                    </div>

                    <!-- Span para exibir alerta de senhas diferentes -->
                    <div class="input-box">
                        <span id="alerta-senha" style="color: red; display: none;">As senhas não coincidem!</span>
                    </div>

                </div>
                <div class="continue-button" style="margin-top: -7%;">
                    <button type="submit" id="btnCadastrar" class="disabled" name="btnCadastrar" style="color: white;">Cadastrar-se</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Variáveis para armazenar o estado das validações
            var senhaValida = false;
            var cpfValido = false;
            var cepValido = false;

            // Função para verificar todas as validações e habilitar/desabilitar o botão de cadastro
            function verificarValidacoes() {
                if (senhaValida && cpfValido && cepValido) {
                    $('#btnCadastrar').removeClass('disabled');  // Remove a classe disabled
                    $('#btnCadastrar').prop('disabled', false);  // Habilita o botão fisicamente
                } else {
                    $('#btnCadastrar').addClass('disabled');  // Adiciona a classe disabled
                    $('#btnCadastrar').prop('disabled', true); // Desativa o botão fisicamente
                }
            }

            // Verificação de senhas iguais
            $('#senha, #confirma_senha').keyup(function () {
                var senha = $('#senha').val();
                var confirmaSenha = $('#confirma_senha').val();

                senhaValida = senha === confirmaSenha && senha.length > 0;

                if (!senhaValida) {
                    $('#alerta-senha').show();
                } else {
                    $('#alerta-senha').hide();
                }

                verificarValidacoes();
            });

            // Formatação automática do CPF
            $('#cpf').on('input', function () {
                var cpf = $(this).val().replace(/\D/g, ''); // Remove todos os não-números
                if (cpf.length <= 11) {
                    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
                    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
                    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
                    $(this).val(cpf);
                }

                // Verificação do CPF
                cpfValido = validarCPF(cpf.replace(/\D/g, ''));

                if (cpfValido) {
                    $(this).removeClass('invalid-cpf').addClass('valid-cpf');
                } else {
                    $(this).removeClass('valid-cpf').addClass('invalid-cpf');
                }

                verificarValidacoes();
            });

            // Formatação automática do CEP
            $('#cep').on('input', function () {
                var cep = $(this).val().replace(/\D/g, ''); // Remove todos os não-números
                if (cep.length <= 8) {
                    cep = cep.replace(/(\d{5})(\d{3})/, "$1-$2");
                    $(this).val(cep);
                }

                // Verificação do CEP
                cepValido = validarCEP(cep.replace(/\D/g, ''));

                if (cepValido) {
                    $(this).removeClass('invalid-cpf').addClass('valid-cpf');
                } else {
                    $(this).removeClass('valid-cpf').addClass('invalid-cpf');
                }

                verificarValidacoes();
            });

            // Formatação automática do celular
            $('#celular').on('input', function () {
                var celular = $(this).val().replace(/\D/g, ''); // Remove todos os não-números
                if (celular.length === 11) {
                    celular = celular.replace(/^(\d{2})(\d{1})(\d{4})(\d{4})$/, "($1) $2 $3-$4");
                } else if (celular.length === 10) {
                    celular = celular.replace(/^(\d{2})(\d{4})(\d{4})$/, "($1) $2-$3");
                }
                $(this).val(celular);
            });

            // Função de validação de CPF
            function validarCPF(cpf) {
                if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
                    return false;
                }
                var soma = 0;
                for (var i = 0; i < 9; i++) {
                    soma += parseInt(cpf.charAt(i)) * (10 - i);
                }
                var resto = 11 - (soma % 11);
                if (resto === 10 || resto === 11) {
                    resto = 0;
                }
                if (resto !== parseInt(cpf.charAt(9))) {
                    return false;
                }

                soma = 0;
                for (i = 0; i < 10; i++) {
                    soma += parseInt(cpf.charAt(i)) * (11 - i);
                }
                resto = 11 - (soma % 11);
                if (resto === 10 || resto === 11) {
                    resto = 0;
                }
                return resto === parseInt(cpf.charAt(10));
            }

            // Função de validação de CEP
            function validarCEP(cep) {
                // Um CEP válido possui exatamente 8 dígitos numéricos
                return cep.length === 8;
            }
        });
    </script>


</body>

</html>
