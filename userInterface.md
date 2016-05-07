## 用户类
这个类的父路径为userManager，所有这个类下面的接口在ajax的路径前面都是`userManager`，如注册的接口是`regist.php`，则ajax的url参数为`/userManager/regist.php`。

### 注册(regist.php)
#### up
* name:用户名
* password: 密码(在前端将密码加密再传过来)

#### return
* 0、1如概述
* 2：用户名已注册

### 登陆(login.php)
#### up
* loginType：登陆方式，可以有一下几种
	* name：用户名
	* identity：身份证
	* mobilePhone：手机号
* name:用户名
* password: 密码(在前端将密码加密再传过来)

#### return
* 0、1如概述
* 2：密码错误
* 3：用户名不存在

### 登出(logout.php)
#### up
* 无需上传参数

#### return
* 1：成功登出

### 修改密码(changePassword.php)
#### up
* password: 新密码

#### return
* 0、1如概述

### 根据查询类型查询用户信息(getUserData.php)
#### up
* searchType：查询的类型，可以为以下几种
	* name：用户名
	* remarkName：别名
	* nickName：昵称
	* realName：真实姓名
	* uid：用户的id
	* identity：身份证号
	* mobilePhone：手机号
	* alipay：支付宝

#### return
* 0：如概述
* 2：无此用户
* 返回json
	* id：用户在数据表里的id，为递增模式
	* gid：用户的用户组id，1为photon用户组，2为bloom用户组
	* name：用户名
	* remarkName：别名
	* nickname：昵称
	* realName：真实姓名
	* fraction：积分
	* headerImgUrl：用户头像的url
	* sex：性别(n为未知，w为女，m为男)
	* address：地址
	* identityNum：身份证号
	* identityNumVerify：身份证号是否经过了验证(0为未验证，1为已验证)
	* mobilePhone：手机号
	* mobilePhoneVerify：手机号是否经过了验证(0为未验证，1为已验证)
	* bornDate：出生日期
	* classNum：年级
	* forbid：用户是否被禁制(0为开放，1为禁止)
	* alipay：用户的支付宝帐号
	* imgGetCount：用户所有图片的浏览总和

### 更新登陆用户的详细资料(upFullData.php)
#### up
* json格式
	* remarkName：别名
	* nickName：昵称
	* headerImgUrl：用户头像的url
	* sex：性别(n为未知，w为女，m为男)
	* address：地址
	* realName：真实姓名
	* identityNum：身份证号
	* mobilePhone：手机号
	* bornDate：出生日期
	* alipay：用户的支付宝帐号

#### return
* 0、1如概述
* 2：资料更新错误

### 关注用户(attention.php)
#### up
* name：被关注的用户名

#### return
* 0：如概述
* 1：双方已为好友
* 2：为被关注的粉丝

### 取消关注用户(noAttention.php)
#### up
* name：被关注的用户名

#### return
* 0：如概述
* 1：取消关注
* 2：取消关注(但是被关注的用户还关注了自己)

### 获取好友列表(friend.php)
#### up
* 无需上传

#### return
* 0：如概述
* json格式
	* friendNum：好友的数量
	* friend：好友数组

### 获取粉丝列表(fans.php)
#### up
* 无需上传

#### return
* 0：如概述
* json格式
	* fansNum：粉丝的数量
	* fans：粉丝数组

### 获取关注的人列表(fans.php)
#### up
* 无需上传

#### return
* 0：如概述
* json格式
	* gzNum：关注的人的数量
	* gz：关注的人的数组

### 签到(checkIn.php)
#### up
* 无需上传

#### return
* 0、1如概述

### 获取签到累计数(getCheckInSum.php)
#### up
* 无需上传

#### return
* 签到的累计数

### 获取连续签到数(getCheckContinousInSum.php)
#### up
* 无需上传

#### return
* 连续的签到数

### 增加积分(addFraction.php)
#### up
* fractionNum：需要增加的积分数

#### return
* 0、1如概述
* 2：添加失败

### 减少积分(cutFraction.php)
#### up
* fractionNum：需要减少的积分数

#### return
* 0、1如概述
* 减少失败(积分数不够)

### 禁止、删除用户(operateUser.php)
#### up
* operateType：操作类型，可以为以下两种
	* delete：删除
	* forbid：禁止
* id：需要禁止的用户的id

#### return
* 0、1如概述

### 查找用户的唯一资料是否存在(isExists.php)
#### up
* searchType：查找类型，可以为以下四种
	* name：用户名
	* mobilePhone：手机号
	* identity：身份证号
	* alipay：支付宝号
* seatchStr：查找的值

#### return
* 0：如概述
* 1：存在
* 2：不存在

### 给用户推送官方信息(sendMsg.php)
#### up
* uid：接收信息的用户的id
* msgContent：信息的内容

#### return
* 0、1：如概述

### 给用户推送访客信息(sendGuestMsg.php)
#### up
* uid：接收信息的用户的id

#### return
* 0、1：如概述

### 获取用户的消息息(getMsg.php)
#### up
* msgType：消息的类型，可以为以下3种
	* 1：评论消息
	* 2：被关注和被取消关注的消息
	* 3：官方推送的消息
	* 4：访客消息

#### return
* 0：如概述
* json格式的信息
	* msgNum：信息的数量
	* msgArr：信息的数组，每个元素为一个信息的json格式
		* id：信息的id，可能是不连续的
		* msgType：信息的类型(同上)
		* msgContent：信息的内容（如果信息类型为关注，则1为被关注，2为被取消关注;如果信息类型为评论，则内容为评论的id；如果信息类型为推送信息，则为推送的内容）
		* fromUid：发送信息的人的id(如果为访客信息，这个就是访客的id)
		* msgDate：信息接收日期
		* msgTime：信息接收时间
		* msgRead：信息的读取状态，0为未读取

### 设置用户为推荐画师(setRecommend.php)
#### up
* uid：画师的uid

#### return
* 0、1：如概述

### 取消推荐画师(setNoRecommend.php)
#### up
* uid：画师的uid

#### return
* 0、1：如概述

### 获取推荐画师(getRecommend.php)
#### up
* 无需上传

#### return
* 0：如概述
* json格式
	* recommendNum：推荐画师的个数
	* recommendArr：推荐画师的信息的数组，元素为json格式的画师的详细信息（信息同查询用户信息返回的json格式）