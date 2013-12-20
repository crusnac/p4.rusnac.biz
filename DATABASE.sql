-- Create syntax for '(null)'

-- Create syntax for TABLE 'reports'
CREATE TABLE `reports` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `request_number` int(255) NOT NULL,
  `scanned_url` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `scan_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `filesize` int(255) NOT NULL,
  `created` int(11) NOT NULL,
  `start_time` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `duration` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `vulns_critical` int(11) NOT NULL,
  `vulns_high` int(11) NOT NULL,
  `vulns_medium` int(11) NOT NULL,
  `vulns_low` int(11) NOT NULL,
  `vulns_informational` int(11) NOT NULL,
  `policy` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `file_timestamp` int(255) NOT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB AUTO_INCREMENT=433 DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'users'
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `last_login` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password_token` varchar(255) NOT NULL DEFAULT '',
  `employee_id` varchar(255) NOT NULL DEFAULT '',
  `authorized` int(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
