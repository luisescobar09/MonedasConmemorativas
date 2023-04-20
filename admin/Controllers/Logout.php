<?php

    class Logout extends Controllers {
        public function __construct() {
            parent::__construct();
        }
        public function logout() {
            session_start();
            session_unset();
            session_destroy();
            header("Location:".base_url()."/login");
        }
    }

?>