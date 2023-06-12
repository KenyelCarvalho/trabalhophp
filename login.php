<?php
 $nome_servidor = "localhost";
 $nome_usuario = "root";
 $senha = "";
 $nome_banco = "Banco_loja";
 // Criar conexão
 $conecta = new mysqli($nome_servidor, $nome_usuario, $senha, $nome_banco);

 /* Verificar Conexão
 if ($conecta->connect_error) {
 die("Conexão falhou: " . $conecta->connect_error."<br>");
 }
 echo "Conexão realizada com sucesso";
//

 // Cria banco de dados
 $sql = "CREATE DATABASE Banco_loja";
 if ($conecta->query($sql) === TRUE) {
 echo "Banco de dados criado com sucesso<br>";
 } else {
 echo "Erro na criação do banco de dados: " . $conecta->error."<br>";
 }
/
 // Criar tabela
 $sql = "CREATE TABLE clientes(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    senha VARCHAR(50),
    data DATE,
    tell VARCHAR(20)
    )";
if ($conecta->query($sql) === TRUE) {
   echo "Tabela clientes criada com sucesso<br>";
   } else {
   echo "Erro na criação da tabela clientes: " . $conecta->error."<br>";
   }

*/
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; // Obtém o email digitado
    $senha = $_POST['senha']; // Obtém a senha digitada

    // Dados de acesso ao banco
    $local = "localhost";
    $usuario_BD = "root";
    $senha_BD = "";
    $base = "Banco_loja";

    // Conexão ao banco
    $conecta = new mysqli($local, $usuario_BD, $senha_BD, $base);
    if ($conecta->connect_error === TRUE) {
        die("Deu erro na conexão " . $conecta->connect_error);
    }

    // Verificação se o email e senha estão corretos
    $tenta_achar = "SELECT * FROM clientes WHERE email='$email' AND senha='$senha'";
    $resultado = $conecta->query($tenta_achar);
    if ($resultado->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $conecta->close(); // Fecha a conexão com o banco de dados
        echo "<script>
                alert('Bem-vindo ao site!');
                window.location.href = 'index.html';
            </script>";
        exit(); // Encerra o script após o redirecionamento
    } else {
        $conecta->close(); // Fecha a conexão com o banco de dados
        echo "<script>
                alert('Login incorreto. Por favor, realize o cadastro.');
                window.location.href = 'cadastro.html';
            </script>";
        exit(); // Encerra o script após o redirecionamento
    }
} else {
    header("Location: cadastro.html"); // Redireciona para a página de cadastro se o método da requisição não for POST
    exit(); // Encerra o script após o redirecionamento
}

?>