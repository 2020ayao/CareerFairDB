<!DOCTYPE html>
<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<body>
		<?php
			echo "<p>Hello World!</p>";
		?>
		<a href="login.php">Click here to login</a> <br/>
		<a href="register.php">Click here to register</a>
	</body>
	<br/>
	<h2 align="center">List</h2>
	<table width="100%" border="1px">
			<tr>
				<th>Id</th>
				<th>Details</th>
				<th>Post Time</th>
				<th>Edit Time</th>
			</tr>
			<?php
				mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysql_select_db("localCF") or die("Cannot connect to database"); //connect to database
				$query = mysql_query("Select * from list Where public='yes'"); // SQL Query
				while($row = mysql_fetch_array($query))
				{
					echo "<tr>";
						echo '<td align="center">'. $row['id'] . "</td>";
						echo '<td align="center">'. $row['details'] . "</td>";
						echo '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
						echo '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
					echo "</tr>";
				}
			?>
	</table>
</html>