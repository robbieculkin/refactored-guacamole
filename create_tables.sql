DROP TABLE listings;
CREATE TABLE listings (
	ID int NOT NULL PRIMARY KEY,
	name varchar(255)NOT NULL,
	description varchar(255),
	type varchar(50) NOT NULL,
	address varchar(255),
	country varchar(50),
	state varchar(15),
	zip varchar(12),
	approved int,
	alum_name varchar(255),
	grad_year varchar(5)
); 
	
