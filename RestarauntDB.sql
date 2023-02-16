drop database if exists restaurantDB;
create database restaurantDB;

CREATE TABLE EmployeesSchedule(
    date date, 
    nurseID integer,
    startTime time,
    endTime time,
    primary key (employeeID, date),
    foreign key (employeeID) references employee(id) on delete cascade);
);

CREATE TABLE employee(
    firstName varchar(50),
    lastName varchar(50),
    email varchar(255),
    ID integer, 

    );

CREATE TABLE chef(
    credentials VARCHAR(50),
    primary key (employeeID, credentials),
    foreign key (employeeID) references employee(id) on delete cascade
);

CREATE TABLE ChefCredentials(
    credentials VARCHAR(50),
    primary key (employeeID, credentials),
    foreign key (employeeID) references employee(id) on delete cascade
);

CREATE TABLE delivery(
    primary key (employeeID),
    foreign key (employeeID) references employee(id) on delete cascade
);

CREATE TABLE server(
    primary key (employeeID),
    foreign key (employeeID) references employee(id) on delete cascade
);

CREATE TABLE management(
    primary key (employeeID),
    foreign key (employeeID) references employee(id) on delete cascade
);

CREATE TABLE foodItem(
    price decimal,
    name varchar(50),
    primary key(name)
);

CREATE TABLE restaurant(
    restaurantName varchar(50),
    url varchar(255),
    address VARCHAR(255),
    primary key(restaurantName)
);

CREATE TABLE customer(
    firstName varchar(50),
    lastName varchar(50),
    email varchar(255),
    ID integer, 
    phoneNumber integer,
    primary key(email)

);

CREATE TABLE eachOrder(
    ID integer,
    amount decimal,
    tip decimal,
    deliveryTime time,
    placementTime time,
    primary key(ID)
);

CREATE TABLE account(
    credit decimal,
    paymentDate date,
    primary key(customerName, credit),
    foreign key (customerName) references customer(email) on delete cascade
);

CREATE TABLE onlineMenu(
    

);

CREATE TABLE orderded(

);

CREATE TABLE 

