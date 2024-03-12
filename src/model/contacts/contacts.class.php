<?php 
class Contacts extends DbConnection{

    public int $id = 0;
    public int $idStore = 0;
    public string $name = "";
    public string $lastName = "";   
    public string $email = "";
    public string $cellPhone = "";

    public function setId(int $id){
        $this->id = $id;
    }

    public function setIdStore(int $idStore){
        $this->idStore = $idStore;
    }

    public function setName(string $name){
        $this->name = $name;
    }
    
    public function setLastName(string $lastName){
        $this->lastName = $lastName;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setCellPhone(string $cellPhone){
        $this->cellPhone = $cellPhone;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdStore(){
        return $this->idStore;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getCellPhone(){
        return $this->cellPhone;
    }
    
    /**
     * setAllBySql function
     *
     * @param string $sql
     * @return bool
     */
    protected function setAllBySql(string $sql){
        $return = false;
        if($result = $this->mysqli->query($sql)){
            $row = $result->fetch_array();
            if($row){
                $this->setId($row['id']);
                $this->setIdStore($row['id_store']);
                $this->setName($row['name']);
                $this->setLastName($row['last_name']);
                $this->setEmail($row['email']);
                $this->setCellPhone($row['cell_phone']);
                $return = true;
            }
        }
        return $return;
    }


    /**
     * getContactsById function
     *
     * @param integer $id
     * @return bool
     */
    public function getContactsById(int $id){
        
        $sqlContacts = "SELECT *
                    FROM `contacts` 
                    WHERE contacts.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        return $this->setAllBySql($sqlContacts);
    }

    /**
     * getContactByStoresId function
     *
     * @param integer $id_store
     * @return bool
     */
    public function getContactByStoresId(int $id_store){

        $sqlContacts = "SELECT *
                    FROM `contacts` 
                    WHERE contacts.id_store = $id_store
                    ORDER BY id DESC LIMIT 1;";               

        return $this->setAllBySql($sqlContacts);
    }

     /**
     * saveContacts function
     *
     * @return boolean
     */
    public function saveContacts(){
        $sqlInsert = "INSERT INTO `contacts`(`id_store`, `name`, `last_name`, `email`, `cell_phone`) 
        VALUES ('".$this->getIdStore()."','".$this->getName()."','".$this->getLastName()."','".$this->getEmail()."','".$this->getCellPhone()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateContacts function
     *
     * @return boolean
     */
    public function updateContacts(){

        $sqlUpdate = "UPDATE `contacts` 
        SET `id_store`='".$this->getIdStore()."',`name`='".$this->getName()."',`last_name`='".$this->getLastName()."',
        `email`='".$this->getEmail()."',`cell_phone`='".$this->getCellPhone()."' 
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllContacts function
     *
     * @return array
     */
    public function getAllContacts(){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `contacts` 
                    ORDER BY id DESC;";

        $resultGetAllContacts = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllContacts->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setIdStore($obj->id_store);
            $arrayObject[$obj->id]->setName($obj->name);
            $arrayObject[$obj->id]->setLastName($obj->last_name);
            $arrayObject[$obj->id]->setEmail($obj->email);
            $arrayObject[$obj->id]->setCellPhone($obj->cell_phone);
        }

        return $arrayObject;
    }

}
?>