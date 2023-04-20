<?php 

	class DenominacionesModel extends PostgreSQL
	{
        private $intIdDenominacion;
        private $intValor;
        private $intIdFamilia;
		public function __construct()
		{
			parent::__construct();
		}	

        public function selectDenominaciones()
        {
            $sql = "SELECT d.id_denominacion, d.valor, f.nombre FROM denominaciones d INNER JOIN familias_monedas f ON d.id_familia = f.id_familia";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectDenominacion(int $intIdDenominacion)
        {
            $this->intIdDenominacion = $intIdDenominacion;
            $sql = "SELECT d.id_denominacion, d.valor, f.nombre, f.diametro, f.forma, f.peso, f.canto, f.composicion FROM denominaciones d INNER JOIN familias_monedas f ON d.id_familia = f.id_familia WHERE d.id_denominacion = {$this->intIdDenominacion}";
            $request = $this->select($sql);
            return $request;
        }

        public function selectDenominacionesNombre(){
            $sql = "SELECT id_denominacion, valor FROM denominaciones";
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertDenominacion(int $intValor, int $intIdFamilia) {
            $this->intValor = $intValor;
            $this->intIdFamilia = $intIdFamilia;
            $return = 0;
            $sql = "SELECT * FROM denominaciones WHERE valor = {$this->intValor} AND id_familia = {$this->intIdFamilia} ";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $query_insert  = "INSERT INTO denominaciones(valor,id_familia) VALUES(?,?)";
                $arrData = array(
                    $this->intValor,
                    $this->intIdFamilia,
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;

        }

        public function updateDenominacion(int $intIdDenominacion, int $intValor, int $intIdFamilia) {
            $this->intIdDenominacion = $intIdDenominacion;
            $this->intValor = $intValor;
            $this->intIdFamilia = $intIdFamilia;
            $sql = "SELECT * FROM denominaciones WHERE valor = {$this->intValor} AND id_familia = {$this->intIdFamilia} AND id_denominacion != {$this->intIdDenominacion}";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $sql = "UPDATE denominaciones SET valor = ?, id_familia = ? WHERE id_denominacion = $this->intIdDenominacion";
                $arrData = array($this->intValor, $this->intIdFamilia);
                $request = $this->update($sql, $arrData);
            } else {
                $request = "exist";
            }
            return $request;
        }

        public function deleteDenominacion(int $intIdDenominacion){
            $this->intIdDenominacion = $intIdDenominacion;
            $sql = "SELECT * FROM monedas WHERE id_denominacion = $this->intIdDenominacion";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $sql = "DELETE FROM denominaciones WHERE id_denominacion = $this->intIdDenominacion";
                $request = $this->delete($sql);
            } else {
                $request = "exist";
            }
            return $request;
        }
        
	}
 ?>