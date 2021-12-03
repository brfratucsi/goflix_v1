<?php

//Sessão
session_start();

//Conexão
include_once 'db_connect.php';

// Deletar Favoritos
if (isset($_POST['del_fav'])) {

    $del_fav = mysqli_escape_string($connect, $_POST['id_favoritos']);

    $sql_delete_fav = "DELETE FROM `favoritos` WHERE `favoritos`.`id_favoritos` = $del_fav";

    if (mysqli_query($connect, $sql_delete_fav)) {
        header('Location: ../perfil.php');
    } else {
        header('Location: ../perfil.php');
    }
}
