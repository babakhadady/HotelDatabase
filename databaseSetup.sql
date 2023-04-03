drop table reservations cascade constraints;
drop table reserves;
drop table roomContains;

create table reservations
    (start_date varchar(20) not null,
    end_date varchar(40) not null,
    reservation_id int not null,
    primary key (reservation_id));
 
grant ALL PRIVILEGES on reservations to public;

create table reserves
    (reservation_id int not null,
	reserves_number int not null,
    primary key (reservation_id, reserves_number),
	foreign key (reservation_id) references reservations
	ON DELETE CASCADE);
 
grant ALL PRIVILEGES on reserves to public;

create table roomContains
    (room_number int not null,
	floor int not null,
	room_type varchar(20) not null,
	status varchar(20) not null,
	price int not null,
    primary key (room_number));
 
grant ALL PRIVILEGES on roomContains to public;

/*
roomContains 
*/
insert into roomContains values(200, 2, 'single', 'vacant', 150);
insert into roomContains values(201, 2, 'single', 'vacant', 150);
insert into roomContains values(202, 2, 'double', 'vacant', 200);

insert into roomContains values(300, 3, 'single', 'occupied', 150);
insert into roomContains values(301, 3, 'double', 'vacant', 200);
insert into roomContains values(302, 3, 'queen', 'vacant', 250);

insert into roomContains values(400, 4, 'single', 'occupied', 150);
insert into roomContains values(401, 4, 'double', 'occupied', 200);
insert into roomContains values(402, 4, 'king', 'vacant', 300);

insert into roomContains values(500, 5, 'single', 'occupied', 150);
insert into roomContains values(501, 5, 'double', 'vacant', 200);
insert into roomContains values(502, 5, 'master', 'occupied', 350);

/*
reservations 
*/
insert into reservations values('jan 10', 'jan 12', 1);
insert into reservations values('jan 10', 'jan 12', 2);

/*
reserves 
*/
insert into reserves values(2, 300);
insert into reserves values(2, 301);
insert into reserves values(1, 302);