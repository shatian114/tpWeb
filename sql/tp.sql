#用户的信息表
create table user (
	id int unsigned auto_increment primary key,
	name varchar(30),
	password char(20)
);

#图片信息的表
create table imgInfo (
	url varchar(200),
	propritary int
);

#用户直接相互关系的表，如关注，粉丝
create table userRelation (
	#粉丝的id
	fId int unsigned,
	#关注者的id
	gId int unsigned,
	#关系,0为关注，为好友
	relation char(1)
);