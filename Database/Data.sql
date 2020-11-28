
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

insert into material(matname)
values('cables');
insert into material(matname)
values('welding machine');
insert into material(matname)
values('wheel');
insert into material(matname)
values('work keys');
--------------------------------------INSERT INTO COMPOSITION

insert into composition(mid,idactivity)
values(001,001);
insert into composition(mid,idactivity)
values(002,001);
insert into composition(mid,idactivity)
values(003,002);
insert into composition(mid,idactivity)
values(004,002);

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
