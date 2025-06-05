<?php
    class Post {
        private $pdo;
        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function addEmployee($data){
            $sql = "INSERT INTO employees (employeeid, firstname, lastname) VALUES (?, ?, ?);";
          
            try{
               $stmt = $this->pdo->prepare($sql);
                $body = [
                    $data->employeeid,
                    $data->firstname,
                    $data->lastname
                ];
               $stmt->execute($body);
               return array("data"=>[], "message"=>"successfully inserted.");
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "Failed to insert.";
        }

       public function editEmployee($data){
            $sql = "UPDATE employees SET employeeid =?, firstname = ?, lastname =? WHERE id = ?";
          
            try{
               $stmt = $this->pdo->prepare($sql);
                $body = [
                    $data->employeeid,
                    $data->firstname,
                    $data->lastname,
                    $data->id
                ];
               $stmt->execute($body);
               return array("data"=>[], "message"=>"successfully updated.");
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "Failed to update.";
        } 

        public function deleteEmployee($data){
            $sql = "DELETE FROM employees WHERE id = ?";
          
            try{
               $stmt = $this->pdo->prepare($sql);
                $body = [
                    $data->id
                ];
               $stmt->execute($body);
               return array("data"=>[], "message"=>"successfully deleted.");
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "Failed to delete.";
        }

    }


?>