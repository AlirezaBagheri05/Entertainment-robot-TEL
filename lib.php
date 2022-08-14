<?php

// CREATE TABLE `eawallir_firstbot`.`firstbot` ( `id` INT NOT NULL AUTO_INCREMENT , `name`  VARCHAR(20) NOT NULL , `value` LONGTEXT NOT NULL , `maker` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

// tables
define('FBOT','firstbot');


class lib{
    private $SERVER_NAME;
    private $USER_NAME;
    private $USER_PASSWORD;
    private $DB_NM;

    public function __Construct($SERVER_NAME,$USER_NAME,$USER_PASSWORD,$DB_NM){
        $this->SERVER_NAME = $SERVER_NAME;
        $this->USER_NAME = $USER_NAME;
        $this->USER_PASSWORD = $USER_PASSWORD;
        $this->DB_NM = $DB_NM;
    }

    private function cov(){
        $SERVER_NAME = $this->SERVER_NAME;
        $USER_NAME = $this->USER_NAME;
        $USER_PASSWORD = $this->USER_PASSWORD;
        $DB_NM = $this->DB_NM;
        $all =  array(
            'S'=>$SERVER_NAME,
            'UN'=>$USER_NAME,
            'UP'=>$USER_PASSWORD,
            'D'=>$DB_NM
        );
        return $all;
    }
    private function connect(){
        $all = $this->cov();
        $link = mysqli_connect($all['S'],$all['UN'],$all['UP'],$all['D']);
        if (mysqli_connect_errno($link)){
            return "Failed to connect to MySQL: " . mysqli_connect_error($link);
        }
        return $link;
    }

    private function query($qrd){
        $link = $this->connect();
        if(empty($qrd)){
            return "qurery is empty";
        }
        $link = mysqli_query($link,$qr);
        if(mysql_errno($link)){
            return mysql_errno($link) . ": " . mysql_error($link). "\n";
        }
        return true;
    }

    public function insert($name,$value,$maker){
        $qr = "INSERT INTO `".FBOT."` (`id`, `name`, `value`, `maker`) VALUES (NULL, '$name', '$value', '$maker');";
        $result = $this->query($qr);
        return $result;
    }

    
}