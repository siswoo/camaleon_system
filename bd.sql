DROP DATABASE IF EXISTS sistema;
CREATE DATABASE sistema;
USE sistema;

DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	
	modelo_view INT DEFAULT 0,
	modelo_edit INT DEFAULT 0,
	modelo_delete INT DEFAULT 0,

	roles_view INT DEFAULT 0,
	roles_edit INT DEFAULT 0,
	roles_delete INT DEFAULT 0,

	pasante_view INT DEFAULT 0,
	pasante_edit INT DEFAULT 0,
	pasante_delete INT DEFAULT 0,

	usuarios_view INT DEFAULT 0,

	reporteModelos_view INT DEFAULT 0,

	monitores_view INT DEFAULT 0,

	sedes_view INT DEFAULT 0,

	paginas_view INT DEFAULT 0,

	seguridad_view INT DEFAULT 0,

	community INT DEFAULT 0,

	financiera INT DEFAULT 0,

	test INT DEFAULT 0,

	PRIMARY KEY (id)
);
INSERT INTO roles (id,nombre,modelo_view,modelo_edit,modelo_delete,roles_view,roles_edit,roles_delete,seguridad_view,pasante_view,pasante_edit,pasante_delete,usuarios_view,reporteModelos_view,monitores_view,sedes_view,paginas_view) VALUES 
(1,'Administrador',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
INSERT INTO roles (id,nombre,modelo_view,modelo_edit,usuarios_view) VALUES (2,'Soporte',1,1,1);
INSERT INTO roles (id,nombre) VALUES (4,'Pasantia');
INSERT INTO roles (id,nombre) VALUES (5,'Modelos');
INSERT INTO roles (id,nombre) VALUES (6,'Monitores');
INSERT INTO roles (id,nombre,reporteModelos_view,monitores_view) VALUES (7,'Jefe Monitores',1,1);
INSERT INTO roles (id,nombre,modelo_view,modelo_edit,pasante_view,pasante_edit) VALUES (8,'Recursos Humanos',1,1,1,1);
INSERT INTO roles (id,nombre,modelo_view,modelo_edit) VALUES (9,'Soporte Junior',1,1);
INSERT INTO roles (id,nombre,test) VALUES (10,'Diseñador',1);
INSERT INTO roles (id,nombre) VALUES (11,'Monitor Junior');
INSERT INTO roles (id,nombre,community) VALUES (12,'Community Manager',1);
INSERT INTO roles (id,nombre,financiera) VALUES (13,'Financiera',1);
ALTER TABLE roles CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS sedes;
CREATE TABLE sedes (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	ciudad VARCHAR(250) NOT NULL,
	responsable VARCHAR(250) NOT NULL,
	cedula VARCHAR(250) NOT NULL,
	rut VARCHAR(250) NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE sedes CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO sedes (nombre,direccion,ciudad,responsable,cedula,rut) VALUES 
('VIP Occidente','Direccion','Bogotá D.C', 'Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Norte','Direccion','Bogotá D.C', 'Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Occidente I','Direccion','Bogotá D.C', 'Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('VIP Suba','Direccion','Bogotá D.C', 'Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Medellin','Direccion','Medellin', 'Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8');


DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	apellido VARCHAR(250) NOT NULL,
	documento_tipo VARCHAR(250) NOT NULL,
	documento_numero VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	usuario VARCHAR(250) NOT NULL,
	clave VARCHAR(250) NOT NULL,
	telefono1 VARCHAR(250) NOT NULL,
	telefono2 VARCHAR(250) NOT NULL,
	rol INT NOT NULL,
	sede INT NOT NULL,
	id_modelo INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
	/*FOREIGN KEY (rol) REFERENCES roles (id)*/
);

INSERT INTO usuarios (nombre,apellido,documento_tipo,documento_numero,correo,usuario,clave,telefono1,telefono2,rol,sede,fecha_inicio) VALUES 
('Juan','Maldonado','PEP','955948708101993','juanmaldonado.co@gmail.com','admin','21232f297a57a5a743894a0e4a801fc3','3125318122','',1,1,'2020-08-18'),
('Leonardo','Matiz Prieto','Cedula de Ciudadania','1014231159','matizprietoleonardo@gmail.com','leomatiz','6e23d09664c2092e3c6f87e56e8efa1d','3197482852','',7,1,'2020-09-22'),
('Rocio','Delgado','Cedula de Ciudadania','1023886014','dptorrhhcamaleonmodels@gmail.com','recursoshumanos','77bedb3696d429d527deb55e83ccd8ed','3058126922','',8,1,'2020-09-23'),
('Andrea','Perez','Cedula de Ciudadania','1233894005','adminnorte@bernal-group.com','adminsuba','12c22c3f68d4c7bc77f1f40bd78f5e9b','3162972851','',13,4,'2020-09-23'),
('Pasantia','Test','PEP','11111111111','test@gmail.com','pasantia','21232f297a57a5a743894a0e4a801fc3','77777777','',4,1,'2020-08-27'),
('Pasantia2','Test2','PEP','22222222222','test2@gmail.com','pasantia2','21232f297a57a5a743894a0e4a801fc3','77777777','',4,2,'2020-10-13'),
('Pasantia3','Test3','PEP','333333333333','test3@gmail.com','pasantia3','21232f297a57a5a743894a0e4a801fc3','77777777','',4,3,'2020-10-13'),
('Pasantia4','Test4','PEP','444444444444','test4@gmail.com','pasantia4','21232f297a57a5a743894a0e4a801fc3','77777777','',4,4,'2020-10-13'),
('Pasantia5','Test5','PEP','555555555555','test5@gmail.com','pasantia4','21232f297a57a5a743894a0e4a801fc3','77777777','',4,5,'2020-10-13'),
('Test','Test','PEP','123123123','test@gmail.com','modelo','21232f297a57a5a743894a0e4a801fc3','77777777','',5,1,'2020-09-23'),
('Variable','Variable','PEP','77777777','Variable@gmail.com','Variable','21232f297a57a5a743894a0e4a801fc3','77777777','',99,1,'2020-09-29'),
('Carlos','Vargas','Cedula de Ciudadania','1108456684','vargas1101@gmail.com','Soporte123','827ccb0eea8a706c4c34a16891f84e7b','','',2,1,'2020-10-06'),
('Denisse Giannyna','Gonzalez Cifuentes','Cedula de Ciudadania','1001184301','denisse.gonzalez1234@gmail.com','denisse.gonzales','723a1d81851c596931b050cae056197f','','',8,2,'2020-10-08');
ALTER TABLE usuarios CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS modelos;
CREATE TABLE modelos (
	id INT AUTO_INCREMENT,
	nombre1 VARCHAR(250) NOT NULL,
	nombre2 VARCHAR(250) NOT NULL,
	apellido1 VARCHAR(250) NOT NULL,
	apellido2 VARCHAR(250) NOT NULL,
	documento_tipo VARCHAR(250) NOT NULL,
	documento_numero VARCHAR(250) NOT NULL,
	genero VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	usuario VARCHAR(250) NOT NULL,
	clave VARCHAR(250) NOT NULL,
	telefono1 VARCHAR(250) NOT NULL,
	telefono2 VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) DEFAULT 'Activa',
	barrio VARCHAR(250) NOT NULL,
	sugerenciaNickname VARCHAR(250) NOT NULL,
	perfil_de_transmision VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,

	banco_cedula VARCHAR(250) NOT NULL,
	banco_nombre VARCHAR(250) NOT NULL,
	banco_tipo VARCHAR(250) NOT NULL,
	banco_numero VARCHAR(250) NOT NULL,
	banco_banco VARCHAR(250) NOT NULL,
	BCPP VARCHAR(250) NOT NULL,
	
	altura VARCHAR(250) NOT NULL,
	peso VARCHAR(250) NOT NULL,
	tpene VARCHAR(250) NOT NULL,
	tsosten VARCHAR(250) NOT NULL,
	tbusto VARCHAR(250) NOT NULL,
	tcintura VARCHAR(250) NOT NULL,
	tcaderas VARCHAR(250) NOT NULL,
	tipo_cuerpo VARCHAR(250) NOT NULL,
	Pvello VARCHAR(250) NOT NULL,
	color_cabello VARCHAR(250) NOT NULL,
	color_ojos VARCHAR(250) NOT NULL,
	Ptattu VARCHAR(250) NOT NULL,
	Ppiercing VARCHAR(250) NOT NULL,
	
	turno VARCHAR(250) NOT NULL,
	sede VARCHAR(250) NOT NULL,
	Htransmision VARCHAR(250) NOT NULL,
	select_equipo VARCHAR(250) NOT NULL,
	equipo INT NOT NULL,
	
	usuario_modelo INT DEFAULT 0,
	PRIMARY KEY (id)
);ALTER TABLE modelos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
/*
INSERT INTO modelos (nombre1,nombre2,apellido1,apellido2,documento_tipo,documento_numero,genero,correo,direccion,usuario,clave,telefono1,telefono2,turno,estatus,sede,fecha_inicio,select_equipo,barrio) VALUES 
('Test','test','test','test','PEP','11111111111','Hombre','test@gmail.com','Carrera 14 #81 - 41 Sur','test','21232f297a57a5a743894a0e4a801fc3','312555555','312777777','Tarde','Activa','VIP Occidente','2020-08-18','Individual','barrio1');
/*('Karla','Nidalle','Ortiz','Lezena','PEP','123456789123','Mujer','test@gmail.com','Carrera 20 #20 - 51 Sur','test','21232f297a57a5a743894a0e4a801fc3','312555555','312777777','Noche','Inactiva','VIP Occidente','2020-08-18','Individual','barrio2');*/


DROP TABLE IF EXISTS equipos;
CREATE TABLE equipos (
	id INT AUTO_INCREMENT,
	nickname VARCHAR(250) NOT NULL,
	cantidad VARCHAR(250) NOT NULL,

	id_modelo1 INT NOT NULL,
	id_modelo2 INT NOT NULL,
	id_modelo3 INT NOT NULL,
	id_modelo4 INT NOT NULL,
	id_modelo5 INT NOT NULL,

	sede VARCHAR(250) NOT NULL,
	turno VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE equipos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

/*
INSERT INTO equipos (id,cantidad,id_modelo1,id_modelo2,id_modelo3,id_modelo4,id_modelo5,sede,turno,estatus,fecha_inicio) VALUES 
(1,'1',1,0,0,0,0,'VIP Occidente','Tarde','Activa','2020-08-21'),
(2,'1',2,0,0,0,0,'VIP Occidente','Noche','Activa','2020-08-21');
*/

/*
DROP TABLE IF EXISTS seguridad;
CREATE TABLE seguridad (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO seguridad (nombre,fecha_inicio) VALUES
('HV2SBPB','2020-08-27');
ALTER TABLE seguridad CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
*/

DROP TABLE IF EXISTS pasantes;
CREATE TABLE pasantes (
	id INT AUTO_INCREMENT,
	tipo_documento VARCHAR(250) NOT NULL,
	numero_documento VARCHAR(250) NOT NULL,
	primer_nombre VARCHAR(250) NOT NULL,
	segundo_nombre VARCHAR(250) NOT NULL,
	primer_apellido VARCHAR(250) NOT NULL,
	segundo_apellido VARCHAR(250) NOT NULL,
	genero VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	telefono1 VARCHAR(250) NOT NULL,
	barrio VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	sede INT NOT NULL,
	estatus VARCHAR(250) DEFAULT 'Proceso',
	enterado VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE pasantes CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS documentos;
CREATE TABLE documentos (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	ruta VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE documentos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO documentos (nombre,ruta,fecha_inicio) VALUES 
('Contrato Prestación','contrato_prestacion_final','2020-09-15'),
('Documento de Identidad','documento_de_identidad','2020-09-28'),
('Pasaporte','pasaporte','2020-09-28'),
('RUT','rut','2020-09-28'),
('Certificación Bancaria','certificacion_bancario','2020-09-28'),
('EPS','eps','2020-09-28'),
('Antecedentes Disciplinarios','antecedentes_disciplinarios','2020-09-28'),
('Foto Cédula con Cara','foto_cedula_con_cara','2020-09-28'),
('Foto Cédula Parte Frontal Cara','foto_cedula_parte_frontal','2020-09-28'),
('Foto Cédula Parte Respaldo','foto_cedula_parte_respaldo','2020-09-28'),
('Antecedentes Penales','antecedentes_penales','2020-09-28'),
('Extras','extras_','2020-10-02'),
('Sensuales','sensuales_','2020-10-06');


DROP TABLE IF EXISTS modelos_documentos;
CREATE TABLE modelos_documentos (
	id INT AUTO_INCREMENT,
	id_documentos INT NOT NULL,
	id_modelos INT NOT NULL,
	tipo VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
	/*FOREIGN KEY (id_documentos) REFERENCES documentos (id),
	FOREIGN KEY (id_modelos) REFERENCES modelos (id)*/
); ALTER TABLE modelos_documentos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

/*INSERT INTO modelos_documentos (id_documentos,id_modelos,fecha_inicio) VALUES (1,1,'2020-09-15');*/


DROP TABLE IF EXISTS modelos_temporal;
CREATE TABLE modelos_temporal (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE modelos_temporal CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS rooms;
CREATE TABLE rooms (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	color VARCHAR(250) NOT NULL,
	sede INT NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE rooms CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO rooms (nombre,color,sede) VALUES 
('101','',1),('102','',1),('103','',1),('104','',1),('105','',1),('106','',1),('107','',1),
('201','',1),('202','',1),('203','',1),
('301','',1),('302','',1),('303','',1),('304','',1),('305','',1),('306','',1),('307','',1),('308','',1),('309','',1),('310','',1),
('401','',1),('402','',1),('403','',1),('404','',1),('405','',1),('406','',1),('407','',1),('408','',1),('409','',1),('410','',1),('411','',1),
('501','',1),('502','',1),('503','',1),('504','',1),('505','',1),('506','',1);

DROP TABLE IF EXISTS paginas;
CREATE TABLE paginas (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	tasa FLOAT (11,2) NOT NULL,
	url VARCHAR(250) NOT NULL,
	moneda VARCHAR(250) NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE paginas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO paginas (nombre,tasa,url,moneda) VALUES 
('Chaturbate', 0.05, 'https://chaturbate.com/','Dolar'),
('Myfreecams', 0.05, 'https://www.myfreecams.com/','Dolar'),
('Camsoda', 0.05, 'https://www.camsoda.com/','Dolar'),
('BongaCams', 0.02, 'https://es.bongacams.com/','Dolar'),
('Stripchat', 0.05, 'https://stripchat.com/trans','Dolar'),
('Cam4', 0.1, 'https://www.cam4.com/','Dolar'),
('Streamatemodels', 1, 'https://www.streamatemodels.com/','Dolar'),
('Flirt4free', 0.02, 'https://www.flirt4free.com/','Dolar'),
('Livejasmin', 1, 'https://www.livejasmin.com/','Dolar'),
('Imlive', 1, 'https://imlive.com/','Dolar'),
('Xlovecam', 1.18, 'https://www.xlovecam.com/','Dolar');

DROP TABLE IF EXISTS modelos_cuentas;
CREATE TABLE modelos_cuentas (
	id INT AUTO_INCREMENT,
	id_modelos INT NOT NULL,
	id_paginas INT NOT NULL,
	usuario VARCHAR(250) NOT NULL,
	clave VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	link VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE modelos_cuentas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

/*
DROP TABLE IF EXISTS modelos_online;
CREATE TABLE modelos_online (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE modelos_online CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS diario_cuentas_modelos;
CREATE TABLE diario_cuentas_modelos (
	id INT AUTO_INCREMENT,
	id_modelos INT NOT NULL,
	id_paginas INT NOT NULL,
	diario INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE diario_cuentas_modelos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS reporte_inicio;
CREATE TABLE reporte_inicio (
	id INT AUTO_INCREMENT,
	modelos INT NOT NULL,
	rooms INT NOT NULL,
	rooms_on INT NOT NULL,
	rooms_off INT NOT NULL,
	diario INT NOT NULL,
	comentario VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	encargado VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE reporte_inicio CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS filas_reporte_diario;
CREATE TABLE filas_reporte_diario (
	id INT AUTO_INCREMENT,
	id_room INT NOT NULL,
	id_modelo INT NOT NULL,
	id_monitor INT NOT NULL,
	id_reporte_inicio INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE filas_reporte_diario CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
*/

DROP TABLE IF EXISTS reporte_inicio_filas;
CREATE TABLE reporte_inicio_filas (
	id INT AUTO_INCREMENT,
	id_room INT NOT NULL,
	id_modelo INT NOT NULL,
	id_monitor INT NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	asunto VARCHAR(250) NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE reporte_inicio_filas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS reporte_inicio;
CREATE TABLE reporte_inicio (
	id INT AUTO_INCREMENT,
	id_filas INT NOT NULL,
	responsable VARCHAR(250) NOT NULL,
	turno VARCHAR(250) NOT NULL,
	token INT NOT NULL,
	sede INT NOT NULL,
	id_reporte_inicio INT NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE reporte_inicio CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS tarea_jefe_monitores;
CREATE TABLE tarea_jefe_monitores (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	asunto VARCHAR(250) NOT NULL,
	sede VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE tarea_jefe_monitores CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS soporte_responsable_modelo;
CREATE TABLE soporte_responsable_modelo (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	id_soporte INT NOT NULL,
	asunto VARCHAR(250) NOT NULL,
	sede VARCHAR(250) NOT NULL,
	fecha_inicio datetime NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE soporte_responsable_modelo CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS tareas;
CREATE TABLE tareas (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	asunto VARCHAR(250) NOT NULL,
	sede VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE tareas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS temporal_ganancias1;
CREATE TABLE temporal_ganancias1 (
	id INT AUTO_INCREMENT,
	performer_id VARCHAR(250) NOT NULL,
	performer_nickname VARCHAR(250) NOT NULL,
	performer_payee VARCHAR(250) NOT NULL,
	customer_nickname VARCHAR(250) NOT NULL,
	fecha DATETIME NOT NULL,
	duration VARCHAR(250) NOT NULL,
    type VARCHAR(250) NOT NULL,
    stream_type VARCHAR(250) NOT NULL,
    performer_earned FLOAT(11,2) NOT NULL,
    studio_id VARCHAR(250) NOT NULL,
    studio_payee VARCHAR(250) NOT NULL,
    studio_earned FLOAT(11,2) NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE temporal_ganancias1 CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS xlove;
CREATE TABLE xlove (
	id INT AUTO_INCREMENT,
	nickname VARCHAR(250) NOT NULL,
	amount FLOAT(11,3) NOT NULL,
	dolares FLOAT(11,3) NOT NULL,
	descuento FLOAT(11,3) NOT NULL,
	tokens FLOAT(11,3) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE xlove CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS chaturbate;
CREATE TABLE chaturbate (
	id INT AUTO_INCREMENT,
	nickname VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	payout FLOAT(11,2) NOT NULL,
	fecha DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE chaturbate CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS stripchat;
CREATE TABLE stripchat (
	id INT AUTO_INCREMENT,
	nickname VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	fecha DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE stripchat CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS streamate;
CREATE TABLE streamate (
	id INT AUTO_INCREMENT,
	id_nickname INT NOT NULL,
	nickname VARCHAR(250) NOT NULL,
	ganancia FLOAT(11,2) NOT NULL,
	tokens FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE streamate CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS myfreecams;
CREATE TABLE myfreecams (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	id_cuenta_modelo VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE myfreecams CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS imlive;
CREATE TABLE imlive (
	id INT AUTO_INCREMENT,
	nickname VARCHAR(250) NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	tokens FLOAT(11,2) NOT NULL,
	responsable INT NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE imlive CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS livejasmin;
CREATE TABLE livejasmin (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	id_cuenta_modelo VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE livejasmin CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS bonga;
CREATE TABLE bonga (
	id INT AUTO_INCREMENT,
	nickname VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE bonga CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS cam4;
CREATE TABLE cam4 (
	id INT AUTO_INCREMENT,
	nickname VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE cam4 CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS camsoda;
CREATE TABLE camsoda (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	id_cuenta_modelo VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE camsoda CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS flirt4free;
CREATE TABLE flirt4free (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	id_cuenta_modelo VARCHAR(250) NOT NULL,
	tokens INT NOT NULL,
	dolares FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE flirt4free CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS descuento;
CREATE TABLE descuento (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	valor INT NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE descuento CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS tienda;
CREATE TABLE tienda (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	valor INT NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE tienda CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS avances;
CREATE TABLE avances (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	valor INT NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE avances CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS multas;
CREATE TABLE multas (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	valor INT NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE multas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS presabana;
CREATE TABLE presabana (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	sede INT NOT NULL,
	inicio DATE NOT NULL,
	fin DATE NOT NULL,
	chaturbate FLOAT(11,2) NOT NULL,
	imlive FLOAT(11,2) NOT NULL,
	xlove FLOAT(11,2) NOT NULL,
	stripchat FLOAT(11,2) NOT NULL,
	streamate FLOAT(11,2) NOT NULL,
	myfreecams FLOAT(11,2) NOT NULL,
	livejasmin FLOAT(11,2) NOT NULL,
	bonga FLOAT(11,2) NOT NULL,
	cam4 FLOAT(11,2) NOT NULL,
	camsoda FLOAT(11,2) NOT NULL,
	flirt4free FLOAT(11,2) NOT NULL,
	total_tokens FLOAT(11,2) NOT NULL,
	subtotal_dolares FLOAT(11,2) NOT NULL,
	rf FLOAT(11,2) NOT NULL,
	meta_porcentajes VARCHAR(250) NOT NULL,
	total_pesos FLOAT(11,2) NOT NULL,
	total_dolares FLOAT(11,2) NOT NULL,
	trm FLOAT(11,2) NOT NULL,
	pv FLOAT(11,2) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE presabana CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS temporal_falta_bancos;
CREATE TABLE temporal_falta_bancos (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE temporal_falta_bancos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS temporal_faltan_descuentos;
CREATE TABLE temporal_faltan_descuentos (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	identificacion VARCHAR(250) NOT NULL,
	sede VARCHAR(250) NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE temporal_faltan_descuentos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS bonos_horas;
CREATE TABLE bonos_horas (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE bonos_horas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS bonos_streamate;
CREATE TABLE bonos_streamate (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE bonos_streamate CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS odontologia;
CREATE TABLE odontologia (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE odontologia CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS seguridad_social;
CREATE TABLE seguridad_social (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE seguridad_social CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS coopserpak;
CREATE TABLE coopserpak (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE coopserpak CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS sexshop;
CREATE TABLE sexshop (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE sexshop CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS belleza;
CREATE TABLE belleza (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE belleza CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS sancionpagina;
CREATE TABLE sancionpagina (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE sancionpagina CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS lenceria;
CREATE TABLE lenceria (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	monto FLOAT(11,2) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE lenceria CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;