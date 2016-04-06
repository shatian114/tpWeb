## 网站管理类
这个类的父路径为siteManager，所有这个类下面的接口在ajax的路径前面都是`siteManager`，如设置网站的标题的接口是`setSiteTitle.php`，则ajax的url参数为`/siteManager/setSiteTitle.php`。
### 设置网站标题(setSiteTitle.php)
#### up
* siteTitle：网站的标题

#### return
* 1如概述

### 设置网站seo(setSiteSeo.php)
#### up
* siteSeo：网站的seo

#### return
* 1如概述

### 设置网站开停状态(setSiteStop.php)
#### up
* siteStop：网站的开停状态
	* 1：关闭
	* 0：打开

#### return
* 1如概述