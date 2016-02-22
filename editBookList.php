<?php
	require_once 'lib/mysql.func.php';
	require_once 'lib/alertMes.php';
	$isLink = connect();
	if(!$isLink){
		exit("数据库转接失败！");
	}
	$id = $_REQUEST['id'];
	$sql = "select booklistname from booklistname";
	$booklistname = fetchOne($sql);
	//$sql = "select * from booklistname where listcode={$id}";
	$sql = "select * from booklistname";
	$totalRow = getResultRow($sql);
	if($totalRow){
		$sql = "select bookname,bookprice,discount,id from booklist where listcode={$id}";
		$rows = fetchAll($sql);
	}else{
		$rows = array();
		alertMes("没有书单信息！！请添加！！","addBookList.php");
	}
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
					<div class="listName" id="listName"><?php echo $booklistname['booklistname'];?></div>
					<input type="text" value="" placeholder="" id="tempListName" style="display:none" class="listName">
					<div class="edit btn small" id="listEdit">编辑</div>
					<a class="back" href="adIndex.php">返回</a>
				</div>
				<div class="bookList">
					<form id="bookShelf" action="doAction.php?act=edit&id=<?php echo $id;?>" method="post" name="bookShelf">
						<?php $i = 1; foreach ($rows as $row):?>
						<div id="book<?php echo $i;?>" class="bookInfo">
							<span>书名：</span>
							<input class="bookName" type="text" name="bookName<?php echo $i;?>" value="<?php echo $row['bookname'];?>" onfocus="isFocus($(this));" onblur="isBlur($(this));" />
							<span>价格：</span>
							<input class="price" type="number" name="price<?php echo $i;?>" value="<?php echo $row['bookprice'];?>" onfocus="isFocus($(this));" onblur="isBlur($(this));" />
							<span>折扣：</span>
							<input class="discount" type="number" name="discount<?php echo $i;?>" value="<?php echo $row['discount'];?>" onfocus="isFocus($(this));" onblur="isBlur($(this));" />
							<input type="text" value="<?php echo $row['id'];?>" style="display: none;" name="bookListId<?php echo $i++;?>" >
						</div>
					<?php endforeach;?>
						<input type="text" value="<?php echo $i-1;?>;" style="display: none;" name="bookSumNum" id="bookSumNum" >
						<input type="text" value="<?php echo $booklistname['booklistname'];?>" style="display: none;" name="bookListName" id="bookListName">
					</form>
						<div id="add" class="add btn small">添加</div>
				</div>
						<div class="fun">
							<input class="publish btn small" type="submit" id="" value="提交" form="bookShelf" />
							<a class="save btn small" href="doAction.php?act=edit&id=<?php echo $id;?>">保存</a>
						</div>
			</div>
		</div>
		<script src="js/zepto.min.js"></script>
		<script src="js/editBooklist.js"></script>
		<script>
			var tempVal;
			function isFocus($this){
				tempVal = $this[0].value;
				$this[0].value = "";
			}
			function isBlur($this){
				if(!$this[0].value){
					$this[0].value = tempVal;
				}
			}
	
		
		</script>
	</body>

</html>