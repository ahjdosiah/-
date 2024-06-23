CREATE TABLE `baseinfo` (
  `cfs` int(11) NOT NULL COMMENT '车位分区数量',
  `cws` int(11) NOT NULL COMMENT '每个分区车位数量',
  `ls` int(11) NOT NULL COMMENT '小区楼栋数',
  `dys` int(11) NOT NULL COMMENT '楼栋单元数',
  `cs` int(11) NOT NULL COMMENT '单元层数',
  `hs` int(11) NOT NULL COMMENT '层户数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO baseinfo (cfs, cws, ls, dys, cs, hs) VALUES
(%s, %s, %s, %s, %s, %s);


CREATE TABLE `blackcar` (
  `carID` varchar(10) NOT NULL,
  `time` datetime NOT NULL,
  `punish` text NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`carID`),
  UNIQUE KEY `carID` (`carID`),
  UNIQUE KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO blackcar (carID, time, punish, reason) VALUES
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s);


CREATE TABLE `carinfo` (
  `carID` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `brand` varchar(10) NOT NULL,
  PRIMARY KEY (`carID`),
  UNIQUE KEY `carID` (`carID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO carinfo (carID, color, brand) VALUES
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s),
(%s, %s, %s);


CREATE TABLE `fees` (
  `timeType` float NOT NULL,
  `fee` float NOT NULL,
  PRIMARY KEY (`timeType`),
  UNIQUE KEY `timeType` (`timeType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO fees (timeType, fee) VALUES
(%s, %s),
(%s, %s),
(%s, %s),
(%s, %s),
(%s, %s),
(%s, %s);


CREATE TABLE `manager` (
  `username` varchar(20) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `isadmin` tinyint(1) DEFAULT '0',
  `loginTime` datetime DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO manager (username, passwd, isadmin, loginTime) VALUES
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s);


CREATE TABLE `maninfo` (
  `name` varchar(10) NOT NULL,
  `stallID` varchar(5) NOT NULL,
  `carID` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `taoc` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address`),
  UNIQUE KEY `address` (`address`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO maninfo (name, stallID, carID, phone, address, taoc) VALUES
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s);


CREATE TABLE `parkingnote` (
  `stallID` varchar(5) NOT NULL,
  `carID` varchar(10) NOT NULL,
  `carIn` datetime NOT NULL,
  `carOut` datetime DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL COMMENT '时间段',
  `money` int(11) DEFAULT '0',
  PRIMARY KEY (`stallID`),
  UNIQUE KEY `carIn` (`carIn`),
  UNIQUE KEY `carOut` (`carOut`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO parkingnote (stallID, carID, carIn, carOut, time, money) VALUES
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s),
(%s, %s, %s, %s, %s, %s);


CREATE TABLE `stall` (
  `stallID` varchar(5) NOT NULL,
  `carID` varchar(10) DEFAULT NULL COMMENT '车牌',
  `space` varchar(30) DEFAULT NULL,
  `isfixed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stallID`),
  UNIQUE KEY `stallID` (`stallID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO stall (stallID, carID, space, isfixed) VALUES
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s),
(%s, %s, %s, %s);


