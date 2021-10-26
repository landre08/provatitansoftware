<?php
session_start();
require_once '../modelo/Produto.php';

$idprod = $_GET['idprod'];

$produto = new Produto();
$produto->setId($idprod);

if ( $produto->excluir() ) {
    header("Location: ../index.php");
}