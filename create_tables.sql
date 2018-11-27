DROP TABLE listings_unapproved;
CREATE TABLE listings_unapproved (
	ID int NOT NULL PRIMARY KEY,
	name varchar(255)NOT NULL,
	description varchar(255),
	type varchar(50) NOT NULL,
	address varchar(255),
	country varchar(50),
	state varchar(15),
	zip varchar(12),
	alum_name varchar(255),
	grad_year varchar(5),
	major varchar(255)
); 
	
DROP TABLE listings_approved;
CREATE TABLE listings_approved (
	ID int NOT NULL PRIMARY KEY,
	name varchar(255)NOT NULL,
	description varchar(255),
	type varchar(50) NOT NULL,
	address varchar(255),
	country varchar(50),
	state varchar(15),
	zip varchar(12),
	alum_name varchar(255),
	grad_year varchar(5),
	major varchar(255)
); 
	
DROP TABLE users;
CREATE TABLE users (
	ID int NOT NULL PRIMARY KEY,
	name varchar(255)NOT NULL,
	grad_year varchar(5),
	major varchar(255),
	reason varchar(511)
); 
