<?php
            $_GET["comment"]; 
			echo $_GET["comment"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "lovetv";
			 
			try {
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // 设置 PDO 错误模式为异常
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 
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
			