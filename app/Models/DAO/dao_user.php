<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_user extends Model
{
	private $id = null;
	private $name = null;
	private $email = null;
	private $password = null;

	function __construct($id, $name, $email, $password)
	{
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}


	function getId()
	{
		return $this->id;
	}

	function setId($id)
	{
		return $this->id = $id;
	}

	function getName()
	{
		return $this->name;
	}

	function setName($name)
	{
		return $this->name = $name;
	}

	function getEmail()
	{
		return $this->email;
	}

	function setEmail($email)
	{
		return $this->email = $email;
	}

	function getPassword()
	{
		return $this->password;
	}

	function setPassword($password)
	{
		return $this->password = $password;
	}

	public function toJSONPrivate()
	{
		return json_encode([
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'password' => $this->password
		]);
	}
}
