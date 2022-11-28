<?php

namespace src\Model;

class User
{
    private ?int $Id = null; // = int or Null
    private String $Mail;
    private String $Password;
    private Array $Roles;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->Id;
    }

    /**
     * @param int|null $Id
     * @return User
     */
    public function setId(?int $Id): User
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return String
     */
    public function getMail(): string
    {
        return $this->Mail;
    }

    /**
     * @param String $Mail
     * @return User
     */
    public function setMail(string $Mail): User
    {
        $this->Mail = $Mail;
        return $this;
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @param String $Password
     * @return User
     */
    public function setPassword(string $Password): User
    {
        $this->Password = $Password;
        return $this;
    }

    /**
     * @return Array
     */
    public function getRoles(): array
    {
        return $this->Roles;
    }

    /**
     * @param Array $Roles
     * @return User
     */
    public function setRoles(array $Roles): User
    {
        $this->Roles = $Roles;
        return $this;
    }


    public function SqlAdd(){
        $bdd = BDD::getInstance();
        try{
            $requete = $bdd->prepare('INSERT INTO users (mail, password, roles) 
    VALUES(:mail, :password, :roles)');
            $requete->execute([
                'mail' => $this->getMail()
                ,'password' => $this->getPassword()
                ,'roles' => json_encode($this->getRoles())
            ]);
            return array("0", "[OK] Insertion",$bdd->lastInsertId());
        }catch (\Exception $e){
            return array("1", "[ERREUR] ".$e->getMessage());
        }
    }

    public static function SqlGetByMail($mail) : ?User{
        $bdd = BDD::getInstance();
        $requete = $bdd->prepare('SELECT * FROM users WHERE mail=:mail');
        $requete->execute([
            "mail"=> $mail
        ]);

        $userSql = $requete->fetch(\PDO::FETCH_ASSOC);

        if($userSql != false){
            $user = new User();
            $user->setMail($userSql["mail"])
                ->setId($userSql["Id"])
                ->setPassword($userSql["password"])
                ->setRoles(json_decode($userSql["roles"]));
            return $user;
        }
        return null;
    }

}