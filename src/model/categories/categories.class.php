<?php 
class Categories extends DbConnection{

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
     * getCategoriesById function
     *
     * @param integer $id
     * @return bool
     */
    public function getCategoriesById(int $id){
        
        $sqlCategories = "SELECT *
                    FROM `categories` 
                    WHERE categories.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultCategories = $this->mysqli->query($sqlCategories)){
            $row = $resultCategories->fetch_array();
            $this->setId($row['id']);
            $this->setName($row['name']);
            return true;
        }
        return false;
    }

    /**
     * saveCategories function
     *
     * @return boolean
     */
    public function saveCategories(){
        $sqlInsert = "INSERT INTO `categories`(`name`) 
        VALUES ('".$this->getName()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateCategories function
     *
     * @return boolean
     */
    public function updateCategories(){

        $sqlUpdate = "UPDATE `categories` 
        SET `name`='".$this->getName()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllCategories function
     *
     * @return array
     */
    public function getAllCategories(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `categories` AS c 
                    ORDER BY c.name ASC;";

        $resultGetAllCategories = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllCategories->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setName($obj->name);
        }

        return $arrayObject;
    }

}
?>