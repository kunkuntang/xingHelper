
	
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>星助手</title>
</head>
<body>
	结果
	<table border="0" cellspacing="0" cellpadding="0">
		<tr><th>清单</th></tr>
		<?php
			$bookName = $_GET['bookName'];
			$bookNum = $_GET['bookNum'];
			$price =  $$_GET['price'];
			echo $bookName;
			echo '<tr><td>书名：</td><td>'.$bookName.'</td></tr>';
			echo '<tr><td>数量：</td><td>'.$bookNum.'</td></tr>';
			print_r($_GET['sum']);
		?>
	</table>
</body>
</html>