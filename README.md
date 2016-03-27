# 概述
所有的返回结果里，0代表ajax提交的参数不够，1代表正常（如注册，登陆、、、），其他则返回相应字符串或json，下面会进行详细介绍
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
*无需上传参数

#### return
* 1：成功登出

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