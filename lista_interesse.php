<?php 
    include_once('class/classes.php');

    $Pet = new Pet();
    $Usuario = new Usuario();

    Helper::logado();
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
        .card {
            width: 18rem;
        }

        .card img {
            height: 200px;
            width: 100%; /* Garante que a imagem ocupe a largura total do card */
            object-fit: contain; /* Garante que a imagem cubra o espaço sem distorção */
        }

        .card-body {
            min-height: 150px; /* Define uma altura mínima para os textos */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: scale(1.1); /* Aumenta o card em 10% */
            transition: transform 0.3s ease; /* Animação suave de aumento */
        }
    </style>
</head>

<body>
    <?php include_once('sidebar.php') ?>

    <div class="container">
        <div class="row mt-4 justify-content-center">

            <h2>Lista de Interesse</h2>
            <hr>
            <br>

            <?php 
                foreach($Pet->listarInteresses($_SESSION['id_usuario']) as $pet){ 
                    $usuario = $Usuario->mostrar($pet->id_usuario);
                    $cep = $Usuario->mostrar($pet->id_usuario)->cep;
            ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-center p-3" data-bs-toggle="modal" data-bs-target="#modalDetalhesPet" 
                        data-id_pet="<?php echo $pet->id_pet ?>"
                        data-nome="<?php echo $pet->nome ?>"
                        data-raca="<?php echo $pet->raca ?>"
                        data-idade="<?php echo $pet->idade ?>"
                        data-cor="<?php echo $pet->cor?>"
                        data-descricao="<?php echo $pet->descricao?>"
                        data-cep="<?php echo $cep ?>"
                        data-usuario_empresa="<?php echo $usuario->nome_empresa ?>"
                        data-usuario_nome="<?php echo $usuario->nome ?>"
                        data-usuario_celular="<?php echo Helper::formatarCelular($usuario->celular) ?>"
                        >
                        <img src="imagens_pets/<?php echo $pet->id_pet ?>.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $pet->nome ?> (<?php echo $pet->raca ?>)</h5>
                            <p class="card-text">
                                <?php echo $pet->idade ?>
                                <br>
                                <span id="card_localizacao"></span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        
    </div>
    
    <!-- Modal Detalhes Pet -->
    <div class="modal fade" id="modalDetalhesPet" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesPetLabel" aria-hidden="true">
        <form action="?" method="post">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetalhesPetLabel">Detalhes da Doação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_pet" id="Pet_id_pet">
                        <div class="row">
                            <div class="col-6 text-center">
                                <img id="imagemPet" src="" class="img-fluid" alt="Imagem do Pet">
                            </div>
                            <div class="col-6">
                                <h3><span class="Pet_nome"></span> (<span class="Pet_raca"></span>)</h3>
                                <p><b>Nome:</b> <span class="Pet_nome"></span></p>
                                <p><b>Raça:</b> <span class="Pet_raca"></span></p>
                                <p><b>Localização:</b> <span class="localizacao">Carregando...</span></p>
                                <p><b>Idade:</b> <span class="Pet_idade"></span></p>
                                <p><b>Cor:</b> <span class="Pet_cor"></span></p>
                                <p><b>Descrição:</b> <span class="Pet_descricao"></span></p>
                                <hr>
                                <h4 class="text-primary">Contato Doador:</h4>
                                <p><b class="text-primary">Empresa: </b><span class="Usuario_empresa"></span></p>
                                <p><b class="text-primary">Nome Responsável: </b><span class="Usuario_nome"></span></p>
                                <p>
                                    <b class="text-primary">Celular: </b>
                                    <span class="Usuario_celular"></span>&nbsp;
                                    <a id="whatsappLink" href="#" target="_blank" class="btn btn-success">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </p>
                                <p><b class="text-primary">Localização: </b><span class="localizacao"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#modalDetalhesPet').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget); // Botão que acionou o modal
            let id_pet = button.data('id_pet');
            let nome = button.data('nome');
            let raca = button.data('raca');
            let idade = button.data('idade');
            let cor = button.data('cor');
            let descricao = button.data('descricao');
            let cep = button.data('cep');

            let usuario_empresa = button.data('usuario_empresa'); 
            let usuario_nome = button.data('usuario_nome'); 
            let usuario_celular = button.data('usuario_celular');

            // Preencher os campos do modal com as informações
            $('#Pet_id_pet').val(id_pet);
            $('.Pet_nome').text(nome);
            $('.Pet_raca').text(raca);
            $('.Pet_idade').text(idade);
            $('.Pet_cor').text(cor);
            $('.Pet_descricao').text(descricao);

            $('.Usuario_empresa').text(usuario_empresa);
            $('.Usuario_nome').text(usuario_nome);
            $('.Usuario_celular').text(usuario_celular);
            
            // Formatar o celular para o link do WhatsApp
            let celularSemFormatacao = usuario_celular.replace(/[^0-9]/g, '');
            $('#whatsappLink').attr('href', `https://wa.me/55${celularSemFormatacao}`);

            // Atualizar a imagem do pet no modal
            $('#imagemPet').attr('src', `imagens_pets/${id_pet}.png`);

            // Buscar a cidade e o estado usando a API ViaCEP
            if (cep) {
                $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                    if (!data.erro) {
                        // Se não houver erro, exibir a cidade e o estado
                        $('#modalDetalhesPet .localizacao').text(`${data.bairro}, ${data.localidade}, ${data.uf}`);
                    } else {
                        $('#modalDetalhesPet .localizacao').text('Localização não disponível');
                    }
                }).fail(function () {
                    $('#modalDetalhesPet .localizacao').text('Erro ao buscar localização');
                });
            } else {
                $('#modalDetalhesPet .localizacao').text('CEP não disponível');
            }
        });

        $('.card').each(function () {
            let card = $(this);
            let cep = card.data('cep'); // Pega o CEP do dataset do card
            
            // Buscar a cidade, estado e bairro usando a API ViaCEP
            if (cep) {
                $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                    if (!data.erro) {
                        // Se não houver erro, exibir a cidade, estado e bairro
                        card.find('#card_localizacao').first().text(`${data.bairro}, ${data.localidade}, ${data.uf}`);
                    } else {
                        card.find('#card_localizacao').first().text('Localização não disponível');
                    }
                }).fail(function () {
                    card.find('#card_localizacao').first().text('Erro ao buscar localização');
                });
            } else {
                card.find('#card_localizacao').first().text('CEP não disponível');
            }
        });

        // Verifica se existe o parâmetro 's' na URL
        let urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('s')) {
            // Exibe o alerta
            alert('Pet adicionado a sua lista de Interesse!');
            
            // Limpa os parâmetros da URL sem recarregar a página
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }
    });
</script>
</html>
