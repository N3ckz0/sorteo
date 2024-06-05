create table TipoUsuarios(
	id int primary key auto_increment,
	rol varchar(50)
);

INSERT INTO TipoUsuarios (rol) VALUES ('admin');
INSERT INTO TipoUsuarios (rol) VALUES ('super');
INSERT INTO TipoUsuarios (rol) VALUES ('client');

create table usuarios(
	id int primary key auto_increment,
	nombre varchar(100),
	apaterno varchar(100),
	amaterno varchar(100),
	usuario varchar(100),
	correo varchar(100),
	telefono varchar(100),
	imagen varchar(100),
	contrasena varchar(100),
	idTipoUsuario int,
	foreign key (idTipoUsuario) references TipoUsuarios(id) ON DELETE CASCADE
);

INSERT INTO usuarios (nombre,apaterno,amaterno,usuario,correo,telefono,imagen,contrasena,idTipoUsuario) VALUES ('admin','admin','admin','admin','','','assets/dist/img/user2-160x160.jpg','admin123',1);

create table clasificaciones(
	id int primary key auto_increment,
	descripcionCatego text
);

create table estadoPremios(
	id int primary key auto_increment,
	estado varchar(50)
);

INSERT INTO estadoPremios (estado) VALUES ('Pendiente');
INSERT INTO estadoPremios (estado) VALUES ('Autorizado');
INSERT INTO estadoPremios (estado) VALUES ('Denegado');

create table premios(
	id int primary key auto_increment,
	nombre varchar(100),
	descripcion text,
	imagen varchar(100),
	actived boolean,
	fecha date,
	precioBoleto float,
	descripcionSorteo text,
	idEstado int,
	idClasificacion int,
	foreign key (idEstado) references estadoPremios(id) ON DELETE CASCADE,
	foreign key (idClasificacion) references clasificaciones(id) ON DELETE CASCADE
);

create table imagenes(
	id int primary key auto_increment,
	url varchar(100)
);

create table ventas(
	id int primary key auto_increment,
	numero int,
	idTicket varchar(100),
	idParticipant int,
	idPremio int,
	foreign key (idParticipant) references usuarios(id) ON DELETE CASCADE,
	foreign key (idPremio) references premios(id) ON DELETE CASCADE
);

create table config(
	id int primary key auto_increment,
	empresa varchar(100),
	logo varchar(100),
	imgfondo varchar(150),
	colorfondo varchar(20),
	fondodegradado  varchar(10),
	colormenu varchar(100),
	menudegradado varchar(10)
);

INSERT INTO config (empresa, logo, imgfondo, colorfondo, fondodegradado, colormenu, menudegradado) VALUES ('Tribuna Comunicación','assets/media/logo.png','assets/media/fondo.jpg','42, 115, 127','0.5','42, 115, 127','0.7');

create table stripe(
	id int primary key auto_increment,
	claveprivada text,
	clavepublica text
);

INSERT INTO stripe (claveprivada, clavepublica) VALUES('sk_test_51Oj4o2EnKGGZMJyG52pkbS5B6OwLlC6zbBlDEaNu5VatMJIFrzoag3CQlVVBUIi0V1Dc1hqSEsE6NHM23prVmQJw00qT9HTDLX','pk_test_51Oj4o2EnKGGZMJyG0tvBgSqNVjuZXfdZeZpciU2Ejhsb276osh9z9cl7NgBDxBHpuXVscHMhfhorvBifqkRrStqG00aEo55Cvx');