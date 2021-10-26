CREATE DATABASE bd_titansoftware;
USE bd_titansoftware;

CREATE TABLE IF NOT EXISTS preco
(
    idpreco int(11) AUTO_INCREMENT,
    preco decimal(10,2),
    desconto decimal(10,2),
    PRIMARY KEY (idpreco)
);

CREATE TABLE IF NOT EXISTS produtos (
    idprod INT AUTO_INCREMENT,
    id_preco INT(11),
    nome VARCHAR(80) NOT NULL,
    cor VARCHAR(50) NOT NULL,
    PRIMARY KEY (idprod),
    FOREIGN KEY (id_preco)
        REFERENCES preco (idpreco)
        ON UPDATE RESTRICT ON DELETE CASCADE
);
