create database bbs;

grant all on bbs.* to bbsadmin@192.168.33.10 identified by '12345678';

use bbs

create table users (
  id int not null auto_increment primary key,
  name varchar(50) unique,
  password varchar(50),
  created_at datetime,
  modified_at datetime
);

desc users;
