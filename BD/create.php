<?php
//Sessão
session_start();

//Conexão
require_once 'db_connect.php';

if (isset($_POST['btn-cadastrar'])) {
    $usuario = mysqli_escape_string($connect, $_POST['usuario']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $id_assinatura = mysqli_escape_string($connect, $_POST['id_assinatura']);

    $sql = " INSERT INTO cliente (usuario, email, senha, id_assinatura) VALUES
	('$usuario',	'$email',	'$senha', '$id_assinatura');";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../index.php');
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar";
        header('Location: ../index.php');
    }
}
