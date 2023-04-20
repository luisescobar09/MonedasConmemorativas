<?php
    const BASE_URL = "https://monedas-conmemorativas.herokuapp.com/admin";


	//Zona Horaria
	date_default_timezone_set('America/Mexico_City');

    //Datos de conexión a Base de Datos
	const DB_HOST = "db.ohtgyhtpsmemszbtbuml.supabase.co";
	const DB_PORT = "5432";
	const DB_NAME = "postgres";
	const DB_USER = "postgres";
	const DB_PASSWORD = "26Ti9228twc8!d3";
	const DB_CHARSET = "utf8";

	//Delimitadores decimal y millar Ej: 24,999.99
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";
    
?>