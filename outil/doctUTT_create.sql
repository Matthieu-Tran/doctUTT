-- =================================================================
-- Base DOCTOLIB version 3
-- Marc LEMERCIER, le 2 mai 2023
-- =================================================================

-- table specialités

create table if not exists specialite (
  id integer unsigned not null, 
  label varchar(40) not null,
  primary key (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- table personne

create table if not exists personne (
 id integer unsigned not null,
 nom varchar(40) not null,
 prenom varchar(40) not null,
 adresse varchar(40) not null, 
 login varchar(20) not null,
 password varchar(20) not null,
 statut integer unsigned not null,
 specialite_id integer unsigned not null,   
 primary key (id), 
 foreign key (specialite_id) references specialite(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- table rdv

create table if not exists rendezvous (
 id integer unsigned not null,
 patient_id integer unsigned not null, 
 praticien_id integer unsigned not null,
 rdv_date varchar(20),
 primary key (id), 
 foreign key (patient_id) references personne(id), 
 foreign key (praticien_id) references personne(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
