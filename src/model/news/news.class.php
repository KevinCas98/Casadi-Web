<?php
require "../src/model/collaborators/collaborators.class.php";

class News extends DbConnection{
    
    public int $id = 0;
    public string $title = "";
    public string $description = "";
    public string $image = "";
    public string $createdAt = "";
    public string $updatedAt = "";
    public int $createdBy = 0;
    public int $updatedBy = 0;
    private $forPage;

    public function setId(int $id){
        $this->id = $id;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function setImage(string $image){
        $this->image = $image;
    }

    public function setCreatedAt(string $updatedAt) {
		$this->updatedAt = $updatedAt;
	}

    public function setUpdatedAt(string $updatedAt) {
		$this->updatedAt = $updatedAt;
	}

    public function setCreatedBy(int $createdBy) {
		$this->createdBy = $createdBy;
	}

    public function setUpdatedBy(int $updatedBy) {
		$this->updatedBy = $updatedBy;
	}

    public function setCount(int $count) {
		$this->count = $count;
	}

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getImage(){
        return $this->image;
    }

    public function getCreatedAt() {
		return $this->updatedAt;
	}

    public function getUpdatedAt() {
		return $this->updatedAt;
	}

    public function getCreatedBy() {
		return $this->createdBy;
	}

    public function getUpdatedBy() {
		return $this->updatedBy;
	}

    public function getCount() {
		return $this->count;
	}

    /**
     * getNewsById function
     *
     * @param integer $id
     * @return boolean
     */
    public function getNewsById(int $id){
        
        $sqlNews = "SELECT *
                    FROM `news` 
                    WHERE news.id = $id
                    ORDER BY id DESC LIMIT 1;";          

        if($resultNews = $this->mysqli->query($sqlNews)){
            $row = $resultNews->fetch_array();
            $this->setId($row['id']);
            $this->setTitle($row['title']);
            $this->setDescription($row['description']);
            $this->setImage($row['image']);
            return true;
        }
        return false;
    }

    /**
     * getNewByIdApi function
     *
     * @param integer $id
     * @return array
     */
    public function getNewByIdApi(int $id){

        $sqlNews = "SELECT *,
                    n.id AS news_id,
                    n.title AS news_title,
                    n.description AS news_description,
                    n.image AS news_image,
                    n.created_at AS news_created_at
                    FROM `news` AS n 
                    WHERE n.id = $id
                    ORDER BY n.id DESC LIMIT 1;";     

        return $this->getArrayDataNews($sqlNews);
    }

    
    /**
     * saveNews function
     *
     * @return boolean
     */
    public function saveNews(){
        $sqlInsert = "INSERT INTO `news`(`title`, `description`, `image`,  `created_by`, `created_at`) 
        VALUES ('".$this->getTitle()."','".$this->getDescription()."','".$this->getImage()."',
        '".$this->getCreatedBy()."','".$this->getCreatedAt()."')";

        if($this->mysqli->query($sqlInsert)){
            $this->setId($this->mysqli->insert_id);
            return true;
        }    
        return false;
    }

    /**
     * updateNews function
     *
     * @return boolean
     */
    public function updateNews(){

        $sqlUpdate = "UPDATE `news` 
        SET `title`='".$this->getTitle()."',`description`='".$this->getDescription()."',`image`='".$this->getImage()."',
        `updated_by`='".$this->getUpdatedBy()."',`updated_at`='".$this->getUpdatedAt()."'
        WHERE id = '".$this->getId()."';";

        if($this->mysqli->query($sqlUpdate)){
            return true;
        }    
        return false;
    }

    /**
     * deleteNews function
     *
     * @return boolean
     */ 
    public function deleteNews($id){
        $sqlDelete = "DELETE FROM `news` WHERE id = $id;";

        if($this->mysqli->query($sqlDelete)){
            return true;
        }    
        return false;
    }   
    
    /**
     * countNews function
     *
     * @return void
     */
    public function countNews(){

        $sqlNews = "SELECT COUNT(id) AS count_news FROM `news`";
        
        if($resultNews = $this->mysqli->query($sqlNews)){
            $row = $resultNews->fetch_array();
            $this->setCount($row["count_news"]);
        }    
    }

    /**
     * getAllNews function
     *
     * @return array
     */
    public function getAllNews($page=NULL,$search=NULL){

        $sqlGetAll = "SELECT *,
        n.id AS news_id,
        n.title AS news_title,
        n.description AS news_description,
        n.image AS news_image,
        n.created_at AS news_created_at
        FROM `news` AS n";

        if($search){
            $sqlGetAll.= " WHERE n.title LIKE '%$search%'";
        }

        if($page){
            $page=$page!=1?$page:1;
            $since = ($page-1) * $this->forPage;
            $sqlGetAll.= " LIMIT $since,$this->forPage";
        }

        return $this->getArrayDataNews($sqlGetAll);
    }

    public function getTotalPages($forPage){
        $this->forPage=$forPage;
        $countUsers = $this->getCount();
        $totalPages = ceil($countUsers/$forPage);
        return $totalPages;
    }

    /**
     * getArrayDataNews function
     *
     * @param string $sql
     * @return array
     */
    public function getArrayDataNews(string $sql){
        $arrayObject = array();
        $resultGetAllNews = $this->mysqli->query($sql); 

        while($obj = $resultGetAllNews->fetch_object()){
            $arrayObject[$obj->news_id] = new static(); 
            $arrayObject[$obj->news_id]->setId($obj->news_id);
            $arrayObject[$obj->news_id]->setTitle($obj->news_title);
            $arrayObject[$obj->news_id]->setDescription($obj->news_description);
            $arrayObject[$obj->news_id]->setImage($obj->news_image);
            $arrayObject[$obj->news_id]->setCreatedAt($obj->news_created_at);
        }

        return $arrayObject;
    }
}
?>