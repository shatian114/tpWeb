create table user (
	id bigint auto_increment primary key,
	name varchar(30),
	password char(20)
);

create table imgInfo (
	url varchar(200),
	propritary bigint
);