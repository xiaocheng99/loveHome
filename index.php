<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<title>
			弹幕小屋
		</title>
		<style type="text/css">
			* {
				box-sizing: border-box;
				opacity: 1;
			}

			body {
				background-color: rgb(160, 169, 176);
			}

			main {
				background: #FAEBD7;
				margin: auto;
				width:1000px;
				height: 1800px;
				background-image: url(backimage/4.jpg);
				/* background-repeat: no-repeat; */
				position: relative;
			}

			#div_input {
				width: 100%;
				height: 10%;
				position: absolute;
				left: 0;
				top: 30px;
				

			}

			#input_blessing {
				width: 65%;
				height: 100px;
				margin: 20px;
				font-size: 50px;
				border-radius: 15px;
				opacity: 0.7;
			}

			#test,
			#btn_submit {
				width: 25%;
				height: 70px;
				border-radius: 20px;
				font-size: 30px;
				background-color: lightblue;
			}

			.slider {
				width: 100%;
				height: 60px;
				margin-top: 15px;
				position: relative;
				overflow: hidden;
				
			}

			.textStyle {
				opacity: 0.8;
				font-size: 38px;
				color: rgb(255,255,255);
				position: absolute;
				background-color: rgba(38, 38, 37,0.7);
				border-radius: 10px;
			}
			#days{
				width: 100%;
				height: 250px;
				color: mediumvioletred;
				/* background-color: #ADD8E6; */
				position: absolute;
				top: 150px;
				/* left: 15%; */
				/* font-size: 100px; */
			}
			
			#days #p1{
				font-size: 80px;
				text-align: center;
			}
			
			#days {
				text-align: center;
			}
			#days #p2{
				margin: 0;
				font-size: 100px;
				text-align: center;
			}
			
			#days #p3 {
				font-size: 80px;
			}
		</style>
	</head>
	<body>

		<main>
			<div id="div_input">

				<input type="text" name="text_blessing" id="input_blessing">
				<input type="submit" value="留下祝福" id="btn_submit">
				<div id="days">
					<p id="p1">We have been love for</p>
					<p ><span id="p2"></span>  <span id="p3">days</span></p> 
				</div>

				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
				<div class="slider"></div>
			</div>
		</main>
	</body>

<script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
<script type="text/javascript" >
	
	
		//获取在一起的天数
		function getDays()
		{
			var s1 = '2019-01-16';
			s1 = new Date(s1.replace(/-/g, "/"));
			s2 = new Date();//当前日期
			var days = s2.getTime() - s1.getTime();
			var time = parseInt(days / (1000 * 60 * 60 * 24));
			var oP2=document.getElementById("p2");
			oP2.innerHTML=time;
		}
		getDays();
		
		
		
	//连接数据库
		function initLetters()
		{	
			var myLetters = new Array();
			//从数据库获取数据 初始化letters
			<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "lovetv";
			
			// 创建连接
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
					myLetters[i]='<?php echo $row["c_comment"] ?>'.toString();
					i++;
				<?php }
			} else { 
				echo "0 结果";
			}
			mysqli_close($conn);
			?>
			return myLetters;
		}
		var myLetters = initLetters();
		initLetters();



		let oBtn_submit = document.getElementById("btn_submit");
		let oInput_blessing = document.getElementById("input_blessing");
		let oDiv_slider = document.getElementsByClassName("slider");
		let oTest = document.getElementById("test");
		let oText = document.getElementsByClassName("textStyle");
		let time1;//弹幕滑动定时器

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
						let textStyle = '<div class="textStyle" >' + myLetters[i] + '</div>';
						shuffle(myLetters);
						oDiv_slider[i].innerHTML = textStyle;
						oText[i].style.left = 750 + 'px';
						var strRGB="rgb("+(Math.floor(Math.random() * 255) + 100).toString()+","+(Math.floor(Math.random() * 255) + 100).toString()+","+(Math.floor(Math.random() * 255) + 100).toString()+")";
						// oText[i].style.color = '#' + Math.random().toString(16).substr(2, 6).toUpperCase();
						oText[i].style.color =strRGB;
						
					}
				}

			}, 15)
		}
		//将数组打乱
		function shuffle(arr) {
			var len = arr.length;
			for (var i = 0; i < len - 1; i++) {
				var index = parseInt(Math.random() * (len - i));
				var temp = arr[index];
				arr[index] = arr[len - i - 1];
				arr[len - i - 1] = temp;
			}
			return arr;
		}
		
		
		siledrLetters();

		function insertNew (){
				

		}
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
		
	</script>
	

</html>
