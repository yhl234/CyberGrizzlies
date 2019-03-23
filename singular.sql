create database CyberGrizzlies;
use CyberGrizzlies;

CREATE TABLE User (
  UserID int(8) unsigned NOT NULL AUTO_INCREMENT,
  UserName varchar(24) NOT NULL,
  FirstName varchar(24) NOT NULL,
  MiddleName varchar(24) DEFAULT NULL,
  LastName varchar(24) NOT NULL,
  StartDate datetime NOT NULL,
  ActiveStatus tinyint(1) NOT NULL,
  PayStatus tinyint(1) NOT NULL,
  Email varchar(64) NOT NULL,
  Phone varchar(13) NOT NULL,
  ChatStatus tinyint(1) NOT NULL,
  DiscordTag varchar(64) DEFAULT NULL,
  PRIMARY KEY (UserID)
);

CREATE TABLE Status (
  StatusID int(8) unsigned NOT NULL AUTO_INCREMENT,
  StatusName varchar(12) NOT NULL,
  PRIMARY KEY (StatusID)
);

CREATE TABLE StreamPlatform (
  StreamPlatformID int(8) unsigned NOT NULL AUTO_INCREMENT,
  StreamPlatformName varchar(12) NOT NULL,
  PRIMARY KEY (StreamPlatformID)
);

CREATE TABLE GamePlatform (
  GamePlatformID int(8) unsigned NOT NULL AUTO_INCREMENT,
  PlatformName varchar(12) NOT NULL,
  PRIMARY KEY (PlatformID)
);

CREATE TABLE Genre (
  GenreID int(8) unsigned NOT NULL AUTO_INCREMENT,
  GenreName varchar(24) NOT NULL,
  PRIMARY KEY (GenreID)
);

CREATE TABLE EventType (
  EventTypeID int(8) unsigned NOT NULL AUTO_INCREMENT,
  TypeName varchar(32) NOT NULL ,
  PRIMARY KEY (EventTypeID)
);

CREATE TABLE Location (
  LocationID int(8) unsigned NOT NULL AUTO_INCREMENT,
  LocationName varchar(32) NOT NULL,
  LocationAddress varchar(64) NOT NULL,
  PRIMARY KEY (LocationID)
);

CREATE TABLE Game (
  GameID int(8) unsigned NOT NULL AUTO_INCREMENT,
  GameName varchar(24) NOT NULL,
  SingleMulti tinyint(1) NOT NULL,
  GenreID int(8) unsigned NOT NULL,
  PRIMARY KEY (GameID),
 CONSTRAINT FOREIGN KEY (GenreID) REFERENCES Genre (GenreID)
);

CREATE TABLE Stream (
  StreamID int(8) unsigned NOT NULL AUTO_INCREMENT,
  StreamLink varchar(100) NOT NULL,
  UserID int(8) unsigned NOT NULL,
  StreamPlatformID int(8) unsigned NOT NULL,
  PRIMARY KEY (StreamID),
CONSTRAINT FOREIGN KEY (UserID) REFERENCES User (UserID),
CONSTRAINT FOREIGN KEY (StreamPlatformID) REFERENCES StreamPlatform (StreamPlatformID)
);

CREATE TABLE Event (
  EventID int(8) unsigned NOT NULL AUTO_INCREMENT,
  EventName varchar(64) NOT NULL,
  EventTypeID int(8) unsigned NOT NULL,
  EventDateTime datetime NOT NULL,
  LocationID int(8) unsigned NOT NULL,
  EventDescription varchar(256) NOT NULL,
  PRIMARY KEY (EventID),
CONSTRAINT FOREIGN KEY (EventTypeID) REFERENCES EventType (EventTypeID),
CONSTRAINT FOREIGN KEY (LocationID) REFERENCES Location (LocationID)
);

CREATE TABLE Player (
  PlayerID int(8) unsigned NOT NULL AUTO_INCREMENT,
  UserID int(8) unsigned NOT NULL,
  GamerTag varchar(64) NOT NULL,
  GameID int(8) unsigned NOT NULL,
  StatusID int(8) unsigned NOT NULL,
  LocationID int(8) unsigned NOT NULL,
  PlatformID int(8) unsigned NOT NULL,
  PRIMARY KEY (PlayerID),
CONSTRAINT FOREIGN KEY (UserID) REFERENCES User (UserID),
CONSTRAINT FOREIGN KEY (GameID) REFERENCES Game (GameID),
CONSTRAINT FOREIGN KEY (StatusID) REFERENCES Status (StatusID),
CONSTRAINT FOREIGN KEY (LocationID) REFERENCES Location (LocationID),
CONSTRAINT FOREIGN KEY (PlatformID) REFERENCES GamePlatform (PlatformID)
);

CREATE TABLE Attendee (
  AttendeeID int(8) unsigned NOT NULL AUTO_INCREMENT,
  UserID int(8) unsigned NOT NULL,
  EventID int(8) unsigned NOT NULL,
  StatusID int(8) unsigned NOT NULL,
  IsRemote int(1) unsigned NOT NULL,
  PlatformID int(8) unsigned NOT NULL,
  PRIMARY KEY (AttendeeID),
CONSTRAINT FOREIGN KEY (UserID) REFERENCES User (UserID),
CONSTRAINT FOREIGN KEY (EventID) REFERENCES Event (EventID),
CONSTRAINT FOREIGN KEY (StatusID) REFERENCES Status (StatusID),
CONSTRAINT FOREIGN KEY (PlatformID) REFERENCES GamePlatform (PlatformID)
);


-- BEGIN INSERT STATEMENTS---#

-- -FILL User TABLE---#

INSERT INTO User (UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES 
("Feelsofly", "Arya", "Stark", "Filsoofi", "2016-08-04", 1, 0, "arya.filsoofi@gmail.com", "123-456-7890", 1, "AF#3557"),
("DanZee", "Dan", "Luigi", "Zee", "2017-12-12", 0, 0, "dan.a.to.zee@hotmail.com", "235-735-1746", 0, "Sixty#8056"),
("Bond", "Nicholas", "James", "Bond", "2019-04-01", 1, 1, "lemon-bond@notaspy.ca", "007-007-0007", 1, "lemonBond#2711"),
("LouiseIV", "Louis", "Eduardo", "Lee", "2018-01-31", 0, 1, "MacsRule@Gmail.com", "231-643-7321", 1, "Louis#5197"),
("xXLenaXx", "Lena", "La", "Lai", "2016-12-31", 1, 0, "Lllllena@sympatico.ca", "234-543-9210", 1, "Lena#0438"),
("Skiph", "Ryan", "Benjamin", "Gee", "2019-05-09", 0, 0, "abcdefgee@Gmail.com", "520-356-4325", 1, "Skiph#5110"),
("LMFAO", "Mohammed", "Muhammad", "Muhammed", "2015-11-11", 0, 1, "TheOtherMuhammed@Mohammad.com", "127-234-6345", 0,""),
("Putin", "Vladimir", "Ivan", "Slavinski", "2017-09-08", 1, 1, "real.Slav@slavsRUs.rus", "111-111-1111", 0, "Slav#4322"),
("Skywalker", "Kyle", "Brett", "Morgan", "2018-02-21", 0, 1, "whiteDude@hotmail.com", "632-534-7693", 1, ""),
("$Money$", "Jeff", "Amazon", "Bezos", "2019-01-01", 1, 1, "richerThanU@amazon.com", "098-765-4321", 0, "");


-- FILL GENRE TABLE---#

INSERT INTO Genre (GenreName)
VALUES ("Battle Royale"),
("FPS"),
("MOBA"),
("MMO"),
("RPG"),
("Fighting"),
("Adventure");


-- -FILL Stream PLATFORM TABLE---#

INSERT INTO StreamPlatform (StreamPlatformName)
VALUES 
("Twitch"),
("YouTube"),
("Mixer");


-- -FILL Event TYPE TABLE---#

INSERT INTO EventType (TypeName) 
VALUES 
('Weekly Meeting'),
('Tournament'),
('Casual Play');


-- -FILL Location TABLE---#

INSERT INTO Location (LocationName, LocationAddress) 
VALUES 
('Georgian College Barrie', '1 Georgian Dr, Barrie, ON L4M 3X9'),
('Georgian College Orilla', '825 Memorial Ave, Orillia, ON L3V 6S2'),
('Georgian College Collingwood', '499 Raglan St, Collingwood, ON L9Y 3Z1');



-- -FILL STATUS TABLE---#

INSERT INTO STATUS (StatusName) 
VALUES 
('Professional'),
('Recreational'),
('Casual'),
('Observer');


-- -FILL GAME PLATFORM TABLE---#

INSERT INTO GamePlatform (PlatformName)
VALUES 
('PS4'),
('PC'),
('Xbox'),
('Xbox 360'),
('Switch'),
('N/A');


-- -FILL Game TABLE---#

INSERT INTO Game (GameName, SingleMulti, GenreID)
VALUES 
("Fortnite", 1, 1),
("League of Legends", 1, 3),
("Dota 2", 1, 3),
("Black Ops IV", 1, 2),
("CS:GO", 1, 2),
("World of Warcraft", 1, 4),
("Assassin's Creed Odyssey", 0, 5),
("Apex Legends", 1, 1),
("Super Smash Bros", 1, 6),
( "Metroid Prime", 0, 7);

-- -FILL Stream TABLE---#

INSERT INTO Stream (UserID, StreamPlatformID, StreamLink)
VALUES 
(1, 1, "Twitch.tv/ArYaGaming"),
(2, 2, "YouTube.com/AToZ"),
(3, 3, "Mixer.com/NotASpy"),
(4, 1, "Twitch.tv/MacGamer34"),
(5, 2, "YouTube.com/ItsLllena"),
(7, 3, "Mixer.com/MuhammadMohammad"),
(9, 1, "Twitch.tv/SikTrix420"),
(10, 2, "Youtube.com/richDude111");

-- FILL Event TABLE---#

INSERT INTO EVENT (EventName, EventTypeID, EventDateTime, LocationID , EventDescription) 
VALUES 
('Weekly Meeting', 1, '2019-04-02', 1 , 'Weekly Club Members Meeting'),
('Casual Play', 3, '2019-04-04', 2 , 'Thursday Night Casual Play'),
('Smash Bros Event', 2, '2019-04-06', 1 , 'Smash Bros Weekend Tournament'),
('Weekly Meeting', 1, '2019-04-09', 3 , 'Weekly Club Members Meeting'),
('Casual Play', 3, '2019-04-11', 2 , 'Thursday Night Casual Play'),
('Call of Duty Event', 3, '2019-04-13', 1 , 'Call of Duty Weekend Tournament'),
('Weekly Meeting', 1, '2019-04-16', 2 , 'Weekly Club Members Meeting'),
('Casual Play', 3, '2019-04-18', 2 , 'Thursday Night Casual Play'),
('Mario Cart Event', 2, '2019-04-20', 2 , 'Mario Cart Weekend Team Tournament'),
( 'Weekly Meeting', 1, '2019-04-23', 1 , 'Weekly Club Members Meeting');

-- FILL Attendee TABLE---#

INSERT INTO Attendee (UserID, EventID, StatusID,  IsRemote, PlatformID) 
VALUES 
(1, 1, 3, 0, 6),
(4, 1, 4, 0, 6),
(3, 6, 1, 0, 4),
(1, 3, 1, 1, 5),
(8, 5, 3, 0, 2),
(10, 3, 1, 1, 5),
(9, 6, 2, 0, 4),
(2, 4, 4, 0, 6),
(7, 8, 3, 0, 1),
(10, 9, 1, 1, 5);

-- FILL Player TABLE---#

INSERT INTO Player (UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES 
(1, 'HappyPenguin', 1, 1, 2, 1),
(2, 'PurplePeopleEater', 5, 3, 2, 3),
(3, 'EpicGamer', 3, 2, 2, 2),
(4, '//Ninja//', 3, 4, 3, 2),
(5, '-=DarkEagle=-', 6, 3, 3, 1),
(6, 'RDBsucks', 2, 3, 1, 3),
(7, 'H4rdC0re', 2, 1, 3, 3),
(8, 'GitGudScrub', 3, 2, 2, 1),
(9, 'NotYourFriend', 8, 4, 3, 1),
(4, 'ProfficientInL33t', 2, 1, 2, 2),
(4, '3L1t3H4x0rZ', 1, 4, 1, 1),
(7, 'AnimeHater32', 6, 3, 2, 3),
(2, 'HakuneAtchoo', 9, 1, 3, 3),
(8, 'TheOG', 7, 2, 3, 1),
(8, 'JimSucks001', 9, 4, 1, 2),
(8, '2Kewl4Skewl', 1, 3, 2, 2),
(1, 'MisterDude', 4, 3, 3, 1),
(3, 'N00bPwner', 6, 3, 1, 1),
(6, 'Darkness420', 5, 4, 2, 3);
