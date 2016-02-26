<?php
	require_once 'lib/mysql.func.php';
	require_once 'lib/alertMes.php';
	$isLink = connect();
	if(!$isLink){
		exit("数据库转接失败！");
	}
	$id = $_REQUEST['booklist'];
	$sql = "select * from booklist";
	$totalRow = getResultRow($sql);
	
	if($totalRow){
		$sql = "select id,bookname,bookprice,discount from booklist where listcode={$id}";
		$rows = fetchAll($sql);
	}else{
		exit("没有此书单信息！！请联系管理员添加！");
	}
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/buyBook.css" />
		<script src="js/zepto.min.js"></script>
	</head>

	<body>
		<div class="header">
			<div class="header_con">
				<div class="logo"></div>
				<div class="title"></div>
			</div>
		</div>
		<div class="bookHead">
			<div class="bookListName">大二上学年书单</div>
			<div class="stuInfo">
				<span class="stuName">名字：</span>
				<input type="text" name="stuName" onblur="onBlur($(this))" id="stuName" />
				<span class="stuNum">学号：</span>
				<input type="text" name="stuNum" onblur="onBlur($(this))" id="stuNum" />
				<div class="btn small buy" id="buy" onclick="javascript:document.getElementById('buyList').submit();">确定购买</div>
				<div class="btn small buy" id="buy" onclick="checkBook()">查询</div>

			</div>
		</div>

		<div class="bookInfo">
			<form action="doAction.php?act=buy" method="post" id="buyList">
				<!--单本书的详细信息-->
				<?php foreach ($rows as $row):?>
				<div class="book">
					<span class="name">书名:<?php echo $row['bookname'];?></span>
					<span class="price">价格:<?php echo $row['bookprice'];?>元</span>
					<span class="discount">折扣:<?php echo $row['discount'];?>折</span>
					<span class="disPrice">折后单价:<?php echo $row['bookprice']*$row['discount']/10;?>元</span>
					<input type="checkbox" name="<?php echo $row['id'];?>" id="<?php echo $row['id'];?>" />
					<label for="buyBook">购买</label>
				</div>
				<input type="text" name="booklistId" value="<?php echo $id;?>" style="display:none" />
			<?php endforeach;?>
				<input type="text" id="username" name="username" style="display:none" />
				<input type="text" id="usernum" name="usernum" style="display:none" />
			</form>
		</div>
	</body>
	
	<script type="text/javascript">
		var arr = ['12','11'];
		console.log($("#12"));
		console.log($("#"+arr[0]));
		//$('#12').attr("checked","check");
		function onBlur($this){
			var value = $this[0].value;
			if($this[0].name == "stuName"){
				$('#username').val(value);
			}
			if($this[0].name == "stuNum"){
				$('#usernum')[0].value=value;
			}
		}
		
		function checkBook(){
			var uNum = $("#stuNum")[0].value;
			//console.log($(".book input")[0]);
			var len = $(".book input").length;
			//$(".book input")[0].checked = "checked";
			console.log(uNum)
			$.ajax({
				type: 'post',
				url: 'doAction.php',
				data: {act: 'checkBook',usernum: uNum},
				dataType: 'json',
				success: function(data){
					console.log('success');
					console.log(data.length);
					//console.log($("#"+data));
					var username = data[0];
					data.shift();
					$("#stuName")[0].value = username;
					for(var j = 0; j < len; j++){
						$(".book input")[j].checked = "";
					}
					for(var i = 0; i < data.length; i++){
						$("#"+data[i])[0].checked = "checked";
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
					alert('没有此用户信息！！');
				}
			});
		}
		
	</script>

</html>