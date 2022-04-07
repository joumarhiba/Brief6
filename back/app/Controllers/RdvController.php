<?php 
require_once './app/Models/Rdv.php';
// require './app/Models/Base.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8 ");
header("Access-Control-Allow-Methods: * ");
header("Access-Control-Allow-Max-Age: 3600 ");
header("Access-Control-Allow-Headers: * ");

class RdvController{

    public function one()
    {
        $data =json_decode(file_get_contents('php://input'));
        $date = $data->date;

        $rdv = new RDV();
        $results = $rdv->RdvDate($date);

            $array = [];
            $array['data'] = [];

            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $rdvs = array(
                    'creneau'=>$créneau
                );
                array_push($array['data'],$rdvs);
            }    
            echo json_encode($array);
    }

    public function add()
    {
        $data =json_decode(file_get_contents("php://input"));

        if(isset($data->sujet) && isset($data->date) && isset($data->creneau) && isset($data->idClient)){
            $sujet = $data->sujet;
            $date = $data->date;
            $creneau = $data->creneau;
            $idClient = $data->idClient;
        }
    
            $rdv = new Rdv();
            if($rdv->addRdv($sujet,$date,$creneau,$idClient)){
                echo json_encode(
                    array("message"=>"Rdv created")
                );
            }else
            {
                echo json_encode(
                    array("message"=>"Rdv not created")
                );
            
        }
    }
// ..........Rdv/historique = fetch
    public function historique()
    {
        $data =json_decode(file_get_contents('php://input'));
        $idClient = $data->idClient;
        // echo json_encode($data);
        $rdv = new Rdv();
        $rdvH = $rdv->historique($idClient);

        if($rdvH){
            $array = array();
            $array['data'] = array();

            while($row = $rdvH->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $Rdv = array(
                    'idRdv'=>$idRdv,
                    'sujet'=>$sujet,
                    'date'=>$date,
                    'creneau'=>$creneau,
                    'idClient'=>$idClient,
                );

                array_push($array['data'],$Rdv);
            }
        echo json_encode($array);
        }else
        {
            echo json_encode(
                array('message'=>'no data is here')
            );
        }
    }


    public function todayRdv()
    {
        $data =json_decode(file_get_contents('php://input'));
        $idClient = $data->idClient;

        $rdv = new Rdv();
        $rdvH = $rdv->todayRdv($idClient);

        if($rdvH){
            $array = array();
            $array['data'] = array();

            while($row = $rdvH->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $Rdv = array(
                    'idRdv'=>$idRdv,
                    'sujet'=>$sujet,
                    'date'=>$date,
                    'creneau'=>$creneau,
                    'idClient'=>$idClient,
                );

                array_push($array['data'],$Rdv);
            }
        echo json_encode($array);
        }else
        {
            echo json_encode(
                array('message'=>'no data is here')
            );
        }
    }

    public function futureRdv()
    {
        $data =json_decode(file_get_contents("php://input"));
        $idClient = $data->idClient;

        $rdv = new Rdv();
        $rdvH = $rdv->futureRdv($idClient);

        if($rdvH){
            $array = array();
            $array['data'] = array();

            while($row = $rdvH->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $Rdv = array(
                    'idRdv'=>$idRdv,
                    'sujet'=>$sujet,
                    'date'=>$date,
                    'creneau'=>$creneau,
                    'idClient'=>$idClient,
                );

                array_push($array['data'],$Rdv);
            }
        echo json_encode($array);
        }else
        {
            echo json_encode(
                array('message'=>'no data is here')
            );
        }
    }

    public function removeRdv()
    {
        $data =json_decode(file_get_contents("php://input"));
        $idRdv = $data->idRdv;

        $rdv = new RDV();
        $rdv->deleteRdv($idRdv);

        if($rdv->deleteRdv($idRdv)){
            echo json_encode(
                array("message"=>"Rdv deleted")
            );
        }else
        {
            echo json_encode(
                array("message"=>"Rdv not deleted")
            );
        
        }
    }
    
    public function oneRdv()
    {
        $id = $_GET['id'];
        $rdv = new RDV();
        $oneRdv = $rdv->one($id);
        
        


        if($oneRdv){
            extract($oneRdv);

            $result = array(
                'idRdv'=>$idRdv,
                'sujet'=>$sujet,
                'date'=>$date,
                'créneau'=>$créneau,
                'Time'=>$theTime,
                'idClient'=>$idClient,
            );
            
            echo json_encode($result);
        }
    }

    public function UpdateRdv(){
        $data =json_decode(file_get_contents("php://input"));

        if(isset($data->sujet) && isset($data->date) && isset($data->creneau) && isset($data->idRdv)){
            $sujet = $data->sujet;
            $date = $data->date;
            $creneau = $data->creneau;
            $idRdv = $data->idRdv;
        }
    
            $rdv = new Rdv();
            if($rdv->updateRdv( $idRdv, $sujet, $date, $creneau)){
                echo json_encode(
                    array("message"=>"Rdv updated")
                );
            }else
            {
                echo json_encode(
                    array("message"=>"Rdv not updated")
                );
            
        }
    } 
}