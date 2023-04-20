<?php 


	class Roles extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
		}

		public function roles()
		{
			$data['page_id'] = 3;
			$data['page_tag'] = "Roles usuario";
			$data['page_title'] = "Roles usuario <small>Monedas Conmemorativas</small>";
			$data['page_name'] = "rol_usuario";
			$data['page_functions_js'] = "functions_roles.js";
			$this->views->getView($this,"roles",$data);
		}

		public function getRoles() {
			$arrData = $this->model->selectRoles();

			for ($i=0; $i < count($arrData); $i++) {
				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}
				//<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntEditRol('.$arrData[$i]['id_rol'].')" title="Permisos"><i class="fas fa-key"></i></button>
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['id_rol'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['id_rol'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
				</div>';
			}
			
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getSelectRoles(){
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if (count($arrData) > 0) {
				for ($i=0; $i < count($arrData); $i++) {
					$htmlOptions .= '<option value="'.$arrData[$i]['id_rol'].'">'.$arrData[$i]['nombre_rol'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}

		public function getRol(int $id_rol) {
			$intIdRol = intval(strClean($id_rol));
			if ($intIdRol > 0) {
				$arrData = $this->model->selectRol($intIdRol);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		
		public function setRol() {

			$intIdRol = intval($_POST['idRol']);
			$strRol = strClean($_POST['txtNombre']);
			$strDescripcion = strClean($_POST['txtDescripcion']);
			$intStatus = intval($_POST['listStatus']);

			if ($intIdRol == 0) {
				//Crear
				$request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
				$option = 1;
			} else {
				//Actualizar
				$request_rol = $this->model->updateRol($intIdRol, $strRol, $strDescripcion, $intStatus);
				$option = 2;
			}

			if ($request_rol > 0) {
				if ($option == 1) {
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				} else {
					$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
				}
			} else if ($request_rol == 'exist') {
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El rol ya existe.');
			} else {
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delRol() {
			if ($_POST) {
				$intIdRol = intval($_POST['idRol']);
				$requestDelete = $this->model->deleteRol($intIdRol);
				if ($requestDelete == 'ok') {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el rol.');
				} else if ($requestDelete == 'exist') {
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un rol asociado a usuarios.');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el rol.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}


	}
 ?>