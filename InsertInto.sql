/* Populating the employee table with 10 records */
INSERT INTO employee (firstName, lastName, email, ID)
VALUES
    ('John', 'Doe', 'johndoe@gmail.com', 14),
    ('Jane', 'Doe', 'janedoe@gmail.com', 2),
    ('Bob', 'Smith', 'bobsmith@gmail.com', 3),
    ('Alice', 'Johnson', 'alicejohnson@gmail.com', 4),
    ('David', 'Lee', 'davidlee@gmail.com', 5),
    ('Karen', 'Brown', 'karenbrown@gmail.com', 6),
    ('Mark', 'Taylor', 'marktaylor@gmail.com', 7),
    ('Emily', 'Wilson', 'emilywilson@gmail.com', 8),
    ('Peter', 'Nguyen', 'peternguyen@gmail.com', 9),
    ('Cindy', 'Chen', 'cindychen@gmail.com', 10);

/* Populating the restaurant table with 3 records */
INSERT INTO restaurant (restaurantName, URL, city, street, zip)
VALUES
    ('Mamma Mia Pizzeria', 'www.mammamiapizzeria.com', 'New York', '123 Main St', '10001'),
    ('Sushi Time', 'www.sushitime.com', 'Los Angeles', '456 Oak Ave', '90001'),
    ('Taco Tuesday', 'www.tacotuesday.com', 'Miami', '789 Pine St', '30001');

/* Populating the chef table with 5 records */
INSERT INTO chef (employeeID, credentials)
VALUES
    (1, 'Certified Pizzaiolo'),
    (2, 'Sushi Master'),
    (3, 'Executive Chef'),
    (4, 'Culinary Arts Degree'),
    (5, 'Asian Cuisine Specialist');

/* Populating the delivery table with 3 records */
INSERT INTO delivery (employeeID)
VALUES
    (6),
    (7),
    (8);

/* Populating the service table with 4 records */
INSERT INTO service (employeeID)
VALUES
    (4),
    (5),
    (9),
    (10);

/* Populating the management table with 2 records */
INSERT INTO management (employeeID)
VALUES
    (2),
    (3);

/* Populating the foodItem table with 5 records */
INSERT INTO foodItem (foodName)
VALUES
    ('Margherita Pizza'),
    ('California Roll'),
    ('Grilled Salmon'),
    ('Beef Teriyaki'),
    ('Taco Salad');

/* Populating the orders table with 4 records */
INSERT INTO orders (ID, totalPrice, tip)
VALUES
    (1, 25.99, 5.00),
    (2, 45.50, 8.00),
    (3, 32.75, 6.50),
    (4, 18.99, 3.00);

/* Populating the customerAccount table with 6 records */
INSERT INTO customerAccount 
    (creditAmount, paymentDate, email, firstName, lastName, cellNum, city, street, zip)
VALUES 
    (500.00, '2023-02-17', 'johndoe@example.com', 'John', 'Doe', 5551234, 'New York', 'Main St', '10001'),
    (1000.00, '2023-02-17', 'janedoe@example.com', 'Jane', 'Doe', 5555678, 'San Francisco', 'Market St', '94103'),
    (750.00, '2023-02-16', 'bobsmith@example.com', 'Bob', 'Smith', 5559876, 'Los Angeles', 'Hollywood Blvd', '90028');

INSERT INTO payment(paymentDate, paymentAmount, customerEmail) VALUES
('2022-01-01', 20.00, 'customer1@example.com'),
('2022-01-02', 15.50, 'customer2@example.com'),
('2022-01-03', 40.00, 'customer3@example.com'),
('2022-01-04', 18.25, 'customer4@example.com'),
('2022-01-05', 30.00, 'customer5@example.com');

INSERT INTO shift(shiftDay, employeeID, startTime, endTime) VALUES
('2022-01-01', 1, '09:00:00', '17:00:00'),
('2022-01-02', 2, '08:00:00', '16:00:00'),
('2022-01-03', 3, '11:00:00', '19:00:00'),
('2022-01-04', 4, '12:00:00', '20:00:00'),
('2022-01-05', 5, '14:00:00', '22:00:00');

