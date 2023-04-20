<?php 

	class LoginModel extends PostgreSQL
	{
        private $intIdUsuario;
        private $strEmail;
        private $strPassword;
        private $strToken;

		public function __construct()
		{
			parent::__construct();
		}
        
        public function loginUser(string $email, string $password)
        {
            $this->strEmail = $email;
            $this->strPassword = $password;

            $sql = "SELECT id_usuario, status FROM usuario WHERE email = '{$this->strEmail}' AND contrasena = '{$this->strPassword}' AND status != 0 ";
            $request = $this->select($sql);
            return $request;
        }

        public function sessionLogin(int $idusuario)
        {
            $this->intIdUsuario = $idusuario;
            $sql = "SELECT u.id_usuario, u.nombre_completo, u.email, r.id_rol, r.nombre_rol, u.status FROM usuario u INNER JOIN rol r ON u.id_rol = r.id_rol WHERE u.id_usuario =  $this->intIdUsuario";
            $request = $this->select($sql);
            return $request;
        }

	}
?>