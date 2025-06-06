<?php

class Get {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

public function getEmployeesWithLatestDtr() {
$sql = "SELECT e.*, d.timein, d.timeout
FROM employees e
LEFT JOIN (
    SELECT t1.*
    FROM dtr t1
    INNER JOIN (
        SELECT employeeid, MAX(id) as max_id
        FROM dtr
        GROUP BY employeeid
    ) t2 ON t1.employeeid = t2.employeeid AND t1.id = t2.max_id
) d ON e.employeeid = d.employeeid";
    $data = array();

    if($result = $this->pdo->query($sql)){
        while($row = $result->fetch(\PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return json_encode($data);
    } else {
        echo "Database not connected";
    }
}
    public function getAccounts(){
        $sql = "SELECT * FROM accounts";
        $data = array();

            if($result = $this->pdo->query($sql)){
            while($row = $result->fetch(\PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return json_encode($data);
        } else {
            echo "Database not connected";
        }
    }
    public function getDtr(){
        $sql = "SELECT * FROM dtr";
        $data = array();

            if($result = $this->pdo->query($sql)){
            while($row = $result->fetch(\PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return json_encode($data);
        } else {
            echo "Database not connected";
        }
    }
}


?>