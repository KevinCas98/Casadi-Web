<?php 
class Vaccines extends DbConnection{

    public int $id = 0;
    public string $name = "";
    public int $count = 0;

    public function setId(int $id){
        $this->id = $id;
    }
    
    public function setName(string $name){
        $this->name = $name;
    }

    public function setCount(string $count){
        $this->count = $count;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getCount(){
        return $this->count;
    }

    /**
     * getVaccinesById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getVaccinesById(int $id){
        
        $sqlVaccines = "SELECT *
                    FROM `vaccines` 
                    WHERE vaccines.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultVaccines = $this->mysqli->query($sqlVaccines)){
            $row = $resultVaccines->fetch_array();
            $this->setId($row['id']);
            $this->setName($row['name']);
            return true;
        }
        return false;
    }

    /**
     * saveVaccines function
     *
     * @return boolean
     */
    public function saveVaccines(){
        $sqlInsert = "INSERT INTO `vaccines`(`name`) 
        VALUES ('".$this->getName()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateVaccines function
     *
     * @return boolean
     */
    public function updateVaccines(){

        $sqlUpdate = "UPDATE `vaccines` 
        SET `name`='".$this->getName()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllVaccines function
     *
     * @return array
     */
    public function getAllVaccines(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `vaccines` 
                    ORDER BY id DESC;";

        $resultGetAllVaccines = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllVaccines->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setName($obj->name);
        }

        return $arrayObject;
    }

    /**
     * countVaccines function
     *
     * @return void
     */
    public function countVaccines(){

        $sqlVaccines = "SELECT COUNT(id) AS count_vaccines FROM `vaccines`";
        
        if($resultVaccines = $this->mysqli->query($sqlVaccines)){
            $row = $resultVaccines->fetch_array();
            $this->setCount($row["count_vaccines"]);
        }    
    }

}
?>