-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-02-19 14:22:06
-- 服务器版本： 10.0.16-MariaDB
-- PHP Version: 5.4.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `helper`
--

-- --------------------------------------------------------

--
-- 表的结构 `administrator`
--

create database `xingHelper`;
use xingHelper;

CREATE TABLE IF NOT EXISTS `administrator` (
  `adminID` int(10) unsigned zerofill NOT NULL,
  `admincode` varchar(30) NOT NULL,
  `admininfo` varchar(30) NOT NULL,
  `adminphone` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `booklist`
--

CREATE TABLE IF NOT EXISTS `booklist` (
  `bid` int(10) NOT NULL,
  `admincode` varchar(30) NOT NULL,
  `bookname` varchar(50) NOT NULL,
  `bookprice` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `userlist`
--

CREATE TABLE IF NOT EXISTS `userlist` (
  `uid` int(10) NOT NULL,
  `admincode` varchar(30) NOT NULL,
  `usernum` int(11) NOT NULL,
  `userbooknum` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `booklist`
--
ALTER TABLE `booklist`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `adminID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `booklist`
--
ALTER TABLE `booklist`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

use xingHelper;
desc administrator;
ALTER table administrator drop booklistname;

alter table booklist add booklistname varchar(50);
set names gbk;
select * from booklistname;
desc booklist;
delete from booklist where bid=2;
insert booklist (bookName,bookprice,discount) values ('asd','1','1');
alter table booklist drop booklistname;
alter table booklist add id int(10);
alter table booklist change id id int not null auto_increment primary key;
alter table `booklist` modify `id` int(10) NOT NULL AUTO_INCREMENT;
alter table `administrator` add booklistname varchar(50);

drop table `booklistname`;
create table `booklistname` (
	`id` int(10) not null auto_increment primary key,
    `adminncode` varchar(30) not null,
    `booklistname` varchar(50) not null
);
select * from booklistname;

select * from booklist;
delete from booklist where id=3;
