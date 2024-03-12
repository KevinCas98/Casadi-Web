<?php 
class Dose extends DbConnection
{
    public int $id = 0;
    public int $idUsers = 0;
    public int $idVaccines = 0;
    public string $dateCheckedDose = "";

    public Vaccines $vaccines;

    public function setId(int $id){
        $this->id = $id;
    }

    public function setIdUsers(int $idUsers){
        $this->idUsers = $idUsers;
    }
    
    public function setIdVaccines(int $idVaccines){
        $this->idVaccines = $idVaccines;
    }

    public function setDateCheckedDose(string $dateCheckedDose){
        $this->dateCheckedDose = $dateCheckedDose;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdUsers(){
        return $this->idUsers;
    }

    public function getIdVaccines(){
        return $this->idVaccines;
    }

    public function getDateCheckedDose(){
        return $this->dateCheckedDose;
    }

    /**
     * Get the value of vaccines
     */ 
    public function getVaccines()
    {
        return $this->vaccines;
    }

    /**
     * Set the value of vaccines
     *
     */ 
    public function setVaccines(Vaccines $vaccines)
    {
        $this->vaccines = $vaccines;
    }

    /**
     * getDoseById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getDoseById(int $id){
        
        $sqlDose = "SELECT *
                    FROM `dose` 
                    WHERE dose.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultDose = $this->mysqli->query($sqlDose)){
            $row = $resultDose->fetch_array();
            $this->setId($row['id']);
            $this->setIdUsers($row['id_users']);
            $this->setIdVaccines($row['id_vaccines']);
            $this->setDateCheckedDose($row['date_checked_dose']);
            return true;  
        }
        return false;
    }

    public function getDoseByUserId(int $userId){

        $sqlDose = "SELECT *, d.id AS id_dose, v.id AS id_v
                    FROM `dose` AS d 
                    LEFT JOIN vaccines AS v ON v.id = d.id_vaccines
                    WHERE d.id_users = 7
                    ORDER BY d.id DESC;"; 

        return $this->getDoseArrayBySql($sqlDose);            
    }

    /**
     * getAllUserArrayBySql function
     *
     * @param string $sql
     * @return array
     */
    private function getDoseArrayBySql(string $sql, bool $api = true){
        $arrayObject = array();
        $resultGetAllDoce = $this->mysqli->query($sql); 

        while($obj = $resultGetAllDoce->fetch_object()){
            if($api){$arrayObject["id"] = $obj->id_dose;}
            $arrayObject[$obj->id_dose] = new static(); 
            $arrayObject[$obj->id_dose]->setId($obj->id_dose);
            $arrayObject[$obj->id_dose]->setIdUsers($obj->id_users);
            $arrayObject[$obj->id_dose]->setIdVaccines($obj->id_vaccines);
            $arrayObject[$obj->id_dose]->setVaccines(new Vaccines);
            $arrayObject[$obj->id_dose]->getVaccines()->setName($obj->name);
        }    

        return $arrayObject;
    }


    /**
     * saveDose function
     *
     * @return boolean
     */
    public function saveDose(){
        $sqlInsert = "INSERT INTO `dose`(`id_users`, `id_vaccines`, `date_checked_dose`) 
        VALUES ('".$this->getIdUsers()."','".$this->getIdVaccines()."','".$this->getDateCheckedDose()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateDose function
     *
     * @return boolean
     */
    public function updateDose(){

        $sqlUpdate = "UPDATE `dose` 
        SET `id_users`='".$this->getIdUsers()."',`id_vaccines`='".$this->getIdVaccines()."',
        `date_checked_dose`='".$this->getDateCheckedDose()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllDose function
     *
     * @return array
     */
    public function getAllDose(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `dose` 
                    ORDER BY id DESC;";

        $resultGetAllDose = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllDose->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setIdUsers($obj->id_users);
            $arrayObject[$obj->id]->setIdVaccines($obj->id_vaccines);
            $arrayObject[$obj->id]->setDateCheckedDose($obj->data_checked_dose);
        }

        return $arrayObject;
    }
}
?>