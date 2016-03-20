#用户的信息表
create table user (
	#用户的id，自增
	id int unsigned auto_increment primary key,
	#用户的组id，默认为1
	gid smallint unsigned not null default 1,
	name varchar(30),
	remarkName varchar(30),
	password char(20),
	#用户的积分
	fraction int unsigned not null default 0,
	#用户头像的url
	headerImgUrl varchar(255) not null default '#',
	#性别
	sex char(1) not null default 'n',
	#地址
	address text,
	#身份证号
	identityNum char(18),
	#手机号
	mobilePhone char(11),
	#出生日期
	bornDate date,
	#年级
	classNum varchar(1) not null default '1'
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