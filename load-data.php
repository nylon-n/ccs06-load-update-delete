<?php

require "config.php";

use App\Pet;

try {
	Pet::register('Moon', 'Female', 'moonthedoggo@gmail.com', '06/05/19', 'Levi Goodman', 'Villa 3, Cardan Village, St. Dominique', '09192352574');
	echo "<li>Added 1 pet";

	$pets = [
		[
			'name' => 'Bliss',
			'gender' => 'Male',
			'email' => 'maryannechong@gmail.com',
			'birthdate' => '18/07/23',
			'owner' => 'Mary Anne Chong',
			'address' => 'No. 59, St Augustine Village, Batumbakal',
			'contact_number' => '09195645319'

		],
		[
			'name' => 'Bloo',
			'gender' => 'Male',
			'email' => 'micaisaemon@gmail.com',
			'birthdate' => '20/11/14',
			'owner' => 'Mica Isaemon',
			'address' => 'No. 69, Pulungpong, Casa Verde, Bulacan',
			'contact_number' => '09185929561'

		]
	];
	Pet::registerMany($pets);
	echo "<li>Added " . count($pets) . " more pets";
	echo "<br /><a href='index.php'>Proceed to Index Page</a>";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}

