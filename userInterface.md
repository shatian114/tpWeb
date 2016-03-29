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

### 获取登陆的用户详细信息(getUserData.php)
#### up
* 无需上传参数

#### return
* 返回json
	* id：用户在数据表里的id，为递增模式
	* gid：用户的用户组id，1为bloom用户组，2为weed用户组
	* name：用户名
	* remarkName：别名
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

### 更新登陆用户的详细资料(upFullData.php)
#### up
* json格式
	* remarkName：别名
	* headerImgUrl：用户头像的url
	* sex：性别(n为未知，w为女，m为男)
	* address：地址
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

### 增加积分(addFraction.php)
#### up
* fractionNum：需要增加的积分数

#### return
* 0、1如概述
* 2：添加失败

### 减少积分(addFraction.php)
#### up
* fractionNum：需要减少的积分数

#### return
* 0、1如概述
* 减少失败(积分数不够)

### 禁止用户(forbidUser.php)
#### up
* id：需要禁止的用户的id
#### return
* 0、1如概述