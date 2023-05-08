<?php

require "config.php";

use App\Pet;

try {
	Pet::clearTable();
	echo "<li>Truncated table";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}
?>

<?php
echo '<a href="load-data.php"><button id="myLButton" onclick="hideLButton()">Load Default Data</button></a>';
?>