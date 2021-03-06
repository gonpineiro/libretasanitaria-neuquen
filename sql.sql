CREATE TABLE libretas_usuarios (
	id int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	id_wappersonas INT NULL,
	dni INT NULL,
	genero VARCHAR(1) NULL,
	nombre VARCHAR(50) NULL,
	apellido VARCHAR(50) NULL,
	telefono VARCHAR(250) NULL,
	email VARCHAR(250) NULL,
	direccion_renaper VARCHAR(250) NULL,
	fecha_nac VARCHAR(45) NULL,
	empresa_cuil VARCHAR(250) NULL,
	empresa_nombre VARCHAR(250) NULL,
	fecha_alta DATETIME DEFAULT GETDATE());
	
CREATE TABLE libretas_solicitudes (
	id int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	id_usuario_solicitante INT NULL,
	id_usuario_solicitado INT NULL,
	tipo_empleo INT NULL,
	renovacion INT NULL,
	id_capacitador INT NULL,
	nro_recibo VARCHAR(50) NULL,
	path_comprobante_pago VARCHAR(500) NULL,
	estado VARCHAR(45) NULL,
	retiro_en VARCHAR(45) NULL,
    fecha_evaluacion VARCHAR(250) NULL,
	fecha_vencimiento VARCHAR(250) NULL,
	observaciones VARCHAR(750) NULL,
	id_usuario_admin INT NULL,
	fecha_alta DATETIME DEFAULT GETDATE());

CREATE TABLE libretas_capacitadores (
	id int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	nombre VARCHAR(50) NULL,
	apellido VARCHAR(50) NULL,
	matricula VARCHAR(45) NULL,	
	municipalidad_nqn INT NULL,
	path_certificado VARCHAR(500) NULL,
	lugar_capacitacion VARCHAR(150) NULL,
	fecha_capacitacion VARCHAR(45) NULL,    
	fecha_alta DATETIME DEFAULT GETDATE());
	
CREATE TABLE libretas_log (
	id int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	id_usuario INT NULL,
	id_solicitud INT NULL,
	id_capacitador INT NULL,
	error VARCHAR(45) NULL,
	class VARCHAR(45) NULL,
	metodo VARCHAR(45) NULL,
	fecha_alta DATETIME DEFAULT GETDATE());
	













ALTER TABLE libretas_solicitudes
	ADD FOREIGN KEY (id_usuario_solicitante) REFERENCES libretas_usuarios(id);
ALTER TABLE libretas_solicitudes
	ADD FOREIGN KEY (id_usuario_solicitado) REFERENCES libretas_usuarios(id);
ALTER TABLE libretas_solicitudes
	ADD FOREIGN KEY (id_usuario_admin) REFERENCES libretas_usuarios(id);
ALTER TABLE libretas_solicitudes
	ADD FOREIGN KEY (id_capacitador) REFERENCES libretas_capacitadores(id);