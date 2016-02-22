<?php
header("Content-type:text/html;charset=utf-8");
require_once 'bookListAction.php';
require_once 'lib/alertMes.php';
$act = $_REQUEST['act'];
$id =@ $_REQUEST['id'];
$arr = $_REQUEST;

if($act == 'publish'){

}elseif($act == 'save'){
	$result = saveBookList($arr);
	if($result){
		alertMes("保存成功！", "adIndex.php");
	}else{
		alertMes("保存失败！", "adIndex.php");
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
	//echo $sql;
	$isDelBookList = mysql_query($sql);
	$sql = "delete from booklist where id={$id}";
	$isDelListName = mysql_query($sql);
	if($isDelBookList && $isDelListName){  
	 	mysql_query("COMMIT");  
		alertMes("删除成功！","adIndex.php");
	}else{  
		mysql_query("ROLLBACK");  
		alertMes("删除失败！","adIndex.php");
	}
	mysql_query("END");
	
}elseif($act == 'edit'){
	mysql_query("BEGIN");
	updateListName($id,$arr);

	mysql_query("COMMIT");
	mysql_query("END");
}