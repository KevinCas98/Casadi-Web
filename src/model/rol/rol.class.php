<?php 

class Rol extends DbConnection{

    public int $id = 0;
    public string $name = "";
    public string $code_name = "";

	public function getId() {
		return $this->id;
	}

	public function setId(int $id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function getCodeName() {
		return $this->code_name;
	}

	public function setCodeName(string $code_name) {
		$this->code_name = $code_name;
	}

	/**
     * getRolById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getRolById(int $id){
        
        $sqlRol = "SELECT *
                    FROM `rol` 
                    WHERE rol.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultRol = $this->mysqli->query($sqlRol)){
            $row = $resultRol->fetch_array();
            $this->setId($row['id']);
            $this->setName($row['name']);
            $this->setCodeName($row['code_name']);
            return true;
        }
        return false;
    }

    /**
     * saveRol function
     *
     * @return boolean
     */
    public function saveRol(){
        $sqlInsert = "INSERT INTO `rol`(`name`, `code_name`) 
        VALUES ('".$this->getName()."','".$this->getCodeName()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateRol function
     *
     * @return boolean
     */
    public function updateRol(){

        $sqlUpdate = "UPDATE `rol` 
        SET `name`='".$this->getName()."',`code_name`='".$this->getCodeName()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllRol function
     *
     * @return array
     */
    public function getAllRol(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `rol` 
                    ORDER BY id DESC;";

        $resultGetAllRol = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllRol->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setName($obj->name);
            $arrayObject[$obj->id]->setCodeName($obj->code_name);
        }

        return $arrayObject;
    }

} 

?>