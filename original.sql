create database CyberGrizzlies;
use CyberGrizzlies;

CREATE TABLE Users (
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
  PlatformID int(8) unsigned NOT NULL AUTO_INCREMENT,
  PlatformName varchar(12) NOT NULL,
  PRIMARY KEY (PlatformID)
);

CREATE TABLE Genre (
  GenreID int(8) unsigned NOT NULL AUTO_INCREMENT,
  GenreName varchar(24) NOT NULL,
  PRIMARY KEY (GenreID)
);

CREATE TABLE EventsType (
  TypeID int(8) unsigned NOT NULL AUTO_INCREMENT,
  TypeName varchar(32) NOT NULL ,
  PRIMARY KEY (TypeID)
);

CREATE TABLE Locations (
  LocationID int(8) unsigned NOT NULL AUTO_INCREMENT,
  LocationName varchar(32) NOT NULL,
  LocationAddress varchar(64) NOT NULL,
  PRIMARY KEY (LocationID)
);

CREATE TABLE Games (
  GameID int(8) unsigned NOT NULL AUTO_INCREMENT,
  GameName varchar(24) NOT NULL,
  SingleMulti tinyint(1) NOT NULL,
  GenreID int(8) unsigned NOT NULL,
  PRIMARY KEY (GameID),
 CONSTRAINT FOREIGN KEY (GenreID) REFERENCES Genre (GenreID)
);

CREATE TABLE Streaming (
  StreamID int(8) unsigned NOT NULL AUTO_INCREMENT,
  StreamLink varchar(100) NOT NULL,
  UserID int(8) unsigned NOT NULL,
  StreamPlatformID int(8) unsigned NOT NULL,
  PRIMARY KEY (StreamID),
CONSTRAINT FOREIGN KEY (UserID) REFERENCES Users (UserID),
CONSTRAINT FOREIGN KEY (StreamPlatformID) REFERENCES StreamPlatform (StreamPlatformID)
);

CREATE TABLE Events (
  EventID int(8) unsigned NOT NULL AUTO_INCREMENT,
  EventName varchar(64) NOT NULL,
  TypeID int(8) unsigned NOT NULL,
  EventDateTime datetime NOT NULL,
  LocationID int(8) unsigned NOT NULL,
  EventDescription varchar(256) NOT NULL,
  PRIMARY KEY (EventID),
CONSTRAINT FOREIGN KEY (TypeID) REFERENCES EventsType (TypeID),
CONSTRAINT FOREIGN KEY (LocationID) REFERENCES Locations (LocationID)
);

CREATE TABLE Players (
  PlayerID int(8) unsigned NOT NULL AUTO_INCREMENT,
  UserID int(8) unsigned NOT NULL,
  GamerTag varchar(64) NOT NULL,
  GameID int(8) unsigned NOT NULL,
  StatusID int(8) unsigned NOT NULL,
  LocationID int(8) unsigned NOT NULL,
  PlatformID int(8) unsigned NOT NULL,
  PRIMARY KEY (PlayerID),
CONSTRAINT FOREIGN KEY (UserID) REFERENCES Users (UserID),
CONSTRAINT FOREIGN KEY (GameID) REFERENCES Games (GameID),
CONSTRAINT FOREIGN KEY (StatusID) REFERENCES Status (StatusID),
CONSTRAINT FOREIGN KEY (LocationID) REFERENCES Locations (LocationID),
CONSTRAINT FOREIGN KEY (PlatformID) REFERENCES GamePlatform (PlatformID)
);

CREATE TABLE Attendees (
  AttendeeID int(8) unsigned NOT NULL AUTO_INCREMENT,
  UserID int(8) unsigned NOT NULL,
  EventID int(8) unsigned NOT NULL,
  StatusID int(8) unsigned NOT NULL,
  LocationID int(8) unsigned NOT NULL,
  PlatformID int(8) unsigned NOT NULL,
  PRIMARY KEY (AttendeeID),
CONSTRAINT FOREIGN KEY (UserID) REFERENCES Users (UserID),
CONSTRAINT FOREIGN KEY (EventID) REFERENCES Events (EventID),
CONSTRAINT FOREIGN KEY (StatusID) REFERENCES Status (StatusID),
CONSTRAINT FOREIGN KEY (LocationID) REFERENCES Locations (LocationID),
CONSTRAINT FOREIGN KEY (PlatformID) REFERENCES GamePlatform (PlatformID)
);



#---BEGIN INSERT STATEMENTS---#

#---FILL USERS TABLE---#

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES (1, "Feelsofly", "Arya", "Stark", "Filsoofi", "2016-08-04", 1, 0, "arya.filsoofi@gmail.com", "123-456-7890", 1, "AF#3557");

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES (2, "DanZee", "Dan", "Luigi", "Zee", "2017-12-12", 0, 0, "dan.a.to.zee@hotmail.com", "235-735-1746", 0, "Sixty#8056");

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES (3, "Bond", "Nicholas", "James", "Bond", "2019-04-01", 1, 1, "lemon-bond@notaspy.ca", "007-007-0007", 1, "lemonBond#2711");

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES (4, "LouiseIV", "Louis", "Eduardo", "Lee", "2018-01-31", 0, 1, "MacsRule@Gmail.com", "231-643-7321", 1, "Louis#5197");

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES (5, "xXLenaXx", "Lena", "La", "Lai", "2016-12-31", 1, 0, "Lllllena@sympatico.ca", "234-543-9210", 1, "Lena#0438");

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES (6, "Skiph", "Ryan", "Benjamin", "Gee", "2019-05-09", 0, 0, "abcdefgee@Gmail.com", "520-356-4325", 1, "Skiph#5110");

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus) 
VALUES (7, "LMFAO", "Mohammed", "Muhammad", "Muhammed", "2015-11-11", 0, 1, "TheOtherMuhammed@Mohammad.com", "127-234-6345", 0);

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus, DiscordTag) 
VALUES (8, "Putin", "Vladimir", "Ivan", "Slavinski", "2017-09-08", 1, 1, "real.Slav@slavsRUs.rus", "111-111-1111", 0, "Slav#4322");

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus) 
VALUES (9, "Skywalker", "Kyle", "Brett", "Morgan", "2018-02-21", 0, 1, "whiteDude@hotmail.com", "632-534-7693", 1);

INSERT INTO Users (UserID, UserName, FirstName, MiddleName, LastName, StartDate, ActiveStatus, PayStatus, Email, Phone, ChatStatus) 
VALUES (10, "$Money$", "Jeff", "Amazon", "Bezos", "2019-01-01", 1, 1, "richerThanU@amazon.com", "098-765-4321", 0);


#---FILL GENRE TABLE---#

INSERT INTO Genre (GenreID, GenreName)
VALUES (1, "Battle Royale");

INSERT INTO Genre (GenreID, GenreName)
VALUES (2, "FPS");

INSERT INTO Genre (GenreID, GenreName)
VALUES (3, "MOBA");

INSERT INTO Genre (GenreID, GenreName)
VALUES (4, "MMO");

INSERT INTO Genre (GenreID, GenreName)
VALUES (5, "RPG");

INSERT INTO Genre (GenreID, GenreName)
VALUES (6, "Fighting");

INSERT INTO Genre (GenreID, GenreName)
VALUES (7, "Adventure");


#---FILL STREAMING PLATFORM TABLE---#

INSERT INTO StreamPlatform (StreamPlatformID, StreamPlatformName)
VALUES (1, "Twitch");

INSERT INTO StreamPlatform (StreamPlatformID, StreamPlatformName)
VALUES (2, "YouTube");

INSERT INTO StreamPlatform (StreamPlatformID, StreamPlatformName)
VALUES (3, "Mixer");


#---FILL EVENTS TYPE TABLE---#

INSERT INTO EventsType (TypeID, TypeName) 
VALUES 
(1, 'Weekly Meeting'),
(2, 'Tournament'),
(3, 'Casual Play');


#---FILL LOCATIONS TABLE---#

INSERT INTO Locations (LocationID, LocationName, LocationAddress) 
VALUES 
(1, 'Georgian College Barrie', '1 Georgian Dr, Barrie, ON L4M 3X9'),
(2, 'Georgian College Orilla', '825 Memorial Ave, Orillia, ON L3V 6S2'),
(3, 'Georgian College Collingwood', '499 Raglan St, Collingwood, ON L9Y 3Z1');



#---FILL STATUS TABLE---#

INSERT INTO Status (StatusID, StatusName) 
VALUES 
(1, 'Professional'),
(2, 'Recreational'),
(3, 'Casual'),
(4, 'Observer');


#---FILL GAME PLATFORM TABLE---#

INSERT INTO GamePlatform (PlatformID, PlatformName)
VALUES (1, 'PS4');

INSERT INTO GamePlatform (PlatformID, PlatformName)
VALUES (2, 'PC');

INSERT INTO GamePlatform (PlatformID, PlatformName)
VALUES (3, 'Xbox');

INSERT INTO GamePlatform (PlatformID, PlatformName)
VALUES (4, 'Xbox 360');

INSERT INTO GamePlatform (PlatformID, PlatformName)
VALUES (5, 'Switch');

INSERT INTO GamePlatform (PlatformID, PlatformName)
VALUES (6, 'N/A');


#---FILL GAMES TABLE---#

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (1, "Fortnite", 1, 1);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (2, "League of Legends", 1, 3);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (3, "Dota 2", 1, 3);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (4, "Black Ops IV", 1, 2);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (5, "CS:GO", 1, 2);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (6, "World of Warcraft", 1, 4);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (7, "Assassin's Creed Odyssey", 0, 5);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (8, "Apex Legends", 1, 1);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (9, "Super Smash Bros", 1, 6);

INSERT INTO Games (GameID, GameName, SingleMulti, GenreID)
VALUES (10, "Metroid Prime", 0, 7);

#---FILL STREAMING TABLE---#

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (1, 1, 1, "Twitch.tv/ArYaGaming");

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (2, 2, 2, "YouTube.com/AToZ");

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (3, 3, 3, "Mixer.com/NotASpy");

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (4, 4, 1, "Twitch.tv/MacGamer34");

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (5, 5, 2, "YouTube.com/ItsLllena");

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (6, 7, 3, "Mixer.com/MuhammadMohammad");

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (7, 9, 1, "Twitch.tv/SikTrix420");

INSERT INTO Streaming (StreamID, UserID, StreamPlatformID, StreamLink)
VALUES (8, 10, 2, "Youtube.com/richDude111");

#---FILL EVENTS TABLE---#

INSERT INTO Events (EventID, EventName, TypeID, EventDateTime, LocationID , EventDescription) 
VALUES 
(1, 'Weekly Meeting', 1, '2019-04-02', 1 , 'Weekly Club Members Meeting'),
(2, 'Casual Play', 3, '2019-04-04', 2 , 'Thursday Night Casual Play'),
(3, 'Smash Bros Event', 2, '2019-04-06', 1 , 'Smash Bros Weekend Tournament'),
(4, 'Weekly Meeting', 1, '2019-04-09', 3 , 'Weekly Club Members Meeting'),
(5, 'Casual Play', 3, '2019-04-11', 2 , 'Thursday Night Casual Play'),
(6, 'Call of Duty Event', 3, '2019-04-13', 1 , 'Call of Duty Weekend Tournament'),
(7, 'Weekly Meeting', 1, '2019-04-16', 2 , 'Weekly Club Members Meeting'),
(8, 'Casual Play', 3, '2019-04-18', 2 , 'Thursday Night Casual Play'),
(9, 'Mario Cart Event', 2, '2019-04-20', 2 , 'Mario Cart Weekend Team Tournament'),
(10, 'Weekly Meeting', 1, '2019-04-23', 1 , 'Weekly Club Members Meeting');

#---FILL ATTENDEES TABLE---#

INSERT INTO Attendees (AttendeeID, UserID, EventID, StatusID,  LocationID, PlatformID) 
VALUES 
(1, 1, 1, 3, 1, 6),
(2, 4, 1, 4, 1, 6),
(3, 3, 6, 1, 1, 4),
(4, 1, 3, 1, 1, 5),
(5, 8, 5, 3, 2, 2),
(6, 10, 3, 1, 1, 5),
(7, 9, 6, 2, 1, 4),
(8, 2, 4, 4, 3, 6),
(9, 7, 8, 3, 2, 1),
(10, 10, 9, 1, 2, 5);


#---FILL PLAYERS TABLE---#

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (1, 1, HappyPenguin, 1, 1, 2, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (2, 2, PurplePeopleEater, 5, 3, 2, 3);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (3, 3, EpicGamer, 3, 2, 2, 2);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (4, 4, //Ninja//, 3, 4, 3, 2);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (5, 5, -=DarkEagle=-, 6, 3, 3, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (6, 6, RDBsucks, 2, 3, 1, 3);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (7, 7, H4rdC0re, 2, 1, 3, 3);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (8, 8, GitGudScrub, 3, 2, 2, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (9, 9, NotYourFriend, 8, 4, 3, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (11, 4, ProfficientInL33t, 2, 1, 2, 2);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (12, 4, 3L1t3H4x0rZ, 1, 4, 1, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (13, 7, AnimeHater32, 6, 3, 2, 3);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (14, 2, HakuneAtchoo, 9, 1, 3, 3);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (15, 8, TheOG, 7, 2, 3, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (16, 8, JimSucks001, 9, 4, 1, 2);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (17, 8, 2Kewl4Skewl, 1, 3, 2, 2);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (18, 1, MisterDude, 4, 3, 3, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (19, 3, N00bPwner, 6, 3, 1, 1);

INSERT INTO Players (PlayerID, UserID, GamerTag, GameID, StatusID, LocationID, PlatformID)
VALUES (20, 6, Darkness420, 5, 4, 2, 3);


