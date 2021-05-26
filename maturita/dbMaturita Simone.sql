drop database if exists maturita;
create database maturita;
use maturita;

create table clienti_fornitori(
id int auto_increment not null,
codice varchar(100) not null,
tipo varchar(50) not null,
intestazione_aziendale varchar(255) not null,
indirizzo varchar(100) not null,
cap int not null,
citta varchar(50) not null,
provincia varchar(50) not null,
partita_iva varchar(255) not null,
telefono varchar(50) not null,
email varchar(255) not null,

primary key(id,codice),
index(codice)
) engine = InnoDB;

create table prodotti(
id int auto_increment,
codice varchar(100) not null,
nome varchar(255) not null,
prezzo_originale int not null,
prezzo_vendita int not null,
descrizione varchar(255) not null,
disponibilita boolean not null,

primary key(id,codice),
index(codice)
) engine = InnoDB;

create table magazzino(
id int auto_increment,
codice_prodotto varchar(100) not null,
quantita_magazzino int not null,
quantita_ordinata int not null,
peso int not null,

primary key(id),

FOREIGN KEY (codice_prodotto) REFERENCES prodotti (codice)
ON DELETE CASCADE
ON UPDATE CASCADE
) engine = InnoDB;

create table ordine_cliente(
id int auto_increment,
codice_cliente varchar(100) not null,
codice_prodotto varchar(100) not null,
quantita int not null,

primary key(id,codice_cliente, codice_prodotto),
FOREIGN KEY (codice_prodotto) REFERENCES prodotti (codice)
ON DELETE CASCADE
ON UPDATE CASCADE,

FOREIGN KEY (codice_cliente) REFERENCES clienti_fornitori (codice)
ON DELETE CASCADE
ON UPDATE CASCADE
) engine = InnoDB;

create table ordine_fornitore(
id int auto_increment,
codice_fornitore varchar(100) not null,
codice_prodotto varchar(100) not null,
quantita int not null,

primary key(id, codice_fornitore, codice_prodotto),
FOREIGN KEY (codice_prodotto) REFERENCES prodotti (codice)
ON DELETE CASCADE
ON UPDATE CASCADE,

FOREIGN KEY (codice_fornitore) REFERENCES clienti_fornitori (codice)
ON DELETE CASCADE
ON UPDATE CASCADE
) engine = InnoDB;

create table User(
id int primary key auto_increment not null,
username varchar(255) not null,
password varchar(255) not null

) engine = InnoDB;

insert into User values (1,'simone','simone');
insert into clienti_fornitori values (1,'PTS365','cliente','Azienda Agricola Mario Ferrari','via dei cordai',38057,'Pergine Valsugana','TN','PTR359725','3243254658','marioferrari@gmail.com');
insert into clienti_fornitori values (2,'PTS343','fornitore','Azienda Agricola Pippo','via dei pippo',38057,'Pergine Valsugana','TN','PTR359725','3243254658','pippo@gmail.com');
insert into prodotti values (1,'0011803','fingerhacke',1000,850,'lavorazione sottofila',true);
insert into magazzino values (1,'0011803',15,85,25);
insert into ordine_cliente values (1,'PTS365','0011803',150);
insert into ordine_fornitore values (1,'PTS343','0011803',300);








