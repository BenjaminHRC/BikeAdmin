<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DAO\Dao_user;
use App\Models\MODEL\Model_user;

use function GuzzleHttp\Promise\each;

class UserController extends Controller
{

	private $Users;

	function __construct()
	{
		$this->Users = new Model_user();
	}

	function liste()
	{
		$query = $this->Users->liste();

		$results = array();

		foreach ($query as $value) {
			// $value->setLastName(strtolower($value->getLastName()));
			array_push($results, json_decode($value->toJSONPrivate(), true));
		}

		return json_encode(['data' => $results]);
	}

	function save(Request $request)
	{
		$results = ['status' => 1, 'message' => "Données non formater"];

		$users = new Dao_user(null, $request->name, $request->email, $request->password);

		if ($this->Users->_save($users)) {
			$results = ['status' => 0, 'message' => 'Données enregistrer'];
		} else {
			$results = ['status' => 2, 'message' => "Erreur lors de l'enregistrement", "item" => $users];
		}

		return json_encode($results);
	}

	function testing(Request $request)
	{
		// var_dump($request);
		$results = [
			$request->name,
			$request->email,
			$request->password
		];
		var_dump($results);
	}


	function view($id)
	{
		$query = $this->Users->view($id);

		return $query;
	}

	function delete($id)
	{
		$results = ["status" => 1, "message" => "données non formatée"];
		
		if ($this->Users->drop($id)) {
			$results = ["status" => 0, "message" => "Données enregistrer"];
		} else {
			$results = ["status" => 2, "message" => "Erreur lors de l'enregistrement"];
		}
		// var_dump($results);

		return json_encode($results);
	}

	function connect(Request $request)
	{
		$results = ["status" => 1, "message" => "données non formatée"];
		if ($this->Users->checkAuth($request->email, $request->password)) {
			
		}
	}
}
