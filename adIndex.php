<?php
require_once 'lib/mysql.func.php';
$isLink = connect();
if(!$isLink){
	exit("数据库转接失败！");
}
$sql = "select * from BookList";
$totalRow = getResultRow($sql);
$sql = "select booklistname from booklistname";
$rows = fetchAll($sql);
if(!$rows){
	echo "没有书单！！";
}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>星购书</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
	</head>
	<body>
		<div class="header">
			<div class="header_con">
				<div class="logo"></div>
				<div class="title"></div>
			</div>
		</div>
		<div class="body">
			<div class="body_con">
				<div class="addPart">
					<a href="addBookList.html"><div id="add" class="btn big">+&nbsp;添加</div></a>
				</div>
				<div class="BookList">
				<?php foreach ($rows as $row): ?>
					<div id="list">
						<span class="bookName"><?php echo $row['booklistname']; ?></span>
						<span class="link"></span>
						<div class="btn middle publish" onclick="doAction.php?act=publish">发布</div>
						<a href="editBookLisk.php">编辑</a>
					</div>
				<?php endforeach;?>
				</div>
			</div>
		</div>
	</body>
</html>
