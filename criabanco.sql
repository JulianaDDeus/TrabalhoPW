CREATE DATABASE wda_crud;
USE wda_crud;
CREATE TABLE customers (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  cpf_cnpj varchar(15) NOT NULL,
  birthdate datetime NOT NULL,
  address varchar(255) NOT NULL,
  hood varchar(100) NOT NULL,
  zip_code varchar(8) NOT NULL,
  city varchar(100) NOT NULL,
  state varchar(2) NOT NULL,
  phone varchar(11) NOT NULL,
  mobile varchar(11) NOT NULL,
  ie varchar(15) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL
);
CREATE TABLE movies (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title varchar(50) NOT NULL,
  director varchar(40) NOT NULL,
  year int NOT NULL,
  created datetime NOT NULL,
  picture varchar(30) NOT NULL,
  modified datetime NOT NULL
);

INSERT INTO `customers` (`name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) 
VALUES ('Fulano de Tal', '123.456.789-00', '1989-01-01', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'SP', '15 55555554', '15955555555', '123456789321', 
'2016-05-24 00:00:00', '2016-05-24 00:00:00'), 
('Ciclano de Tal', '123.456.789-00', '1980-01-01', 'Rua da Fatec, 123', 'Internet', '12345678', 'Teste', 'SP', '15 55555554', '15955555555', '123456789321', 
'2016-05-24 00:00:00', '2016-05-24 00:00:00');

INSERT INTO `movies` (`title`, `director`, `year`, `created`, `picture`);
VALUES ('Guardiões da Galáxia', 'James Gunn', '2014', '2026-09-08', 'movies\fotos\guardioesdagalaxia.jpg');