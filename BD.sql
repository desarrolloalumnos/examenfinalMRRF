CREATE DATABASE hotel;

CREATE TABLE rol (
    rol_id SERIAL PRIMARY KEY,
    rol_nombre VARCHAR(50),
    rol_situacion SMALLINT DEFAULT 1
);

CREATE TABLE usuario (
    usu_id SERIAL PRIMARY KEY,
    usu_nombre VARCHAR(50) UNIQUE,
    usu_dpi INTEGER UNIQUE,
    usu_password LVARCHAR,
    usu_email VARCHAR(255) UNIQUE,
    usu_telefono VARCHAR(15),
    usu_rol INTEGER REFERENCES rol(rol_id),
    usu_situacion SMALLINT DEFAULT 2
);

CREATE TABLE habitaciones (
    habitacion_id SERIAL PRIMARY KEY,
    habitacion_numero INT NOT NULL,
    habitacion_tipo VARCHAR(255) NOT NULL,
    habitacion_descripcion VARCHAR(100),
    habitacion_tarifa DECIMAL(10, 2) NOT NULL,
    habitacion_disponibilidad SMALLINT DEFAULT 1,
    habitacion_situacion SMALLINT DEFAULT 1
);

CREATE TABLE reservas (
    reserva_id SERIAL PRIMARY KEY,
    reserva_cliente_id INT REFERENCES usuario(usu_id),
    reserva_habitacion_id INT REFERENCES habitaciones(habitacion_id),
    reserva_fecha_inicio DATETIME YEAR TO MINUTE NOT NULL,
    reserva_fecha_fin DATETIME YEAR TO MINUTE NOT NULL,
    reserva_estado SMALLINT DEFAULT 1,
    reserva_situacion SMALLINT DEFAULT 1
);

CREATE TABLE facturas (
    factura_id SERIAL PRIMARY KEY,
    factura_reserva_id INT REFERENCES reservas(reserva_id),
    factura_total DECIMAL(10, 2) NOT NULL,
    factura_pdf_path VARCHAR(255) NOT NULL,
    factura_situacion SMALLINT DEFAULT 1
);



insert into rol (rol_nombre ) values ('ADMINISTRADOR');
insert into rol (rol_nombre ) values ('TECNICO');
insert into rol (rol_nombre ) values ('CLIENTE');
insert into rol (rol_nombre ) values ('PENDIENTE');

insert into usuario (usu_nombre, usu_dpi, usu_password, usu_email, usu_telefono, usu_rol, usu_situacion ) values 
('CARLOS REYES', 664052, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS', 'reyes@gmail.com', 55237292, 1, 1);
insert into usuario (usu_nombre, usu_dpi, usu_password, usu_email, usu_telefono, usu_rol ) values 
('ABNER FUENTES', 623041, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS', 'fuentes@gmail.com', 45330075, 4);
insert into usuario (usu_nombre, usu_dpi, usu_password, usu_email, usu_telefono, usu_rol ) values 
('FRANCO ALEGRIA', 123456, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS', 'franco@gmail.com', 40383291, 4);
insert into usuario (usu_nombre, usu_dpi, usu_password, usu_email, usu_telefono, usu_rol ) values 
('FORTIN', 1234567, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS', 'fortin@gmail.com', 35039584, 4);
