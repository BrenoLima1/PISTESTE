CREATE DATABASE saveur CHARACTER SET utf8 COLLATE utf8_general_ci;
USE saveur;

CREATE TABLE IF NOT EXISTS mesas(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(12) NOT NULL,
    numero INT NOT NULL UNIQUE,
    id_reserva INT NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS funcionarios(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NOT NULL,
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS reservas(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_funcionario INT NOT NULL,
    nome_cliente VARCHAR(200) NOT NULL,
    id_mesa INT NOT NULL,
    dia DATE NOT NULL,
    hora TIME(0) NOT NULL,
    CONSTRAINT fk_id_funcionario FOREIGN KEY(id_funcionario) REFERENCES funcionarios(id),
    CONSTRAINT fk_id_mesa FOREIGN key(id_mesa) REFERENCES mesas(id),
    situacao VARCHAR(12) NOT NULL
) ENGINE=INNODB;
    