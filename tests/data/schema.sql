create table products (
    id integer primary key autoincrement,
    name varchar(255) not null,
    price float not null,
    quantity int not null,
    total float not null
);