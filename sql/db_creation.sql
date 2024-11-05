CREATE DATABASE find_my_studio;

CREATE TABLE find_my_studio.studio (
    StudioID int Not Null AUTO_INCREMENT,
    Studio_name varchar(32) Not Null,
    City varchar(32),
    Postal_code varchar(4),
    Street varchar (40),
    street_no int,
    Type varchar(16),
    Price int,
    
    PRIMARY KEY(StudioID));
    
 CREATE TABLE find_my_studio.user (
     UserID int Not Null AUTO_INCREMENT,
     First_Name varchar(24),
     Last_Name varchar(24),
     Email varchar(40),
     Phone_number varchar(24),
     User_Password varchar(64),
     
     PRIMARY KEY (UserID));
     
CREATE TABLE find_my_studio.reservation (
    ReservationID varchar(12),
    Reservation_Date date,
    UserID int,
    StudioID int,
    
    PRIMARY KEY(ReservationID),
    FOREIGN KEY(UserID) REFERENCES USER(userID),
    FOREIGN KEY(StudioID) REFERENCES STUDIO(StudioID));
    
    