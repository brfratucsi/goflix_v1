<?php
//Conexão
include_once 'db_connect.php';

//Sessão
session_start();

// Adicionar
if (isset($_POST['add_fav'])) {

    $id = $_SESSION['id_cliente'];
    $filme_fav = mysqli_escape_string($connect, $_POST['id_filme']);

    $add_fav = "INSERT INTO favoritos(id_cliente, id_filme) VALUES  
	('$id', '$filme_fav')";

    if (mysqli_query($connect, $add_fav)) {
        header('Location: ../home.php');
    } else {
        header('Location: ../home.php');
    }
}
