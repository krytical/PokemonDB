<html>
<head>
<title>PokemonDB - Search Results</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<div id="login">
  <form method="POST" action="index.php">
        User: <input type="text" name="username" size="14" maxlength="30" placeholder="Trainer ID" />
    Password: <input type="password" name="password" size="14" maxlength="30" />
    <input type="submit" value="Log In" name="loginButton" />
  </form>
</div>

<a href="index.php"><img src="PokemonLogo.png"></a>

<form name="search" method="post" action="search.php">
<input type="text" name="find" placeholder="Search Pokemon" />
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form>

<?php
session_start();

 $searching = $_POST['searching'];
 $find = $_POST['find'];
 
 echo "<h2>Search Results</h2><p>"; 
  
 // Create connection
	$con=mysqli_connect("localhost","dbmanager", "pokemon", "PokemonDB") or die;

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
 
 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 
 
 //Now we search for our search term, in the field the user specified 
 $query = "SELECT * FROM Pokemon WHERE PSpecies LIKE'%$find%'"; 
 $result = mysqli_query($con, $query);
 
 if ($result === FALSE) {
	echo "Error, can't find user data from DBManager.";
	die(mysql_error());
}

echo "<table border='1'>
<tr>
<th>Pokemon_ID</th>
<th>Pokemon Name</th>
<th>Trainer ID</th>
<th>Area Name</th>
<th>Type</th>
<th>Species</th>
</tr>";


 //And we display the results 
 while($row = mysqli_fetch_array( $result )) 
 { 
 echo "<tr>";
 echo "<td>" . $row['Pokemon_ID'] . "</td>"; 
 echo "<td>" . $row['PName'] . "</td>"; 
 echo "<td>" . $row['PTID'] . "</td>"; 
 echo "<td>" . $row['aName'] . "</td>"; 
 echo "<td>" . $row['Ptype'] . "</td>"; 
 echo "<td>" . $row['PSpecies'] . "</td>"; 
 echo "</tr>";
 } 
 
echo "</table>";
 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysqli_num_rows($result); 
 if ($anymatches == 0) 
 { 
 echo "No results<br><br>"; 
 } 

 ?> 
 </html>
