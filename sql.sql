CREATE TABLE ls_usuarios (
	id int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	id_wappersonas INT NULL,
	dni INT NULL,
	genero VARCHAR(1) NULL,
	nombre VARCHAR(45) NULL,
	apellido VARCHAR(45) NULL,
	telefono VARCHAR(250) NULL,
	email VARCHAR(250) NULL,
	direccion_renaper VARCHAR(250) NULL,
	fecha_nac VARCHAR(45) NULL,
	empresa_cuil VARCHAR(250) NULL,
	empresa_nombre VARCHAR(250) NULL,
	fecha_alta DATETIME DEFAULT GETDATE());
	
CREATE TABLE ls_solicitudes (
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
	observaciones VARCHAR(250) NULL,
	id_usuario_admin INT NULL,
	fecha_alta DATETIME DEFAULT GETDATE());

CREATE TABLE ls_capacitadores (
	id int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	nombre VARCHAR(45) NULL,
	apellido VARCHAR(45) NULL,
	matricula VARCHAR(45) NULL,	
	municipalidad_nqn INT NULL,
	path_certificado VARCHAR(500) NULL,
	lugar_capacitacion VARCHAR(45) NULL,
	fecha_capacitacion VARCHAR(45) NULL,    
	fecha_alta DATETIME DEFAULT GETDATE());
	
CREATE TABLE ls_log (
	id int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	id_usuario INT NULL,
	id_solicitud INT NULL,
	id_capacitador INT NULL,
	error VARCHAR(45) NULL,
	class VARCHAR(45) NULL,
	metodo VARCHAR(45) NULL,
	fecha_alta DATETIME DEFAULT GETDATE());
	
ALTER TABLE ls_solicitudes
	ADD FOREIGN KEY (id_usuario_solicitante) REFERENCES ls_usuarios(id)
ALTER TABLE ls_solicitudes
	ADD FOREIGN KEY (id_usuario_solicitado) REFERENCES ls_usuarios(id)
ALTER TABLE ls_solicitudes
	ADD FOREIGN KEY (id_usuario_admin) REFERENCES ls_usuarios(id)
ALTER TABLE ls_solicitudes
	ADD FOREIGN KEY (id_capacitador) REFERENCES ls_capacitadores(id);
