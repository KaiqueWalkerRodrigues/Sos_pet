<?php 
    include_once('class/classes.php');

    $Pet = new Pet();
    $Usuario = new Usuario();

    Helper::logado();

    if(isset($_POST['btnInteresse'])){
        $Pet->adicionarInteresse($_SESSION['id_usuario'],$_POST['id_pet']);
    }
    if(isset($_POST['btnCadastrar'])){
        $Pet->cadastrar($_POST,$_POST['imagem']);
    }
    if(isset($_POST['btnEditar'])){
        $Pet->editar($_POST);
    }
    if(isset($_POST['btnExcluir'])){
        $Pet->excluir($_POST['id_pet'],$_POST['tipo']);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>SOS pets</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
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
    <?php include_once('sidebar.php'); ?>
<div class="container">
    <div class="col-12 mt-4 text-center">
        <?php if($_SESSION['cnpj'] != ''){ ?>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrarGato">Doar Gato</button>
        <?php } ?>
    </div>
    <div class="row mt-4 justify-content-center">
    <?php if($_SESSION['cnpj'] != ''){ ?>
        <h3>Seus Gatos para doação</h3>
        <hr>
        <br>

        <?php 
            foreach($Pet->listarMeusPets($_SESSION['id_usuario'],2) as $gato){ 
                $cep = $Usuario->mostrar($gato->id_usuario)->cep;
        ?>
            <div class="col-md-3 col-sm-6">
                <div class="card text-center p-3" data-bs-toggle="modal" data-bs-target="#modalEditarGato" 
                    data-id_pet="<?php echo $gato->id_pet ?>"
                    data-nome="<?php echo $gato->nome ?>"
                    data-raca="<?php echo $gato->raca ?>"
                    data-idade="<?php echo $gato->idade ?>"
                    data-sexo="<?php echo $gato->sexo ?>"
                    data-castrado="<?php echo $gato->castrado ?>"
                    data-cor="<?php echo $gato->cor?>"
                    data-descricao="<?php echo $gato->descricao?>"
                    data-cep="<?php echo $cep ?>"
                    >
                    <img src="imagens_pets/<?php echo $gato->id_pet ?>.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $gato->nome ?> (<?php echo $gato->raca ?>)</h5>
                        <p class="card-text">
                            <?php echo $gato->idade ?>
                            <br>
                            <span id="card_localizacao"></span>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>

    <?php } ?>
        <h3>Gatos Disponíveis para Doação</h3>
        <hr>

        <?php 
            foreach($Pet->listar($_SESSION['id_usuario'],2) as $gato){ 
                $cep = $Usuario->mostrar($gato->id_usuario)->cep;
        ?>
            <div class="col-md-3 col-sm-6">
                <div class="card text-center p-3" data-bs-toggle="modal" data-bs-target="#modalDetalhesgato" 
                    data-id_pet=<?php echo $gato->id_pet ?>
                    data-nome="<?php echo $gato->nome ?>"
                    data-raca="<?php echo $gato->raca ?>"
                    data-idade="<?php echo $gato->idade ?>"
                    data-cor="<?php echo $gato->cor?>"
                    data-descricao="<?php echo $gato->descricao?>"
                    data-cep="<?php echo $cep ?>"
                    >
                    <img src="imagens_pets/<?php echo $gato->id_pet ?>.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $gato->nome ?> (<?php echo $gato->raca ?>)</h5>
                        <p class="card-text">
                            <?php echo $gato->idade ?>
                            <br>
                            <span id="card_localizacao"></span>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        
    </div>

    <!-- Modal Cadastrar Doação -->
    <div class="modal fade p-3" id="modalCadastrarGato" tabindex="1" role="dialog" aria-labelledby="modalCadastrarGatoLabel" aria-hidden="true">
        <form action="?" method="post" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastrar Gato para Doação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
                                <input type="hidden" name="tipo" value="2">
                                <label for="nome_gato" class="form-label">Nome do Gato *</label>
                                <input type="text" name="nome" id="cadastrar_nome_gato" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="raca" class="form-label">Raça</label>
                                <input type="text" name="raca" id="cadastrar_raca" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="idade" class="form-label">Idade *</label>
                                <input type="text" name="idade" id="cadastrar_idade" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="sexo" class="form-label">Sexo *</label>
                                <select name="sexo" id="cadastrar_sexo" class="form-control">
                                    <option value="">Selecione...</option>
                                    <option value="1">Macho</option>
                                    <option value="2">Fêmea</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="cor" class="form-label">Cor *</label>
                                <input type="text" name="cor" id="cadastrar_cor" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="castrado" class="form-label">Castrado *</label>
                                <select name="castrado" id="cadastrar_castrado" class="form-control">
                                    <option value="">Selecione...</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                            <hr class="mt-4">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="imagem" class="form-label">Imagem</label>
                                <input type="file" class="form-control" name="imagem" src="" alt="">
                            </div>
                            <hr class="mt-4">
                            <div class="col-12 mt-3">
                                <label for="descricao" class="form-label">Breve Descrição Sobre o Gato</label>
                                <textarea name="descricao" id="descricao" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="submit" name="btnCadastrar" class="btn btn-success">Cadastrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Modal Editar Doação -->
    <div class="modal fade p-3" id="modalEditarGato" tabindex="1" role="dialog" aria-labelledby="modalEditarGatoLabel" aria-hidden="true">
        <form action="?" method="post" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Gato para Doação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
                                <input type="hidden" name="tipo" value="2">
                                <input type="hidden" name="id_pet" id="editar_id_pet">
                                <label for="editar_nome" class="form-label">Nome do Gato *</label>
                                <input type="text" name="nome" id="editar_nome" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="raca" class="form-label">Raça</label>
                                <input type="text" name="raca" id="editar_raca" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="idade" class="form-label">Idade *</label>
                                <input type="text" name="idade" id="editar_idade" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="sexo" class="form-label">Sexo *</label>
                                <select name="sexo" id="editar_sexo" class="form-control">
                                    <option value="">Selecione...</option>
                                    <option value="1">Macho</option>
                                    <option value="2">Fêmea</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="cor" class="form-label">Cor *</label>
                                <input type="text" name="cor" id="editar_cor" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="castrado" class="form-label">Castrado *</label>
                                <select name="castrado" id="editar_castrado" class="form-control">
                                    <option value="">Selecione...</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                            <hr class="mt-4">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="imagem" class="form-label">Imagem</label>
                                <input type="file" name="imagem" class="form-control" src="" alt="">
                            </div>
                            <hr class="mt-4">
                            <div class="col-12 mt-3">
                                <label for="descricao" class="form-label">Breve Descrição Sobre o Gato</label>
                                <textarea name="descricao" id="editar_descricao" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col-2">
                                <button type="submit" name="btnExcluir" class="btn btn-danger me-auto">Excluir</button>
                            </div>
                            <div class="offset-7 col-3 text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                                <button type="submit" name="btnEditar" class="btn btn-success">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Detalhes Gato -->
    <div class="modal fade" id="modalDetalhesGato" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesGatoLabel" aria-hidden="true">
        <form action="?" method="post">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetalhesGatoLabel">Detalhes da Doação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_pet" id="gato_id_pet">
                        <div class="row">
                            <div class="col-6 text-center">
                                <img id="imagemGato" src="" class="img-fluid" alt="Imagem do Cachorro">
                            </div>
                            <div class="col-6">
                                <h3><span class="gato_nome"></span> (<span class="gato_raca"></span>)</h3>
                                <p><b>Nome:</b> <span class="gato_nome"></span></p>
                                <p><b>Raça:</b> <span class="gato_raca"></span></p>
                                <p><b>Localização:</b> <span class="localizacao">Carregando...</span></p>
                                <p><b>Idade:</b> <span class="gato_idade"></span></p>
                                <p><b>Cor:</b> <span class="gato_cor"></span></p>
                                <p><b>Sexo:</b> <span class="gato_sexo"></span></p>
                                <p><b>Castrado:</b> <span class="gato_castrado"></span></p>
                                <p><b>Descrição:</b> <span class="gato_descricao"></span></p>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btnInteresse" class="btn btn-success">Tenho Interesse</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
</body>
<!-- jQuery deve ser carregado primeiro -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#modalDetalhesGato').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id_pet = button.data('id_pet');
            let nome = button.data('nome');
            let raca = button.data('raca');
            let idade = button.data('idade');
            let sexo = button.data('sexo');
            let castrado = button.data('castrado');
            let cor = button.data('cor');
            let descricao = button.data('descricao');
            let cep = button.data('cep'); // Pega o CEP do dataset do card

            if (sexo == 1) {
                sexo = 'Macho';
            } else {
                sexo = 'Fêmea';
            }
            if (castrado == 0) {
                castrado = 'Não';
            } else {
                castrado = 'Sim';
            }

            // Preencher os campos do modal com as informações
            $('#gato_id_pet').val(id_pet);
            $('.gato_nome').text(nome);
            $('.gato_sexo').text(sexo);
            $('.gato_castrado').text(castrado);
            $('.gato_raca').text(raca);
            $('.gato_idade').text(idade);
            $('.gato_cor').text(cor);
            $('.gato_descricao').text(descricao);

            // Preencher a imagem do gato no modal com o caminho dinâmico usando o id_pet
            $('#imagemGato').attr('src', `imagens_pets/${id_pet}.png`);

            // Buscar a cidade e o estado usando a API ViaCEP
            if (cep) {
                $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                    if (!data.erro) {
                        // Se não houver erro, exibir a cidade e o estado
                        $('#modalDetalhesGato .localizacao').text(`${data.bairro}, ${data.localidade}, ${data.uf}`);
                    } else {
                        $('#modalDetalhesGato .localizacao').text('Localização não disponível');
                    }
                }).fail(function () {
                    $('#modalDetalhesGato .localizacao').text('Erro ao buscar localização');
                });
            } else {
                $('#modalDetalhesGato .localizacao').text('CEP não disponível');
            }
        });

        $('#modalEditarGato').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id_pet = button.data('id_pet');
            let nome = button.data('nome');
            let raca = button.data('raca');
            let idade = button.data('idade');
            let sexo = button.data('sexo');
            let castrado = button.data('castrado');
            let cor = button.data('cor');
            let descricao = button.data('descricao');
            
            // Preencher os campos do modal com as informações
            $('#editar_id_pet').val(id_pet);
            $('#editar_nome').val(nome);
            $('#editar_raca').val(raca);
            $('#editar_sexo').val(sexo);
            $('#editar_castrado').val(castrado);
            $('#editar_idade').val(idade);
            $('#editar_cor').val(cor);
            $('#editar_descricao').val(descricao);
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
        })
    });
</script>
</html>
