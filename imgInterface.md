## 图片相册类
这个类的父路径为imgManager，所有这个类下面的接口在ajax的路径前面都是`imgManager`，如注册的接口是`createImgFolder.php`，则ajax的url参数为`/imgManager/createImgFolder.php`。
### 创建相册(createImgFolder.php)
#### up
* imgFolderName:相册名
* imgFolderTag：相册的tag
* imgFolderExplanation :相册的说明

#### return
* 0、1如概述
* 2：相册名已存在

### 上传图片(upImg.php)
#### up
* imgFolderId：相册id
* imgJson：json格式的照片信息
	* imgUrl：图片的url
	* imgTag：图片的tag
	* imgTitle：图片的标题
	* imgExplanation：图片的说明
	* imgTitlePage：是否设置为相册封面(1为是，0为否)
	* imgWidth：图片的宽
	* imgHeigt：图片的高
	* software：所用软件
	* tool：所用工具
	* remark：图片的备注

#### return
* 0、1如概述

### 添加tag(addTag.php)
#### up
* addId：要添加tag的id(图片或相册的id)
* tag：以空格分开的字符串

#### return
* 0、1如概述
* 2：tag数量超过8个，添加失败

### 获取有相同tag的图片(sameTagImg.php)
#### up
* sameTag：需要查找的相同的tag

#### return
* 0：如概述
* json格式的图片信息
 * imgNum：图片的数量
 * imgArr：图片信息的数组

### 获取有相同tag的相册(sameTagImgFolder.php)
#### up
* sameTag：需要查找的相同的tag

#### return
* 0：如概述
* json格式的相册信息
 * imgNum：相册的数量
 * imgArr：相册信息的数组

### 收藏(collect.php)
#### up
* id：需要收藏的图片或相册的id

#### return
* 0、1：如概述

### 获取相册里的图片(getImg.php)
#### up
* imgFolderId：相册的id

#### return
* 0：如概述
* json格式的图片信息(类型如上传图片的json格式一样)

### 根据编码获取图片(getImgForId.php)
#### up
* imgId：图片的编码(也是图片的id)

#### return
* 0：如概述
* 2：无此编码
* json格式的图片信息(类型如上传图片的json格式一样)

### 获取用户的相册(getImgFolder.php)
#### up
* id：需要获取的相册的所有者的id

#### return
* 0：如概述
* json格式的相册信息
	* imgFolderNum：相册数量
	* imgFolderArr：相册信息的数组

### 举报图片(reportImg.php)
#### up
* id：需要举报的图片的id

#### return
* 0、1：如概述