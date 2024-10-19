<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<nav class="menu container-fluid">
    <div class="row">
        <div class="col-1 offset-6 text-center">
            <a href="/sos_pet/home">
                <img src="imagens/logo.png" class="imagem-topo" style="margin-top: -20%;margin-left: -40%">
            </a>
        </div>
        <div class="col-2 offset-1">
            <b>Olá, <?php echo $_SESSION['nome'] ?> (<?php if($_SESSION['cnpj'] == ''){echo 'Cliente';}else{echo 'Doador';} ?>)</b>
        </div>
        <div class="col-1 text-end">
            <div class="row">
                <div class="col-6">
                    <a href="lista_interesse" class="btn btn-lg btn-secondary"><i class="fa-solid fa-hand-holding-heart"></i></a>
                </div>
                <div class="col-6">
                    <a href="sair" class="btn btn-lg btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </div>
        </div>
    </div>
</nav>