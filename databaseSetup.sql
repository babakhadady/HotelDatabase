drop table reservations;
drop table reserves;
drop table roomContains;


create table reservations (
	start_date CHAR(20) NOT NULL,
	end_date CHAR(20) NOT NULL,
	reservation_id INTEGER PRIMARY KEY,
)

grant select on reservations to public;

create table reserves (
	reservation_id INTEGER not null,
	number INTEGER,
	PRIMARY KEY (reservation_id, number)
	FOREIGN KEY (reservation_id) REFERENCES Reservation
		ON DELETE SET NULL
	ON UPDATE CASCADE
FOREIGN KEY (number) REFERENCES RoomContains2
	ON DELETE SET NULL
	ON UPDATE CASCADE
)

grant select on reserves to public;

create table roomContains (
	number INTEGER
	floor INTEGER,
	room_type CHAR(20),
	status CHAR(20),
	price INTEGER NOT NULL
	PRIMARY KEY (number)
	FOREIGN KEY (id) REFERENCES HotelOwns2	
	ON DELETE SET NULL
	ON UPDATE CASCADE
FOREIGN KEY (floor, room_type) REFERENCES RoomContains1
	ON DELETE SET NULL
	ON UPDATE CASCADE
)

grant select on roomContains to public;

INSERT
INTO roomContains(number, floor, room_type, status, price)
VALUES (401, 4, "Double", "occupied", 200)

INSERT
INTO roomContains(number, floor, room_type, status, price)
VALUES (‘501’, ‘5’, ‘Master’, ‘vacant’, ‘300’)

INSERT
INTO roomContains(number, floor, room_type, status, price)
VALUES (‘601’, ‘6’, ‘Single’, ‘occupied’, ‘200’)

INSERT
INTO roomContains(number, floor, room_type, status, price)
VALUES (‘701’, ‘7’, ‘Queen’, ‘occupied’, ‘250’)

INSERT
INTO roomContains(number, floor, room_type, status, price)
VALUES (‘801’, ‘8’, ‘King’, ‘occupied’, ‘300’)