<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data = $_POST['data'];
    $tell = $_POST['tell'];

    $nome_servidor = "localhost";
    $nome_usuario = "root";
    $senha_bd = "";
    $nome_banco = "Banco_loja";

    $conexao = new mysqli($nome_servidor, $nome_usuario, $senha_bd, $nome_banco);
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    $sql = "INSERT INTO clientes (nome, email, senha, data, tell) VALUES ('$nome', '$email', '$senha', '$data', '$tell')";
    if ($conexao->query($sql) === TRUE) {
        $_SESSION['login'] = $nome;
        $_SESSION['senha'] = $senha;
        $conexao->close();
        echo "<script>
                alert('Bem-vindo ao site!');
                window.location.href = 'index.html';
            </script>";
        exit();
    } else {
        $conexao->close();
        echo "<script>
                alert('Erro ao cadastrar. Por favor, tente novamente.');
                window.location.href = 'cadastro.html';
            </script>";
        exit();
    }
}
?>