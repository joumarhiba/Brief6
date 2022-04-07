<?php 

require_once('Base.php');

class Rdv extends Base
{
    private $table = "rdv";
    private $con; 

    public function __construct(){
        $this->con = $this->connect();
    }

    public function addRdv($sujet, $date, $creneau, $idClient )
    {
        $query = "INSERT INTO $this->table SET sujet='$sujet',`date`='$date',créneau=$creneau,idClient=$idClient";
        $stmt = $this->con->prepare($query);

        return $stmt->execute();   
    }

    public function deleteRdv($id)
    {
        $query = "DELETE FROM $this->table WHERE idRdv = ?";
        $stmt = $this->con->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(1, $id);

        return $stmt->execute();
    } 

    public function updateRdv( $idRdv, $sujet, $date, $creneau)
    {
        $sujet = htmlspecialchars(strip_tags($sujet));
        $date = htmlspecialchars(strip_tags($date));
        $creneau = htmlspecialchars(strip_tags($creneau));
        $idRdv = htmlspecialchars(strip_tags($idRdv));

        $query = "UPDATE $this->table SET `sujet`='$sujet',`date`='$date',`créneau`=$creneau WHERE idRdv = $idRdv";
        $stmt = $this->con->prepare($query);

        // $stmt->bindParam("sujet", $sujet);
        // $stmt->bindParam("date", $date);
        // $stmt->bindParam("creneau", $creneau);
        // $stmt->bindParam("idRdv", $idRdv);


        return $stmt->execute();
    }

    public function RdvDate($date)
    {
        $query = "SELECT * FROM `rdv` WHERE date=:date";
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':date',$date);
        
        $stmt->execute();
        return $stmt;

        
    }

    public function historique($idClient)
    {
        $date = date('Y\-m\-d');
        $query = "SELECT rdv.*, calandrier.creneau  FROM $this->table JOIN calandrier ON $this->table.créneau = calandrier.id
        WHERE date < '$date' AND idClient=:idClient";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':idClient',$idClient);
        $stmt->execute();

        return $stmt;

    }

    public function todayRdv($idClient)
    {
        $date = date('Y\-m\-d');
        $query = "SELECT rdv.*, calandrier.creneau  FROM $this->table JOIN calandrier ON $this->table.créneau = calandrier.id WHERE date='$date' AND idClient=:idClient";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':idClient',$idClient);
        $stmt->execute();

        return $stmt;
    }

    public function futureRdv($idClient)
    {
        $date = date('Y\-m\-d');
        $query = "SELECT rdv.*, calandrier.creneau  FROM $this->table JOIN calandrier ON $this->table.créneau = calandrier.id WHERE date >'$date' AND idClient=:idClient";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':idClient',$idClient);
        $stmt->execute();

        return $stmt;
    }

    public function one($idRdv)
    {
        $query = "SELECT rdv.*,calandrier.creneau as theTime FROM $this->table JOIN calandrier ON $this->table.créneau = calandrier.id 
        WHERE idRdv =:idRdv";
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':idRdv',$idRdv);

        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}