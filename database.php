<?php

  class database {

    private $host= 'localhost';
    private $user= 'root';
    private $password= '';
    private $database= 'school';
    private $conn= null;

    public function __construct($host, $user, $password, $database) {
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
      $this->database = $database;
    }

    public function connect() {
      try {
          $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //afficher les erreurs sous forme d'exception.
          return $this->conn;
      } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
      }
    }

    public function disconnect() {
        $this->conn = null;
    }
  }

?>