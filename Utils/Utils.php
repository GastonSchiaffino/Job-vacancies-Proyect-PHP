<?php
    namespace Utils;


    class Utils{

        public static function checkSessionStudent(){
            if(!isset($_SESSION['student'])&&!isset($_SESSION['admin'])&&!isset($_SESSION['company'])){
                header("location:".FRONT_ROOT);
            }
        }
        public static function checkSessionAdmin(){
            if(!isset($_SESSION['admin'])){
                header("location:".FRONT_ROOT);
            }
        }
        public static function checkSessionCompany(){
            if(!isset($_SESSION['company'])&&!isset($_SESSION['admin'])){
                header("location:".FRONT_ROOT);
            }
        }
        public static function checkSessionAll(){
            if(!isset($_SESSION['company'])&&!isset($_SESSION['admin'])&&!isset($_SESSION['student'])){
                header("location:".FRONT_ROOT);
            }
        }
        public static function apiConsume($fileName){
            $apiData = curl_init(API_URL .$fileName);

            curl_setopt($apiData, CURLOPT_HTTPHEADER, array('x-api-key: '.API_KEY));
            curl_setopt($apiData, CURLOPT_RETURNTRANSFER, true);
            // Envio de la petición.
            $response = curl_exec($apiData);
            $arrayToDecode = json_decode($response, true);

            return $arrayToDecode;
        }

    }

?>