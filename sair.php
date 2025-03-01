<?php
session_start(); // Inicia a sessão se ainda não foi iniciada

// Destrói todas as variáveis de sessão
$_SESSION = array();

// Se for desejado destruir a sessão completamente, também delete o cookie da sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrói a sessão
session_destroy();

// Redireciona para index.php
header('Location: index.php');
exit();
