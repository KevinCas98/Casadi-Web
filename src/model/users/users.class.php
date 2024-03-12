<?php 
require "../src/model/collaborators/collaborators.class.php";

class Users extends DbConnection
{
    public int $id = 0;
    public int $idCollaborator = 0;
    public string $dni = "";
    public string $dateChecked = "";
    public int $checked = 0;
    public int $checkedBy = 0;
    public string $name = "";
    public string $lastName = "";
    public string $sex = "";
    public string $dateOfBirth = "";
    public string $city = "";
    public string $province = "";
    public string $email = "";
    public string $contact = "";
    public string $userName = "";
    public string $password = "";
    public string $token = "";
    public string $typeOfCard = "";
    public int $count = 0;
    public int $doseQuantity = 0;
    public string $profileImg = "";
    public string $deviceToken = "";
    public Collaborators $collaborators;

    private $forPage;
    


    public function setId(int $id){
        $this->id = $id;
    }

    public function setIdCollaborator(int $idCollaborator){
        $this->idCollaborator = $idCollaborator;
    }

    public function setDni(string $dni){
        $this->dni = $dni;
    }

    public function setDateChecked($dateChecked){
        $this->dateChecked = $dateChecked?$dateChecked:"";
    }

    public function setChecked($checked){
        $this->checked = $checked?$checked:0;
    }

    public function setCheckedBy($checkedBy){
        $this->checkedBy = $checkedBy?$checkedBy:0;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setLastName(string $lastName){
        $this->lastName = $lastName;
    }

    public function setSex(string $sex){
        $this->sex = $sex;
    }

    public function setDateOfBirth(string $dateOfBirth){
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setCity(string $city){
        $this->city = $city;
    }

    public function setProvince(string $province){
        $this->province = $province;
    }
    
    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setContact(string $contact){
        $this->contact = $contact;
    }

    public function setUserName(string $userName){
        $this->userName = $userName;
    }

    public function setPassword(string $password){
        $this->password = $password;
    }

    public function setToken(string $token){
        $this->token = $token;
    }
    
    public function setTypeOfCard(string $typeOfCard){
        $this->typeOfCard = $typeOfCard;
    }

    public function setCount(string $count){
        $this->count = $count;
    }

    public function setDoseQuantity(int $doseQuantity){
        $this->doseQuantity = $doseQuantity;
    }

    public function setDeviceToken(string $deviceToken) {
        $this ->deviceToken = $deviceToken;
    }

    /**
     * Get the value of profileImg
     */ 
    public function getProfileImg()
    {
        return $this->profileImg;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdCollaborator(){
        return $this->idCollaborator;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getDateChecked(){
        return $this->dateChecked;
    }

    public function getChecked(){
        return $this->checked;
    }

    public function getCheckedBy(){
        return $this->checkedBy;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getSex(){
        return $this->sex;
    }

    public function getDateOfBirth(){
        return $this->dateOfBirth;
    }

    public function getCity(){
        return $this->city;
    }

    public function getProvince(){
        return $this->province;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getContact(){
        return $this->contact;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getToken(){
        return $this->token;
    }

    public function getTypeOfCard(){
        return $this->typeOfCard;
    }
    
    public function getCount(){
        return $this->count;
    }

    public function getDoseQuantity(){
        return $this->doseQuantity;
    }

    public function getDeviceToken() {
        return $this->deviceToken;
    }

    /**
     * Set the value of profileImg
     */   
    public function setProfileImg($profileImg)
    {
        $this->profileImg = $profileImg;
    }

    /**
     * setAllDataBySql function
     *
     * @param string $sql
     * @return boolean
     */
    private function setAllDataBySql(string $sql){
        $return = false;
        if($resultUser = $this->mysqli->query($sql)){
            $row = $resultUser->fetch_array();
                if($row){
                    $this->setId($row['id']);
                    $this->setIdCollaborator($row['id_collaborator']?$row['id_collaborator']:0);
                    $this->setDni($row['dni']);
                    $this->setDateChecked($row['date_checked']?$row['date_checked']:"");
                    $this->setChecked($row['checked']?$row['checked']:"");
                    $this->setCheckedBy($row['checked_by']?$row['checked_by']:"");
                    $this->setName($row['name']);
                    $this->setLastName($row['last_name']);
                    $this->setSex($row['sex']?$row['sex']:"");
                    $this->setDateOfBirth($row['date_of_birth']?$row['date_of_birth']:"");
                    $this->setCity($row['city']?$row['city']:"");
                    $this->setProvince($row['province']?$row['province']:"");
                    $this->setEmail($row['email']);
                    $this->setContact($row['contact']?$row['contact']:"");
                    $this->setUserName($row['user_name']);
                    $this->setPassword($row['password']);
                    $this->setToken($row['token']);
                    $this->setTypeOfCard($row['type_of_card']?$row['type_of_card']:"");
                    $this->setDoseQuantity($row['dose_quantity']?$row['dose_quantity']:0);
                    $return = true;
                }
        }
        return $return;
    }

    /**
     * getUserByEmail function
     *
     * @param string $email
     * @return array
     */
    public function getUserByEmail(string $email){
        $sqlUser = "SELECT *
                    FROM `users` 
                    WHERE users.email = '".$email."'
                    ORDER BY id DESC LIMIT 1;";             

        return $this->getAllUserArrayBySql($sqlUser);            
    }

    /**
     * getUserByToken function
     *
     * @param string $token
     * @return array
     */
    public function getUserByToken(string $token){
        $sqlUser = "SELECT *
                    FROM `users` 
                    WHERE users.token = '".$token."'
                    ORDER BY id DESC LIMIT 1;";              

        return $this->getAllUserArrayBySql($sqlUser);            
    }

    /**
     * getUserByUserNameAndPassword function
     *
     * @param string $userName
     * @param string $password
     * @return array
     */
    public function getUserByUserNameAndPassword(string $userName, string $password){
        $sqlUser = "SELECT *
                    FROM `users` 
                    WHERE users.user_name = '".$userName."' AND users.password = '".$password."'
                    ORDER BY id DESC LIMIT 1;";              

        return $this->getAllUserArrayBySql($sqlUser);            
    }

    
    /**
     * getUserByIdApi function
     *
     * @param integer $id
     * @return array
     */
    public function getUserByIdApi(int $id){
        $sqlUser = "SELECT *
                    FROM `users` 
                    WHERE users.id = $id
                    ORDER BY id DESC LIMIT 1;";   

        return $this->getAllUserArrayBySql($sqlUser); 
    }


    /**
     * getUsersById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getUsersById(int $id){
        
        $sqlUser = "SELECT *
                    FROM `users` 
                    WHERE users.id = $id
                    ORDER BY id DESC LIMIT 1;";   

        return $this->setAllDataBySql($sqlUser);            
        
    }

    /**
     * saveUser function
     *
     * @return boolean
     */
    public function saveUser(){
        $sqlInsert = "INSERT INTO `users`(`name`, `last_name`, `dni`, `email`, 
        `user_name`, `password`, `token`, `device_token`) 
        VALUES ('".$this->getName()."','".$this->getLastName()."',
        '".$this->getDni()."','".$this->getEmail()."',
        '".$this->getUserName()."','".$this->getPassword()."','".$this->getToken()."','".$this->getDeviceToken()."');";
     
        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateUser function
     *
     * @return boolean
     */
    public function updateUser(){

        $sqlUpdate = "UPDATE `users` 
        SET `dni`='".$this->getDni()."',
        `name`='".$this->getName()."',`last_name`='".$this->getLastName()."',`sex`='".$this->getSex()."',
        `date_of_birth`='".$this->getDateOfBirth()."',`city`='".$this->getCity()."',
        `province`='".$this->getProvince()."', `contact`='".$this->getContact()."',
        `profile_img`='".$this->getProfileImg()."'
        WHERE token = '".$this->getToken()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * updateDataCard function
     *
     * @param string $token
     * @return bool
     */
    public function updateDataCard(string $token){
        $sqlUpdate = "UPDATE `users` 
        SET `dose_quantity`='".$this->getDoseQuantity()."',
        `type_of_card`='".$this->getTypeOfCard()."',`checked`='".$this->getChecked()."'
        WHERE token = '".$token."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllUserArrayBySql function
     *
     * @param string $sql
     * @return array
     */
    private function getAllUserArrayBySql(string $sql, bool $api = true){

        $arrayObject = array();
        $resultGetAllUsers = $this->mysqli->query($sql); 

        while($obj = $resultGetAllUsers->fetch_object()){
            if($api){$arrayObject["id"] = $obj->id;}
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setIdCollaborator($obj->id_collaborator?$obj->id_collaborator:0);
            $arrayObject[$obj->id]->setDni($obj->dni);
            $arrayObject[$obj->id]->setDateChecked($obj->date_checked?$obj->date_checked:"");
            $arrayObject[$obj->id]->setChecked($obj->checked?$obj->checked:"");
            $arrayObject[$obj->id]->setCheckedBy($obj->checked_by?$obj->checked_by:0);
            $arrayObject[$obj->id]->setName($obj->name);
            $arrayObject[$obj->id]->setLastName($obj->last_name);
            $arrayObject[$obj->id]->setSex($obj->sex?$obj->sex:"");
            $arrayObject[$obj->id]->setDateOfBirth($obj->date_of_birth?$obj->date_of_birth:"");
            $arrayObject[$obj->id]->setCity($obj->city?$obj->city:"");
            $arrayObject[$obj->id]->setProvince($obj->province?$obj->province:"");
            $arrayObject[$obj->id]->setEmail($obj->email);
            $arrayObject[$obj->id]->setContact($obj->contact?$obj->contact:"");
            $arrayObject[$obj->id]->setUserName($obj->user_name);
            $arrayObject[$obj->id]->setPassword($obj->password);
            $arrayObject[$obj->id]->setToken($obj->token);
            $arrayObject[$obj->id]->setDeviceToken($obj->device_token);
            $arrayObject[$obj->id]->setTypeOfCard($obj->type_of_card?$obj->type_of_card:"");
            $arrayObject[$obj->id]->setDoseQuantity($obj->dose_quantity?$obj->dose_quantity:0);
            $arrayObject[$obj->id]->setProfileImg($obj->profile_img?$obj->profile_img:"");
        }

        return $arrayObject;

    }

    /**
     * getAllUser function
     *
     * @return array
     */
    public function getAllUser($page=NULL,$search=NULL){
        $sqlGetAll = "SELECT *
                    FROM `users`";

        if($search){
            $sqlGetAll.= " WHERE name LIKE '%$search%'";
        }

        $sqlGetAll.= " ORDER BY id DESC";

        if($page){
            $page=$page!=1?$page:1;
            $since = ($page-1) * $this->forPage;
            $sqlGetAll.= " LIMIT $since,$this->forPage";
        }

        return $this->getAllUserArrayBySql($sqlGetAll, false);
    }

    public function getTotalPages($forPage){
        $this->forPage=$forPage;
        $countUsers = $this->getCount();
        $totalPages = ceil($countUsers/$forPage);
        return $totalPages;
    }
    
    /**
     * countUsers function
     *
     * @return void
     */
    public function countUsers(){

        $sqlUsers = "SELECT COUNT(id) AS count_users FROM `users`";
        
        if($resultUsers = $this->mysqli->query($sqlUsers)){
            $row = $resultUsers->fetch_array();
            $this->setCount($row["count_users"]);
        }    
    }

    public function getNameStatus(int $checked){
        $return="";
        if($checked == 0){
            $return = "Incompleto"; 
        }elseif($checked == 1){
            $return = "Verificar";
        }else{
            $return = "Verificado";
        }
        return $return;
    }

    public function updateDataUserChecked(){
        $sqlUpdate = "UPDATE `users` 
        SET `dose_quantity`='".$this->getDoseQuantity()."',`checked`='".$this->getChecked()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }
}

?>