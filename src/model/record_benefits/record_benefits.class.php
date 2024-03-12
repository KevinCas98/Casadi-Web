<?php 

require "../src/model/stores/stores.class.php";
require "../src/model/benefits/benefits.class.php";

class RecordBenefits extends DbConnection {

    public int $id = 0;
    public int $idUser = 0;
    public int $idBenefits = 0;
    public int $idStores = 0;
    public string $dateRecord = "";

    public int $count = 0;
    public Benefits $benefit;
    public Stores $stores;

    public function getStores()
    {
        return $this->stores;
    }
    public function setStores($stores)
    {
        $this->stores = $stores;
    }

    public function getBenefit() {
		return $this->benefit;
	}

	public function setBenefit(Benefits $benefit) {
		$this->benefit = $benefit;
	}


    public function setId(int $id){
        $this->id = $id;
    }

    public function setIdUser(int $idUser){
        $this->idUser = $idUser;
    }
    
    public function setIdBenefits(int $idBenefits){
        $this->idBenefits = $idBenefits;
    }

    public function setDateRecord(string $dateRecord){
        $this->dateRecord = $dateRecord;
    }

    public function setCount(int $count) {
		$this->count = $count;
	}

    public function getId(){
        return $this->id;
    }

    public function getIdUser(){
        return $this->idUser;
    }

    public function getIdBenefits(){
        return $this->idBenefits;
    }

    public function getDateRecord(){
        return $this->dateRecord;
    }

    /**
     * Get the value of idStore
     */ 
    public function getIdStores()
    {
        return $this->idStores;
    }

    /**
     * Set the value of idStore
     */ 
    public function setIdStores($idStores)
    {
        $this->idStores = $idStores;
    }

    public function getCount() {
		return $this->count;
	}

    /**
     * getRecordBenefits ById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getRecordBenefitsById(int $id){
        
        $sqlRecordBenefits = "SELECT *
                    FROM `record_benefits` 
                    WHERE record_benefits.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultRecordBenefits = $this->mysqli->query($sqlRecordBenefits)){
            $row = $resultRecordBenefits->fetch_array();
            if($row){
                $this->setId($row['id']);
                $this->setIdUser($row['id_user']);
                $this->setIdBenefits($row['id_benefits']);
                $this->setIdBenefits($row['id_stores']);
                $this->setDateRecord($row['date_record']);
            }
            return true;
        }
        return false;
    }

     /**
     * saveRecordBenefits function
     *
     * @return boolean
     */
    public function saveRecordBenefits(){
        $sqlInsert = "INSERT INTO `record_benefits`(`id_user`, `id_benefits`, `id_stores`, `date_record`) 
        VALUES ('".$this->getIdUser()."','".$this->getIdBenefits()."','".$this->getIdStores()."','".$this->getDateRecord()."');";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateRecordBenefits function
     *
     * @return boolean
     */
    public function updateRecordBenefits(){

        $sqlUpdate = "UPDATE `record_benefits` 
        SET `id_user`='".$this->getIdUser()."',
        `id_benefits`='".$this->getIdBenefits()."',
        `id_stores`='".$this->getIdStores()."',
        `date_record`='".$this->getDateRecord()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllRecordBenefits function
     *
     * @return array
     */
    public function getAllRecordBenefits(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `record_benefits` 
                    ORDER BY id DESC;";

        $resultGetAllRecordBenefits = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllRecordBenefits->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setIdUser($obj->id_user);
            $arrayObject[$obj->id]->setIdBenefits($obj->id_benefits);
            $arrayObject[$obj->id]->setIdStores($obj->id_stores);
            $arrayObject[$obj->id]->setDateRecord($obj->date_record);
        }

        return $arrayObject;
    }

    /**
     * getRecordBenefitsByUserId function
     * 
     * @param integer $idStores
     */
    public function getRecordBenefitsByUserId(int $idUser,  bool $api = true){

        $sqlRecordBenefits = "SELECT *
                    FROM `record_benefits` 
                    WHERE record_benefits.id_user = $idUser
                    ORDER BY id DESC;";     
                    
        return $this->getAllArrayBySql($sqlRecordBenefits, $api);
    }

    /**
     * getRecordBenefitsByStoresId function
     * 
     * @param integer $idStores
     */
    public function getRecordBenefitsByStoresId(int $idStores, bool $api = true){

        $sqlRecordBenefits = "SELECT *
                    FROM `record_benefits` 
                    WHERE record_benefits.id_stores = $idStores
                    ORDER BY id DESC;";     
                    
        return $this->getAllArrayBySql($sqlRecordBenefits, $api);
    }

    /**
     * getAllArrayBySql function
     *
     * @param string $sql
     * @return array
     */
    private function getAllArrayBySql(string $sql, bool $api = true){
        $arrayObject = array();
        $resultGetAll = $this->mysqli->query($sql); 
        while($obj = $resultGetAll->fetch_object()){
            if($api){$arrayObject["id"] = $obj->id;}
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setIdUser($obj->id_user);
            $arrayObject[$obj->id]->setIdBenefits($obj->id_benefits);
            $arrayObject[$obj->id]->setIdStores($obj->id_stores);
            $arrayObject[$obj->id]->setDateRecord($obj->date_record);
            $arrayObject[$obj->id]->setBenefit(new Benefits());
            $arrayObject[$obj->id]->getBenefit()->getBenefitsByStoresId($obj->id_stores);
            $arrayObject[$obj->id]->setStores(new Stores);
            $arrayObject[$obj->id]->getStores()->getStoresById($obj->id_stores);

        }    
        return $arrayObject;
    }
    
    /**
     * countRecordBenefits function
     *
     * @return void
     */
    public function countRecordBenefits(){

        $sqlRecordBenefits = "SELECT COUNT(id) AS count_record_benefits FROM `record_benefits`";
        
        if($resultRecordBenefits = $this->mysqli->query($sqlRecordBenefits)){
            $row = $resultRecordBenefits->fetch_array();
            $this->setCount($row["count_record_benefits"]);
        }    
    }
}
?>