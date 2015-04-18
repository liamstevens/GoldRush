<?php
$handle = mysql_connect("mysql.declanhaigh.com", "h4kker", "dexterity") 
  or die("Unable to connect to MySQL");
$selected = mysql_select_db("tanda_hackathon", $handle) 
  or die("Could not select database");
