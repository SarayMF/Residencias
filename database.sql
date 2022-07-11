create table *
go

use table *
go

CREATE TABLE [dbo].[Usuario](
 [idUsuario] INT NOT NULL AUTO_INCREMENT,
 [curp] VARCHAR(20) NOT NULL UNIQUE,
 [nombre] VARCHAR(50) NOT NULL,
 [apellidoP] VARCHAR(40) NOT NULL,
 [apellidoM] VARCHAR(40) NOT NULL,
 [puesto] VARCHAR(40) NOT NULL,
 [area] VARCHAR(40) NOT NULL,
 [correo] VARCHAR(100) NOT NULL UNIQUE,
 [password] VARCHAR(40),
 [idLink] INT,
 CONSTRAINT [PK_Usuario] PRIMARY KEY ([idUsuario]),
 CONSTRAINT [FK_UserLink] FOREIGN KEY ([idLink]) REFERENCES [linkPassword]([idLink])
)GO

CREATE TABLE [dbo].[linkPassword](
 [idLink] INT NOT NULL AUTO_INCREMENT,
 [idUsuario] INT NOT NULL,
 [token] VARCHAR(MAX) NOT NULL,
 [fechaCreacion] TIMESTAMP NOT NULL,
 CONSTRAINT [PK_linkPassword] PRIMARY KEY ([idLink]),
 CONSTRAINT [FK_LinkUser] FOREIGN KEY ([idUsuario]) REFERENCES [Usuario]([idUsuario])
)GO

CREATE TABLE [dbo].[Permisos](
 [idPermiso] INT NOT NULL AUTO_INCREMENT,
 [nombre] VARCHAR(40) NOT NULL,
 CONSTRAINT [PK_Permisos] PRIMARY KEY ([idPermiso])
)GO

CREATE TABLE [dbo].[permisosUsuario](
 [idPermisoUsuario] INT NOT NULL AUTO_INCREMENT,
 [idUsuario] INT NOT NULL,
 [idPermiso] INT NOT NULL,
 CONSTRAINT [PK_PermisosUsuario] PRIMARY KEY ([idPermisoUsuario]),
 CONSTRAINT [FK_UsuarioPermiso] FOREIGN KEY ([idUsuario]) REFERENCES [Usuario]([idUsuario]),
 CONSTRAINT [FK_Permiso] FOREIGN KEY ([idPermiso]) REFERENCES [Permisos]([idPermiso])
)GO

CREATE TABLE [dbo].[Asignacion]{
 [idAsignacion] INT NOT NULL AUTO_INCREMENT,
 [fechaAsignacion] DATE NOT NULL,
 [usuarioAsigna] INT NOT NULL,
 [usuarioAsignado] INT NOT NULL,
 [observaciones] VARCHAR(MAX),
 CONSTRAINT [PK_Asignacion] PRIMARY KEY ([idAsignacion]),
 CONSTRAINT [FK_UsuarioAsignado] FOREIGN KEY ([usuarioAsignado]) REFERENCES [Usuario]([idUsuario]), 
}GO

CREATE TABLE [dbo].[Aplicaciones](
 [idAplicacion] INT NOT NULL AUTO_INCREMENT,
 [nombre] VARCHAR(40) NOT NULL,
 CONSTRAINT [PK_Aplicaciones] PRIMARY KEY ([idAplicacion])
)GO

