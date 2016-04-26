#用户的信息表
create table user (
	#用户的id，自增
	id int unsigned auto_increment primary key,
	#用户的组id，默认为1
	gid smallint unsigned not null default 1,
	name varchar(30),
	remarkName varchar(30) not null default '',
	nickName varchar(30) not null default '',
	realName varchar(30) not null default '',
	password char(40),
	#用户的积分
	fraction int unsigned not null default 0,
	#用户头像的url
	headerImgUrl varchar(255) not null default '#',
	#性别
	sex char(1) not null default 'n',
	#地址
	address text not null default '',
	#身份证号
	identityNum char(18) not null default '',
	#身份证号验证
	identityNumVerify char(1) not null default '0',
	#手机号
	mobilePhone char(11) not null default '',
	#手机号验证
	mobilePhoneVerify char(1) not null default '0',
	#出生日期
	bornDate date,
	#年级
	classNum varchar(1) not null default '1',
	#是否禁止使用本用户，1为禁止
	forbid char(1) not null default '0',
	alipay varchar(255) not null default '',
	#相册个数
	imgFolderNum int unsigned not null default 0,
	#相册的id的字符串记录
	imgFolderIdStr text not null default '',
	#签到总数
	checkInSum int unsigned not null default 0,
	#连续签到数
	checkInContinousSum int unsigned not null default 0,
	#是否推荐，推荐则为1
	recommend char(1) not null default '',
	#图片浏览次数的总和
	imgGetCount bigint unsigned not null default 0
);

#图片的表
create table imgInfo (
	#图片编号
	id varchar(255),
	url varchar(255),
	tag text,
	title varchar(255),
	#图片说明
	explanation text,
	#是否是封面，1为是
	titlePage char(1) not null default '0',
	width smallint,
	height smallint,
	imgDate date,
	imgTime time,
	#所用工具
	tool varchar(255),
	#所用修改的软件
	software varchar(255),
	#备注
	remark varchar(255),
	#图片的pv量
	pvNum bigint not null default 0,
	forbid char(1) not null default "0",
	#举报者的id记录串，五个为上限，空格隔开
	reportUid varchar(255) not null default '',
	reportInfo text not null default '',
	#tag点赞的数量
	tagLikeNumStr varchar(31) not null default '',
	#给tag点赞的人的id的字符串
	tagUidStr text not null default ''
);

#用户相互关系的表，如关注，粉丝
create table userRelation (
	#粉丝的id
	fId int unsigned,
	#关注者的id
	gId int unsigned,
	#关系,0为关注，为好友
	relation char(1)
);

#举报的表
create table reportTable (
	#图片的id
	id varchar(255),
	#举报者的id
	uid varchar(255),
	#举报的理由
	argument text,
	reportDate date,
	reportTime time
);

#创建相册表
create table imgFolderInfo (
	id varchar(255) primary key,
	name varchar(255),
	tag varchar(255),
	explanation text,
	createDate date,
	createTime time,
	imgNum bigint not null default 0,
	pvNum bigint not null default 0,
	recommend char(1) not null default '0',
	imgIdStr text not null default '',
	#tag点赞的数量
	tagLikeNumStr varchar(31) not null default '',
	#给tag点赞的人的id的字符串
	tagUidStr text not null default ''
);

#用户给tag点赞的记录
create table tagLike (
	uid bigint unsigned primary key,
	imgId varchar(255),
	tagIndex tinyint unsigned,
	likeDate date,
	likeTime time
);