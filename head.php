<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cyber Grizzlies</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">
</head>
	<?php require 'connect.php';?>

<body>
<header>
  <nav>
	<ul>
		<li><a class="border-link">#create</a>
		<!-- Create Drop Menu -->
		<ul>
			<li><a href="user.php">User</a></li>
			<li><a href="player.php">Player</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="event.php">Event</a></li>
		</ul>
		</li>
		<li><a class="border-link" href="update.php">#edit</a></li>
		<li><a class="border-link" href="#">#reports</a>
		<!-- Reports Drop Menu -->
		<ul class="reports-dropmenu">
			<li><a href="view_attendenceDateType.php">Attendance by Date & Type</a></li>
			<li><a href="view_currentMember.php">Current Members</a></li>
			<li><a href="view_eventDate.php">Events by Date</a></li>
			<li><a href="view_memberevent.php">Events by Member</a></li>
		</ul>
	  </li>
	</ul>
  </nav>
</header>
<main>