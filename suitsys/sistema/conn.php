<?php

header('Content-Type: text/html; charset=utf-8');

if (!class_exists('Conexao')) {

      DEFINE('DB_HOST', 'localhost');
      DEFINE('DB_USER', 'root');
      DEFINE('DB_PASS', '');
      DEFINE('DB_TABLE', 'suitsys');

      class Conexao extends PDO
      {
            private static $instancia;

            public function __construct($dsn, $username = "", $password = "")
            {
                  // O construtro abaixo é o do PDO
                  parent::__construct($dsn, $username, $password);
            }

            public static function getInstance()
            {
                  if (!isset(self::$instancia)) {
                        try {
                              self::$instancia = new Conexao("mysql:host=" . DB_HOST . ";dbname=" . DB_TABLE, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
                        } catch (Exception $e) {
                              echo 'Erro ao conectar';
                              exit();
                        }
                  }
                  return self::$instancia;
            }
      }

      $DB = Conexao::getInstance();
      $a = $DB->query("SET NAMES utf8;SET character_set_connection=utf8;SET character_set_client=utf8;SET character_set_results=utf8;SET time_zone='-3:00';");
      $a->closeCursor();

      date_default_timezone_set('America/Sao_paulo');
      setlocale(LC_ALL, "pt_BR");

      /* ============= CRUD ==================*/
      include('includes/CRUD.php');
      include('includes/FUNC.php');
}
