<?php 


	class PWA extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function getMonedas() {
			$arrdata = $this->model->selectMonedas();
			if(empty($arrdata)){
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}
			else {
				for ($i=0; $i < count($arrdata); $i++) {
					$arrdata[$i]['presentacion'] = '<a href="'.$arrdata[$i]['presentacion'].'" target="_blank">Vídeo</a>';
					$arrdata[$i]['fecha_circulacion'] = date("d-m-Y", strtotime($arrdata[$i]['fecha_circulacion']));
					$arrdata[$i]['decreto'] = '<a href="'.$arrdata[$i]['decreto'].'" target="_blank">Archivo</a>';
				}
				$arrResponse = array('status' => true, 'data' => $arrdata);
			}
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
			header("Content-Type: application/json; charset=UTF-8");
			$json = json_encode($arrResponse);
			echo $json;
		}
	}
?>