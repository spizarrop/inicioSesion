CREATE TABLE usuarios (
    `idUsuario` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(50) NOT NULL,
    `contrasenia` varchar(50) NOT NULL,
    `correo` varchar(150) NOT NULL,
    `tipo` char(1) NOT NULL,
    PRIMARY KEY (`idUsuario`)
    );