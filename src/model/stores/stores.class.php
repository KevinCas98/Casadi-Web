<?php 
require "../src/model/categories/categories.class.php";

class Stores extends DbConnection{

    public int $id = 0;
    public int $idCategory = 0;
    public string $name = "";
    public string $cuit = "";
    public string $address = "";
    public string $image1 = "";
    public string $image2 = "";
    public string $cellPhone = "";
    public string $web = "";
    public string $instagram = "";
    public string $whatsapp = "";
    public string $phone = "";
    public int $count = 0;
    public Categories $category;
    public Benefits $benefit;
    public Contacts $contcats;
    public string $createdAt = "";
    public string $updatedAt = "";
    public int $createdBy = 0;
    public int $updatedBy = 0;
    private $forPage;

	public function getCategory() {
		return $this->category;
	}

	public function setCategory(Categories $category) {
		$this->category = $category;
	}

    public function getBenefit() {
		return $this->benefit;
	}

	public function setBenefit(Benefits $benefit) {
		$this->benefit = $benefit;
	}

    public function getContacts() {
		return $this->contcats;
	}

	public function setContacts(Contacts $contcats) {
		$this->contcats = $contcats;
	}


	public function setCount(int $count) {
		$this->count = $count;
	}

    public function setId(int $id){
        $this->id = $id;
    }

    public function setIdCategory(int $idCategory){
        $this->idCategory = $idCategory;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setCuit(string $cuit){
        $this->cuit = $cuit;
    }
    
    public function setAddress(string $address){
        $this->address = $address;
    }

    public function setImage1(string $image1){
        $this->image1 = $image1;
    }

    public function setImage2(string $image2){
        $this->image2 = $image2;
    }

    public function setContact(string $contact){
        $this->contact = $contact;
    }

    public function setCellPhone(string $cellPhone){
        $this->cellPhone = $cellPhone;
    }

    public function setWeb(string $web){
        $this->web = $web;
    }

    public function setInstagram(string $instagram){
        $this->instagram = $instagram;
    }

    public function setWhatsapp(string $whatsapp){
        $this->whatsapp = $whatsapp;
    }

    public function setPhone(string $phone){
        $this->phone = $phone;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdCategory(){
        return $this->idCategory;
    }

    public function getName(){
        return $this->name;
    }

    public function getCuit(){
        return $this->cuit;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getImage1(){
        return $this->image1;
    }

    public function getImage2(){
        return $this->image2;
    }

    public function getCellPhone(){
        return $this->cellPhone;
    }

    public function getWeb() {
		return $this->web;
	}

    public function getInstagram() {
		return $this->instagram;
	}

    public function getWhatsapp() {
		return $this->whatsapp;
	}

    public function getPhone() {
		return $this->phone;
	}

    public function getCount() {
		return $this->count;
	}

    public function getUpdatedAt() {
		return $this->updatedAt;
	}

	public function setCreatedAt(string $updatedAt) {
		$this->updatedAt = $updatedAt;
	}

    public function getCreatedAt() {
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
     * getStoresById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getStoresById(int $id){
        
        $sqlStores = "SELECT *
                    FROM `stores` 
                    WHERE stores.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultStores = $this->mysqli->query($sqlStores)){
            $row = $resultStores->fetch_array();
            $this->setId($row['id']);
            $this->setIdCategory($row['id_category']);
            $this->setName($row['name']);
            $this->setCuit($row['cuit']);
            $this->setAddress($row['address']);
            $this->setImage1($row['image1']);
            $this->setImage2($row['image2']);
            $this->setCellPhone($row['cell_phone']);
            $this->setWeb($row['web']);
            $this->setInstagram($row['instagram']);
            $this->setWhatsapp($row['whatsapp']);
            $this->setPhone($row['phone']);
            return true;
        }
        return false;
    }

    /**
     * getStoresByIdApi function
     *
     * @param integer $id
     * @return array
     */
    public function getStoresByIdApi(int $id){

        $sqlStores = "SELECT *,s.id AS store_id, 
        s.name AS store_name,
        c.id AS category_id, 
        c.name AS category_name
        FROM `stores` AS s 
        LEFT JOIN `categories` AS c ON c.id = s.id_category
        WHERE s.id = $id
        ORDER BY s.id DESC LIMIT 1;";    

        return $this->getArrayDataStore($sqlStores);
    }
    
    /**
     * saveStores function
     *
     * @return boolean
     */
    public function saveStores(){
        $sqlInsert = "INSERT INTO `stores`(`id_category`, `name`, `cuit`, `address`, `image1`, `image2`, `cell_phone`, `web`, `instagram`, `whatsapp`, `phone`, `created_by`, `created_at`) 
        VALUES ('".$this->getIdCategory()."','".$this->getName()."','".$this->getCuit()."','".$this->getAddress()."','".$this->getImage1()."',
        '".$this->getImage2()."','".$this->getCellPhone()."','".$this->getWeb()."','".$this->getInstagram()."','".$this->getWhatsapp()."','".$this->getPhone()."','".$this->getCreatedBy()."','".$this->getCreatedAt()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateStores function
     *
     * @return boolean
     */
    public function updateStores(){

        $sqlUpdate = "UPDATE `stores` 
        SET `id_category`='".$this->getIdCategory()."',`name`='".$this->getName()."',
        `cuit`='".$this->getCuit()."',`address`='".$this->getAddress()."',`image1`='".$this->getImage1()."',
        `image2`='".$this->getImage2()."',`cell_phone`='".$this->getCellPhone()."',
        `web`='".$this->getWeb()."',`instagram`='".$this->getInstagram()."',
        `whatsapp`='".$this->getWhatsapp()."',`phone`='".$this->getPhone()."',
        `updated_by`='".$this->getUpdatedBy()."',`updated_at`='".$this->getUpdatedAt()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }  

    /**
     * getAllStores function
     *
     * @return array
     */
    public function getAllStores($page=NULL,$search=NULL){

        $sqlGetAll = "SELECT *,s.id AS store_id, 
        s.name AS store_name,
        c.id AS category_id, 
        c.name AS category_name
        FROM `stores` AS s 
        LEFT JOIN `categories` AS c 
        ON c.id = s.id_category";

        if($search){
            $sqlGetAll.= " WHERE s.name LIKE '%$search%'";
        }

        if($page){
            $page=$page!=1?$page:1;
            $since = ($page-1) * $this->forPage;
            $sqlGetAll.= " LIMIT $since,$this->forPage";
        }

        return $this->getArrayDataStore($sqlGetAll);

    }

    public function getTotalPages($forPage){
        $this->forPage=$forPage;
        $countUsers = $this->getCount();
        $totalPages = ceil($countUsers/$forPage);
        return $totalPages;
    }

    /**
     * getArrayDataStore function
     *
     * @param string $sql
     * @return array
     */
    public function getArrayDataStore(string $sql){
        $arrayObject = array();
        $resultGetAllStores = $this->mysqli->query($sql); 

        while($obj = $resultGetAllStores->fetch_object()){
            $arrayObject[$obj->store_id] = new static(); 
            $arrayObject[$obj->store_id]->setId($obj->store_id);
            $arrayObject[$obj->store_id]->setIdCategory($obj->id_category);
            $arrayObject[$obj->store_id]->setName($obj->store_name);
            $arrayObject[$obj->store_id]->setCuit($obj->cuit);
            $arrayObject[$obj->store_id]->setAddress($obj->address);
            $arrayObject[$obj->store_id]->setImage1($obj->image1);
            $arrayObject[$obj->store_id]->setImage2($obj->image2);
            $arrayObject[$obj->store_id]->setCellPhone($obj->cell_phone);
            $arrayObject[$obj->store_id]->setWeb($obj->web);
            $arrayObject[$obj->store_id]->setInstagram($obj->instagram);
            $arrayObject[$obj->store_id]->setWhatsapp($obj->whatsapp);
            $arrayObject[$obj->store_id]->setPhone($obj->phone);
            $arrayObject[$obj->store_id]->setCategory(new Categories());
            $arrayObject[$obj->store_id]->getCategory()->setId($obj->category_id);
            $arrayObject[$obj->store_id]->getCategory()->setName($obj->category_name);
            $arrayObject[$obj->store_id]->setBenefit(new Benefits());
            $arrayObject[$obj->store_id]->getBenefit()->getBenefitsByStoresId($obj->store_id);
            $arrayObject[$obj->store_id]->setContacts(new Contacts);
            $arrayObject[$obj->store_id]->getContacts()->getContactByStoresId($obj->store_id);
        }
        return $arrayObject;
    }
    
    /**
     * countStores function
     *
     * @return void
     */
    public function countStores(){

        $sqlStores = "SELECT COUNT(id) AS count_stores FROM `stores`";
        
        if($resultStores = $this->mysqli->query($sqlStores)){
            $row = $resultStores->fetch_array();
            $this->setCount($row["count_stores"]);
        }    
    }
}
?>