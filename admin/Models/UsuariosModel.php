<?php 

	class UsuariosModel extends PostgreSQL
	{
        private $intIdUsuario;
        private $strNombre;
        private $strEmail;
        private $strPassword;
        private $intRolid;
        private $intStatus;
        private $strToken;

		public function __construct()
		{
			parent::__construct();
		}
        
        public function insertUsuario(string $nombre, string $email, string $password, int $rolid, int $status)
        {
            $this->strNombre = $nombre;
            $this->strEmail = $email;
            $this->strPassword = $password;
            $this->intRolid = $rolid;
            $this->intStatus = $status;

            $return = 0;
            $sql = "SELECT * FROM usuario WHERE email = '{$this->strEmail}' ";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $query_insert  = "INSERT INTO usuario(nombre_completo,email,contrasena,id_rol,status) VALUES(?,?,?,?,?)";
                $arrData = array(
                    $this->strNombre,
                    $this->strEmail,
                    $this->strPassword,
                    $this->intRolid,
                    $this->intStatus,
                    
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;
        }

        public function selectUsuarios()
        {
            $sql = "SELECT u.id_usuario, u.nombre_completo, u.email, u.status, r.nombre_rol
                    FROM usuario u
                    INNER JOIN rol r
                    ON u.id_rol = r.id_rol
                    WHERE u.status != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectUsuario(int $idusuario)
        {
            $this->intIdUsuario = $idusuario;
            $sql = "SELECT u.id_usuario, u.nombre_completo, u.email, u.status, r.id_rol, r.nombre_rol
                    FROM usuario u
                    INNER JOIN rol r
                    ON u.id_rol = r.id_rol
                    WHERE u.id_usuario = $this->intIdUsuario";
            $request = $this->select($sql);
            return $request;
        }

        public function updateUsuario(int $idUsuario, string $strNombre, string $strEmail, string $strpassword, int $intRolid, int $intStatus) {
            $this->intIdUsuario = $idUsuario;
            $this->strNombre = $strNombre;
            $this->strEmail = $strEmail;
            $this->strPassword = $strpassword;
            $this->intRolid = $intRolid;
            $this->intStatus = $intStatus;
            
            $sql = "SELECT * FROM usuario WHERE (email = '{$this->strEmail}' AND id_usuario != $this->intIdUsuario) ";
            $request = $this->select_all($sql);

            if(empty($request)) {
                if($this->strPassword != "") {
                    $sql = "UPDATE usuario SET nombre_completo = ?, email = ?, contrasena = ?, id_rol = ?, status = ? WHERE id_usuario = $this->intIdUsuario ";
                    $arrData = array(
                        $this->strNombre,
                        $this->strEmail,
                        $this->strPassword,
                        $this->intRolid,
                        $this->intStatus
                    );
                } else {
                    $sql = "UPDATE usuario SET nombre_completo = ?, email = ?, id_rol = ?, status = ? WHERE id_usuario = $this->intIdUsuario ";
                    $arrData = array(
                        $this->strNombre,
                        $this->strEmail,
                        $this->intRolid,
                        $this->intStatus
                    );
                }
                $request = $this->update($sql, $arrData);
            } else {
                $request = "exist";
            }
            return $request;
        }

        public function deleteUsuario(int $idusuario)
        {
            $this->intIdUsuario = $idusuario;
            $sql = "UPDATE usuario SET status = ? WHERE id_usuario = $this->intIdUsuario ";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            return $request;
        }


	}
 ?>