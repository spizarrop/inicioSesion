CREATE TABLE usuarios (
    `idUsuario` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(50) NOT NULL UNIQUE,
    `contrasenia` varchar(60) NOT NULL,
    `correo` varchar(100) NOT NULL UNIQUE,
    `tipo` char(1) NOT NULL,
    PRIMARY KEY (`idUsuario`)
);