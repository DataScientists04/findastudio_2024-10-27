INSERT INTO user (First_Name,	Last_Name,	Email,	Phone_number,	User_Password) VALUES
('Sepp', 'Gruber', 'sepp.g@email.com', '+43 1234 56789', 'password1'),
('Hansi', 'Reiter', 'hansi.r@email.com', '+43 2234 56789', 'password1'),
('Franz', 'Hauser', 'franz.h@email.com', '+43 3234 56789', 'password1');

INSERT INTO studio (StudioID, Studio_name, City, Postal_code, Street, Street_no, Type, Price) VALUES
(1, 'SoundLab Vienna', 'Wien', '1010', 'Singerstraße', '10', 'Rehearsal', 25.00),
(2, 'Vienna Beat', 'Wien', '1020', 'Praterstraße', '15', 'Rehearsal', 30.00),
(3, 'Rockhouse Vienna', 'Wien', '1030', 'Rennweg', '35', 'Recording', 45.00),
(4, 'Echo Chamber', 'Wien', '1040', 'Favoritenstraße', '20', 'Rehearsal', 28.00),
(5, 'Music Loft', 'Wien', '1050', 'Margaretenstraße', '50', 'Recording', 40.00),
(6, 'Bassline Studios', 'Wien', '1060', 'Mariahilferstraße', '89', 'Rehearsal', 35.00),
(7, 'Groove Room', 'Wien', '1070', 'Neubaugasse', '23', 'Recording', 50.00),
(8, 'Jam Space Vienna', 'Wien', '1080', 'Josefstädter Straße', '12', 'Rehearsal', 27.00),
(9, 'Studio A1', 'Wien', '1090', 'Alser Straße', '45', 'Recording', 55.00),
(10, 'Harmony Hub', 'Wien', '1100', 'Laxenburger Straße', '78', 'Rehearsal', 26.00),
(11, 'Sound Space', 'Wien', '1110', 'Simmeringer Hauptstraße', '120', 'Recording', 42.00),
(12, 'Vienna Sound Studio', 'Wien', '1120', 'Meidlinger Hauptstraße', '55', 'Rehearsal', 32.00),
(13, 'Music Hive', 'Wien', '1130', 'Hietzinger Hauptstraße', '22', 'Recording', 60.00),
(14, 'EchoPoint', 'Wien', '1140', 'Linzer Straße', '10', 'Rehearsal', 29.00),
(15, 'Studio Vienna West', 'Wien', '1150', 'Wiener Straße', '3', 'Recording', 48.00);

INSERT INTO reservation (ReservationID, Reservation_Date, UserID, StudioID) VALUES
(NULL, '2024-11-11', '3', '4'),
(NULL, '2024-11-12', '3', '4'),
(NULL, '2024-11-13', '3', '4'),
(NULL, '2024-11-14', '3', '4'),
(NULL, '2024-11-15', '3', '4'),
(NULL, '2024-11-16', '3', '4');
