<?php
header("Content-type:text/html;charset=utf-8");
require_once 'bookListAction.php';
require_once 'lib/alertMes.php';
$act = $_REQUEST['act'];
$arr = $_REQUEST;

if($act == 'publish'){

}elseif($act == 'save'){
	$result = saveBookList($arr);
	if($result){
		alertMes("保存成功！", "adIndex.php");
	}else{
		alertMes("保存失败！", "adIndex.php");
	}
}