*作者：小成Charles
原创作品
转载请标注原创文章地址：[https://blog.csdn.net/weixin_42999453/article/details/113784389](https://blog.csdn.net/weixin_42999453/article/details/113784389)
*

## 一、前言
这不是马上到2.14情人节了吗，寻思着做了一个比较有意义的网站，网站功能很简单，就是实现用户留言，并将留言的内容以弹幕的形式展示在网页上，项目很简单，但是挺有意思的，网站目前已经搭建在服务器上了，可以在我的网站看一下效果[http://helloqt.top](http://helloqt.top) 这是效果图
（ps:js和php其实都不不太熟悉，边看语法边写的=-=）
![在这里插入图片描述](https://img-blog.csdnimg.cn/20210210180445814.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80Mjk5OTQ1Mw==,size_16,color_FFFFFF,t_70)

## 二、设计思路
这个项目主要的难点呢就是设计好弹幕的实现方法，这里我的设计方法就是把一个`div`平均分成多个相同大小的`div`部分,如`下图所示`，每一个部分就是一个弹幕显示位置，然后利用随机位置让这些弹幕的位置随机摆放，再放一个定时器不断地移动弹幕位置，这就ok啦，很简单！
弹幕数据的存入和读取还是要利用`php`写后端，接入`mysql`简单的写几句读取和存入的`sql`语句就行了，下面来开始讲核心代码逻辑部分！
![在这里插入图片描述](https://img-blog.csdnimg.cn/2021021019224516.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80Mjk5OTQ1Mw==,size_16,color_FFFFFF,t_70)


## 三、核心代码讲解
（1）这里直接讲解`JS`的代码逻辑，首先你得创建出来多个均分的`div`模块，这里就称它为`slider`模块，再准备一个弹幕数据做测试，这里用的是`myLetters`,如下代码块所示，首先`for`循环在每个slider模块上`innerHtml`，这里`inner`的`textStyle` 就是用来存放弹幕文字的模块，接下来的for循环再把刚刚创建的textStyle的每个属性的`位置`和`颜色`随机设置一下，然后就是一个名为`time1`的间隔定时器，这里的逻辑就是每过30毫秒将`textStyle`模块在`slider`上向左移动`4px`,其中的if语句`if (oText[i].offsetLeft < (-oText[i].offsetWidth)`此处判断的是当弹幕全部移动到左边消失了的条件，在这里我们就要重新在当前位置创建一个新的`textStyle`,到此为止这个项目就基本完成了！

```javascript
//弹幕滑动函数
function siledrLetters() {
	//打乱数组
	// var myLetters = initLetters();
	shuffle(myLetters);
	let maxWidth = 830;
	for (let i = 0; i < oDiv_slider.length; i++) {
		//创建text
		let textStyle = '<div class="textStyle" >' + myLetters[i] + '</div>';
		oDiv_slider[i].innerHTML = textStyle;
	}

	for (let j = 0; j < oDiv_slider.length; j++) {
		//将所有文字坐标位置随机摆放
		oText[j].style.left = Math.floor((Math.random() * 750) + 1) + 'px';
		var strRGB="rgb("+(Math.floor(Math.random() * 255) + 100).toString()+","+(Math.floor(Math.random() * 255) + 100).toString()+","+(Math.floor(Math.random() * 255) + 100).toString()+")";//获取随机颜色 rgb
		oText[j].style.color =strRGB;
								
	}
	let time1 = setInterval(function() {
		for (let i = 0; i < oDiv_slider.length; i++) {
			let x = oText[i].offsetLeft;
			x -= 4;
			oText[i].style.left = x + 'px';
			if (oText[i].offsetLeft < (-oText[i].offsetWidth)) {
			shuffle(myLetters);
				let textStyle = '<div class="textStyle" >' + myLetters[i] + '</div>';
				oDiv_slider[i].innerHTML = textStyle;
				oText[i].style.left = 750 + 'px';
				var strRGB="rgb("+(Math.floor(Math.random() * 255) + 100).toString()+","+(Math.floor(Math.random() * 255) + 100).toString()+","+(Math.floor(Math.random() * 255) + 100).toString()+")";
				// oText[i].style.color = '#' + Math.random().toString(16).substr(2, 6).toUpperCase();
				oText[i].style.color =strRGB;
				
			}
		}

	}, 15)
}
```
（2）接下来就是`php`的代码逻辑块，这里就是对`mysql`的连接以及数据的提取存储过程，这里写起来麻烦的点就是php和js写在一起，php的标签要标好就行了，这里连接数据库之后，执行sql语句读取所有留言数据，再把数据结果以数组的形式依次传递给JS的数组，这里注意用的
`myLetters[i]='<?php echo $row["c_comment"] ?>'`这样的写法，这样可以写也是在进行数据更新，`push`的写法要多加两行代码处理，不然数组会变得超级长.......，好了这里就成功的读取到数据了

```javascript
//连接数据库
function initLetters()
{	
	var myLetters = new Array();
	//从数据库获取数据 初始化letters
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "lovetv";
	 
	// 创建连接
	header("Content-type: text/html; charset=utf8"); 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// Check connection
	if (!$conn) {
		die("连接失败: " . mysqli_connect_error()); ?>
		// alert('failed');
	 <?php } else ?>
	  // alert ("successful");
	
	 <?php
	 
	$sql = "SELECT c_comment FROM comment";
	$result = mysqli_query($conn, $sql);
	 
	if (mysqli_num_rows($result) > 0) { ?>
	
	// alert("have data");
		let i=0; //数组的index
		// 输出数据
		 <?php
		while($row = mysqli_fetch_assoc($result)) { ?>
			myLetters[i]='<?php echo $row["c_comment"] ?>';
			i++;
		<?php }
	} else { 
		echo "0 结果";
	}
	mysqli_close($conn);
	?>
	return myLetters;}
```
（3）这里就是留言后的数据处理方式了，这里留言后重新创建一个弹幕放到页面上，然后将数据存储到数据库中，然后就是ajax请求，这里利用了`XMLHttpRequest`这个类进行`GET`请求的形式发送数据给当前目录的`mysqlnsert.php`数据文件，具体过程代码块的注释写得很清楚，`mysqlnsert.php`文件中用的是预处理SQL绑定的方式将读取的数据存储到数据库中，这里要注意我用的`returnCitySN['cip']`是用了搜狐的api,大家可以略过。要注意`url =“”`的写法，如果本地测试要把本地ip和目录位置写清楚，因为我搭建在服务器上写个相对位置就好了。

```javascript
//点击留下祝福
oBtn_submit.onclick = function() {
	if (oInput_blessing.value != "") {
	
		//将心留言的数据添加到页面
		usrStr = oInput_blessing.value;
		let indePlace = Math.floor((Math.random() * 8) + 2);
		let textStyle = '<div class="textStyle" >' + usrStr + '</div>';
		oDiv_slider[indePlace].innerHTML = textStyle;
		oText[indePlace].style.left = 950 + 'px';
		oText[indePlace].style.color = "white";
		oText[indePlace].style.border = "3px solid yellow";
		
		myLetters.push(oInput_blessing.value);
		shuffle(myLetters);
		//将留言发送给数据库存储  这里将用户留言的城市和ip都记录下来了
		 var httpRequest = new XMLHttpRequest();//第一步：建立所需的对象
		 var url ="./mysqlnsert.php?"+"comment="+oInput_blessing.value.toString()+"&ip="+returnCitySN['cip'].toString()+"&city="+returnCitySN['cname'].toString();
		 httpRequest.open('GET', url, true);//第二步：打开连接  将请求参数写在url中  ps:"./Ptest.php?name=test&nameone=testone"
		 httpRequest.send();//第三步：发送请求  将请求参数写在URL中
		 alert("感谢您的祝福呦！");
		initLetters();//重新初始化数据
	}
}
```
mysqlInsert.php

```php
<?php
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "lovetv";
	 
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// 设置 PDO 错误模式为异常
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		mysql_query("set names 'utf8'",$conn);
	 
		// 预处理 SQL 并绑定参数
		$stmt = $conn->prepare("INSERT INTO comment (c_ip,c_city,c_comment) 
		VALUES (:c_ip,:c_city,:c_comment)");
		$stmt->bindParam(':c_comment', $c_comment);
		$stmt->bindParam(':c_ip', $c_ip);
		$stmt->bindParam(':c_city', $c_city);
	 
		// 插入行
		$c_comment = $_GET["comment"]; 	
		$c_ip = $_GET["ip"]; 	
		$c_city = $_GET["city"]; 	
		$stmt->execute(); 
		
	 }
	
	catch(PDOException $e)
	{ 
		echo "Error: " . $e->getMessage(); 
	}
	$conn = null;
	?>
	
```
## 四、搭建到服务器
到此为止，项目已经可以运行了，现在搭建到服务器上吧，我用的是`腾讯云`的1M的ESC云服务器,搭载的`centos7`系统，安装好`apatch`,`php`,`mariaDB`(或者`mysql`),因为centos下载的mysql默认为`mariaDB`，索性就用它了，效果一样的。

 1. 将项目文件打包上传到服务器上，默认地址`/var/www/html`路径下，如果你上传的是文件夹的话，需要把`apatch`的默认根目录地址更改，到文件夹`/etc/httpd/conf`下打开`httpd.conf`,找到`DocumentRoot "/var/www/html/lovetv"`这一号行把`html`后面改成你的文件夹的名字，我这里是`lovetv`,以及`<Directory "/var/www/html/lovetv">`这一行改成你的文件夹路径就好了！然后再重启一下httpd，执行`service httpd restart` ，去浏览器输入你的公网ip就可以访问啦！
 2. 第一次使用php去调用数据库的时候，会出现读出来的数据会出现全是问号的问题，这里是因为字符集配置问题，在黑夜里只要在`/etc`
文件夹中找到，`my.cnf`这个文件打开在大概中间位置添加一下数据就好了
```xml
[client]
default_character_set=utf8
[mysqld]
collation_server = utf8_general_ci
character_set_server = utf8
```
## 六、总结
目前为止你再弄一个域名解析到你的服务器的ip地址就完美了，项目用到的所有代码都已经上传到了我的github:[https://github.com/xiaocheng99/loveHome.git](https://github.com/xiaocheng99/loveHome.git)

CSDN下载地址：[https://download.csdn.net/download/weixin_42999453/15182020](https://download.csdn.net/download/weixin_42999453/15182020)

项目测试地址：[http://helloqt.top](http://helloqt.top)
欢迎大家来我的弹幕小屋给我留下你的祝福哦！



-----------------------------------
*作者：小成Charles
原创作品
转载请标注原创文章地址：[https://blog.csdn.net/weixin_42999453/article/details/113784389](https://blog.csdn.net/weixin_42999453/article/details/113784389)*
