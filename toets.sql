create database toets;

use toets;
create table telefoon(
ID int auto_increment,
merk varchar(255),
model varchar(255) not null,
opslag varchar(255) not null,
prijs int not null,
primary key (ID)
);
drop table telefoon;