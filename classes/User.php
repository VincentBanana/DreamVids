<?php
class User {

    private $existing;
    private $id = 0;
    private $name;
    private $mail;
    private $avatar;
    private $subscribers;
    private $rank;

    protected function __construct($id) {
    	$this->id = $id;
        $this->loadDataFromDatabase();
    }

    // Read infos about User from the DB
    private function loadDataFromDatabase() {
    	$db = new BDD();
        $result = $db->select("*", "users", "WHERE id='".$this->id."'") or die(mysql_error());

        while($row = $db->fetch_array($result)) {
            $this->id = $row['id'];
            $this->name = $row['username'];
            $this->mail = $row['email'];
            $this->avatar = $row['avatar'];
            $this->subscribers = $row['subscribers'];
            $this->rank = $row['rank'];
        }

        if($this->id != 0) {
            $this->existing = true;
        }
        else
            $this->existing = false;
    }

    public function saveDataToDatabase() {
        if($this->existing) {
            $db = new BDD();
            $db->update("users", "username='".$db->real_escape_string($this->name)."', email='".$db->real_escape_string($this->mail)."', avatar='".$db->real_escape_string($this->avatar)."', subscribers='$this->subscribers', rank='$this->rank'", "WHERE id='$this->id'");
        }
    }
    
    public function setUsername($newName) {
    	if ($this->existing) {
    		$this->name = $newName;
    	}
    }
    
    public function setPass($newPass) {
    	if ($this->existing) {
    		$db = new BDD();
    		$db->update("users", "pass='".sha1($db->real_escape_string($newPass) )."'",  "WHERE id='$this->id'");
    	}
    }

    public function setEmailAddress($newMail) {
        if($this->existing) {
            $this->mail = $newMail;
        }
    }

    public function setAvatarPath($newAvatar) {
        if($this->existing) {
            $this->avatar = $newAvatar;
        }
    }

    public function setSubscribers($newSubscribers) {
        if($this->existing) {
            $this->subscribers = $newSubscribers;
        }
    }

    public function setRank($newRank) {
        if($this->existing) {
            $this->rank = $newRank;
        }
    }

    //
    
	public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmailAddress() {
        return $this->mail;
    }

    public function getAvatarPath() {
        return $this->avatar;
    }

    public function getSubscribers() {
        return $this->subscribers;
    }

    public function getRank() {
        return $this->rank;
    }
}

?>