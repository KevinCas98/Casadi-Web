<?php 
class Files extends DbConnection {

    public int $id = 0;
    public int $idUser = 0;
    public string $name = "";
    public string $path = "";
    public int $checked = 0;

    public function setId(int $id){
        $this->id = $id;
    }
    
    public function setIdUser(int $idUser){
        $this->idUser = $idUser;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    /**
     * Set the value of checked
     *
     */ 
    public function setChecked($checked)
    {
        $this->checked = $checked;
    }

    /**
     * Set the value of path
     *
     */ 
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the value of checked
     */ 
    public function getChecked()
    {
        return $this->checked;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdUser(){
        return $this->idUser;
    }

    public function getName(){
        return $this->name;
    }
    
    /**
     * getFilesById function
     *
     * @param integer $id
     * @return boolean 
     */
    public function getFilesById(int $id){
        
        $sqlFiles = "SELECT *
                    FROM `files` 
                    WHERE files.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultFiles = $this->mysqli->query($sqlFiles)){
            $row = $resultFiles->fetch_array();
            $this->setId($row['id']);
            $this->setIdUser($row['id_user']);
            $this->setName($row['name']);
            $this->setPath($row['path']);
            return true;
        }
        return false;
    }


    /**
     * saveFiles function
     *
     * @return boolean
     */
    public function saveFiles(){
        $sqlInsert = "INSERT INTO `files`(`id_user`,`name`,`path`,`checked`) 
        VALUES ('".$this->getIdUser()."','".$this->getName()."','".$this->getPath()."','".$this->getChecked()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * getAllFiles function
     *
     * @return array
     */
    public function getAllFiles(){
        $sqlGetAll = "SELECT *
                    FROM `files` 
                    ORDER BY id DESC;";

        return $this->setArrayAllDataBySql($sqlGetAll);
    }

    /**
     * getFilesByUserId function
     *
     * @param integer $idUser
     * @return array
     */
    public function getFilesByUserId(int $idUser){
        $sql = "SELECT *
                    FROM `files` 
                    WHERE id_user = '".$idUser."' AND checked = 1
                    ORDER BY id DESC;";

        return $this->setArrayAllDataBySql($sql);
    }

    /**
     * setArrayAllDataBySql function
     *
     * @param string $sql
     * @return array
     */
    public function setArrayAllDataBySql(string $sql){

        $arrayObject = array();

        $resultGetAllFiles = $this->mysqli->query($sql); 

        while($obj = $resultGetAllFiles->fetch_object()){
            $arrayObject[$obj->id] = new static(); 
            $arrayObject[$obj->id]->setId($obj->id);
            $arrayObject[$obj->id]->setIdUser($obj->id_user);
            $arrayObject[$obj->id]->setName($obj->name);
            $arrayObject[$obj->id]->setPath($obj->path);
            $arrayObject[$obj->id]->setChecked($obj->checked);
        }
        return $arrayObject;
    } 

    /**
     * updateCheckByIdUser function
     *
     * @return bool
     */
    public function updateCheckByIdUser(){
        $sqlUpdate = "UPDATE `files` 
        SET `checked`='0'
        WHERE id_user = '".$this->getIdUser()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }
}
?>