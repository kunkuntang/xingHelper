<?php
require_once 'lib/mysql.func.php';
$isLink = connect();
if(!$isLink){
	exit("数据库转接失败！");
}
$adminId = $_REQUEST['adminId'];
$sql = "select * from booklistname where admincode={$adminId}";
$totalRow = getResultRow($sql);
if($totalRow){
	$sql = "select booklistname,id from booklistname where admincode={$adminId}";
	$rows = fetchAll($sql);
}else{
	$rows = array();
	echo "<script>alert( '没有书单！！请添加！！');</script>";
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
					<a href="addBookList.php?adminId=<?php echo $adminId;?>"><div id="add" class="btn big">+&nbsp;添加</div></a>
				</div>
				<div class="BookList">
				<?php foreach ($rows as $row): ?>
					<div class="list">
						<a class="bookName" href="checkBookList.php?id=<?php echo $row['id'] ?>&adminId=<?php echo $adminId ;?>"><?php echo $row['booklistname']; ?></a>
						<span class="link"></span>
						<div class="btn middle publish" onclick="publish(<?php echo $row['id'];?>)">发布</div>
						<a href="editBookList.php?id=<?php echo $row['id'];?>">编辑</a>
						<a onclick="delList(<?php echo $row['id'];?>,<?php echo $adminId;?>)">删除</a>
					</div>
				<?php endforeach;?>
				</div>
			</div>
		</div>
	</body>
	<script src='js/zepto.min.js'></script>
	<script src='js/adIndex.js'></script>
	<script>
		function delList(id,adminId){
			if(window.confirm("确定要删除吗？")){
				window.location="doAction.php?act=delList&id="+id+"&adminId="+adminId;
			}
		}
		function publish(id){
			window.location="doAction.php?act=publish&id="+id;
		}
	</script>
</html>
