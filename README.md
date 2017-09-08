# delegator
assign task to others and see track it at one place. no log on required , uses windows logon


# Works with Internet Explorer Only


# features
* track status of task assigned
* search and filter fields easily 
* saves time as no login is required
* simple yet elegant feel


# How to run 

table strucutre and schema can be created using below code


Database: `db_delegator`

Table structure for table `tb_tasks`

CREATE TABLE `tb_tasks` (
  `t_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `work_description` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

Table structure for table `tb_userlist`

CREATE TABLE `tb_userlist` (
  `ul_id` int(11) NOT NULL,
  `ul_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tb_tasks`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `to_id` (`to_id`);


ALTER TABLE `tb_userlist`
  ADD PRIMARY KEY (`ul_id`);


ALTER TABLE `tb_tasks`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `tb_userlist`
  MODIFY `ul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;


ALTER TABLE `tb_tasks`
  ADD CONSTRAINT `tb_tasks_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `tb_userlist` (`ul_id`),
  ADD CONSTRAINT `tb_tasks_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `tb_userlist` (`ul_id`);




