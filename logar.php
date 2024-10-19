<?php 
    include_once('class/classes.php');

    $Usuario = new Usuario();

    if(isset($_POST['btnLogin'])){
        $Usuario->logar($_POST['email'],$_POST['senha']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="shortcut icon" href="imagens" type="image/x-icon">
    <title>Login Doadores</title>
</head>

<body>
    <form action="?" method="post">
    <div class="main-login">
        <div class="esquerda-login">
            <h1>Faça login<br> e doe um PET </h1>
            <img src="imagens/doadores.png" background-size 100% 100%;>
        </div>
        <div class="direita-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                <div class="campo-texto">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="campo-texto">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>

                <h4><br>Não tem cadastro ainda?</br></h4>
                <h5><a href="cadastrar">Cadastre-se!</a></h5>

                <button type="submit" name="btnLogin" class="btn-login btn-1" style="text-decoration: none; color:darkblue">
                    Login
                </button>
            </div>
        </div>
    </div>
    </form>
</body>
<script src="script/script.js"></script>
</html>