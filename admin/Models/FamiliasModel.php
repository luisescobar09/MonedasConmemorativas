<?php 

	class FamiliasModel extends PostgreSQL
	{
        private $intIdFamilia;
        private $strNombre;
        private $decDiametro;
        private $strForma;
        private $decPeso;
        private $strCanto;
        private $strComposicion;


		public function __construct()
		{
			parent::__construct();
		}

        public function insertFamilia(string $strNombre, float $decDiametro, string $strForma, float $decPeso, string $strCanto, string $strComposicion) {
            $this->strNombre = $strNombre;
            $this->decDiametro = $decDiametro;
            $this->strForma = $strForma;
            $this->decPeso = $decPeso;
            $this->strCanto = $strCanto;
            $this->strComposicion = $strComposicion;

            $return = 0;
            $sql = "SELECT * FROM familias_monedas WHERE nombre = '{$this->strNombre}' ";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $query_insert  = "INSERT INTO familias_monedas(nombre,diametro,forma,peso,canto,composicion) VALUES(?,?,?,?,?,?)";
                $arrData = array(
                    $this->strNombre,
                    $this->decDiametro,
                    $this->strForma,
                    $this->decPeso,
                    $this->strCanto,
                    $this->strComposicion,
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;

        }

        public function selectFamiliasNombre() {
            $sql = "SELECT id_familia, nombre FROM familias_monedas";
            $request = $this->select_all($sql);
            return $request;
        }
        
        public function selectFamilias() {
            $sql = "SELECT * FROM familias_monedas";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectFamilia(int $intIdFamilia) {
            $this->intIdFamilia = $intIdFamilia;
            $sql = "SELECT * FROM familias_monedas WHERE id_familia = $this->intIdFamilia";
            $request = $this->select($sql);
            return $request;
        }


        public function updateFamilia(int $intIdFamilia, string $strNombre, float $decDiametro, string $strForma, float $decPeso, string $strCanto, string $strComposicion) {
            $this->intIdFamilia = $intIdFamilia;
            $this->strNombre = $strNombre;
            $this->decDiametro = $decDiametro;
            $this->strForma = $strForma;
            $this->decPeso = $decPeso;
            $this->strCanto = $strCanto;
            $this->strComposicion = $strComposicion;

            $sql = "SELECT * FROM familias_monedas WHERE (nombre = '{$this->strNombre}' AND id_familia != $this->intIdFamilia) ";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $sql = "UPDATE familias_monedas SET nombre = ?, diametro = ?, forma = ?, peso = ?, canto = ?, composicion = ? WHERE id_familia = $this->intIdFamilia";
                $arrData = array(
                    $this->strNombre,
                    $this->decDiametro,
                    $this->strForma,
                    $this->decPeso,
                    $this->strCanto,
                    $this->strComposicion,
                );
                $request = $this->update($sql, $arrData);
            } else {
                $request = "exist";
            }
            return $request;
        }

        public function deleteFamilia(int $intIdFamilia) {
            $this->intIdFamilia = $intIdFamilia;
            $sql = "SELECT * FROM familias_monedas WHERE id_familia = $this->intIdFamilia";
            $request = $this->select($sql);
            if (empty($request)) {
                $request = "exist";
            } else {
                $sql = "DELETE FROM familias_monedas WHERE id_familia = $this->intIdFamilia";
                $request = $this->delete($sql);
                if($request)
				{
					$request = 'ok';
				} else {
					$request = 'error';
				}
            }
            return $request;
        }

	}

?>