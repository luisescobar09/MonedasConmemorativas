<?php


class Usuarios extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
		}
	}

	public function usuarios()
	{
		$data['page_id'] = 1;
		$data['page_tag'] = "Usuarios";
		$data['page_title'] = "USUARIO <small>Monedas Conmemorativas</small>";
		$data['page_name'] = "usuarios";
		$data['page_functions_js'] = "functions_usuarios.js";
		$this->views->getView($this, "usuarios", $data);
	}

	public function setUsuario()
	{
		if ($_POST) {
			if (
				empty($_POST['txtNombre']) || empty($_POST['txtEmail'])
				|| empty($_POST['listRolid']) || empty($_POST['listStatus'])
			) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idUsuario = intval($_POST['idUsuario']);
				$strNombre = ucwords(strClean($_POST['txtNombre']));
				$strEmail = strClean($_POST['txtEmail']);
				$intRolid = intval(strclean($_POST['listRolid']));
				$intStatus = intval(strclean($_POST['listStatus']));

				if ($idUsuario == 0) {
					$option = 1;
					$strpassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtPassword']);
					$request_user = $this->model->insertUsuario($strNombre, $strEmail, $strpassword, $intRolid, $intStatus);
				} else {
					$option = 2;
					$strpassword = empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);
					$request_user = $this->model->updateUsuario($idUsuario, $strNombre, $strEmail, $strpassword, $intRolid, $intStatus);
				}



				if ($request_user > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
					}
				} else if ($request_user == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, verifique e intente de nuevo.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getUsuarios()
	{
		$arrData = $this->model->selectUsuarios();

		for ($i = 0; $i < count($arrData); $i++) {
			if ($arrData[$i]['status'] == 1) {
				$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
			} else {
				$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
			}
			$arrData[$i]['options'] = '<div class="text-center">
			<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Ver Usuario"><i class="far fa-eye"></i></button>
			<button class="btn btn-primary btn-sm btnEditUsuario" onClick="fntEditUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Editar Usuario"><i class="fas fa-pencil-alt"></i></button>
			<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Eliminar usuario"><i class="fas fa-trash-alt"></i></button>
			</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function getUsuario(int $id_usuario)
	{
		$intIdUsuario = intval(strClean($id_usuario));
		if ($intIdUsuario > 0) {
			$arrData = $this->model->selectUsuario($intIdUsuario);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function delUsuario()
	{
		if ($_POST) {
			$intIdUsuario = intval($_POST['idUsuario']);
			$requestDelete = $this->model->deleteUsuario($intIdUsuario);
			if ($requestDelete) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario.');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function perfil()
	{
		$data['page_id'] = 1;
		$data['page_tag'] = "Perfil";
		$data['page_title'] = "Perfil de usuario <small>Monedas Conmemorativas</small>";
		$data['page_name'] = "perfil";
		$data['page_functions_js'] = "functions_usuarios.js";
		$this->views->getView($this, "perfil", $data);
	}
}
