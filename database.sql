create database activosbd;

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
 password VARCHAR(255),
 CONSTRAINT PK_Usuario PRIMARY KEY (idUsuario)
);

CREATE TABLE linkPassword(
 idLink INT NOT NULL AUTO_INCREMENT,
 idUsuario INT NOT NULL UNIQUE,
 token VARCHAR(500) NOT NULL,
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
 fechaAsignacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 cantidad INT,
 idAccesorio INT,
 idActivo INT,
 usuarioAsigna INT NOT NULL,
 usuarioAsignado INT NOT NULL,
 observaciones VARCHAR(65535),
 CONSTRAINT PK_Asignacion PRIMARY KEY (idAsignacion),
 CONSTRAINT FK_UsuarioAsignado FOREIGN KEY (usuarioAsignado) REFERENCES Usuario(idUsuario)
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
 observaciones VARCHAR(65535),
 idAsignacion INT,
 estado BIT NOT NULL DEFAULT 1,
 usuarioBaja INT,
 fechabaja DATE,
 CONSTRAINT PK_Activo PRIMARY KEY (idActivo),
 CONSTRAINT FK_ActivoAsignado FOREIGN KEY (idAsignacion) REFERENCES Asignacion(idAsignacion)
);

CREATE TABLE Accesorio(
 idAccesorio INT NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(50) NOT NULL,
 cantidad INT NOT NULL,
 fechaRegistro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 fechaActualizacion TIMESTAMP,
 fechaEliminacion TIMESTAMP,
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
 idAplicacion VARCHAR(100) NOT NULL,
 CONSTRAINT PK_ActivoAplicacion PRIMARY KEY (idActivoAplicacion),
 CONSTRAINT FK_Activo FOREIGN KEY (idActivo) REFERENCES Activo(idActivo),
);

INSERT INTO permisos(nombre) VALUES ('Permisos');
INSERT INTO permisos(nombre) VALUES ('Mis activos');
INSERT INTO permisos(nombre) VALUES ('Reporte de activos');
INSERT INTO permisos(nombre) VALUES ('Reporte de bajas');
INSERT INTO permisos(nombre) VALUES ('Altas');
INSERT INTO permisos(nombre) VALUES ('Asignar');

INSERT INTO Aplicaciones(nombre) VALUES ('Office 365');
INSERT INTO Aplicaciones(nombre) VALUES ('VPN');
INSERT INTO Aplicaciones(nombre) VALUES ('Antivirus');
INSERT INTO Aplicaciones(nombre) VALUES ('Educafin');

INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4485110876632173', '4539513839717', 'Waelchi, Crooks and Kirlin', 'Bednar-Christiansen', '4', '1', '2', '1988-02-25 07:08:47', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5148612751955302', '4916779899018', 'Swift-Huels', 'Nicolas, Predovic and Greenholt', '3', '8', '6', '2015-04-28 10:39:35', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4532494571949', '348509109255577', 'Hilll-Nikolaus', 'Kuhn-West', '6', '3', '6', '1978-02-05 12:07:13', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4555164058310055', '4366585288024', 'Sauer Ltd', 'Reichel-Wisoky', '', '8', '9', '1997-06-10 13:29:20', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4532597041573119', '4929581886167193', 'Dare LLC', 'Hermiston-Mann', '2', '1', '5', '2013-04-30 13:53:20', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4539396889952168', '4716102083095', 'Schowalter, Watsica and Vandervort', 'Kohler-Fahey', '1', '5', '9', '2006-05-03 09:53:58', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4532730518826', '5307469330304272', 'Keeling, Rowe and Hand', 'Farrell and Sons', '1', '9', '', '1978-04-05 05:11:45', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5470360055225176', '5469025171101029', 'Wyman Ltd', 'Hayes-Weissnat', '2', '5', '4', '2022-08-29 10:23:37', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5522601896320413', '5128183308643503', 'Boehm-Lindgren', 'Prosacco-Abshire', '2', '4', '3', '2012-02-16 12:58:45', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5441189298085220', '5493469766270381', 'Weissnat-Bradtke', 'Bartoletti Group', '8', '', '5', '1983-11-15 22:07:51', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5523813684696021', '340089538588490', 'Funk and Sons', 'Marks Inc', '9', '3', '6', '2014-08-10 05:31:49', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4481533417076', '4539859461371', 'Gusikowski LLC', 'Herzog LLC', '1', '', '5', '2003-02-15 21:57:31', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4556866304044418', '4024007150696', 'Douglas Inc', 'Denesik-Hermiston', '2', '9', '5', '1975-05-11 06:54:56', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4556987005514577', '5582910166661139', 'Sauer, Weissnat and Russel', 'Hackett, Romaguera and Price', '', '1', '', '1992-08-21 10:04:16', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4532321370793', '4485203603957543', 'Robel-Barrows', 'Runolfsson, Nikolaus and Gibson', '4', '6', '3', '2005-01-02 07:19:57', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5463586051137484', '4539957552094', 'Bauch-Lowe', 'Pouros Ltd', '3', '9', '', '1985-08-23 23:23:16', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5262125034102292', '4485539177747363', 'Adams', 'Kon and Steuber', 'Haag-Spencer', '2', '9', '1', '2011-04-19 18:52:49', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('347043028012203', '373129934278502', 'Wolff-Nicolas', 'Schumm Inc', '6', '7', '3', '2000-05-13 06:30:47', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4478336758917', '5570071536255361', 'Walker-Jones', 'Rau Inc', '8', '4', '2', '1998-08-22 10:58:00', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5247812215865823', '5276451147156063', 'Hessel Group', 'Greenholt and Sons', '5', '6', '2', '1995-12-24 06:19:39', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('6011608802826793', '5529922494184653', 'Wolff-Krajcik', 'Feil Ltd', '6', '2', '2', '1984-03-10 06:52:31', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('343843958341952', '4716975883733555', 'Daniel, Boehm and Dickens', 'Osinski-Considine', '9', '4', '9', '2011-12-19 16:52:15', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4107500426675', '4916292502813529', 'Wintheiser-Mertz', 'Weissnat-Jerde', '6', '7', '8', '2020-04-04 05:52:25', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5332874778756444', '5198473727767766', 'Quigley-Hills', 'Kirlin, Friesen and Smitham', '5', '9', '8', '2015-10-04 07:23:18', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5112406702725901', '4929119077341732', 'Maggio-Hilll', 'Emard-Hagenes', '4', '3', '7', '1984-12-15 02:32:17', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5401105562271288', '374552729217028', 'Reinger PLC', 'Schroeder-Ward', '7', '3', '3', '1991-11-04 03:21:44', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5501364000188502', '5380538661826708', 'Shanahan-Kutch', 'Littel PLC', '', '', '6', '2022-06-03 17:02:22', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5261728605279693', '5204526744960509', 'Kunze, Kemmer and Kutch', 'McKenzie, Kihn and Mills', '5', '6', '3', '2019-06-24 00:19:07', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5371867414707521', '6011114233248272', 'Strosin Inc', 'McGlynn Group', '2', '5', '3', '1996-05-20 05:23:30', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4916165929217', '5424068780410352', 'Metz, Cartwright and Kris', 'Fay, Ritchie and Zboncak', '1', '2', '8', '2010-12-08 23:28:19', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('6011927195205566', '4929153248571217', 'Mante Inc', 'Sipes-Legros', '6', '3', '6', '1993-03-15 08:06:40', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('6011915579022841', '341752927616286', 'Becker-Schinner', 'Aufderhar Ltd', '6', '', '7', '1998-10-23 00:28:50', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5367551192740726', '5171768687158441', 'Swift Ltd', 'Thompson, Turcotte and Gutkowski', '9', '9', '1', '2007-10-23 08:24:24', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5577441084227270', '4916900444446778', 'Roberts, Predovic and Adams', 'Koelpin Group', '8', '2', '7', '2020-12-16 07:37:25', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5526410514090233', '4929772470939265', 'Rolfson LLC', 'Krajcik, Parker and Leffler', '5', '3', '1', '1996-06-10 08:10:46', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5221008863690081', '5320161258953203', 'Grimes, Stark and Raynor', 'Tromp-Batz', '2', '9', '5', '2017-06-08 13:23:26', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4526173614491', '4024007132487', 'Kertzmann-Zemlak', 'Maggio-Doyle', '3', '3', '8', '1973-07-07 06:35:09', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('348078555686718', '5303337495625307', 'Mayert Ltd', 'Cole PLC', '4', '4', '', '1982-05-22 05:15:17', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('6011047668508318', '5221511896116218', 'Kub, Schroeder and Quigley', 'Howell-Cormier', '2', '2', '5', '1988-10-16 19:58:39', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4929837455789342', '4485655271449149', 'Bergnaum, Greenholt and Hoeger', 'Cassin-Hilpert', '6', '8', '2', '2017-04-24 16:49:08', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5489170319959515', '4539411030583000', 'Powlowski-Heidenreich', 'Moen, Dietrich and Okuneva', '3', '4', '2', '2016-10-25 12:02:05', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5111055264959255', '4539771173969696', 'Koelpin, Miller and Boyer', 'Haag and Sons', '5', '6', '', '2013-05-02 04:29:29', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('6011661719652000', '4716389168505', 'Gorczany PLC', 'Wisozk', 'Lebsack and Connell', '6', '', '7', '1995-09-19 10:20:48', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4024007157209870', '4197613600168', 'Stanton Inc', 'Volkman-Hammes', '8', '1', '2', '1992-06-14 19:14:21', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5594374078210940', '341817571325828', 'Bailey-Buckridge', 'Strosin Ltd', '', '8', '', '1991-04-29 04:39:06', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4916002263172810', '4929178108518319', 'Hagenes, Bashirian and Turcotte', 'Shanahan, Schuster and Pacocha', '6', '9', '5', '2010-08-24 07:18:23', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4511583908609', '5207204041251936', 'Mayer and Sons', 'Gerlach, Haley and Botsford', '2', '', '3', '1990-02-15 18:43:02', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4024007112641', '5521462131940211', 'Hane-Kovacek', 'Turner-Schamberger', '2', '', '9', '1982-05-26 11:17:25', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('4556833333285', '378903921957659', 'Waters, Kunze and Cruickshank', 'Gleichner', 'Amore and Conroy', '', '9', '2', '1983-07-15 15:17:17', NULL, '1', NULL, NULL);
INSERT INTO Activo (noActivo, noSerie, marca, modelo, memoriaRAM, discoDuro, procesador, fechaAlta, idAsignacion, estado, usuarioBaja, fechabaja) VALUES ('5575949431996830', '5253956069564632', 'Sporer, Daniel and Beatty', 'Gusikowski, Leuschke and Franecki', '9', '5', '3', '2021-12-13 21:18:42', NULL, '1', NULL, NULL);

INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (1, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (2, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (3, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (4, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (5, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (6, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (7, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (8, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (9, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (10, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (11, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (12, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (13, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (14, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (15, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (16, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (17, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (18, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (19, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (20, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (21, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (22, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (23, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (24, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (25, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (26, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (27, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (28, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (29, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (30, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (31, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (32, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (33, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (34, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (35, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (36, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (37, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (38, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (39, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (40, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (41, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (42, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (43, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (44, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (45, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (46, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (47, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (48, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (49, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (50, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (1, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (2, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (3, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (4, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (5, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (6, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (7, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (8, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (9, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (10, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (11, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (12, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (13, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (14, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (15, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (16, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (17, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (18, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (19, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (20, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (21, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (22, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (23, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (24, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (25, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (26, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (27, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (28, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (29, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (30, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (31, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (32, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (33, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (34, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (35, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (36, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (37, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (38, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (39, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (40, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (41, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (42, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (43, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (44, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (45, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (46, 4);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (47, 1);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (48, 2);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (49, 3);
INSERT INTO ActivoAplicaciones (idActivo, idAplicacion) VALUES (50, 4);

INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('MAFA971218MGTDRL03', 'Aleida Saray', 'Madrigal', 'Fernandez', 'accusantium', 'rerum', 'smadrigal4935@gmail.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('6011021799998605', 'Florencio', 'Wolf', 'Will', 'accusantium', 'rerum', 'qlakin@gmail.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('5197174058938508', 'Kris', 'Quitzon', 'Roob', 'non', 'hic', 'prosacco.verda@gmail.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('4485656136051', 'Urban', 'Batz', 'Block', 'ex', 'numquam', 'pconn@connelly.org', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('5155564954661686', 'Ike', 'Hilpert', 'Prohaska', 'asperiores', 'consequuntur', 'vframi@hotmail.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('4556970900955', 'Jarret', 'Sauer', 'Dietrich', 'voluptas', 'qui', 'rocio98@heaney.net', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('4916526521524769', 'Kariane', 'Schneider', 'Mitchell', 'voluptatem', 'consequatur', 'arvid49@mclaughlin.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('346224253764271', 'Lindsay', 'Mitchell', 'Donnelly', 'repudiandae', 'quia', 'garland.parker@gmail.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('4929311961734', 'Maude', 'Powlowski', 'Baumbach', 'labore', 'exercitationem', 'christy.weber@yahoo.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('6011548304570521', 'Reed', 'Gibson', 'McDermott', 'ea', 'expedita', 'gislason.fleta@gmail.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');
INSERT INTO Usuario (curp, nombre, apellidoP, apellidoM, puesto, area, correo, password) VALUES ('6011653944695183', 'Jevon', 'Jerde', 'Rogahn', 'ut', 'quia', 'lucious.schmitt@hotmail.com', '$2a$04$Px0fEvD3PtzVYYABrNu2ju7EcnC8W3vmPqC5vCDlg6ui2q5Kn87nm');

INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (1, 1);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (1, 2);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (1, 3);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (1, 4);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (1, 5);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (1, 6);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (2, 2);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (3, 3);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (4, 4);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (5, 5);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (6, 6);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (7, 1);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (8, 2);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (9, 3);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (10, 4);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (2, 6);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (3, 1);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (4, 2);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (5, 3);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (6, 4);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (7, 5);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (8, 6);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (9, 1);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (10, 2);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (2, 4);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (3, 5);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (4, 6);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (5, 1);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (6, 2);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (7, 3);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (8, 4);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (9, 5);
INSERT INTO permisosUsuario (idUsuario, idPermiso) VALUES (10, 6);