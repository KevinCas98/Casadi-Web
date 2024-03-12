<?php 
require "../src/model/rol/rol.class.php";
class Collaborators extends DbConnection {

    public int $id = 0;
    public int $idInstitution = 0;
    public string $userName = "";
    public string $password = "";
    public string $name = "";
    public string $lastName = "";
    public string $dni = "";
    public string $email = "";
    public int $idRol = 0;
    public Rol $rol;
    private $forPage;

    public function setId(int $id){
        $this->id = $id;
    }

    public function setIdInstitution(int $idInstitution){
        $this->idInstitution = $idInstitution;
    }

    public function setUserName(string $userName){
        $this->userName = $userName;
    }

    public function setPassword(string $password){
        $this->password = $password;
    }

    public function setName(string $name){
        $this->name = $name;
    }
    
    public function setLastName(string $lastName){
        $this->lastName = $lastName;
    }

    public function setDni(string $dni){
        $this->dni = $dni;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setIdRol(int $idRol) {
		$this->idRol = $idRol;
	}

    public function setRol(Rol $rol) {
		$this->rol = $rol;
	}

    public function setCount(int $count) {
		$this->count = $count;
	}

    public function getId(){
        return $this->id;
    }

    public function getIdInstitution(){
        return $this->idInstitution;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getIdRol() {
		return $this->idRol;
	}

    public function getRol() {
		return $this->rol;
	}

    public function getCount() {
		return $this->count;
	}

    /**
     * getCollaboratorById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getCollaboratorsById(int $id){
        
        $sqlCollaborators = "SELECT *
                    FROM `collaborators` 
                    WHERE collaborators.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultCollaborators = $this->mysqli->query($sqlCollaborators)){
            $row = $resultCollaborators->fetch_array();
            $this->setId($row['id']);
            $this->setIdInstitution($row['id_institution']);
            $this->setUserName($row['user_name']);
            $this->setPassword($row['password']);
            $this->setName($row['name']);
            $this->setLastName($row['last_name']);
            $this->setDni($row['dni']);
            $this->setEmail($row['email']);
            return true;
        }
        return false;
    }
    
    /**
     * getCollaboratorByUserAndPass
     * @param string  $userName
     * @param string  $password
     * @return boolean
     */
    public function getCollaboratorByUserAndPass(string $userName, string $password){
        $sqlCollaborator = "SELECT *, c.id AS id_collaborators, c.name AS name_collaborators, r.id AS id_rol, r.code_name AS code_name 
        FROM `collaborators` AS c 
        LEFT JOIN `rol` AS r ON r.id = c.id_rol
        WHERE c.user_name = '$userName' AND c.password = '$password'
        ORDER BY id_collaborators DESC LIMIT 1;";  
        
        if($resultCollaborator = $this->mysqli->query($sqlCollaborator)){
            $row = $resultCollaborator->fetch_array();
            if($row){
                $this->setId($row["id_collaborators"]);
                $this->setIdInstitution($row["id_institution"]);
                $this->setName($row["name_collaborators"]);
                $this->setLastName($row["last_name"]);
                $this->setRol(new Rol());
                $this->getRol()->setId($row["id_rol"]);
                $this->getRol()->setCodeName($row["code_name"]);
                return true;
            }
        }   
        return false;
    }

    /**
     * saveCollaborator function
     *
     * @return boolean
     */
    public function saveCollaborators(){
        $sqlInsert = "INSERT INTO `collaborators`(`id_institution`, `user_name`, `password`, `name`, `last_name`, `dni`, `email`, `id_rol`) 
        VALUES ('".$this->getIdInstitution()."','".$this->getUserName()."','".$this->getPassword()."','".$this->getName()."','".$this->getLastName()."','".$this->getDni()."','".$this->getEmail()."','".$this->getIdRol()."')";

        echo $sqlInsert;
        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateCollaborator function
     *
     * @return boolean
     */
    public function updateCollaborators(){

        $sqlUpdate = "UPDATE `collaborators` 
        SET `id_institution`='".$this->getIdInstitution()."',`user_name`='".$this->getUserName()."',
        `password`='".$this->getPassword()."',`name`='".$this->getName()."',`last_name`='".$this->getLastName()."',`dni`='".$this->getDni()."',
        `email`='".$this->getEmail()."',`id_rol`='".$this->getIdRol()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * getAllCollaborator function
     *
     * @return array
     */
    public function getAllCollaborators($page=NULL,$search=NULL){

        $arrayObject = array();
        $sqlGetAll = "SELECT *
                    FROM `collaborators`";

        if($search){
            $sqlGetAll.= " WHERE name LIKE '%$search%'";
        }

        $sqlGetAll.= " ORDER BY id DESC";

        if($page){
            $page=$page!=1?$page:1;
            $since = ($page-1) * $this->forPage;
            $sqlGetAll.= " LIMIT $since,$this->forPage";
        }

        $resultGetAllCollaborators = $this->mysqli->query($sqlGetAll); 

        while($obj = $resultGetAllCollaborators->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setIdInstitution($obj->id_institution);
            $arrayObject[$obj->id]->setUserName($obj->user_name);
            $arrayObject[$obj->id]->setPassword($obj->password);
            $arrayObject[$obj->id]->setName($obj->name);
            $arrayObject[$obj->id]->setLastName($obj->last_name);
            $arrayObject[$obj->id]->setDni($obj->dni);
            $arrayObject[$obj->id]->setEmail($obj->email);
            $arrayObject[$obj->id]->setIdRol($obj->id_rol);
        }

        return $arrayObject;
    }

    public function getTotalPages($forPage){
        $this->forPage=$forPage;
        $countUsers = $this->getCount();
        $totalPages = ceil($countUsers/$forPage);
        return $totalPages;
    }

    /**
     * countCollaborators function
     *
     * @return void
     */
    public function countCollaborators(){

        $sqlCollaborators = "SELECT COUNT(id) AS count_collaborators FROM `collaborators`";
        
        if($resultCollaborators = $this->mysqli->query($sqlCollaborators)){
            $row = $resultCollaborators->fetch_array();
            $this->setCount($row["count_collaborators"]);
        }    
    }

}
?>