<?php 


	class Monedas extends Controllers{
		public function __construct()
		{
			session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
			parent::__construct();
		}

		public function monedas()
		{
			$data['page_id'] = 1;
			$data['page_tag'] = "Monedas";
			$data['page_title'] = "Monedas <small>Conmemorativas</small>";
			$data['page_name'] = "monedas";
			$data['page_functions_js'] = "functions_monedas.js";
			$this->views->getView($this,"monedas",$data);
		}

		public function getMonedas() {
			$arrdata = $this->model->selectMonedas();
			for ($i=0; $i < count($arrdata); $i++) {
				$arrdata[$i]['presentacion'] = '<a href="'.$arrdata[$i]['presentacion'].'" target="_blank">Vídeo</a>';
				$arrdata[$i]['fecha_circulacion'] = date("d-m-Y", strtotime($arrdata[$i]['fecha_circulacion']));
				$arrdata[$i]['decreto'] = '<a href="'.$arrdata[$i]['decreto'].'" target="_blank">Archivo</a>';
				$btnView = '<button class="btn btn-info btn-sm btnViewMoneda" onClick="fntViewMoneda('.$arrdata[$i]['id_moneda'].')" title="Ver moneda"><i class="far fa-eye"></i></button>';
				$btnEdit = '<button class="btn btn-primary btn-sm btnEditMoneda" onClick="fntEditMoneda('.$arrdata[$i]['id_moneda'].')" title="Editar moneda"><i class="fas fa-pencil-alt"></i></button>';
				$btnDelete = '<button class="btn btn-danger btn-sm btnDelMoneda" onClick="fntDelMoneda('.$arrdata[$i]['id_moneda'].')" title="Eliminar moneda"><i class="far fa-trash-alt"></i></button>';
				$arrdata[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getMoneda(int $idMoneda) {
			$arrData = $this->model->getMoneda($idMoneda);
			$arrData['presentacion'] = '<a href="'.$arrData['presentacion'].'" target="_blank">Vídeo</a>';
			$arrData['fecha_circulacion'] = date("d-m-Y", strtotime($arrData['fecha_circulacion']));
			$arrData['decreto'] = '<a href="'.$arrData['decreto'].'" target="_blank">Archivo</a>';
			if(empty($arrData)){
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setMoneda() {
			
			if($_POST) { 
				$id_moneda = $_POST['idMoneda'];
				$txtNombre = $_POST['txtNombre'];
				$listDenominacionid = $_POST['listDenominacionid'];
				$txtDescripcion = $_POST['txtDescripcion'];
				$txtPresentacion = $_POST['txtPresentacion'];
				$txtDecreto = $_POST['txtDecreto'];
				$fechaCirculacion = $_POST['fechaCirculacion'];
				$imgMoneda = $_FILES['photo'];
				$request_moneda = '';
				$option = 0;
				if($imgMoneda != '') {
					$image_type = $_FILES['photo']['type'];
					$imgNombre = 'moneda_'.md5(date('d-m-Y H:m:s')).".png";
					
					if($id_moneda == 0) {
							$option = 1;
							if($txtNombre != '' && $listDenominacionid != '' && $txtDescripcion != '' && $txtPresentacion != '' && $txtDecreto != '' && $fechaCirculacion != '') {
								$request_moneda = $this->model->insertMoneda($txtNombre, $listDenominacionid, $txtDescripcion, $txtPresentacion, $txtDecreto, $fechaCirculacion, $imgNombre);
								if($request_moneda > 0) {								
									$upload_image = uploadImage($imgMoneda, $imgNombre);
									if($upload_image) {
										$arrresponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
									}
									else {
										$request_moneda = $this->model->deleteMoneda($id_moneda);
										if($request_moneda > 0) {
											$arrresponse = array('status' => false, 'msg' => 'No es posible almacenar la imagen.');
										}
										else {
											$arrresponse = array('status' => false, 'msg' => 'No es posible almacenar la imagen y eliminar los datos.');
										}
									}
								}
								else if($request_moneda == 'exist') {
									$arrresponse = array('status' => false, 'msg' => '¡Atención! La moneda ya existe.');
								}
								else {
									$arrresponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
								}
							}
							else {
								$arrresponse = array('status' => false, 'msg' => 'Datos no validos.');
							}
						}
						else {
							$option = 2;
							if($id_moneda != '' && $txtNombre != '' && $listDenominacionid != '' && $txtDescripcion != '' && $txtPresentacion != '' && $txtDecreto != '' && $fechaCirculacion != '') {
								$select_image = $this->model->selectImage($id_moneda);
								if($select_image) {
									$delete_image = deleteFile($select_image);
									if($delete_image) {
										$request_moneda = $this->model->updateMoneda($id_moneda, $txtNombre, $listDenominacionid, $txtDescripcion, $txtPresentacion, $txtDecreto, $fechaCirculacion, $imgNombre);
										if($request_moneda == 'ok') {
											$upload_image = uploadImage($imgMoneda, $imgNombre);
											if($upload_image) {
												$arrresponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
											}
											else {
												$delete_moneda = $this->model->deleteMoneda($id_moneda);
												if($delete_moneda) {
													$arrresponse = array('status' => false, 'msg' => 'No es posible almacenar la imagen.');
												}
												else {
													$arrresponse = array('status' => false, 'msg' => 'No es posible almacenar la imagen y eliminar los datos.');
												}
											}
										}
										else if($request_moneda == 'exist') {
											$arrresponse = array('status' => false, 'msg' => '¡Atención! La moneda ya existe.');
										}
										else {
											$arrresponse = array('status' => false, 'msg' => 'No es posible actualizar los datos.');
										}
									}
									else{
										$arrresponse = array('status' => false, 'msg' => 'No es posible eliminar la imagen.');
									}
								}
								else {
									$arrresponse = array('status' => false, 'msg' => 'No es posible eliminar la imagen.');
								}
							}
							else {
								$arrresponse = array('status' => false, 'msg' => 'Datos no validos.');
							}
						}
						
					}

				}
				else {
					$arrresponse = array('status' => false, 'msg' => 'Error al subir la imagen.');
				}

				if($request_moneda > 0) {
					if($option == 1) {
						$arrresponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}
					else {
						$arrresponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
					}
				}
				else if($request_moneda == 'exist') {
					$arrresponse = array('status' => false, 'msg' => '¡Atención! La moneda ya existe.');
				}
				else {
					$arrresponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
				}
				
				//$request_image = $this->model->insertImage($id_moneda, $imgNombre);
			
			//$a_id = uniqid();
			//$arrresponse = array('status' => true, 'imgname' => 'img_'.$a_id.'.jpg');
			echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
			die();
		}

	}
?>