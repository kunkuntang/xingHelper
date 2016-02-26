<?php
	require_once 'lib/mysql.func.php';
	require_once 'lib/alertMes.php';
	$isLink = connect();
	if(!$isLink){
		exit("数据库转接失败！");
	}
	$adminId = $_REQUEST['adminId'];//接收传来的用户Id
	$id = $_REQUEST['id'];//接受传来的书单id
	$sql = "select booklistname,url from booklistname where id={$id}";
	$listname = fetchOne($sql);

	$sql = "select * from booklist";
	$totalRow = getResultRow($sql);
	if($totalRow){
		$sql = "select bookname,bookprice,discount,buynum,id from booklist where listcode={$id}";
		
		$booklist = fetchAll($sql);
	}else{
		$booklist = array();
		//alertMes("没有此书单的任何信息！！请添加！","addBookList.html");
	}
	$totalPrice = null;
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/checkBookList.css" />
	</head>

	<body>
		<div class="header">
			<div class="header_con">
				<div class="logo"></div>
				<div class="title"></div>
			</div>
		</div>
		<div class="body">
			<!--书单名-->
			<div class="title"> 
				<div class="btn middle publish" id="publish">发布</div>
				<a class="back" href="adIndex.php?adminId=<?php echo $adminId;?>">返回</a>
				<span class="bookListName"><?php echo $listname['booklistname'];?></span>
				<span class="link">链接：<?php echo $listname['url'];?></span>
			</div>
			<!--书单-->
			<div class="bookInfo">
				<!--单本书的详细信息-->
				<?php $i = 0; foreach ($booklist as $row):?>
				<div class="book">
					<span class="name">书名:<?php echo $row['bookname'];?></span>
					<span class="price">价格:<?php echo $row['bookprice'];?>元</span>
					<span class="discount">折扣:<?php echo $row['discount'];?>折</span>
					<span class="disPrice">折后单价:<?php echo ($row['discount']*$row['bookprice']/10);?>元</span>
					<span class="num">人数:<?php echo $row['buynum'];?>人</span>
					<span class="sumPrice">折后总价:<?php echo $row['buynum']*$row['discount']*$row['bookprice']/10;?>元</span>
					<a href="javascript:void(0);" class="show" index="">展开︾</a>
				</div>
				<!--学生姓名学号-->
				<div class="stuInfo" id="stuInfo<?php echo $i++;?>">
					<?php 
						$sql = "select username,usernum from userlist where bookid={$row['id']}";
						$users =@ fetchAll($sql);
					foreach ($users as $user):?>
					<span class="stuName">姓名：<?php echo $user['username'];?></span><span class="stuNum">学号：<?php echo $user['usernum'];?></span>
				<?php  endforeach;?>	
				</div>
				<?php  endforeach;?>
			</div>
			<!--底下总价栏-->
			<div class="sumPriceCon" style="display:block">
				<span class="allSumPrice">总价：200元</span>
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
		
			<script src="js/zepto.min.js"></script>
			<script type="text/javascript">
				var dialog = document.getElementById('dialog');
				var publish = document.getElementById('publish');
				var clsoeBtn = document.getElementById('close');
				var maskCon = document.getElementById('mask');
				publish.onclick = function(){
					/*maskCon.style.zIndex = 1;*/
					$.ajax({
						type: 'post',
						url: 'doAction.php',
						data: {act: 'publish',id: <?php echo $id;?>},
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
			
			<script type="text/javascript">
				window.onload=function(){
					var stu = $('.stuInfo span');
					var stuNum = Math.ceil(stu.length/4);
					var showBtn = $('.show');
					var stuInfo = $('.stuInfo');
					var isShow = true;

					for(var i = 0; i < showBtn.length; i++){
						showBtn[i].index = i;
						showBtn[i].onclick = function(){
							var index = $(this)[0].index;
							if(isShow){
								stuInfo[index].style.borderBottom = '1px solid #000000';
								stuInfo[index].style.height = stuNum*55 + 'px';
								stuInfo[index].style.opacity = 1;
								isShow = false;
							}else{
								stuInfo[index].style.borderBottom = '1px solid #ffffff';
								stuInfo[index].style.height = 0 + 'px';
								stuInfo[index].style.opacity = 0;
								isShow = true;
							}
						};
					}
				};
			</script>
	</body>

</html>