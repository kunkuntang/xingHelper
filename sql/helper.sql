create database `xingHelper`;
use xingHelper;

select * from administrator;
desc administrator;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

create table `administrator` (
	`username` varchar(50) not null unique ,
    `password` varchar(50) not null,
    `id` int(10) not null auto_increment primary key 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `booklist`
--
desc booklist;
select * from booklist;
desc booklist;
CREATE TABLE IF NOT EXISTS `booklist` (
  `id` int(10) NOT NULL auto_increment primary key,
  `listcode` int(10) not null,
  `bookname` varchar(50) NOT NULL,
  `bookprice` int(10) NOT NULL,
  `discount` tinyint(3),
  `buyNum` int(10) not null default 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `userlist`
--
desc userlist;
CREATE TABLE IF NOT EXISTS `userlist` (  
  `username` varchar(20) NOT NULL,
  `usernum` int(50) NOT NULL,
  `bookid` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



desc booklistname;
create table `booklistname` (
	`id` int(10) not null auto_increment primary key,
    `adminncode` varchar(30) not null,
    `booklistname` varchar(50) not null,
    `url` varchar(20) not null
)ENGINE=MyISAM DEFAULT CHARSET=utf8;