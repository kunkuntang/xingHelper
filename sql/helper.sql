use xingHelper;

CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(10) unsigned NOT NULL auto_increment primary key,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- 表的结构 `booklist`
--
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

CREATE TABLE IF NOT EXISTS `userlist` (  
  `username` varchar(20) NOT NULL,
  `usernum` int(50) NOT NULL,
  `bookid` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

create table `booklistname` (
  `id` int(10) not null auto_increment primary key,
    `admincode` varchar(30) not null,
    `booklistname` varchar(50) not null,
    `url` varchar(20) not null
)ENGINE=MyISAM DEFAULT CHARSET=utf8;
