<?php

class Produto
{
    private $nome;
    private $preco;
    private $cor;
    private $desconto;
    private $idprod;
    private $mudar;
    public static $instancia;

    public function __construct()
    {
        
		if(!isset(self::$instancia)) {
			self::$instancia = new \PDO("mysql:host=localhost;dbname=bd_titansoftware;", "landre", "acad", array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			self::$instancia->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		return self::$instancia;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
        
    }

    private function calculaDesconto()
    {        

        if ($this->cor == "1"|| $this->cor == "2"){
            $this->desconto = $this->preco * 0.20;
        }elseif ($this->cor == "3"){
            $this->desconto = $this->preco * 0.10;
        }elseif($this->cor == "2" && $this->preco > 50){
            $this->desconto = $this->preco * 0.05;
        }

    }

    public function setCor($cor)
    {
        $this->cor = $cor;
    }   
    
    public function setId($idprod)
    {
        $this->idprod = $idprod;
    }

    public function setMudar($mudar)
    {
        $this->mudar = $mudar;
    }

    public function salvar()
    {

        $pdo = Produto::$instancia;

        $this->calculaDesconto();

        $sql = "INSERT INTO preco (preco, desconto) 
                    VALUES (:preco, :desconto)";
        $sql = $pdo->prepare($sql);
        
        $sql->bindValue(":preco", $this->preco);
        $sql->bindValue(":desconto", $this->desconto);

        $sql->execute();
        $ultimoId = $pdo->lastInsertId();

        $sql = "INSERT INTO produtos (nome, id_preco, cor) 
                    VALUES (:nome, :id_preco, :cor)";
        $sql = $pdo->prepare($sql);

        $sql->bindValue(":nome", $this->nome);
        $sql->bindValue(":id_preco", $ultimoId);
        $sql->bindValue(":cor", $this->cor);

        $sql->execute();

        return true;

    }

    public function editar()
    {
        $pdo = Produto::$instancia;        

        $sql = "SELECT
                    a.*, b.*
                FROM produtos a
                left join preco b on a.id_preco = b.idpreco
                WHERE a.idprod = :idprod";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":idprod", $this->idprod);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }

        if ($dados['cor'] != 0){
            $this->cor = $dados['cor'];
        }

        $this->calculaDesconto();
        
        if ($this->mudar == 's'){
            $sql_produto = "UPDATE produtos SET nome = :nome, cor = :cor WHERE idprod = :idprod";
            $sql = $pdo->prepare($sql_produto);
            
            $sql->bindValue(":nome", $this->nome);
            $sql->bindValue(":cor", $this->cor);
            $sql->bindValue(":idprod", $this->idprod);
            $sql->execute();

            $sql_produto = "UPDATE preco SET preco = :preco, desconto = :desconto WHERE idpreco = :idpreco";
            $sql = $pdo->prepare($sql_produto);
            $sql->bindValue(":preco", $this->preco);
            $sql->bindValue(":idpreco", $dados['id_preco']);
            $sql->bindValue(":desconto", $this->desconto);
            $sql->execute();


        }elseif($this->mudar == 'n') {
            $sql_produto = "UPDATE produtos SET nome = :nome WHERE idprod = :idprod";
            $sql = $pdo->prepare($sql_produto);            
            $sql->bindValue(":nome", $this->nome);
            $sql->bindValue(":idprod", $this->idprod);
            $sql->execute();

            $sql_produto = "UPDATE preco SET preco = :preco, desconto = :desconto WHERE idpreco = :idpreco";    
            $sql = $pdo->prepare($sql_produto);        
            $sql->bindValue(":idpreco", $dados['id_preco']);
            $sql->bindValue(":preco", $this->preco);
            $sql->bindValue(":desconto", $this->desconto);
            $sql->execute();

        }

        return $dados;
    }

    public function excluir()
    {
        $pdo = Produto::$instancia;

        $sql = "SELECT
            a.*, b.*
            FROM produtos a
            left join preco b on a.id_preco = b.idpreco
            WHERE a.idprod = :idprod";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":idprod", $this->idprod);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $sql = "DELETE FROM produtos WHERE idprod = :idprod";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":idprod", $dados['idprod']);
        $sql->execute();

        $sql = "DELETE FROM preco WHERE idpreco = :idpreco";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":idpreco",$dados['id_preco']);
        $sql->execute();

        return true;
    }

    public function listar()
    {
        $dados = array();

        $pdo = Produto::$instancia;
        $sql = "SELECT
                    a.*, b.*
                FROM produtos a
                left join preco b on a.id_preco = b.idpreco
                order by a.idprod desc";

        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $dados;
        
    }

    public function obterProduto($idprod)
    {
        $dados = array();

        $pdo = Produto::$instancia;
        $sql = "SELECT
                    a.*, b.*
                FROM produtos a
                left join preco b on a.id_preco = b.idpreco
                WHERE a.idprod = :idprod
                order by a.idprod desc";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":idprod", $idprod);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }

        return $dados;
    }

}