## 图片相册类
这个类的父路径为imgManager，所有这个类下面的接口在ajax的路径前面都是`imgManager`，如创建相册的接口是`createImgFolder.php`，则ajax的url参数为`/imgManager/createImgFolder.php`。
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
 * imgArr：图片信息的数组(包括以下两项)
 	* reportUid：已空格分开的举报此图片的用户的id
 	* reportInfo：本图片的举报内容

### 获取有相同tag的相册(sameTagImgFolder.php)
#### up
* sameTag：需要查找的相同的tag

#### return
* 0：如概述
* json格式的相册信息
 * imgNum：相册的数量
 * imgArr：相册信息的数组(包括以下两项)
 	* reportUid：已空格分开的举报此图片的用户的id
 	* reportInfo：本图片的举报内容

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
* 2：无此相册
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
* reportId：需要举报的图片的id
* reportInfo：举报的内容

#### return
* 0、1：如概述
* 2：本id不存在
* 3：本图片的举报信息未处理
* 4：图片举报的次数已达到5次，不能举报
* 5：此用户已举报过本图片，不能举报

### 处理举报的图片(operateReport.php)
#### up
* imgId：需要处理的图片的id
* operateType：处理的类型
	* 1：删除图片
	* 2：消除举报

#### return
* 0、1：如概述

### 对图片进行评论(imgReview.php)
#### up
* imgId：需要评论的图片的id
* content：评论的内容
* replyId：这个评论如果是对其他评论的回复，这里则是需要回复的评论的id，如果不是回复其他评论，则为0

#### return
* 0、1：如概述

### 获取图片的评论(getImgReview.php)
#### up
* imgId：需要评论的图片的id

#### return
* 0：如概述
* 2：无此图片
* json格式的图片评论信息
	* reviewNum：评论的数量
	* reviewArr：评论信息的数组，数组的每个元素都是一个json格式的评论信息，格式如下
		* id：评论的id，递增的
		* content：评论的内容
		* replyId：为0的话，是对图片的直接评论;非0则代表是对这个id的评论的回复
		* reviewDate：评论日期
		* reviewTime：评论时间
		* reviewUid：评论的人的id