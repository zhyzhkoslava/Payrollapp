-- auto-generated definition
create table Payroll
  (
    id         int auto_increment
      primary key,
    name       varchar(50)   null,
    department varchar(50)   null,
    amount     int           null,
    payroll    int default 0 null
  );
