<?php
    session_start(); // Inicia a sessão
    
    // Realiza o logout removendo as variáveis de sessão
    session_unset();
    session_destroy();
    
    // Redireciona o usuário para a página após o logout
    header("Location: index.html");
    exit();
?>