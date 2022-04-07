#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE `user`(
        `id_user`       Int  Auto_increment  NOT NULL ,
        `lastname`      Varchar (50) NOT NULL ,
        `firstname`     Varchar (50) NOT NULL ,
        `mail`          Varchar (100) NOT NULL ,
        `phone `        Varchar (10) NOT NULL ,
        `password`      Char (60) NOT NULL ,
        `registered_at` Datetime NOT NULL ,
        `validated_at`  Datetime ,
        `admin`         Bool NOT NULL
	,CONSTRAINT `user_PK` PRIMARY KEY (`id_user`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: schoolclass
#------------------------------------------------------------

CREATE TABLE `schoolclass`(
        `id_class`   Int  Auto_increment  NOT NULL ,
        `class_name` Varchar (10) NOT NULL ,
        `city`       Varchar (50) NOT NULL
	,CONSTRAINT `schoolclass_PK` PRIMARY KEY (`id_class`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: child
#------------------------------------------------------------

CREATE TABLE `child`(
        `id_child`      Int  Auto_increment  NOT NULL ,
        `lastname`      Varchar (50) NOT NULL ,
        `firstname`     Varchar (50) NOT NULL ,
        `registered_at` Datetime NOT NULL ,
        `birthdate`     Date NOT NULL ,
        `id_class`      Int NOT NULL ,
        `id_user`       Int NOT NULL
	,CONSTRAINT `child_PK` PRIMARY KEY (`id_child`)

	,CONSTRAINT `child_schoolclass_FK` FOREIGN KEY (`id_class`) REFERENCES `schoolclass`(`id_class`)
	,CONSTRAINT `child_user0_FK` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: canteen
#------------------------------------------------------------

CREATE TABLE `canteen`(
        `id_canteen` Int  Auto_increment  NOT NULL ,
        `date`       Date NOT NULL ,
        `id_child`   Int NOT NULL
	,CONSTRAINT `canteen_PK` PRIMARY KEY (`id_canteen`)

	,CONSTRAINT `canteen_child_FK` FOREIGN KEY (`id_child`) REFERENCES `child`(`id_child`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: file
#------------------------------------------------------------

CREATE TABLE file(
        `id_file`    Int  Auto_increment  NOT NULL ,
        `updated_at` Datetime NOT NULL ,
        `deleted_at` Datetime ,
        `id_user`    Int NOT NULL
	,CONSTRAINT `file_PK` PRIMARY KEY (`id_file`)

	,CONSTRAINT `file_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: picture
#------------------------------------------------------------

CREATE TABLE `picture`(
        `id_picture` Int  Auto_increment  NOT NULL ,
        `updated_at` Datetime NOT NULL ,
        `deleted_at` Datetime NOT NULL ,
        `id_user`    Int NOT NULL
	,CONSTRAINT `picture_PK` PRIMARY KEY (`id_picture`)

	,CONSTRAINT `picture_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: actuality
#------------------------------------------------------------

CREATE TABLE `actuality`(
        `id_actuality` Int  Auto_increment  NOT NULL ,
        `link`         Varchar (100) NOT NULL ,
        `label`        Varchar (100) NOT NULL ,
        `description`  Text NOT NULL ,
        `id_user`      Int NOT NULL
	,CONSTRAINT `actuality_PK` PRIMARY KEY (`id_actuality`)

	,CONSTRAINT `actuality_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`)
)ENGINE=InnoDB;

