<?php
header("Content-type:text/html;charset=utf-8");
require_once 'bookListAction.php';
require_once 'lib/alertMes.php';
$act = $_REQUEST['act'];
$id =@ $_REQUEST['id'];
$adminId =@ $_REQUEST['adminId'];
$arr = $_REQUEST;

if($act == 'publish'){
	$url = "buyBook.php?booklist={$id}";
	$sql = "select url from booklistname where id={$id}";
	$result = fetchOne($sql);
	if($result['url'] == null){
		$sql = "update booklistname set url = 'localhost/xingHelper/{$url}' where id={$id}";
		$result = mysql_query($sql);
		if($result){
			echo $url; 
		}else{
			echo "error";
		}
	}else{
		echo $url;
	}
}elseif($act == 'save'){
	$result = saveBookList($arr,$adminId);
	if($result){
		alertMes("保存成功！", "adIndex.php?adminId={$adminId}");
	}else{
		alertMes("保存失败！", "adIndex.php?adminId={$adminId}");
	}
}elseif($act == 'delList'){
	/*
	没有开启事务，没有回滚
	$isDelBookList = deleteBookList($id);
	$isDelListName = deleteListName($id);
	if($isDelBookList && $isDelListName){
		alertMes("删除成功！","adIndex.php");
	}else{
		alertMes("删除失败！","adIndex.php");
	}
	*/

	//开启了事务，有回滚
	mysql_query("BEGIN");
	$sql = "delete from booklistname where id={$id}";
	$isDelBookList = mysql_query($sql);
	$sql = "delete from booklist where listcode={$id}";
	$isDelListName = mysql_query($sql);
	if($isDelBookList && $isDelListName){  
	 	mysql_query("COMMIT");  
		alertMes("删除成功！","adIndex.php?adminId={$adminId}");
	}else{  
		mysql_query("ROLLBACK");  
		alertMes("删除失败！","adIndex.php?adminId={$adminId}");
	}
	mysql_query("END");
	
}elseif($act == 'edit'){	
	updateListName($id,$arr);
}elseif($act == 'buy'){
	$booklistId = $arr['booklistId'];
	$username = $arr['username'];
	$usernum = $arr['usernum'];
	$sql = "delete from userlist where usernum = {$usernum}";
	mysql_query($sql);
	print_r($arr);
	unset($arr['act']);
	unset($arr['booklistId']);
	unset($arr['username']);
	unset($arr['usernum']);
	foreach ($arr as $key => $val) {
		mysql_query("BEGIN");
		$sql = "select buynum from booklist where id={$key}";
		$buyNum = fetchOne($sql);	
		$buyNum = $buyNum['buynum'] + 1;		
		$sql = "update booklist set buyNum = '{$buyNum}' where id={$key}";
		echo "<br/>";
		echo $sql;
		$result1 = mysql_query($sql);
		$sql = "insert userlist (username,usernum,bookid) values ('{$username}','{$usernum}','{$key}')";
		$result2 = mysql_query($sql);
		echo "<br/>";
		echo $sql;
		
		if($result2 && $result1){
			mysql_query("COMMIT");
			$result = true;
		}else{
			mysql_query("ROLLBACK");
			$result = false;
		}
	}  
	exit();
	if($result){
		alertMes("购买成功！！","buybook.php?booklist={$booklistId}");
	}else{
		alertMes("购买失败！！","buybook.php?booklist={$booklistId}");
	}
}elseif($act == "checkBook"){
	//print_r($arr);
	$usernum = $arr['usernum'];
	$result = array();
	$sql = "select username,bookId from userlist where usernum = {$usernum}";
	//echo $sql;
	$rows = fetchAll($sql);
	//print_r($rows);
	$isName = false;
	foreach ($rows as $row) {
		if(!$isName){
			array_push($result, $row['username']);
			$isName = true;
		}
		array_push($result, $row['bookId']);
	}
	echo json_encode($result);
}elseif($act == 'login'){
	print_r($arr);
	$username = $arr['username'];
	$password = $arr['password'];
	$sql = "select password,id from administrator where username='{$username}'";
	echo $sql;
	$result = fetchOne($sql);
	if($result['password'] == $password){
		alertMes("登录成功！！！","adIndex.php?adminId={$result['id']}");
	}else{
		alertMes("登录失败！！！","login.html");
	}
}elseif($act == "regist"){
	print_r($arr);
	$username = $arr['username'];
	$password = $arr['password'];
	$sql = "insert administrator (username,password) values ('{$username}','{$password}')";
	echo $sql;
	mysql_query($sql);
	$result = mysql_insert_id();
	if($result){
		alertMes("注册成功！请登录","login.html");
	}else{
		alertMes("注册失败！！请重新注册","register.html");
	}
}
