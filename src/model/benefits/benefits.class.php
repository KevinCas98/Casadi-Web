<?php 

class Benefits extends DbConnection{

    public int $id = 0;
    public int $idStore = 0;
    public string $typeOfBenefit = "";
    public string $name = "";
    public int $pin = 0;
    public string $conditions = "";
    public string $createdAt = "";
    public string $updatedAt = "";
    public int $createdBy = 0;
    public int $updatedBy = 0;

    public function getName(){
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setId(int $id){

        $this->id = $id;
    }

    public function setIdStore(int $idStore){
        $this->idStore = $idStore;
    }

    public function setCreatedAt(string $createdAt){
        $this->createdAt = $createdAt;
    }

    public function setTypeOfBenefit(string $typeOfBenefit){
        $this->typeOfBenefit = $typeOfBenefit;
    }

    public function setPin(int $pin){
        $this->pin = $pin;
    }

    public function setConditions(string $conditions){
        $this->conditions = $conditions;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getIdStore(){
        return $this->idStore;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function getTypeOfBenefit(){
        return $this->typeOfBenefit;
    }

    public function getPin(){
        return $this->pin;
    }

    public function getConditions(){
        return $this->conditions;
    }

    public function getUpdatedAt() {
		return $this->updatedAt;
	}

	public function setUpdatedAt(string $updatedAt) {
		$this->updatedAt = $updatedAt;
	}

	public function getCreatedBy() {
		return $this->createdBy;
	}

	public function setCreatedBy(int $createdBy) {
		$this->createdBy = $createdBy;
	}

	public function getUpdatedBy() {
		return $this->updatedBy;
	}

    public function setUpdatedBy(int $updatedBy) {
		$this->updatedBy = $updatedBy;
	}

    /**
     * setAllBySql function
     *
     * @param string $sql
     * @return bool
     */
    protected function setAllBySql(string $sql){
        $return = false;
        if($resultBenefits = $this->mysqli->query($sql)){
            $row = $resultBenefits->fetch_array();
            if($row){
                $this->setId($row['id']);
                $this->setName($row['name']);
                $this->setIdStore($row['id_store']);
                $this->setCreatedAt($row['created_at']);
                $this->setTypeOfBenefit($row['type_of_benefit']);
                $this->setPin($row['pin']);
                $this->setConditions($row['conditions']);
                $return = true;
            }
        }
        return $return;
    }

    /**
     * getBenefitsById function
     *
     * @param integer $id
     * @return bool
     */
    public function getBenefits(int $id){
        
        $sqlBenefits = "SELECT *
                    FROM `benefits` 
                    WHERE benefits.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        return $this->setAllBySql($sqlBenefits);
    }

    /**
     * getBenefitsByStoresId function
     *
     * @param integer $id_store
     * @return bool
     */
    public function getBenefitsByStoresId(int $id_store){

        $return = false;
        $sqlBenefits = "SELECT *
                    FROM `benefits` 
                    WHERE benefits.id_store = $id_store
                    ORDER BY id DESC LIMIT 1;";   

        return $this->setAllBySql($sqlBenefits);
    }

    /**
     * saveBenefits function
     *
     * @return boolean
     */
    public function saveBenefits(){
        $sqlInsert = "INSERT INTO `benefits`(`id_store`, `name`, `type_of_benefit`, `pin`, `conditions`, `created_by`, `created_at`) 
        VALUES ('".$this->getIdStore()."', '".$this->getName()."','".$this->getTypeOfBenefit()."','".$this->getPin()."','".$this->getConditions()."','".$this->getCreatedBy()."','".$this->getCreatedAt()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateBenefits function
     *
     * @return boolean
     */
    public function updateBenefits(){

        $sqlUpdate = "UPDATE `benefits` 
                     SET `id_store`='".$this->getIdStore()."', `name`='".$this->getName()."',
                     `type_of_benefit`='".$this->getTypeOfBenefit()."',
                     `pin`='".$this->getPin()."',`conditions`='".$this->getConditions()."',
                     `updated_by`='".$this->getUpdatedBy()."',`updated_at`='".$this->getUpdatedAt()."'
                     WHERE id = '".$this->getId()."';";          

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllBenefits function
     *
     * @return array
     */
    public function getAllBenefits(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `benefits` 
                    ORDER BY id DESC;";

        $resultGetAllBenefits = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllBenefits->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setName($obj->name);
            $arrayObject[$obj->id]->setIdStore($obj->id_store);
            $arrayObject[$obj->id]->setCreatedAt($obj->created_at);
            $arrayObject[$obj->id]->setUpdatedAt($obj->updated_at);
            $arrayObject[$obj->id]->setCreatedBy($obj->created_by);
            $arrayObject[$obj->id]->setUpdatedBy($obj->updated_by);
            $arrayObject[$obj->id]->setTypeOfBenefit($obj->type_of_benefit);
            $arrayObject[$obj->id]->setPin($obj->pin);
            $arrayObject[$obj->store_id]->setConditions($obj->conditions);
        }

        return $arrayObject;
    }

}
?>