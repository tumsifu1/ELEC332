DROP DATABASE IF EXISTS restaurantDB;
CREATE DATABASE restaurantDB;
USE restaurantDB;
/*need to ad NOT NULLs*/
/*strong entities */

CREATE TABLE employee(
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    email VARCHAR(255),
    ID INTEGER NOT NULL, 
    PRIMARY KEY(ID)
    );

CREATE TABLE restaurant(
    restaurantName VARCHAR(50) NOT NULL,
    URL VARCHAR(255),
    PRIMARY KEY(restaurantName),
    city VARCHAR(255),
    street VARCHAR(255),
    zip VARCHAR(255)
);


CREATE TABLE chef(
    employeeID INTEGER NOT NULL,
    credentials VARCHAR(50) NOT NULL,
    PRIMARY KEY (employeeID, credentials),
    FOREIGN KEY (employeeID) 
        REFERENCES employee(id)
        ON DELETE CASCADE
);

CREATE TABLE delivery(
    employeeID INTEGER NOT NULL,
    PRIMARY KEY (employeeID),
    FOREIGN KEY (employeeID) 
        REFERENCES employee(id)
        ON DELETE CASCADE
);

CREATE TABLE service(
    employeeID INTEGER NOT NULL,
    PRIMARY KEY (employeeID),
    FOREIGN KEY (employeeID) 
        REFERENCES employee(id)
        ON DELETE CASCADE
);

CREATE TABLE management(
    employeeID INTEGER NOT NULL,
    PRIMARY KEY (employeeID),
    FOREIGN KEY (employeeID) 
        REFERENCES employee(id)
        ON DELETE CASCADE
);

CREATE TABLE foodItem(
    foodName VARCHAR(50) NOT NULL,
    PRIMARY KEY(foodName)
);

CREATE TABLE orders(
    ID INTEGER NOT NULL,
    totalPrice DECIMAL,
    tip DECIMAL,
    PRIMARY KEY(ID)
);

CREATE TABLE customerAccount(
    creditAmount DECIMAL,
    paymentDate date,
    email VARCHAR(255) NOT NULL,
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    cellNum INTEGER, 
    city VARCHAR(255),
    street VARCHAR(255),
    zip VARCHAR(255),
    PRIMARY KEY(email)
);


/* weak entity */

CREATE TABLE payment(
    paymentDate date NOT NULL,
    paymentAmount DECIMAL NOT NULL,
    customerEmail VARCHAR(255) NOT NULL,
    PRIMARY KEY(paymentDate, customerEmail),
    FOREIGN KEY (customerEmail)
        REFERENCES customerAccount(email) 
        ON DELETE CASCADE
);

CREATE TABLE shift(
    shiftDay date NOT NULL,
    employeeID INTEGER NOT NULL,
    startTime TIME,
    endTime TIME,
    PRIMARY KEY (employeeID, shiftDay),
    FOREIGN KEY (employeeID) 
        REFERENCES employee(id) 
        ON DELETE CASCADE
);


/*relationships */
/* N to M */

Create TABLE employeeRelatedTo(
    relationshipType VARCHAR(50) NOT NULL,
    employeeID INTEGER NOT NULL,
    customerEmail VARCHAR(255) NOT NULL,
    PRIMARY KEY(employeeID, customerEmail),
    FOREIGN KEY (employeeID)
        REFERENCES employee(ID)
        ON DELETE CASCADE,
    FOREIGN KEY (customerEmail)
        REFERENCES customerAccount(email)
        ON DELETE CASCADE

);

Create TABLE orderContains(
    orderID INTEGER NOT NULL,
    foodName VARCHAR(50) NOT NULL,
    PRIMARY KEY (orderID, foodName),
    FOREIGN KEY (orderID)
        REFERENCES orders(ID) 
        ON DELETE CASCADE,
    FOREIGN KEY (foodName)
        REFERENCES foodItem(foodName)
        ON DELETE CASCADE
        );


Create TABLE restaurantOffers(
    price DECIMAL NOT NULL,
    foodName VARCHAR(50) NOT NULL,
    restaurantName  VARCHAR(50) NOT NULL,
    PRIMARY KEY(foodName, restaurantName),
    FOREIGN KEY (foodName)
        REFERENCES foodItem(foodName),
    FOREIGN KEY (restaurantName) 
        REFERENCES restaurant(restaurantName) 
        ON DELETE CASCADE

);

/* N to 1 do we delete on cascade*/
Create TABLE employeeScheduled(
    employeeID INTEGER NOT NULL,
    PRIMARY KEY(employeeID),
    FOREIGN KEY (employeeID) 
        REFERENCES employee(ID)
        ON DELETE CASCADE
);

Create TABLE employeeWorks(
    restaurantName  VARCHAR(50) NOT NULL,
    PRIMARY KEY(restaurantName),
    FOREIGN KEY (restaurantName)
        REFERENCES restaurant(restaurantName) 
        ON DELETE CASCADE
);

Create TABLE DeliverdBy(
    timeDelivered TIME NOT NULL,
    employeeID INTEGER NOT NULL,
    PRIMARY KEY(employeeID),
    FOREIGN KEY (employeeID)
        REFERENCES delivery(employeeID)
        ON DELETE CASCADE
);

Create TABLE customerMakesPayment(
    customerEmail VARCHAR(255) NOT NULL,
    PRIMARY KEY(customerEmail),
    FOREIGN KEY (customerEmail)
        REFERENCES customerAccount(email)
        ON DELETE CASCADE
);

/*1 to 1 */
CREATE TABLE customerPlaces(
    timePlace TIME,
    customerEmail VARCHAR(255) NOT NULL,
    PRIMARY KEY(customerEmail),
    FOREIGN KEY (customerEmail)
        REFERENCES customerAccount(email)
        ON DELETE CASCADE

);



