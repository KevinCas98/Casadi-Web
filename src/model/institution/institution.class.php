<?php 
class Institution extends DbConnection{

    public int $id = 0;
    public string $name = "";

    public function setId(int $id){
        $this->id = $id;
    }

    public function setName(string $name){
        $this->name = $name;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    /**
     * getInstitutionById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getInstitutionById(int $id){
        
        $sqlInstitution = "SELECT *
                    FROM `institution` 
                    WHERE institution.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultInstitution = $this->mysqli->query($sqlInstitution)){
            $row = $resultInstitution->fetch_array();
            $this->setId($row['id']);
            $this->setName($row['name']);
            return true;
        }
        return false;
    }

/**
     * saveInstitution function
     *
     * @return boolean
     */
    public function saveInstitution(){
        $sqlInsert = "INSERT INTO `institution`(`name`) 
        VALUES ('".$this->getName()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateInstitution function
     *
     * @return boolean
     */
    public function updateInstitution(){

        $sqlUpdate = "UPDATE `institution` 
        SET `name`='".$this->getName()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllInstitution function
     *
     * @return array
     */
    public function getAllInstitution(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `institution` 
                    ORDER BY id DESC;";

        $resultGetAllInstitution = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllInstitution->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setName($obj->name);
        }

        return $arrayObject;
    }

}
?>