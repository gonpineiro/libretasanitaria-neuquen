CREATE TABLE ferias_Usuario (
    id int IDENTITY(1,1) PRIMARY KEY,
    id_wappersonas int,
    telefono varchar(50),
    email varchar(255),
    ciudad varchar(255),
    fechaModificacion datetime NOT NULL default getdate(),
    fechaAlta datetime NOT NULL default getdate()
); 

CREATE TABLE ferias_Solicitud (
    id int IDENTITY(1,1) PRIMARY KEY,
    id_usuario int NOT NULL,
    feria varchar(50) NOT NULL,
    nombre_emprendimiento varchar(255) NOT NULL,
    rubro_emprendimiento varchar(50) NOT NULL,
    producto varchar(50) NOT NULL,
    instagram varchar(1000),
    previa_participacion varchar(50) NOT NULL,
    estado int NOT NULL,
    observacion varchar(1000),
    fechaAlta datetime NOT NULL default getdate(),
    CONSTRAINT FK_ferias_UsuarioSolicitud FOREIGN KEY (id_usuario)
    REFERENCES ferias_Usuario(id)
); 

CREATE TABLE ferias_Log (
    id int IDENTITY(1,1) PRIMARY KEY,
    id_usuario int,
    id_solicitud int,
    error varchar(255),
    date datetime default getdate()
); 
