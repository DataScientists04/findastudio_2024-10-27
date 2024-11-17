CREATE DATABASE find_a_studio;

CREATE OR REPLACE TABLE find_a_studio.studio (
    StudioID int Not Null AUTO_INCREMENT,
    Studio_name varchar(32) Not Null,
    City varchar(32),
    Postal_code varchar(4),
    Street varchar (40),
    street_no int,
    Type varchar(16),
    Price int,
    
    PRIMARY KEY(StudioID));
    
 CREATE OR REPLACE TABLE find_a_studio.user (
     UserID int Not Null AUTO_INCREMENT,
     First_Name varchar(24),
     Last_Name varchar(24),
     Email varchar(40),
     Phone_number varchar(24),
     User_Password varchar(64),
     
     PRIMARY KEY (UserID));
     
CREATE OR REPLACE TABLE find_a_studio.reservation (
    ReservationID int Not Null AUTO_INCREMENT,
    Reservation_Date date,
    UserID int,
    StudioID int,
    
    PRIMARY KEY(ReservationID),
    FOREIGN KEY(UserID) REFERENCES USER(UserID),
    FOREIGN KEY(StudioID) REFERENCES STUDIO(StudioID));