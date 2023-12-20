<?php
     namespace App\Orm;
     use \PDOException;
     use \PDO;
     require("../app/config/config.php");
     class Orm {
        private $db_database_connect;
    
        public function __construct($db_name =  DB_NAME, $db_host = DB_HOST, $db_user = DB_USERNAME, $db_pass = DB_PASSWORD)
        {
            try {
                $this->db_database_connect = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
                $this->db_database_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Failed: " . $e->getMessage();
            }
        }
    
        public function selectAll($table)
        {
            try {
            
                $stmt = $this->db_database_connect->prepare("SELECT * FROM {$table}");
    
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {

                echo "Error: " . $e->getMessage();

                return false;

            }
        }
        public function selectOne($table, $id)
        {
            try {
                
                $stmt = $this->db_database_connect->prepare("SELECT * FROM {$table} WHERE  id =:id");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {

                echo "Error: " . $e->getMessage();

                return false;
            }
        }
    
        public function insert($table, $data)
        {
            $placeValues = ":" . implode(",:", array_keys($data));
            $columnNames = implode(",", array_keys($data));
        
            try {
                $stmt = $this->db_database_connect->prepare("INSERT INTO {$table} ({$columnNames}) VALUES ({$placeValues})");
        
                foreach ($data as $key => $val) {
                    echo $val . "  =  " . gettype($val) . "<br>";
                    $type = gettype($val);
                    switch ($type) {
                        case "integer":
                            $stmt->bindValue(":$key", $val, PDO::PARAM_INT);
                            break;
        
                        case "boolean":
                            $stmt->bindValue(":$key", $val, PDO::PARAM_BOOL);
                            break;
        
                        default:
                            $stmt->bindValue(":$key", $val, PDO::PARAM_STR);
                    }
                }
        
               $stmt = $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        
    
        public function update($table, $data,$id)
        {
            $placeColumnsValues= implode(", ", array_map(function ($key, $value) {
                return "$key=:$key";
            }, array_keys($data), $data));
           
        
            try {
                $stmt = $this->db_database_connect->prepare("UPDATE  {$table} SET  ({$placeColumnsValues}) WHERE id =:id ");
               
                foreach ($data as $key => $val) {
                    echo $val . "  =  " . gettype($val) . "<br>";
                    $type = gettype($val);
                    switch ($type) {
                        case "integer":
                            $stmt->bindValue(":$key", $val, PDO::PARAM_INT);
                            break;
        
                        case "boolean":
                            $stmt->bindValue(":$key", $val, PDO::PARAM_BOOL);
                            break;
        
                        default:
                            $stmt->bindValue(":$key", $val, PDO::PARAM_STR);
                    }
                }
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
               $stmt = $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        public function delete($table, $id)
        {
            try {
                
                $stmt = $this->db_database_connect->prepare("DELETE FROM {$table} WHERE  id =:id");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt;

            } catch (PDOException $e) {

                echo "Error: " . $e->getMessage();

                return false;
            }
        }

        public function find($table, $inputSearch)
        {      
              $placeSearchCondition = implode("AND", array_map(function ($key, $value) {
                return "$key LIKE '%:$key%'";
            }, array_keys($inputSearch), $inputSearch));
            try 
            {
                
                $stmt = $this->db_database_connect->prepare("DELETE FROM {$table} WHERE {$placeSearchCondition}");

                foreach ($inputSearch as $key => $value) 
                {

                    $stmt->bindValue(":$key", $value, PDO::PARAM_STR);    

                }

                $stmt->execute();

                return $stmt;

            } catch (PDOException $e) 
            {

                echo "Error: " . $e->getMessage();

                return false;
            }
        }
        public function innerJoinSelect($tables, $COLUMNS, $condition , $where)
        {
            $tables= implode(" INNER JOIN ",$tables);
            $condition= implode(" AND ", array_map(function ($key, $value) {
            return "$key = $value";
            }, array_keys($condition),$condition));
            $where =implode(" AND ", array_map(function ($key,$value){
                return "$key=$value";
            },array_keys($where), $where));
            $COLUMNS=implode(",",$COLUMNS);

            $stmt = $this->db_database_connect->prepare("SELECT {$COLUMNS}  FROM {$tables} ON {$condition} WHERE  {$where}");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        }
        public function __destruct()
        {
            $this->db_database_connect = null;
        }
    }
    