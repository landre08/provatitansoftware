<?php
session_start();
require_once '../modelo/Produto.php';

unset($_SESSION['msg_vazio']);

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$cor = $_POST['cor'];

if ( empty($nome) || empty($preco) ) {
    $msg = "Preencha todos os campos.";
    $_SESSION['msg_vazio'] =  $msg;

    header("Location: adicionar.php");
    exit;
}

$produto = new Produto();

$preco = str_replace(",", ".", $preco);
$produto->setNome($nome);
$produto->setPreco($preco);
$produto->setCor($cor);

if ( $produto->salvar() ) {
    header("Location: ../index.php");
}

