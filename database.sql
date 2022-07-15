create database activosbd;

use database activosbd;

SET time_zone='-05:00';

CREATE TABLE Usuario(
 idUsuario INT NOT NULL AUTO_INCREMENT,
 curp VARCHAR(20) NOT NULL UNIQUE,
 nombre VARCHAR(50) NOT NULL,
 apellidoP VARCHAR(40) NOT NULL,
 apellidoM VARCHAR(40) NOT NULL,
 puesto VARCHAR(40) NOT NULL,
 area VARCHAR(40) NOT NULL,
 correo VARCHAR(100) NOT NULL UNIQUE,
 password VARCHAR(40),
 CONSTRAINT PK_Usuario PRIMARY KEY (idUsuario)
);

CREATE TABLE linkPassword(
 idLink INT NOT NULL AUTO_INCREMENT,
 idUsuario INT NOT NULL UNIQUE,
 token VARCHAR(MAX) NOT NULL,
 fechaCreacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT PK_linkPassword PRIMARY KEY (idLink),
 CONSTRAINT FK_LinkUser FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Permisos(
 idPermiso INT NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(40) NOT NULL,
 CONSTRAINT PK_Permisos PRIMARY KEY (idPermiso)
);

CREATE TABLE permisosUsuario(
 idPermisoUsuario INT NOT NULL AUTO_INCREMENT,
 idUsuario INT NOT NULL,
 idPermiso INT NOT NULL,
 CONSTRAINT PK_PermisosUsuario PRIMARY KEY (idPermisoUsuario),
 CONSTRAINT FK_UsuarioPermiso FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario),
 CONSTRAINT FK_Permiso FOREIGN KEY (idPermiso) REFERENCES Permisos(idPermiso)
);

CREATE TABLE Asignacion(
 idAsignacion INT NOT NULL AUTO_INCREMENT,
 fechaAsignacion DATE NOT NULL,
 usuarioAsigna INT NOT NULL,
 usuarioAsignado INT NOT NULL,
 observaciones VARCHAR(MAX),
 CONSTRAINT PK_Asignacion PRIMARY KEY (idAsignacion),
 CONSTRAINT FK_UsuarioAsignado FOREIGN KEY (usuarioAsignado) REFERENCES Usuario(idUsuario), 
);

CREATE TABLE Activo(
 idActivo INT NOT NULL AUTO_INCREMENT,
 noActivo VARCHAR(50) NOT NULL UNIQUE,
 noSerie VARCHAR(50) NOT NULL UNIQUE,
 marca VARCHAR(50) NOT NULL,
 modelo VARCHAR(50) NOT NULL,
 memoriaRAM VARCHAR(10),
 discoDuro VARCHAR(10),
 procesador VARCHAR(30),
 fechaAlta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 idAsignacion INT,
 estado BIT NOT NULL,
 usuarioBaja INT,
 fechabaja DATE,
 CONSTRAINT PK_Activo PRIMARY KEY (idActivo),
 CONSTRAINT FK_ActivoAsignado FOREIGN KEY (idAsignacion) REFERENCES Asignacion(idAsignacion)
);

CREATE TABLE Accesorio(
 idAccesorio INT NOT NULL AUTO_INCREMENT,
 CONSTRAINT PK_Accesorio PRIMARY KEY (idAccesorio)
);

CREATE TABLE Aplicaciones(
 idAplicacion INT NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(40) NOT NULL,
 CONSTRAINT PK_Aplicaciones PRIMARY KEY (idAplicacion)
);

CREATE TABLE ActivoAplicaciones(
 idActivoAplicacion INT NOT NULL AUTO_INCREMENT,
 idActivo INT NOT NULL,
 idAplicacion INT NOT NULL,
 CONSTRAINT PK_ActivoAplicacion PRIMARY KEY (idActivoAplicacion),
 CONSTRAIN FK_Activo FOREIGN KEY (idActivo) REFERENCES Activo(idActivo),
 CONSTRAIN FK_Aplicacion FOREIGN KEY (idAplicacion) REFERENCES Aplicaciones(idAplicacion)
);

