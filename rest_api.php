<?php
    class database{
        private $pdo;
        public function __construct($host,$dbname,$username,$password){
            $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.';',$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $conn;
        }
        public function query($show){
            $stmt = $this->pdo->prepare($show);
            $stmt->execute();
            if($show){
                $data = $stmt->fetchAll();
                return $data;
            }
        }
    }
    $db = new database('localhost','testdb','root','');
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        echo json_encode($db->query('select * from api_test')); 
    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo 'This is POST';
    }
    else{
        http_response_code(405);
    }
?>
