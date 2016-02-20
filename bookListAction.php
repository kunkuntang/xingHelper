<?php
header("Content-type:text/html;charset=utf-8");
require_once 'lib/mysql.func.php';
$isLink = connect();
if(!$isLink){
	exit("数据库转接失败！");
}


function saveBookList($arr){
	//var_dump($arr);
	print_r($arr);
	$bookSumNum = $arr['bookSumNum'];
	$bookListName = $arr['bookListName'];
	$sql = "insert booklistname (booklistname) values ('{$bookListName}')";
	$result = mysql_query($sql);
	if(!$result)	exit("插入书名出错！");
	for($i=1;$i<=$bookSumNum;$i++){
		$bookArray['book'.$i]['bookName']=$arr['bookName'.$i];
		$bookArray['book'.$i]['bookprice']=$arr['price'.$i];
		$bookArray['book'.$i]['discount']=$arr['discount'.$i];
		//$bookArray['book'.$i]['bookName']=$arr['bookName'.$i];
	}
	foreach ($bookArray as $array => $val) {
		print_r($array);
		$result = insert("booklist",$bookArray[$array]);
		if(!$result)	exit("插入数据出错！");
	}
	return $result;
}