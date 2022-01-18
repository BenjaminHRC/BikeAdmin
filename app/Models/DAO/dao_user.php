<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_user extends Model
{
	private $id = null;
	private $name = null;
	private $email = null;
	private $password = null;
	private $role_id = null;
	private $role;

	function __construct($id, $name, $email, $password, $role_id)
	{
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->role_id = $role_id;
		// $this->role = [];
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

	function getRoleId()
	{
		return $this->role_id;
	}

	function setRoleId($role_id)
	{
		return $this->role_id = $role_id;
	}

	function getRole()
	{
		return $this->role;
	}

	function setRole($role)
	{
		// var_dump($role);
		return $this->role = $role;
	}

	public function toJSONPrivate()
	{
		// var_dump($this->role);
		if ($this->role != null && !empty($this->role)) {
			return json_encode([
				'id' => $this->id,
				'name' => $this->name,
				'email' => $this->email,
				'password' => $this->password,
				'role_id' => $this->role_id,
				'role' => json_decode($this->role->toJSONPrivate()),
			]);
		} else {
			return json_encode([
				'id' => $this->id,
				'name' => $this->name,
				'email' => $this->email,
				'password' => $this->password,
				'role_id' => $this->role_id,
			]);
		}
	}
}
