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