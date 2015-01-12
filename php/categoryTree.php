<?php
/* 
 * 
          sql
             /   \
    postgresql    oracle-----__
        |        /    |        \
     linux   solaris  linux   windows
                     /     \
                  glibc1   glibc2
 * 
 * 1)
 * create table categories (
 *  id serial, //autoincrementing int
 *  parent_id int8,
 *  name text not null default '',
 *  primary key (id)
 * );
 * 
 * create unique index ui_categorytable (parent_id , name);
 * alter table category add foreign key (parent_id) references categories (id)
 * 
 * 2)
 * create table categories (
 *  id BIGINT, 
 *  name text not null default '',
 *  primary key (id)
 * );
 * 
 * create table relationship (
 *  first_id BIGINT,
 *  second_id BIGINT,
 *  depth TINYINT,
 *  primary key (first_id , second_id)
 * );
 * 
 * alter table relationship add foreign key (first_id)  references categories (id);
 * alter table relationship add foreign key (second_id) references categories (id);
 * 
              sql
             /   \
    postgresql    oracle-----__
        |        /    |        \
     linux   solaris  linux   windows
                     /     \
                  glibc1   glibc2
 * catagory:
 * id | name
 * ---------
 * 1  | sql
 * 2  | postgresql
 * 3  | oracle
 * 4  | 
 * 
 */



