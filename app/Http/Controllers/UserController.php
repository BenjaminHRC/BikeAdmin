<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DAO\Dao_user;
use App\Models\MODEL\Model_role;
use App\Models\MODEL\Model_user;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

	private $Users;
	private $Roles;

	function __construct()
	{
		$this->Users = new Model_user();
		$this->Roles = new Model_role();
	}

	function index()
	{
		$query['roles'] = $this->Roles->findAll();
		$valuesRoles = [];
		foreach ($query['roles'] as $value) {
			array_push($valuesRoles, json_decode($value->toJSONPrivate(), true));
		}
		$results['roles'] = $valuesRoles;
		return json_encode($results);
	}

	function view($id)
	{
		if ($id != null && !empty($id)) {
			return $this->Users->findIt($id)->toJSONPrivate();
		} else {
			return ['status' => 1, 'message' => 'ID null ou undefined'];
		}
	}

	function save(Request $request)
	{
		$results = ['status' => 1, 'message' => "Données non formater"];
		if ($request->id != null && !empty($request->id)) {
			$users = new Dao_user(
				$request->id,
				$request->name,
				$request->email,
				$request->password,
				$request->role_id
			);

			if ($this->Users->updateIt($users) === true) {
				$results = [
					'status' => 0,
					'action' => 'update',
					'message' => 'Données enregistrer',
				];
			} else {
				$results = [
					'status' => 2,
					'action' => 'update',
					'message' => "Erreur lors de l'enregistrement",
					"error" => $this->Users->updateIt($users)
				];
			}
		} else {
			foreach ($this->Users->findAll() as $value) {
				$value_decode = json_decode($value->toJSONPrivate(), true);
				if ($value_decode['email'] == $request->email) {
					return
						[
							'status' => 3,
							'message' => 'Email déja existant',
						];
				}
			}
			$users = new Dao_user(
				null,
				$request->name,
				$request->email,
				Hash::make($request->password),
				$request->role_id,
			);
			if ($this->Users->createIt($users) === true) {
				$results = [
					'status' => 0,
					'action' => 'create',
					'message' => 'Données enregistrer'
				];
			} else {
				$results = [
					'status' => 2,
					'action' => 'create',
					'message' => "Erreur lors de l'enregistrement",
					"item" => $users
				];
			}
		}
		return json_encode($results);
	}

	function delete($id)
	{
		$results = ["status" => 1, "message" => "données non formatée"];

		if ($this->Users->dropIt($id)) {
			$results = ["status" => 0, "message" => "Données enregistrer"];
		} else {
			$results = ["status" => 2, "message" => "Erreur lors de l'enregistrement"];
		}

		return json_encode($results);
	}

	function list()
	{
		$query = $this->Users->findAll();

		$results = array();

		foreach ($query as $value) {
			// $value->setLastName(strtolower($value->getLastName()));
			array_push($results, json_decode($value->toJSONPrivate(), true));
		}

		return json_encode(['data' => $results]);
	}
}
