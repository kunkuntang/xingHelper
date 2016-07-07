<?php
header("Content-type:text/html;charset=utf-8");
require_once 'lib/mysql.func.php';
require_once 'lib/alertMes.php';
$isLink = connect();
if(!$isLink){
	exit("数据库转接失败！");
}


function saveBookList($arr,$adminId){
	//var_dump($arr);
	//print_r($arr);
	/*for($i=21;$i<=29;$i++){
		$sql = "delete from bookListname where id={$i}";
		mysql_query($sql);
	}
	exit();*/
	$bookSumNum = $arr['bookSumNum'];
	$bookListName = $arr['bookListName'];
	$sql = "insert booklistname (booklistname,admincode) values ('{$bookListName}','{$adminId}')";
	echo $sql;
	die();
	mysql_query($sql);
	$bookListId = mysql_insert_id();
	if(!$bookListId)	alertMes("插入书名出错！","adIndex.php");

	/*$sql = "insert booklist (listcode) values ('{$bookListId}')";
	mysql_query($sql);
	$result = mysql_insert_id();
	if($result)	exit("插入书名号出错！");*/

	for($i=1;$i<=$bookSumNum;$i++){
		$bookArray['book'.$i]['bookName']=$arr['bookName'.$i];
		$bookArray['book'.$i]['bookprice']=$arr['price'.$i];
		$bookArray['book'.$i]['discount']=$arr['discount'.$i];
		$bookArray['book'.$i]['listcode']=$bookListId;
	}
	foreach ($bookArray as $array => $val) {
		print_r($array);
		$result = insert("booklist",$bookArray[$array]);
		if(!$result)	alertMes("插入数据出错！","adIndex.php?adminId={$adminId}");
	}
	return $result;
}

function deleteBookList($id){
	if(delete("booklist","id={$id}")){
		$mes = true;
	}else{
		$mes = false;
	}
	return $mes;
}

function deleteListName($id){
	if(delete("booklistname","id={$id}")){
		$mes = true;
	}else{
		$mes = false;
	}
	return $mes;
}

function updateListName($id,$arr){
	mysql_query("BEGIN");
	//print_r($arr);
	echo "<br/>";
	$bookSumNum = $arr['bookSumNum'];
	$bookListName = $arr['bookListName'];
	$sql = "update booklistname set booklistname='{$bookListName}' where id={$id}";
	//echo $sql;
	$result1 = mysql_query($sql);
	
	//if(!$result1)	alertMes("插入书名出错！","adIndex.php");
	
	for($i=1;$i<=$bookSumNum;$i++){
		$bookArray['book'.$i]['bookName']=$arr['bookName'.$i];
		$bookArray['book'.$i]['bookprice']=$arr['price'.$i];
		$bookArray['book'.$i]['discount']=$arr['discount'.$i];
		$bookArray['book'.$i]['id']=$arr['bookListId'.$i];;
	}
	print_r($bookArray);
	
	
	foreach ($bookArray as $array => $val) {
		print_r($bookArray[$array]);
		//exit();
		$result2 = update("booklist",$bookArray[$array],"id={$bookArray[$array]['id']}");
	}
	if($result1 && $result2){
		mysql_query("COMMIT");
	alertMes("修改成功！","adIndex.php");	
	}else{
		mysql_query("ROLLBACK");
		alertMes("插入数据出错！","adIndex.php");
	}
	mysql_query("END");
}