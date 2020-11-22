drop table if exists Client cascade;
drop table if exists MainActivity cascade;
drop table if exists Material cascade;
drop table if exists Typology cascade;
drop table if exists Site cascade;
drop table if exists MainProcedure cascade;
drop table if exists Skill cascade;
drop table if exists DailyAvailability cascade;
drop table if exists Holding cascade;
drop table if exists SPAssignment cascade;
drop role if exists gruppo5;

create table Client (
	username varchar(20),
	pass varchar(20) not null,
	clientname varchar(20),
	ncompetence smallint,
	clientrole varchar(50) not null,
	constraint pk_client primary key (username)
);

create table Typology (
	tid smallint,
	description varchar(30) not null,
	constraint pk_Typology primary key(tid)	
);

create table Site(
	sid smallint,
	branch varchar(20) not null,
	departement varchar(20) not null,
	constraint pk_Site primary key(sid)
);

create table MainActivity (
	maid smallint,
	description varchar(10000),
	estimatedtime time,
	interruptible bool,
	mtype varchar(30) not null,
	week smallint,
	workspacenotes varchar(2000),
	username varchar(20),
	idtypology smallint,
	idsite smallint,
	constraint pk_MainActivity primary key (maid),
	constraint fk_username_MainActivity_username_client foreign key (username)
		references Client(username)
		on delete restrict on update cascade,
	constraint fk_idtypology_MainActivity_tid_Typology foreign key(idtypology)
		references Typology(tid)
		on delete restrict on update cascade,
	constraint fk_site_MainActivity_sid_Site foreign key(idsite)
		references Site(sid)
		on delete restrict on update cascade
	
);
create table Material (
	mid smallint not null,
	name varchar(100),
	idactivity smallint,
	constraint pk_Material primary key(mid),
	constraint fk_idactivity_Material_maid_MainActivity foreign key(idactivity)
	references MainActivity(maid)
	on delete restrict on update cascade
);

create table MainProcedure (
	mpid smallint,
	description varchar(2000),
	smp bytea,
	idactivity smallint,
	constraint pk_MainProcedure primary key(mpid),
	constraint fk_idactivity_MainProcedure_maid_MainActivity foreign key(idactivity)
	references MainActivity(maid)
	on delete restrict on update cascade
);

create table Skill(
	skid smallint,
	skillname varchar(100),
	constraint pk_Skill primary key(skid)
);

create table DailyAvailability(
	dataavail date not null unique,
	username varchar(20) not null unique,
	avail8_9 varchar(10),
	avail9_10 varchar(10),
	avail10_11 varchar(10),
	avail11_12 varchar(10),
	avail14_15 varchar(10),
	avail15_16 varchar(10),
	avail16_17 varchar(10),
	percentavailab varchar(5),
	constraint pk_DailyAvailability primary key (dataavail, username)
);
create table Holding(
	username varchar(20) not null unique,
	idskill smallint not null unique,
	constraint pk_Holding primary key (username,idskill),
	constraint fk_username_Holding_username_client foreign key (username)
		references Client(username)
		on delete restrict on update cascade,
	constraint fk_idskill_Holding_skid_Skill foreign key (idskill)
		references Skill(skid)
		on delete restrict on update cascade
);

create table SPAssignment (
	ids smallint not null unique,
	idp smallint not null unique,
	constraint pk_SPAssignment primary key (ids,idp),
	constraint fk_ids_SPAssignment_skid_Skill foreign key (ids)
		references Skill(skid)
		on delete restrict on update cascade,
	constraint fk_idp_SPAssignment_mpid_MainProcedure foreign key (idp)
		references MainProcedure(mpid)
		on delete restrict on update cascade
);
CREATE ROLE gruppo5 LOGIN SUPERUSER PASSWORD 'progettoSE2020';
