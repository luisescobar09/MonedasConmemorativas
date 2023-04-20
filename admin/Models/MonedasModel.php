<?php 

	class MonedasModel extends PostgreSQL
	{
        private $intIdMoneda;
        private $strNombre;
		private $intIdDenominacion;
		private $strDescripcion;
		private $strPresentacion;
		private $strDecreto;
		private $strFechaCirculacion;
		private $strImgNombre;


		public function __construct()
		{
			parent::__construct();
		}	

        public function insertMoneda(string $txtNombre, int $listDenominacionid, string $txtDescripcion, string $txtPresentacion, string $txtDecreto, $fechaCirculacion, $imgNombre){
			$this->strNombre = $txtNombre;
			$this->intIdDenominacion = $listDenominacionid;
			$this->strDescripcion = $txtDescripcion;
			$this->strPresentacion = $txtPresentacion;
			$this->strDecreto = $txtDecreto;
			$this->strFechaCirculacion = $fechaCirculacion;
			$this->strImgNombre = $imgNombre;

			$sql = "SELECT * FROM monedas WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request)){
				$query_insert  = "INSERT INTO monedas(nombre, id_denominacion, descripcion, presentacion, fecha_circulacion, decreto, imagen) VALUES(?,?,?,?,?,?,?)";
				$arrData = array(
					$this->strNombre,
					$this->intIdDenominacion,
					$this->strDescripcion,
					$this->strPresentacion,
					$this->strFechaCirculacion,
					$this->strDecreto,
					$this->strImgNombre
				);
				$request_insert = $this->insert($query_insert, $arrData);
				$return = $request_insert;
			} else {
				$return = "exist";
			}
			return $return;
		}

		public function updateMoneda(int $id_moneda, string $txtNombre, int $listDenominacionid, string $txtDescripcion, string $txtPresentacion, string $txtDecreto, $fechaCirculacion, $imgNombre){
			$this->intIdMoneda = $id_moneda;
			$this->strNombre = $txtNombre;
			$this->intIdDenominacion = $listDenominacionid;
			$this->strDescripcion = $txtDescripcion;
			$this->strPresentacion = $txtPresentacion;
			$this->strDecreto = $txtDecreto;
			$this->strFechaCirculacion = $fechaCirculacion;
			$this->strImgNombre = $imgNombre;

			$sql = "SELECT * FROM monedas WHERE nombre = '{$this->strNombre}' AND id_moneda != {$this->intIdMoneda}";
			$request = $this->select_all($sql);
			if(empty($request)) {
					$sql = "UPDATE monedas SET nombre = ?, id_denominacion = ?, descripcion = ?, presentacion = ?, fecha_circulacion = ?, decreto = ?, imagen = ? WHERE id_moneda = $this->intIdMoneda";
					$arrData = array(
						$this->strNombre,
						$this->intIdDenominacion,
						$this->strDescripcion,
						$this->strPresentacion,
						$this->strFechaCirculacion,
						$this->strDecreto,
						$this->strImgNombre
					);
				$request = $this->update($sql, $arrData);
			} else {
				$request = "exist";
			}
			return $request;
		}

		public function getMoneda(int $idMoneda){
			$this->intIdMoneda = $idMoneda;
			$sql = "SELECT m.id_moneda, m.nombre, m.presentacion, m.decreto, m.fecha_circulacion, m.imagen, m.descripcion, d.valor, f.nombre AS familia, f.diametro, f.forma, f.peso, f.canto, f.composicion
			FROM monedas m INNER JOIN denominaciones d ON d.id_denominacion = m.id_denominacion
			INNER JOIN familias_monedas f ON f.id_familia = d.id_familia
			WHERE m.id_moneda = $this->intIdMoneda";
			$request = $this->select($sql);
			return $request;
		}

		public function selectMonedas()
		{
			$sql = "SELECT m.id_moneda, m.nombre, d.valor, f.nombre AS familia, m.presentacion, m.decreto, m.fecha_circulacion
			FROM monedas m INNER JOIN denominaciones d ON d.id_denominacion = m.id_denominacion
			INNER JOIN familias_monedas f ON f.id_familia = d.id_familia";
			$request = $this->select_all($sql);
			return $request;
		}
	}
 ?>