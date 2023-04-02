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


insert into roomContains values
(200, 2, 'single', 'vacant', 150);

insert into roomContains values
(201, 2, 'single', 'vacant', 150);

insert into roomContains values
(202, 2, 'double', 'vacant', 200);
