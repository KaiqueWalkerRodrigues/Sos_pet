<?php 
    include_once('class/classes.php');

    Helper::logado();

    if (isset($_POST['btnCadastrar'])) {
        $usuario = new Usuario();
        $usuario->cadastrarEmpresa($_POST);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>SOS pets</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php include_once('sidebar.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card bg-color-grey">
                    <div class="card-content collapse show" style="margin-top: -40px;">
                        <div class="card-body">
                            <div class="pre-tela">
                                <h2>Bem-vindo à plataforma SOS PETS</h2>
                                <p>Escolha qual classe de PET está interessado</p>
                                <?php if($_SESSION['cnpj'] == ''){ ?>
                                    <button class="btn btn-primary mb-3" style="font-size: 19px" data-bs-toggle="modal" data-bs-target="#modalAdicionarCNPJ">Torne-se Doador</button>
                                <?php } ?>
                                <div class="list-modulos">
                                    <a href="cachorros" class="link-entrada">
                                        <div class="modutos">
                                            <div class="box-modutos mod-bob">
                                                <img src="imagens/dog.png" class="img-pre-tela" alt="">
                                                <h3>Adotar Cachorros</h3>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="gatos" class="link-entrada">
                                        <div class="modutos">
                                            <div class="box-modutos mod-workteams">
                                                <img src="imagens/gatos.png" class="img-pre-tela" alt="">
                                                <h3>Adotar Gatos</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Adicionar CNPJ -->
    <div class="modal fade p-3" id="modalAdicionarCNPJ" tabindex="1" role="dialog" aria-labelledby="modalAdicionarCNPJLabel" aria-hidden="true">
        <form action="?" method="post">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastrar Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="nome_empresa" class="form-label">Nome da Empresa *</label>
                                <input type="text" name="nome_empresa" id="cadastrar_nome_empresa" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="cnpj" class="form-label">CNPJ *</label>
                                <input type="text" name="cnpj" id="cadastrar_cnpj" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="submit" name="btnCadastrar" class="btn btn-success disabled" id="btnCadastrar">Cadastrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Aplica a máscara no campo de CNPJ
        $('#cadastrar_cnpj').mask('00.000.000/0000-00', {reverse: true});

        // Verifica se o CNPJ é válido quando o usuário sai do campo
        $('#cadastrar_cnpj').on('blur', function() {
            var cnpj = $(this).val();
            if (validarCNPJ(cnpj)) {
                $(this).css('border-color', 'green');
                $('#btnCadastrar').removeClass('disabled')
            } else {
                $(this).css('border-color', 'red');
                $('#btnCadastrar').addClass('disabled')
            }
        });

        function validarCNPJ(cnpj) {
            cnpj = cnpj.replace(/[^\d]+/g, '');

            if (cnpj.length !== 14) {
                return false;
            }

            // Elimina CNPJs com todos os dígitos iguais
            if (/^(\d)\1+$/.test(cnpj)) {
                return false;
            }

            // Validação dos dígitos verificadores
            var tamanho = cnpj.length - 2;
            var numeros = cnpj.substring(0, tamanho);
            var digitos = cnpj.substring(tamanho);
            var soma = 0;
            var pos = tamanho - 7;

            for (var i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) pos = 9;
            }

            var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0)) {
                return false;
            }

            tamanho++;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;

            for (var i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) pos = 9;
            }

            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1)) {
                return false;
            }

            return true;
        }
    });
</script>
</html>
