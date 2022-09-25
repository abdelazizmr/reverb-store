use database e_commerce_store
create table admins(
	admin_id int(9) primary key auto_increment not null,
	admin_name varchar(255) not null,
	admin_email varchar(255) not null,
    admin_phone int(11) not null,
    admin_username varchar(255) not null,
    admin_password varchar(255) not null
);

create table clients(
	client_id  int(9) primary key auto_increment not null,
    client_name varchar(255) not null,
	client_email varchar(255) not null,
    client_phone int(11) not null,
    client_adress varchar(255) not null,
    client_username varchar(255) not null,
    client_password varchar(255) not null
);

create table products(
	product_id  int(9) primary key auto_increment not null,
    product_name varchar(255) not null,
	price int(11) not null,
    points int(11) not null default 0,
    quantity_in_stock int(11) not null,
    shipping_price int(11) not null,
    product_description varchar(255)
);

create table orders(
	order_id  int(9) primary key auto_increment not null,
    product_id int not null,
	client_id int not null ,
    order_status varchar(20) not null,
    order_date datetime
);
