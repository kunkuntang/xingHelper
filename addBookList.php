<?php
	$adminId = $_REQUEST['adminId'];//接收管理员用户ID
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>星购书</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/addBookList.css" />
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
				<div class="title">
					<div class="listName" id="listName">书单1</div>
					<input type="text" value="" placeholder="" id="tempListName" style="display:none" class="listName">
					<div class="edit btn small" id="listEdit">编辑</div>
					<a class="back" href="adIndex.php?adminId=<?php echo $adminId;?>">返回</a>
				</div>
				<div class="bookList">
					<form id="bookShelf" action="doAction.php?act=save&adminId=<?php echo $adminId;?>" method="post" name="bookShelf">
						<!--<div id="book10" class="bookInfo">
							<span>书名：</span>
							<input class="bookName" type="text" name="bookName" />
							<span>价格：</span>
							<input class="price" type="number" name="price" />
							<span>折扣：</span>
							<input class="discount" type="number" name="bookNum" />
						</div>-->
						<input type="text" value="1" style="display: none;" name="bookSumNum" id="bookSumNum">
						<input type="text" value="" style="display: none;" name="bookListName" id="bookListName">
					</form>
						<div id="add" class="add btn small">添加</div>
				</div>
						<div class="fun">
							<input class="publish btn small" type="submit" id="" value="保存" form="bookShelf" />
						</div>
			</div>
		</div>
		<script src="js/zepto.min.js"></script>
		<script src="js/addBookList.js"></script>
		<script>

		</script>
	</body>

</html>