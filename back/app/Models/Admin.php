<?php
require_once('Base.php');

class Admin extends Base{
    // Connexion
    private $con;
    private $table = "client";

    // object properties
    public $idClient;
    public $nom;
    public $age;
    public $profession;
    public $reference;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     */
    public function __construct(){
        $this->con = $this->connect();
    }

    public function getAllClients()
    {
        $query = "SELECT * FROM $this->table ";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

public function deleteClient($idClient)
    {
        $query = "DELETE FROM $this->table WHERE idClient = ?";
        $stmt = $this->con->prepare($query);

        $idClient = htmlspecialchars(strip_tags($idClient));
        $stmt->bindParam(1, $idClient);

        return $stmt->execute();
    }


    public function one($idClient)
    {
        $query = "SELECT * FROM $this->table WHERE idClient =:idClient";
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':idClient',$idClient);

        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateClient($nom,$prenom, $age,$profession, $idClient){
        $query = "UPDATE $this->table SET `nom`='$nom',`prenom`='$prenom',`age`='$age',`profession`='$profession' WHERE `idClient` = $idClient ";
        $stmt = $this->con->prepare($query);

        // $nom= htmlspecialchars(strip_tags($nom));
        // $prenom = htmlspecialchars(strip_tags($prenom));
        // $age = htmlspecialchars(strip_tags($age));
        // $profession = htmlspecialchars(strip_tags($profession));
        // $idClient = htmlspecialchars(strip_tags($idClient));
        // $reference= htmlspecialchars(strip_tags($reference));
        
        // $stmt->bindParam(":nom", $nom);
        // $stmt->bindParam(":prenom", $prenom);
        // $stmt->bindParam(":age", $age);
        // $stmt->bindParam(":profession", $profession);
        // $stmt->bindParam(":idClient", $idClient);
        // $stmt->bindParam("reference", $reference);
        
        return $stmt->execute();
    }


    public function getAdmin($reference)
    {
        $query = "SELECT * FROM administrateur WHERE reference=:reference ";
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':reference',$reference);

        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   }