CREATE DATABASE IF NOT EXISTS carnesDB;
USE carnesDB;

CREATE TABLE tipos_de_carnes (
    nombreTipo VARCHAR(25) NOT NULL,
    clima VARCHAR(25),
    observacion VARCHAR(50),
    zona VARCHAR(50),
    PRIMARY KEY (nombreTipo)
);

CREATE TABLE carnes (
    idCarne INT(11) NOT NULL AUTO_INCREMENT,
    nombreCarne VARCHAR(25) NOT NULL,
    cantidadProduccion VARCHAR(25),
    costo INT(11),
    nombreTipo VARCHAR(25),
    fechaProduccion DATE,
    PRIMARY KEY (idCarne),
    FOREIGN KEY (nombreTipo) REFERENCES tipos_de_carnes(nombreTipo)
);
