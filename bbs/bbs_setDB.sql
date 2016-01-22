create table bbs(
  id integer primary key autoincrement,
  time integer,
  message text
);

create table reviews(
  id integer primary key autoincrement,
  username text,
  q1 integer,
  q2 integer,
  q3 integer,
  q4 integer,
  q5 integer,
  q6 integer,
  q7 integer,
  q8 integer,
  q9 integer,
  q10 integer);
  
