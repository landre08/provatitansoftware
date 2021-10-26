<?php
session_start();
require_once '../modelo/Produto.php';

unset($_SESSION['msg_vazio']);

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$cor = $_POST['cor'];;


if ( empty($nome) || empty($preco) ) {
    $msg = "Preencha todos os campos.";
    $_SESSION['msg_vazio'] =  $msg;

    header("Location: ../editar.php?idprod=".$_POST['idprod']);
    exit;
}

$produto = new Produto();

$preco = str_replace(",", ".", $preco);
$produto->setId($_POST['idprod']);
$produto->setNome($nome);
$produto->setPreco($preco);
$produto->setMudar($_POST['mudar']);
$produto->setCor($cor);

if ( $produto->editar() ) {
    header("Location: ../index.php");
}

