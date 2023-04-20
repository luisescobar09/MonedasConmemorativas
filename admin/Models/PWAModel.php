<?php 

	class PWAModel extends PostgreSQL
	{
        private $intIdMoneda;


		public function __construct()
		{
			parent::__construct();
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
			$sql = "SELECT m.id_moneda, m.nombre, m.presentacion, m.decreto, m.fecha_circulacion, m.imagen, m.descripcion, d.valor, f.nombre AS familia, f.diametro, f.forma, f.peso, f.canto, f.composicion
			FROM monedas m INNER JOIN denominaciones d ON d.id_denominacion = m.id_denominacion
			INNER JOIN familias_monedas f ON f.id_familia = d.id_familia";
			$request = $this->select_all($sql);
			return $request;
		}
	}
 ?>