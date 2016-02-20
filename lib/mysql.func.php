<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PWD", "root");
define("DB_CHARSET", "gbk");
define("DB_DBNAME", "xingHelper");

/*
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PWD = "root";
$DB_CHARSET = "utf-8";
$DB_DBNAME = "xingHelper";
*/

//连接数据库
function connect(){
	$link = mysql_connect(DB_HOST,DB_USER,DB_PWD) or die("数据库打开失败Error:".mysql_errno().":".mysql_error());
	mysql_set_charset(DB_CHARSET);
	mysql_select_db(DB_DBNAME) or die("指定数据库打开失败！");
	return $link;
}

//插入数据库操作
function insert($table,$array){
	//insert $table (AAA,BBB,CCC) values ('aaa','bbb','ccc');
	$keys=join(",",array_keys($array));
	$vals="'".join("','",array_values($array))."'";
	$sql = "insert {$table} ({$keys}) values ({$vals})";
	mysql_query($sql);
	return mysql_insert_id();
}

//更新操作
function update($table,$array,$where = null){
	//update $table set AAA='aaa', BBB='bbb', CCC='ccc'; 
	//update $table set AAA='aaa', BBB='bbb', CCC='ccc' where id='number';  id='number'即是$where;
	foreach ($array as $key => $val) {
		if($str==null){
			$sep="";
		}else{
			$sep=",";
		}
		$str.=$sep.$key."='".$val."'";
	}
	$sql = "update {$table} set {$str} ".($where=null?null:"where ".$where);
	$result = mysql_query($sql);
	if($result){
		return mysql_affected_rows();
	}else{
		return false;
	}
}

//删除数据
function delete($table,$where=null){
	$where = $where==null?null:" where".$where;
	//delete from $table where id = 'number';
	$sql = "delete from {$table} {$where}";
	mysql_query($sql);
	return mysql_affected_rows();
}

//得到指定一条记录
function fetchOne($sql,$result_type=MYSQL_ASSOC){
	//$sql="select id,username,password,email from ${table} where id='{$id}'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($resul,$result_type);
	return $row;
}

//得到结果集中的所有记录
function fetchAll($sql,$result_type=MYSQL_ASSOC){
	//$sql="select id,username,email from ${table} limit {$offset},{$pageSize}";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result,$result_type)) {
		$rows[] = $row;
	}
	return $rows;
}

//得到结果集中的条数
function getResultRow($sql){
	//$sql = "select * from ${table}";
	$result = mysql_query($sql);
	return mysql_num_rows($result);
}

//得到上一部插入记录的ID号
function getInsertId(){
	return mysql_insert_id();
}