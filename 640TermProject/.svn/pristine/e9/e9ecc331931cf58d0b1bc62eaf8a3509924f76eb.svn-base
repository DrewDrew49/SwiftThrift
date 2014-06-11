<?php

class User{

	private $firstName;
	private $username;
	private $email;
	private $password;
	private $admin;

	function __construct($id, $firstName, $username, $email, $password, $admin){
		$this->setId($id);
		$this->setFirstName($firstName);
		$this->setUsername($username);
		$this->setEmail($email);
		$this->setPassword($password);
		$this->setAdmin($admin);
	}

	public function getId(){
		return $this->id;
	}

	public function getFirstName(){
		return $this->firstName;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getAdmin(){
		return $this->admin;
	}

	public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

	public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function setHashedPassword($password){
    	$this->password = $password;

    	return $this;
    }

    public function setPassword($password)
    {
        $this->password = Utils::saltAndHash($password);

        return $this;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }
}

?>
