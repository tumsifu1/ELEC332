drop database if exists restaurantDB;
create database restaurantDB;
/*need to ad not nulls*/
/*strong entities */

CREATE TABLE employee(
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    email VARCHAR(255),
    ID integer not null, 
    primary key(ID)
    );

CREATE TABLE restaurant(
    restaurantName VARCHAR(50) not null,
    URL VARCHAR(255),
    primary key(restaurantName),
    city VARCHAR(255),
    street VARCHAR(255),
    zip VARCHAR(255),
);


CREATE TABLE chef(
    credentials VARCHAR(50) not null,
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
    nameFood VARCHAR(50) not null,
    primary key(name)
);

CREATE TABLE Order(
    ID integer not null,
    totalPrice decimal,
    tip decimal,
    primary key(ID)
);

CREATE TABLE customerAccount(
    creditAmount decimal,
    paymentDate date,
    email VARCHAR(255) not null,
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    cellNum integer, 
    city VARCHAR(255),
    street VARCHAR(255),
    zip VARCHAR(255),
    primary key(email),
);


/* weak entitie */

CREATE TABLE payment(
    paymentDate date not null,
    paymentAmount decimal not null,
    primary key(paymentDate, customerEmail)
    foreign key customerEmail references customerAccount(email) on delete cascade 
);

CREATE TABLE shift(
    shiftDay date not null,
    startTime time,
    endTime time,
    primary key (employeeID, shiftDay),
    foreign key (employeeID) references employee(id) on delete cascade
);


/*relationships */
/* N to M */

Create TABLE employeeRelatedTo(
    relationshipType VARCHAR(50) not null,
    primary key(employeeID, customerEmail),
    foreign key employeeID references employee(ID),
    foreign key customerEmail references customerAccount(email) on delete cascade

);

Create TABLE orderContains(
    primary key(orderID, foodName),
    foreign key orderID references Order(ID),
    foreign key foodName references foodItem(name) on delete cascade
);

Create TABLE restaurantOffers(
    price decimal not null,
    primary key(foodName, restaurantName)
    foreign key foodName references foodItem(name)
    foreign key restaurantName references restaurant(restaurantName) on delete cascade

);

/* N to 1 do we delete on cascade*/
Create TABLE employeeScheduled(
    primary key(employeeID),
    foreign key employeeID references employee(ID) on delete cascade
);

Create TABLE employeeWorks(
    primary key(restaurantName),
    foreign key restaurantName references restaurant(restaurantName) on delete cascade
);

Create TABLE DeliverdBy(
    timeDelivered time not null,
    primary key(employeeID),
    foreign key employeeID references delivery(employeeID) on delete cascade
);

Create TABLE customerMakesPayment(
    primary key(customerEmail),
    foreign key customerEmail references customerAccount(email) on delete cascade
);

/*1 to 1 */
CREATE TABLE customerPlaces(
    timePlace time,
    primary key(customerEmail)
    foreign key customerEmail references customerAccount(email) on delete cascade

);



