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
	tid SERIAL,
	description varchar(30) not null,
	constraint pk_Typology primary key(tid)	
);

create table Site(
	sid SERIAL,
	branch varchar(20) not null,
	department varchar(20) not null,
	constraint pk_Site primary key(sid)
);

create table MainActivity (
	maid SERIAL,
	description varchar(10000),
	estimatedtime interval,
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
	mid SERIAL not null,
	matname varchar(100),
	idactivity smallint,
	constraint pk_Material primary key(mid),
	constraint fk_idactivity_Material_maid_MainActivity foreign key(idactivity)
	references MainActivity(maid)
	on delete restrict on update cascade
);

create table MainProcedure (
	mpid SERIAL,
	description varchar(2000),
	smp bytea,
	idactivity smallint,
	constraint pk_MainProcedure primary key(mpid),
	constraint fk_idactivity_MainProcedure_maid_MainActivity foreign key(idactivity)
	references MainActivity(maid)
	on delete restrict on update cascade
);

create table Skill(
	skid SERIAL,
	skillname varchar(100),
	constraint pk_Skill primary key(skid)
);

create table DailyAvailability(
	dataavail date not null,
	username varchar(20) not null,
	avail8_9 interval,
	avail9_10 interval,
	avail10_11 interval,
	avail11_12 interval,
	avail14_15 interval,
	avail15_16 interval,
	avail16_17 interval,
	percentavailab interval,
	constraint pk_DailyAvailability primary key (dataavail, username),
	constraint fk_username_DailyAvailability_username_client foreign key (username)
		references Client(username)
		on delete restrict on update cascade
);
create table Holding(
	username varchar(20) not null,
	idskill smallint not null,
	constraint pk_Holding primary key (username,idskill),
	constraint fk_username_Holding_username_client foreign key (username)
		references Client(username)
		on delete restrict on update cascade,
	constraint fk_idskill_Holding_skid_Skill foreign key (idskill)
		references Skill(skid)
		on delete restrict on update cascade
);

create table SPAssignment (
	ids smallint not nulL,
	idp smallint not null,
	constraint pk_SPAssignment primary key (ids,idp),
	constraint fk_ids_SPAssignment_skid_Skill foreign key (ids)
		references Skill(skid)
		on delete restrict on update cascade,
	constraint fk_idp_SPAssignment_mpid_MainProcedure foreign key (idp)
		references MainProcedure(mpid)
		on delete restrict on update cascade
);
CREATE ROLE gruppo5 LOGIN SUPERUSER PASSWORD 'progettoSE2020';



-------------------------------------INSERT INTO SITE
insert into Site(branch,department)
values ('Fisciano','Molding');
insert into Site(branch,department)
values ('Nusco','Carpentry');
insert into Site(branch,department)
values ('Morra','Painting');

---------------------------------INSERT INTO TYPOLOGY

insert into Typology(description)
values ('Mechanical');
insert into Typology( description)
values ('Electric');
insert into Typology(description)
values ('Hydraulic');
insert into Typology(description)
values ('Electronics');

--------------------------------INSERT INTO CLIENT

insert into Client(username,pass,clientrole)
values('simonasorgente','s1m0n4','planner');
insert into Client(username,pass,clientrole)
values('antoniettanapoli','4n70n1e774','planner');
insert into Client(username,pass,clientrole)
values('antonellarossi','4n70nell4','planner');
insert into Client(username,pass,clientrole)
values('angelovistocco','4ngel0','planner');
insert into Client(username,pass,clientname,ncompetence,clientrole)
values('Pippo1','p1pp0','Pippo',3,'maintainer');
insert into Client(username,pass,clientname,ncompetence,clientrole)
values('Paperino2','p4per1n0','Paperino',2,'maintainer');
insert into Client(username,pass,clientname,ncompetence,clientrole)
values('Topolino3','70p0l1n0','Topolino',4,'maintainer');

--------------------------------INSERT INTO SKILL
insert into skill(skillname)
values('PAV Certification');
insert into skill(skillname)
values('Electrical maintenance');
insert into skill(skillname)
values('Knowledge of cable types');
insert into skill(skillname)
values('Xyz-type robot knowledge');
insert into skill(skillname)
values('Knowledge of robot workstation 23');
insert into skill(skillname)
values('Mechanical Maintenance');
insert into skill(skillname)
values('Compressor Knowledge');
insert into skill(skillname)
values('Molding plant knowledge');
insert into skill(skillname)
values('Knowledge of working line P3');
---------------------------INSERT INTO DAILY AVAILABILITY
insert into DailyAvailability(dataavail,username,avail8_9,avail9_10,avail10_11,avail11_12,avail14_15,avail15_16,avail16_17,percentavailab)
values('18-11-2020','Pippo1','00:50:00','00:30:00','1:00:00','00:40:00','1:00:00','1:00:00','00:35:00','80%');
insert into DailyAvailability(dataavail,username,avail8_9,avail9_10,avail10_11,avail11_12,avail14_15,avail15_16,avail16_17,percentavailab)
values ('18-11-2020','Paperino2','00:00:00','00:00:00','00:10:00','1:00:00','00:00:00','00:00:00','00:25:00','20%');
insert into DailyAvailability(dataavail,username,avail8_9,avail9_10,avail10_11,avail11_12,avail14_15,avail15_16,avail16_17,percentavailab)
values ('18-11-2020','Topolino3','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','00:00:00','0%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('19-11-2020','Pippo1','100%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('19-11-2020','Paperino2','50%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('19-11-2020','Topolino3','20%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('20-11-2020','Pippo1','20%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('20-11-2020','Paperino2','80%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('20-11-2020','Topolino3','100%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('21-11-2020','Pippo1','100%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('21-11-2020','Paperino2','50%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('21-11-2020','Topolino3','20%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('22-11-2020','Pippo1','50%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('22-11-2020','Paperino2','100%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('22-11-2020','Topolino3','80%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('23-11-2020','Pippo1','20%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('23-11-2020','Paperino2','50%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('23-11-2020','Topolino3','100%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('24-11-2020','Pippo1','100%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('24-11-2020','Paperino2','80%');
insert into DailyAvailability(dataavail,username,percentavailab)
values ('24-11-2020','Topolino3','100%');


--------------------------------------INSERT INTO MAINACTIVITY
insert into MainActivity(description,estimatedtime,interruptible,mtype,week,workspacenotes,idtypology,idsite)
values ('replacement of robot 23 welding cables','00:30:00',true,'planned activity',23,
	   'the plant is closed from 00/00/20 to 00/00/20; on the remaining days it is possible to intervene
		only after 15:00.',002,002);
insert into MainActivity(description,estimatedtime,interruptible,mtype,week,workspacenotes,idtypology,idsite)
values ('compressor replacement','1:10:00',false,'ewo',23,'Plant stopped from 12:23 p.m. pending intervention.
		Smoke from the XX4 compressor as a result of loud noise.',001,001);

--------------------------------------INSERT INTO MATERIAL

insert into material(matname,idactivity)
values('cables',001);
insert into material(matname,idactivity)
values('welding machine',001);
insert into material(matname,idactivity)
values('wheel',002);
insert into material(matname,idactivity)
values('work keys',002);


--------------------------------------------INSERT INTO MAINPROCEDURE
insert into MainProcedure(description,idactivity)
values ('unscrew the affected part; cut anche remove the cables; remove the residues; apply new cables.',001);
insert into MainProcedure(description, idactivity)
values ('empty the compressor;remove the wheel; unscrew the compressor;insert new piston, cylinder, header and valves',002);


-----------------------------------------------INSERT INTO HOLDING
insert into Holding(username,idskill)
values('Pippo1',001);
insert into Holding(username,idskill)
values('Pippo1',002);
insert into Holding(username,idskill)
values('Pippo1',003);
insert into Holding(username,idskill)
values('Paperino2',001);
insert into Holding(username,idskill)
values('Paperino2',006);
insert into Holding(username,idskill)
values('Paperino2',007);
insert into Holding(username,idskill)
values('Paperino2',008);

-----------------------------------------------INSERT INTO SPASSIGNMENT
insert into SPAssignment(ids,idp)
values(001,001);
insert into SPAssignment(ids,idp)
values(002,001);
insert into SPAssignment(ids,idp)
values(003,001);
insert into SPAssignment(ids,idp)
values(004,001);
insert into SPAssignment(ids,idp)
values(005,001);
insert into SPAssignment(ids,idp)
values(001,002);
insert into SPAssignment(ids,idp)
values(006,002);
insert into SPAssignment(ids,idp)
values(007,002);
insert into SPAssignment(ids,idp)
values(008,002);
insert into SPAssignment(ids,idp)
values(009,002);


