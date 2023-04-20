<?php 


	class Denominaciones extends Controllers{
		public function __construct()
		{
			parent::__construct();
            session_start();
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
		}

		public function denominaciones()
		{
			$data['page_id'] = 1;
			$data['page_tag'] = "Denominaciones";
			$data['page_title'] = "Denominaciones <small>Monedas Conmemorativas</small>";
			$data['page_name'] = "denominaciones";
            $data['page_functions_js'] = "functions_denominaciones.js";
			$this->views->getView($this,"denominaciones",$data);
		}

        public function getDenominacion(int $idDenominacion) {
            $intIdDenominacion = intval(strClean($idDenominacion));
            if ($intIdDenominacion > 0) {
                $arrData = $this->model->selectDenominacion($intIdDenominacion);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getSelectDenominaciones() {
            $htmlOptions = "";
            $arrData = $this->model->selectDenominacionesNombre();
            if (count($arrData) > 0) {
                for ($i=0; $i < count($arrData); $i++) {
                    $htmlOptions .= '<option value="' . $arrData[$i]['id_denominacion'] . '">$' . $arrData[$i]['valor'] . '.00</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getDenominaciones() {
            $arrData = $this->model->selectDenominaciones();
            for ($i=0; $i < count($arrData); $i++) {
                $btnView = '<button class="btn btn-info btn-sm btnViewDenominacion" onClick="fntViewDenominacion(' . $arrData[$i]['id_denominacion'] . ')" title="Ver denominación"><i class="far fa-eye"></i></button>';
                $btnEdit = '<button class="btn btn-primary btn-sm btnEditDenominacion" onClick="fntEditDenominacion(' . $arrData[$i]['id_denominacion'] . ')" title="Editar denominación"><i class="fas fa-pencil-alt"></i></button>';
                $btnDelete = '<button class="btn btn-danger btn-sm btnDelDenominacion" onClick="fntDelDenominacion(' . $arrData[$i]['id_denominacion'] . ')" title="Eliminar denominación"><i class="far fa-trash-alt"></i></button>';
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setDenominacion() {
            $intIdDenominacion = intval($_POST['idDenominacion']);
            $intValor = intval(strClean($_POST['intValor']));
            $intIdFamilia = intval($_POST['listDenominacionid']);
            $request_denominacion = "";
            if ($intIdDenominacion == 0) {
                $option = 1;
                if ($intValor == '' || $intIdFamilia == '') {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                } else {
                    $request_denominacion = $this->model->insertDenominacion($intValor, $intIdFamilia);
                }
            } else {
                $option = 2;
                if ($intValor == '' || $intIdFamilia == '') {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                } else {
                    $request_denominacion = $this->model->updateDenominacion($intIdDenominacion, $intValor, $intIdFamilia);
                }
            }
            if ($request_denominacion > 0) {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
            } else if ($request_denominacion == 'exist') {
                $arrResponse = array('status' => false, 'msg' => '¡Atención! La denominación ya existe.');
            } else {
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delDenominacion() {
            if ($_POST) {
                $intIdDenominacion = intval($_POST['idDenominacion']);
                $requestDelete = $this->model->deleteDenominacion($intIdDenominacion);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la denominación');
                } else if ($requestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una denominación asociada a una moneda.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la denominación.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

	}
 ?>