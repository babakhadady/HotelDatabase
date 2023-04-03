drop table reservations cascade constraints;
drop table reserves;
drop table roomContains;
-- drop table guest;
-- drop table owner;

create table reservations
    (start_date varchar(20) not null,
    end_date varchar(40) not null,
    reservation_id int not null,
    primary key (reservation_id));
 
grant ALL PRIVILEGES on reservations to public;

create table roomContains
    (room_number int not null,
	floor int not null,
	room_type varchar(20) not null,
	status varchar(20) not null,
	price int not null,
    primary key (room_number));
 
grant ALL PRIVILEGES on roomContains to public;

create table reserves
    (reservation_id int not null,
	room_number int not null,
    primary key (reservation_id, room_number),
	foreign key (reservation_id) references reservations
	    ON DELETE CASCADE,
    foreign key (room_number) references roomContains
        ON DELETE CASCADE);
 
grant ALL PRIVILEGES on reserves to public;

-- create table guest
--     (guest_id int not null,
-- 	card_number int not null,
-- 	guest_name varchar(20) not null,
-- 	email varchar(20) not null,
--     primary key (guest_id));
 
-- grant select on guest to public;

-- create table owner
--     (owner_name varchar(20) not null,
-- 	email varchar(20) not null,
--     primary key (owner_name));
 
-- grant select on owner to public;

-- create table belongsTo
--     (belongsTo_id int not null,
-- 	reservation_id int not null,
--     primary key (belongsTo_id, reservation_id));
 
-- grant select on belongsTo to public;


insert into roomContains values
(200, 2, 'single', 'vacant', 150);

insert into roomContains values
(201, 2, 'single', 'vacant', 150);

insert into roomContains values
(202, 2, 'double', 'vacant', 200);

insert into reservations values
('jan 1', 'jan 2', 1);

insert into reservations values
('jan 4', 'jan 7', 6);

-- insert into guest values
-- ('123456', 'Henry Kim', '24429988', 'walkingbuddies2002@gmail.com');

-- insert into guest values
-- ('222222', 'Benry Bim', '48603847', 'zedandshen@gmail.com');

-- insert into guest values
-- ('123456', 'Jenry Jim', '66739853', 'yuumicarry@gmail.com');

-- insert into guest values
-- ('444444', 'Tenry Tim', '12546434', 'thisisnotanemail@gmail.com');

-- insert into guest values
-- ('666666', 'Lenry Lim', '89745676', 'impostersussy@gmail.com');
