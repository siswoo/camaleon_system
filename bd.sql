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

	jefe INT DEFAULT 0,

	administracion INT DEFAULT 0,

	nomina INT DEFAULT 0,

	test INT DEFAULT 0,

	callcenter INT DEFAULT 0,

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
INSERT INTO roles (id,nombre,jefe) VALUES (14,'Jefe',1);
INSERT INTO roles (id,nombre,administracion) VALUES (15,'Administración Sede',1);
INSERT INTO roles (id,nombre,nomina) VALUES (16,'Gestion Nomina',1);
INSERT INTO roles (id,nombre,callcenter) VALUES (17,'Call Center',1);
INSERT INTO roles (id,nombre,callcenter) VALUES (18,'Sexshop',1);
INSERT INTO roles (id,nombre,callcenter) VALUES (19,'RRHH Contenido',1);
INSERT INTO roles (id,nombre,callcenter) VALUES (20,'Soporte Contenido',1);
INSERT INTO roles (id,nombre,callcenter) VALUES (21,'Auditoria',1);
INSERT INTO roles (id,nombre) VALUES (22,'Satelite');
INSERT INTO roles (id,nombre) VALUES (23,'Auxiliar Contable');
INSERT INTO roles (id,nombre) VALUES (24,'Soluciones');
ALTER TABLE roles CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS sedes;
CREATE TABLE sedes (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	ciudad VARCHAR(250) NOT NULL,
	descripcion VARCHAR(250) NOT NULL,
	responsable VARCHAR(250) NOT NULL,
	cedula VARCHAR(250) NOT NULL,
	rut VARCHAR(250) NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE sedes CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO sedes (nombre,direccion,ciudad,descripcion,responsable,cedula,rut) VALUES 
('VIP Occidente','Direccion','Bogotá D.C','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Norte','Direccion','Bogotá D.C','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Tunal','Direccion','Bogotá D.C','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('VIP Suba','Direccion','Bogotá D.C','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Medellin','Direccion','Medellin','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Soacha','Direccion','Bogotá D.C','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901.257.204-8'),
('Belen','Carrera 81 #30A 67','Medellin','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901322261-6'),
('Sur Americana','Calle 48 #66 70','Medellin','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901322261-6'),
('Manrique','Carrera 36 #70 41','Medellin','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901322261-6'),
('Bucaramanga','direccion','Bucaramanga','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901322261-6'),
('Cali','direccion','Cali','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901322261-6'),
('Satelite','direccion','Satelite','BERNAL GROUP  SAS','Andres Fernando Bernal Correa', '80.774.671', '901322261-6');


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
('Juan','Arias','Cedula de Ciudadania','1081933064','juan_jose07@hotmail.es','juan_mt','d757719ed7c2b66dd17dcee2a3cb29f4','3507945712','',7,1,'2021-01-26'),
('Rocio','Delgado','Cedula de Ciudadania','1023886014','dptorrhhcamaleonmodels@gmail.com','recursoshumanos','77bedb3696d429d527deb55e83ccd8ed','3058126922','',15,1,'2020-09-23'),
('Andrea','Perez','Cedula de Ciudadania','1233894005','adminnorte@bernal-group.com','adminsuba','12c22c3f68d4c7bc77f1f40bd78f5e9b','3162972851','',13,4,'2020-09-23'),
('Pasantia','Test','PEP','11111111111','test@gmail.com','pasantia','21232f297a57a5a743894a0e4a801fc3','77777777','',4,1,'2020-08-27'),
('Pasantia2','Test2','PEP','22222222222','test2@gmail.com','pasantia2','21232f297a57a5a743894a0e4a801fc3','77777777','',4,2,'2020-10-13'),
('Pasantia3','Test3','PEP','333333333333','test3@gmail.com','pasantia3','21232f297a57a5a743894a0e4a801fc3','77777777','',4,3,'2020-10-13'),
('Pasantia4','Test4','PEP','444444444444','test4@gmail.com','pasantia4','21232f297a57a5a743894a0e4a801fc3','77777777','',4,4,'2020-10-13'),
('Pasantia5','Test5','PEP','555555555555','test5@gmail.com','pasantia4','21232f297a57a5a743894a0e4a801fc3','77777777','',4,5,'2020-10-13'),
('Test','Test','PEP','123123123','test@gmail.com','modelo','21232f297a57a5a743894a0e4a801fc3','77777777','',5,1,'2020-09-23'),
('Variable','Variable','PEP','77777777','Variable@gmail.com','Variable','21232f297a57a5a743894a0e4a801fc3','77777777','',99,1,'2020-09-29'),
('Carlos','Vargas','Cedula de Ciudadania','1108456684','vargas1101@gmail.com','Soporte123','827ccb0eea8a706c4c34a16891f84e7b','','',2,1,'2020-10-06'),
('Denisse Giannyna','Gonzalez Cifuentes','Cedula de Ciudadania','1001184301','denisse.gonzalez1234@gmail.com','denisse.gonzales','723a1d81851c596931b050cae056197f','','',8,2,'2020-10-08'),
('Andres Fernando','Bernal Correa','Cedula de Ciudadania','80774671','gerencia@bernal-group.com','gerencia','a26f6e63b6c494cfaea39625a6f3abdd','','',14,1,'2020-12-30'),
('Daniela','Buitrago','Cedula de Ciudadania','1031175837','lauradanielabuga@gmail.com','dani_8','c591db46628b4c9292ac9e0d3223026e','','',12,1,'2021-02-19'),
('Karen Stefanny','Parra Sanchez','Cedula de Ciudadania','1018492284','stefanny1parra@gmail.com','karenparra','ed53feba2a0a4df03d19ef836b701ea0','3058754431','',8,6,'2021-03-22'),
('Jorse Luis','Casique Useche','Cedula de Ciudadania','1130245934','jorgecasique220@gmail.com','jorgeuseche','5311b986f20a6f348fad8fb41f898995','3504633380','',15,6,'2021-03-22'),
('Soacha','Test6','PEP','66666666666','test6@gmail.com','soacha','a5604eb6a51af9e9719bb9fda7bf0686','77777777','',4,6,'2021-03-22'),
('Kenlly','Lopez','Cedula de Ciudadania','1016063760','Kenllylopez25@gmail.com','kenlly123','599fdfa24809faf5bd5b7047c63557ea','3502915076','',15,1,'2021-04-07'),
('Anderson','Prieto','Cedula de Ciudadania','1001046590','prietovargas4@gmail.com','soportesoacha','bf4dee03a08c7c0536760c11e3041ab3','3123790146','',2,6,'2021-03-29'),

('Thayana','Rios Vasquez','Cedula de Ciudadania','1017230042','thayana503@gmail.com','thayana503','959b551e0a7fe3f0ec403884dfac2769','3023769858','',15,7,'2021-03-30'),
('Yoryenis','Cabrejo Ortega','Cedula de Ciudadania','1000871360','Yoryenisortega@gmail.com','Yoryenis123','356bc2382667819f405b4dd88b5b6ac4','3004758167','',2,7,'2021-03-30'),
('Isabel','Arango','Cedula de Ciudadania','43252386','cris4325@gmail.com','cris4325','ebb9800d3b2856e85f7d2eee4d76dfa7','3154655878','',15,8,'2021-03-30'),

('pasantebelen','pasantebelen','Cedula de Ciudadania','77777777777','pasantebelen@gmail.com','pasantebelen','a5604eb6a51af9e9719bb9fda7bf0686','777777777777','',4,7,'2021-03-30'),
('pasantesa','pasantesa','Cedula de Ciudadania','77777777777','pasantesa@gmail.com','pasantesa','a5604eb6a51af9e9719bb9fda7bf0686','777777777777','',4,8,'2021-03-30'),
('pasantemanrique','pasantemanrique','Cedula de Ciudadania','77777777777','pasantemanrique@gmail.com','pasantemanrique','a5604eb6a51af9e9719bb9fda7bf0686','777777777777','',4,9,'2021-03-30'),

('Valentina','Linares','Cedula de Ciudadania','1026594002','givalimu0321@gmail.com','valentina0321','cd2acea595e93463bc8ea3b6d1583fc9','3222791497','',8,6,'2021-03-31'),
('Lizeth','Reyes','Cedula de Ciudadania','1073699719','santiagoreyes1201@gmail.com','reyes19','30d708ec57e485cd54a78968d278959f','3123109781','',15,6,'2021-04-01'),

('Buffet','Buffet','Cedula de Ciudadania','999999999999','Buffet@gmail.com','Buffet','999999999999999999999','999999999999999','',1,1,'2021-06-01'),
('Spa','Spa','Cedula de Ciudadania','999999999999','Spa@gmail.com','Spa','cc91e646ffef196e61f25dce2ada9ae5','999999999999999','',1,1,'2021-06-01'),

('Miguel','Molina','Cedula de Ciudadania','1032441680','migueldanza91@outlook.com','migueladmoccidente1','38bf6d2d4596f6e1e885d34c3e7e9649','3104782087','',15,3,'2021-06-17'),


('Karen Saray','Giraldo Medina','Cedula de Ciudadania','1010073466','k23giraldo@gmail.com','karensgm1','c6ce9b2c6904aa4b0071569f112fb1d9','3104782087','',8,6,'2021-06-22');

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
	banco_tipo_documento VARCHAR(250) NOT NULL,
	
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
('Foto Cédula Parte Frontal Cara','foto_cedula_parte_frontal_cara','2020-09-28'),
('Foto Cédula Parte Respaldo','foto_cedula_parte_respaldo','2020-09-28'),
('Antecedentes Penales','antecedentes_penales','2020-09-28'),
('Extras','extras_','2020-10-02'),
('Sensuales','sensuales_','2020-10-06'),
('Permiso Bancario','acta_cuenta_prestada','2021-04-15'),
('Examenes ocupacionales','examenes_ocupacionales','2022-06-06');


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
	identificacion VARCHAR(250) NOT NULL,
	auto_numerico VARCHAR(250) NOT NULL,
	tipo_identificacion VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
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
('Xlovecam', 1.18, 'https://www.xlovecam.com/','Dolar'),
('Amateur', 1.18, 'https://es.amateur.tv/','Dolar'),
('Streamray', 1.18, 'https://streamray.com/','Dolar');

DROP TABLE IF EXISTS modelos_cuentas;
CREATE TABLE modelos_cuentas (
	id INT AUTO_INCREMENT,
	id_modelos INT NOT NULL,
	id_paginas INT NOT NULL,
	usuario VARCHAR(250) NOT NULL,
	clave VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	link VARCHAR(250) NOT NULL,
	nickname_xlove VARCHAR(250) NOT NULL,
	edit_usuario_bonga VARCHAR(250) NOT NULL,
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
	nickname_pagina VARCHAR(250) NOT NULL,
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
	estado VARCHAR(250) DEFAULT 'Activo',
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
	estado VARCHAR(250) DEFAULT 'Activo',
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
	estado VARCHAR(250) DEFAULT 'Activo',
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
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
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
	responsable INT NOT NULL,
	estado VARCHAR(250) DEFAULT 'Activo',
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE lenceria CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS medellin_temporal1;
CREATE TABLE medellin_temporal1 (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	identificacion VARCHAR(250) NOT NULL,
	auto_numerico VARCHAR(250) NOT NULL,
	tipo_identificacion VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE medellin_temporal1 CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS pqr;
CREATE TABLE pqr (
	id INT AUTO_INCREMENT,
	responsable INT NOT NULL,
	mensaje VARCHAR(250) NOT NULL,
	tema VARCHAR(250) NOT NULL,
	area VARCHAR(250) NOT NULL,
	fecha_inicio DATE NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	respuesta VARCHAR(250) NOT NULL,
	rol_responsable INT NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE pqr CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS recuperar_password;
CREATE TABLE recuperar_password (
	id INT AUTO_INCREMENT,
	responsable INT NOT NULL,
	codigo VARCHAR(250) NOT NULL,
	verificado INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE recuperar_password CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS monitores;
CREATE TABLE monitores (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	apellido VARCHAR(250) NOT NULL,
	tipo_documento VARCHAR(250) NOT NULL,
	numero_documento VARCHAR(250) NOT NULL,
	telefono VARCHAR(250) NOT NULL,
	estatus INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE monitores CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS monitores_registro_diario;
CREATE TABLE monitores_registro_diario (
	id INT AUTO_INCREMENT,
	monitor INT NOT NULL,
	fecha DATE NOT NULL,
	tokens INT NOT NULL,
	turno VARCHAR(250) NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE monitores_registro_diario CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS auditoria;
CREATE TABLE auditoria (
	id INT AUTO_INCREMENT,
	responsable INT NOT NULL,
	accion TEXT NOT NULL,
	descripcion VARCHAR(250) NOT NULL,
	modulo VARCHAR(250) NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE auditoria CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS redes_sociales;
CREATE TABLE redes_sociales (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	red TEXT NOT NULL,
	link TEXT NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE redes_sociales CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS publicas;
CREATE TABLE publicas (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE publicas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE categorias CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS t_usuarios;
CREATE TABLE t_usuarios (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	usuario VARCHAR(250) NOT NULL,
	clave VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE t_usuarios CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO t_usuarios (nombre,usuario,clave,correo,fecha_inicio) VALUES 
('Juan Maldonado','admin','202cb962ac59075b964b07152d234b70','juanmaldonado.co@gmail.com','2021-02-19'),
('Michell','sexshop1','8ebf43c2d97d2a3b5d453af2ddcde67a','sexshop1@camaleonmg.com','2021-05-11');

DROP TABLE IF EXISTS t_categorias;
CREATE TABLE t_categorias (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE t_categorias CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO t_categorias (nombre,estatus,responsable,fecha_inicio) VALUES ('Categoria1','Activo',1,'2021-02-20');

DROP TABLE IF EXISTS t_productos;
CREATE TABLE t_productos (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	marca VARCHAR(250) NOT NULL,
	modelo VARCHAR(250) NOT NULL,
	descripcion TEXT NOT NULL,
	caracteristica1 TEXT NOT NULL,
	caracteristica2 TEXT NOT NULL,
	caracteristica3 TEXT NOT NULL,
	caracteristica4 TEXT NOT NULL,
	caracteristica5 TEXT NOT NULL,
	precio INT NOT NULL,
	categoria INT NOT NULL,
	imagen VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE t_productos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

/*
INSERT INTO t_productos (nombre,descripcion,precio,categoria,imagen,estatus,responsable,fecha_inicio) VALUES 
('nombre','descripcion',50000,1,'default.png','Activa',1,'2021-02-23'),
('manzana','descripcion2',10000,1,'default.png','Activa',1,'2021-02-23');
*/

DROP TABLE IF EXISTS t_sedes;
CREATE TABLE t_sedes (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE t_sedes CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO t_sedes (nombre,responsable,fecha_inicio) VALUES 
('Vip Occidente',1,'2021-03-02'),
('Tunal',1,'2021-03-02'),
('Norte',1,'2021-03-02'),
('Vip Suba',1,'2021-03-02');

DROP TABLE IF EXISTS t_inventario;
CREATE TABLE t_inventario (
	id INT AUTO_INCREMENT,
	id_producto INT NOT NULL,
	cantidad INT NOT NULL,
	colores VARCHAR(250) NOT NULL,
	tamanios VARCHAR(250) NOT NULL,
	sabores VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	tamanios_precios INT NOT NULL,
	imagen VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	sede INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE t_inventario CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS t_carrito;
CREATE TABLE t_carrito (
	id INT AUTO_INCREMENT,
	id_usuario INT NOT NULL,
	id_producto INT NOT NULL,
	cantidad INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE t_carrito CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

/*
INSERT INTO t_carrito (id_usuario,id_producto,cantidad,fecha_inicio) VALUES 
(1,1,5,'2021-02-23'),
(1,2,3,'2021-02-23');
*/

DROP TABLE IF EXISTS nomina;
CREATE TABLE nomina (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	apellido VARCHAR(250) NOT NULL,
	documento_tipo VARCHAR(250) NOT NULL,
	documento_numero VARCHAR(250) NOT NULL,
	genero VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	correo_personal VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	telefono VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) DEFAULT 'Activa',
	fecha_inicio date NOT NULL,

	banco_cedula VARCHAR(250) NOT NULL,
	banco_nombre VARCHAR(250) NOT NULL,
	banco_tipo VARCHAR(250) NOT NULL,
	banco_numero VARCHAR(250) NOT NULL,
	banco_banco VARCHAR(250) NOT NULL,
	BCPP VARCHAR(250) NOT NULL,
	
	turno VARCHAR(250) NOT NULL,
	sede VARCHAR(250) NOT NULL,
	cargo VARCHAR(250) NOT NULL,

	emergencia_nombre VARCHAR(250) NOT NULL,
	emergencia_telefono VARCHAR(250) NOT NULL,
	emergencia_parentesco VARCHAR(250) NOT NULL,

	salario INT NOT NULL,
	fecha_nacimiento date NOT NULL,
	fecha_ingreso date NOT NULL,
	fecha_retiro date NOT NULL,

	funcion INT NOT NULL,

	clave VARCHAR(250) NOT NULL,
	fecha_expedicion date NOT NULL,

	contrato INT NOT NULL,

	PRIMARY KEY (id)
);ALTER TABLE nomina CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS personal1;
CREATE TABLE personal1 (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	turno INT NOT NULL,
	observacion VARCHAR(250) NOT NULL,
	fotos VARCHAR(250) NOT NULL,
	nickname VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_asignada date NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE personal1 CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS cargos;
CREATE TABLE cargos (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE cargos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO cargos (nombre,responsable,fecha_inicio) VALUES 
('Directivo',1,'2021-03-11'),
('Administrador',1,'2021-03-11'),
('Aseo',1,'2021-03-11'),
('Asesor de Imagen',1,'2021-03-11'),
('Asistente',1,'2021-03-11'),
('Capacitadora y Pagos',1,'2021-03-11'),
('Diseñador',1,'2021-03-11'),
('Fotografo',1,'2021-03-11'),
('Gerente de Operaciones',1,'2021-03-11'),
('Jefe Soporte',1,'2021-03-11'),
('Mantenimiento',1,'2021-03-11'),
('Monitor',1,'2021-03-11'),
('Programador',1,'2021-03-11'),
('Recursos Humanos',1,'2021-03-11'),
('Reparaciones',1,'2021-03-11'),
('Soporte',1,'2021-03-11'),
('Soporte Técnico',1,'2021-03-11'),
('Tráfico',1,'2021-03-11'),
('Vigilante',1,'2021-03-11'),
('Financiera',1,'2021-03-15'),
('Jefe de Monitores',1,'2021-03-16'),
('Community Manager',1,'2021-03-16'),
('Sexshop',1,'2021-03-16'),
('Seguridad Social',1,'2021-03-17'),
('Hoster',1,'2021-03-20'),
('APP',1,'2021-03-20'),
('Administrador Restaurante',1,'2021-03-20'),
('Chef',1,'2021-03-20');

DROP TABLE IF EXISTS n_documentos;
CREATE TABLE n_documentos (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE n_documentos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO n_documentos (nombre,responsable,fecha_inicio) VALUES 
("Seguridad Social",1,"2021-03-17"),
("EPS",1,"2021-03-17"),
("Fondo de Pension",1,"2021-03-17"),
("ARL",1,"2021-03-17"),
("Antecedentes Penales",1,"2021-03-17"),
("Hoja de Vida",1,"2021-03-17"),
("Identificacion",1,"2021-03-19"),
("Firma",1,"2021-03-19"),
("Rut",1,"2021-03-29"),
("Certificación Bancaria",1,"2021-04-06"),
("Permiso Bancario",1,"2021-04-06");
	
DROP TABLE IF EXISTS n_archivos;
CREATE TABLE n_archivos (
	id INT AUTO_INCREMENT,
	id_nomina INT NOT NULL,
	id_documento INT NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE n_archivos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS n_pagos;
CREATE TABLE n_pagos (
	id INT AUTO_INCREMENT,
	id_nomina INT NOT NULL,
	salario INT NOT NULL,
	bonos INT NOT NULL,
	inasistencias INT NOT NULL,
	multas INT NOT NULL,
	responsable INT NOT NULL,
	inicio date NOT NULL,
	fin date NOT NULL,
	estatus VARCHAR(250) DEFAULT "Proceso",
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE n_pagos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS funciones;
CREATE TABLE funciones (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	descripcion1 VARCHAR(250) NOT NULL,
	descripcion2 VARCHAR(250) NOT NULL,
	descripcion3 VARCHAR(250) NOT NULL,
	descripcion4 VARCHAR(250) NOT NULL,
	descripcion5 VARCHAR(250) NOT NULL,
	descripcion6 VARCHAR(250) NOT NULL,
	descripcion7 VARCHAR(250) NOT NULL,
	descripcion8 VARCHAR(250) NOT NULL,
	descripcion9 VARCHAR(250) NOT NULL,
	descripcion10 VARCHAR(250) NOT NULL,
	descripcion11 VARCHAR(250) NOT NULL,
	descripcion12 VARCHAR(250) NOT NULL,
	descripcion13 VARCHAR(250) NOT NULL,
	descripcion14 VARCHAR(250) NOT NULL,
	descripcion15 VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	cargo INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE funciones CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO funciones (nombre,descripcion1,descripcion2,descripcion3,descripcion4,descripcion5,descripcion6,descripcion7,descripcion8,descripcion9,descripcion10,descripcion11,descripcion12,descripcion13,descripcion14,descripcion15,responsable,fecha_inicio) VALUES 
("Financiero","El Responsable Financiero","Encargada Corroborar, Verificar Y Controlar, Todo Lo Relacionado A Pagos De Nomina, Empleados, Proovedores Y Pago De Servicios.","Asi Mismo Controlar Los Ingresos De Todo Lo Referido A Monetizacion.","","","","","","","","","","","","",1,"2021-04-05"),
("JEFE DE MONITOREO","Supervisar Y Verificar E Innovar todas las actividades de los monitores","","","","","","","","","","","","","","",1,"2021-04-05"),
("MAQUINAS","Realizar Inventarios De Productos Para Maquinas De Café Y Dispensadores","Realizar Y Recibir Pedidos Para Maquinas De Café Y Dispensador","Surtir Maquina","Llevar Finanzas De Maquinas","Velar Por El Buen Funcionamiento De Las Maquinas  En Las 3 Sedes","","","","","","","","","","",1,"2021-04-05"),
("MONITORES","Recibir a los modelos y asignarles room","Entregar un reporte al incio de cada turno de modelos en trasmisión","Configurar paginas, obs y angulos de cámara para empezar una trasmision optima","Cada monitor tiene en promedio 8 modelos bajo su cargo a quienes tendrán en sus pantallas supervisadas para resolver cualquier situación que se presente en el streaming y a su vez brindar apoyo en sus shows","Entregar reporte de números al final del turno para hacer una evaluación de dicho proceso","Llevar un control del proceso del modelo para asi verificar sus fallas y dar soluciones al mejoramiento de las mismas","","","","","","","","","",1,"2021-04-05"),
("ADMINISTRADORES","Reclutamiento y selección del personal","Capacitar personal","Resolver conflictos que puedan haber dentro de la sede","Evaluación del personal de nomina que esta en la sede y de las modelos","Gestionar creacion de bios","Mandar información para apertura de cuentas","Gestionar seccion de fotos a las modelos"," Llevar el control de la aplicacion (carga de documentos)","Verificar desprendibles de pagos","Llevar control de inasistencias y llegadas tardes (subir multas a la aplicacion)","Depuración de la aplicación","Ayudar a Resolver dudas de las modelos de otros departamentos"," apoyar  y Capacitar a la modelos","","",1,"2021-04-05"),
("VIGILANTE","Apertura de puerta principal ala 6 am ","Verificacion de toda la sede ","Chequeo de todo los modelos que ingresan y salen de las sede en los 3 turnos ","Verificacion de todo el personal nomina ; hora de llega con sus respectivos uniformes ","Verificacion que las modelos esten en trasmision a la hora correspondiente ","Chequeo cada 30 minitos por toda la sede para que no se presente nunguna anomalia ","Verificacion de aseo y limpiesa de toda la sede ","Verificacion y cierre de la sede al final del turno asegurando el cierre y la seguridad de la sede","","","","","","","",1,"2021-04-05"),
("MANTENIMIENTO","Realización de limpieza de cada área y rooms","Manejo de cafetería","Realizar lavados de tendidos","Supervisar que cada área este limpia del personal encargado","","","","","","","","","","","",1,"2021-04-05"),
("JEFE DE SOPORTE","Verificación y supervisión de la creación de cuentas","Desmaneo de cuentas","Verificación de las cuentas en la app ,cuando ya están aprobadas  y se alertan para que la modelo cepa que ya tienen sus cuentas a la app,  en el drive se aprueban","Capacitación de personal nuevo para el área de soporte","Apoyo en las demás sedes con la solución de requerimientos","Supervisar que todos los modelos tengan plan choque (todas las cuentas) al día","Solución de rechazos de documentos en las diferentes paginas","Actualización y verificación de la app","Apoyo en las demás áreas con diferentes demás donde se pueden intervenir","","","","","","",1,"2021-04-05"),
("DISEÑADOR GRAFICO","Actualización de biografías","Diseño de cenefa de las pg de cada modelo","Verificación de datos personales","Elaboración de contenido profesional  y personalizado en cada biografía  con su line grafica","Integrar las biografías en cada página","Creación de gif para la trasmisión","","","","","","","","","",1,"2021-04-05"),
("COMUNITY MANAGER","Elaboración de artículos para el posicionamiento de la marca camaleón.","Creación de objetivos para parrilla de contenido semanal.","Redacción y creación de textos para la parrilla de contenido semanal.","Coordinación de las funciones del equipo de marketing.","Posicionamiento de las redes sociales instagram, facebook, twitter, youtube y página web. Elaboración de estrategias y campañas para eventos de camaleón models.","Elaboración de guiones para videos de la marca.","Posicionamiento de embajadores camaleón.","Actualización de base de datos de modelos públicas y consecución de su autorización por escrito.","Posicionamiento en redes sociales tienda camaleón shop.","Elaboración de contenido escrito para magazine camaleón (próximamente). Visibilizarcion de la marca camaleón con medios de comunicación.","","","","","",1,"2021-04-05"),
("SOPORTE","Creación de cuentas","desmaneó de cuentas","Verificación de las cuentas en la app ,cuando ya están aprobadas  y se alertan para que la modelo cepa que ya tienen sus cuentas a la app,  en el drive se aprueba","","","","","","","","","","","","",1,"2021-04-05"),
("DISEÑADOR G DE MARK","Diseñar piezas gráficas para redes sociales","Diseñar y actualizar contenido de página web","Diseñar y actualizar contenido de tienda virtual","Realización y edición de videos para redes sociales","Acompañamiento en procesos de posicionamiento de redes sociales","Diseño de piezas gráficas de comunicación interna y externa como correos de rebote para app.","Manejo de imagen corporativa.","","","","","","","","",1,"2021-04-05"),
("FOTOGRAFO","Crear de contenidos para las modelos en la pag web","Crear contenido para marketing y redes sociales","Encargado de tomas las fotografías y videos","","","","","","","","","","","","",1,"2021-04-05"),
("SOPORTE TECNICO","Realizar auditoria de las configuraciones y calidades de las modelos de las 7 sedes","Realizar el paralelo de tráfico a cada modelo","","","","","","","","","","","","","",1,"2021-04-05"),
("RECURSOS HUMANOS","Seguimiento de modelos","Controlar base de datos para realizar aperturas de cuenta de las modelos","Realizar entrevistas para las personas que desean ser modelos","Control de registros en el app","Realizar la aprobación de modelos en el app","Ejecución y planificación de capacitaciones a las modelos","Entrega de reportes de entrevistas y de capacitaciones","","","","","","","","",1,"2021-04-05"),
("SEXSHOP","Ventas de la tienda","Sostenibilidad en la tienda de sex-shop","","","","","","","","","","","","","",1,"2021-04-05"),
("SOPORTE TÉCNICO DE INFRAESTRUCTURA","Verificación  del mantenimiento diario de la parte estructural y supervisión para el cuidado de las sedes","Encargamos de la solicitud de requerimientos de material de trabajo al momento de detectar daños, bajo cotización y compra con la parte operacional, entré otras labores","","","","","","","","","","","","","",1,"2021-04-05"),
("DISEÑADOR MULTIMEDIA","Diseñador en 3d con conocimiento en ( cinema 4d o unreal engine 4 ) para la creacion de espacios virtuales","Conocimiento en ( z brush ) para el modelado de personajes virtuales","Conocimiento en animacion en cinema 4d de personajes con formato ( obj, fbx, 3ds )","Creación de texturas en cualquier programa de diseño 2d","Manejo de programas de edición de formatos mp4","Manejos de  programas estructuras con base de archivos stl para impresiones en 3d","","","","","","","","","",1,"2021-04-05"),
("GERENTE OPERACIONAL","Encargado de las administración de los recursos necesarios para el correcto funcionamiento de una empresa ","Función de planificar e implementar y supervisar el desarrollo óptimo y la ejecución de todas las actividades  y procesos diarios","","","","","","","","","","","","","",1,"2021-04-05"),
("PROGRAMADOR","Ejecucion y modificacion  de toda la parte de  la app","","","","","","","","","","","","","","",1,"2021-04-05");

DROP TABLE IF EXISTS n_funciones;
CREATE TABLE n_funciones (
	id INT AUTO_INCREMENT,
	id_cargo INT NOT NULL,
	id_funciones INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE n_funciones CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS n_contrato;
CREATE TABLE n_contrato (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE n_contrato CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO n_contrato (nombre,fecha_inicio) VALUES 
("Indefinido","2021-04-06"),
("Prestación de servicio","2021-04-06");

DROP TABLE IF EXISTS presabana_inactivos;
CREATE TABLE presabana_inactivos (
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
); ALTER TABLE presabana_inactivos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS facturas1;
CREATE TABLE facturas1 (
	id INT AUTO_INCREMENT,
	cuenta VARCHAR(250) NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	fecha_operacion DATE NOT NULL,
	fecha_valor DATE NOT NULL,
	codigo VARCHAR(250) NOT NULL,
	observaciones VARCHAR(250) NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	numero_movimiento VARCHAR(250) NOT NULL,
	importe FLOAT(11,2) NOT NULL,
	detalle VARCHAR(250) NOT NULL,
	extension VARCHAR(250) NOT NULL,
	soporte1 INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE facturas1 CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS trm1;
CREATE TABLE trm1 (
	id INT AUTO_INCREMENT,
	valor VARCHAR(250) NOT NULL,
	inicio date NOT NULL,
	fin date NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE trm1 CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS n_descuentos;
CREATE TABLE n_descuentos (
	id INT AUTO_INCREMENT,
	id_nomina INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	valor INT NOT NULL,
	fecha_asignada date NOT NULL,
	descuento VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE n_descuentos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS bancolombia1;
CREATE TABLE bancolombia1 (
	id INT AUTO_INCREMENT,
	referencia VARCHAR(250) NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	valor FLOAT(11,2) NOT NULL,
	soporte INT DEFAULT 0,
	responsable INT NOT NULL,
	fecha_creacion date NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE bancolombia1 CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS temporal_nomina_pagos;
CREATE TABLE temporal_nomina_pagos (
	id INT AUTO_INCREMENT,
	id_nomina INT NOT NULL,
	concepto VARCHAR(250) NOT NULL,
	texto VARCHAR(250) NOT NULL,
	valor INT NOT NULL,
	fecha DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE temporal_nomina_pagos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS nomina_pagos;
CREATE TABLE nomina_pagos (
	id INT AUTO_INCREMENT,
	id_nomina INT NOT NULL,
	sede INT NOT NULL,
	cargo INT NOT NULL,
	sueldo INT NOT NULL,
	laborados INT NOT NULL,
	nolaborados INT NOT NULL,
	subtotal INT NOT NULL,
	doblaturno INT NOT NULL,
	prestamos INT NOT NULL,
	bono INT NOT NULL,
	devolucion_ss INT NOT NULL,
	ajustenomina INT NOT NULL,
	otrosconceptos INT NOT NULL,
	totaldevengado INT NOT NULL,
	descuentos INT NOT NULL,
	totaldeducciones INT NOT NULL,
	totalpagar INT NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE nomina_pagos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS nomina_pagos_presabana;
CREATE TABLE nomina_pagos_presabana (
	id INT AUTO_INCREMENT,
	id_nomina INT NOT NULL,
	sede INT NOT NULL,
	cargo VARCHAR(250) NOT NULL,
	sueldo INT NOT NULL,
	laborados INT NOT NULL,
	nolaborados INT NOT NULL,
	subtotal INT NOT NULL,
	doblaturno INT NOT NULL,
	prestamos INT NOT NULL,
	bono INT NOT NULL,
	devolucion_ss INT NOT NULL,
	ajustenomina INT NOT NULL,
	otrosconceptos INT NOT NULL,
	totaldevengado INT NOT NULL,
	descuentos INT NOT NULL,
	totaldeducciones INT NOT NULL,
	totalpagar INT NOT NULL,
	fecha_desde DATE NOT NULL,
	fecha_hasta DATE NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
	PRIMARY KEY (id)
);ALTER TABLE nomina_pagos_presabana CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS amateur;
CREATE TABLE amateur (
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
); ALTER TABLE amateur CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS streamray;
CREATE TABLE streamray (
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
); ALTER TABLE streamray CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS contenido_presabana;
CREATE TABLE contenido_presabana (
	id INT AUTO_INCREMENT,
	id_modelo INT NOT NULL,
	mes VARCHAR(250) NOT NULL,
	anio VARCHAR(250) NOT NULL,
	subtotal FLOAT(11,2) NOT NULL,
	rf FLOAT(11,2) NOT NULL,
	meta_porcentajes VARCHAR(250) NOT NULL,
	total FLOAT(11,2) NOT NULL,
	trm FLOAT(11,2) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE contenido_presabana CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS contenido_paginas;
CREATE TABLE contenido_paginas (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE contenido_paginas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO contenido_paginas (nombre,responsable,fecha_inicio) VALUES 
('Pornhub',1,'2022-05-23'),
('Onlyfans',1,'2022-05-23'),
('Manyvids',1,'2022-05-23');

DROP TABLE IF EXISTS contenido_valores_extras;
CREATE TABLE contenido_valores_extras (
	id INT AUTO_INCREMENT,
	id_modelos INT NOT NULL,
	id_paginas INT NOT NULL,
	condicion VARCHAR(250) NOT NULL,
	valor FLOAT(11,2) NOT NULL,
	mes VARCHAR(250) NOT NULL,
	anio VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE contenido_valores_extras CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS contenido_modelos;
CREATE TABLE contenido_modelos (
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
	telegram VARCHAR(250) NOT NULL,

	banco_cedula VARCHAR(250) NOT NULL,
	banco_nombre VARCHAR(250) NOT NULL,
	banco_tipo VARCHAR(250) NOT NULL,
	banco_numero VARCHAR(250) NOT NULL,
	banco_banco VARCHAR(250) NOT NULL,
	BCPP VARCHAR(250) NOT NULL,
	banco_tipo_documento VARCHAR(250) NOT NULL,
	
	altura VARCHAR(250) NOT NULL,
	peso VARCHAR(250) NOT NULL,
	pene VARCHAR(250) NOT NULL,
	sosten VARCHAR(250) NOT NULL,
	busto VARCHAR(250) NOT NULL,
	cintura VARCHAR(250) NOT NULL,
	caderas VARCHAR(250) NOT NULL,
	tipo_cuerpo VARCHAR(250) NOT NULL,
	vello VARCHAR(250) NOT NULL,
	cabello VARCHAR(250) NOT NULL,
	ojos VARCHAR(250) NOT NULL,
	tattoo VARCHAR(250) NOT NULL,
	piercing VARCHAR(250) NOT NULL,

	estatus VARCHAR(250) DEFAULT 'Activa',
	responsable INT NOT NULL,
	fecha_inicio DATE NOT NULL,
   	PRIMARY KEY (id)
); ALTER TABLE contenido_modelos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO contenido_modelos (nombre1,nombre2,apellido1,apellido2,documento_tipo,documento_numero,genero,correo,direccion,usuario,clave,telefono1,estatus,responsable,fecha_inicio) VALUES 
('Juan','Jose','Maldonado','la Cruz','Cedula de Extranjeria','23627750','Hombre','juanmaldonado.co2@gmail.com','','JDolarJ','71b3b26aaa319e0cdf6fdb8429c112b0','3016984868',1,1,'2022-06-05');

DROP TABLE IF EXISTS contenido_documentos;
CREATE TABLE contenido_documentos (
	id INT AUTO_INCREMENT,
	id_documentos INT NOT NULL,
	id_modelos INT NOT NULL,
	imagen VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE contenido_documentos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS contenido_cuentas;
CREATE TABLE contenido_cuentas (
	id INT AUTO_INCREMENT,
	id_modelos INT NOT NULL,
	id_paginas INT NOT NULL,
	usuario VARCHAR(250) NOT NULL,
	clave VARCHAR(250) NOT NULL,
	estatus VARCHAR(250) NOT NULL,
	responsable INT NOT NULL,
	fecha_modificacion date NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE contenido_cuentas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;