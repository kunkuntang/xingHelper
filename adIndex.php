<?php
require_once 'lib/mysql.func.php';
$isLink = connect();
if(!$isLink){
	exit("数据库转接失败！");
}
$adminId = $_REQUEST['adminId'];//接收管理员用户ID
$sql = "select * from booklistname where admincode={$adminId}";
$totalRow = getResultRow($sql);
if($totalRow){
	$sql = "select booklistname,id,url from booklistname where admincode={$adminId}";
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
		<link rel="stylesheet" type="text/css" href="css/aIndex.css"/>
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
					<a href="addBookList.php?adminId=<?php echo $adminId;?>&adminId=<?php echo $adminId ;?>"><div id="add" class="btn big">+&nbsp;添加</div></a>
				</div>
				<div class="BookList">
				<?php foreach ($rows as $row): ?>
					<div class="list">
						<a class="bookName" href="checkBookList.php?id=<?php echo $row['id'] ?>&adminId=<?php echo $adminId ;?>"><?php echo $row['booklistname']; ?></a>
						<a class="link" href="<?php echo $row['url']; ?>">链接：<?php echo $row['url']; ?></a>
						<div class="btn middle publish" id="publish">发布</div>
						<a href="editBookList.php?id=<?php echo $row['id'];?>&adminId=<?php echo $adminId ;?>">编辑</a>
						<a onclick="delList(<?php echo $row['id'];?>,<?php echo $adminId;?>)">删除</a>
					</div>
				<?php endforeach;?>
				</div>
			</div>
		</div>
		<!--遮罩层-->
		<div class="mask" id="mask">
			<div class="dialog" id="dialog">
				<div class="close" id="close"></div>
				<div class="title">分享</div>
				<div class="content">
					<p>复制链接后发送到需要购买的人：</p>
					
					<a id="bookListUrl" href="#"></a>
				</div>
			</div>
		</div>
	</body>
	<script src='js/zepto.min.js'></script>
	<script src='js/adIndex.js'></script>
	<script type="text/javascript">
				var dialog = document.getElementById('dialog');
				var publish = document.getElementById('publish');
				var clsoeBtn = document.getElementById('close');
				var maskCon = document.getElementById('mask');
				publish.onclick = function(){
					$.ajax({
						type: 'post',
						url: 'doAction.php',
						data: {act: 'publish',id: <?php echo $row['id'];?>},
						datatype: 'json',
						success: function(data){
							if(data != 'error'){
								console.log(data);
								maskCon.style.display = 'block';
								maskCon.style.backgroundColor = "rgba(0,0,0,0.6)";
								$("#bookListUrl").text("http://localhost/xingHelper/"+data);
								$("#bookListUrl").attr('href',data);
							}else{
								alert("发布失败！");
							}
							
						},
						error: function(XMLHttpRequest, textStatus, errorThrown){
							console.log(XMLHttpRequest.status);
	                        console.log(XMLHttpRequest.readyState);
	                        console.log(textStatus);
							alert('发布失败！');
						}
					});
				};
				clsoeBtn.onclick = function(){
					/*maskCon.style.zIndex = -1;*/
					maskCon.style.display = 'none';
					maskCon.style.backgroundColor = "rgba(0,0,0,0)";
				};
			</script>
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
