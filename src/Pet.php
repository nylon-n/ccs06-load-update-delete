<?php

namespace App;

use PDO;

class Pet
{
	protected $id;
	protected $name;
	protected $gender;
	protected $email;
	protected $birthdate; //
	protected $owner; //
	protected $address; //
	protected $contact_number; //
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getGender()
	{
		return $this->gender;
	}
	
	public function getEmail()
	{
		return $this->email;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function getOwner()
	{
		return $this->owner;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function getCNum()
	{
		return $this->contact_number;
	}

	public static function list()
	{
		global $conn;

		try {
			$sql = "SELECT * FROM pets";
			$statement = $conn->query($sql);
			
			$pets = [];
			while ($row = $statement->fetchObject('App\Pet')) {
				array_push($pets, $row);
			}

			return $pets;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM pets
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\Pet');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($name, $gender, $email, $birthdate, $owner, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				INSERT INTO pets (name, gender, email, birthdate, owner, address, contact_number)
				VALUES ('$name', '$gender', '$email', '$birthdate', '$owner', '$address', '$contact_number')
			";
			$conn->exec($sql);

			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
	{
		global $conn;

		try {
			foreach ($users as $user) {
				$sql = "
					INSERT INTO pets
					SET
						name=\"{$user['name']}\",
						gender=\"{$user['gender']}\",
						email=\"{$user['email']}\",
						birthdate=\"{$user['birthdate']}\",
						owner=\"{$user['owner']}\",
						address=\"{$user['address']}\",
						contact_number=\"{$user['contact_number']}\"
				";
				$conn->exec($sql);
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function update($id, $name, $gender, $email, $birthdate, $owner, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
					name=?,
					gender=?,
					email=?,
					birthdate=?,
					owner=?,
					address=?,
					contact_number=?

				WHERE id=?
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				$name,
				$gender,
				$email,
				$birthdate,
				$owner,
				$address,
				$contact_number,
				$id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function updateUsingPlaceholder($id, $name, $gender, $email, $birthdate, $owner, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
					name=:name,
					gender=:gender,
					email=:email,
					birthdate=:birthdate,
					owner=:owner,
					address=:address,
					contact_number=:contact_number

				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'name' => $name,
				'gender' => $gender,
				'email' => $email,
				'birthdate' => $birthdate,
				'owner' => $owner,
				'address' => $address,
				'contact_number' => $contact_number,
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function deleteById($id)
	{
		global $conn;

		try {
			$sql = "
				DELETE FROM pets
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function clearTable()
	{
		global $conn;

		try {
			$sql = "TRUNCATE TABLE pets";
			$statement = $conn->prepare($sql);
			return $statement->execute();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}