<?php

require_once './app/Models/Admin.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8 ");
header("Access-Control-Allow-Methods: * ");
header("Access-Control-Allow-Max-Age: 3600 ");
header("Access-Control-Allow-Headers: * ");


    // On instancie la base de données
   

class AdminController
{
    public function loginAdmin()
    {
        $data =json_decode(file_get_contents('php://input'));
        if(isset($data->reference)){
            $referenceCheck = $data->reference;
        }
        if(isset($referenceCheck))
        {
            $data =[];
            $data['data'] =[];
            $client = new Admin();
            if($result = $client->getAdmin($referenceCheck)){
                extract($result);
                $message = array(
                    'reference'=>$reference
                );
                echo json_encode($message);
            }
            else{
                $message = array(
                    'error'=>true,
                    'message'=>'User not found'
                );
                array_push($data['data'],$message);
                echo json_encode($data);
            }

        }

}

    public function allC()
    {
        $clients = new Admin();
        $stmt = $clients->getAllClients();

        // echo "<pre>";
        // print_r($results);
        // echo "</pre>";
        if($stmt->rowCount() > 0){
            // On initialise un tableau associatif
            $tableauClient = [];
            $tableauClient['clients'] = [];
    
            // On parcourt les produits
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
    
                $c = [
                    "idClient" => $idClient,
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "age" => $age,
                    "profession" => $profession,
                    "reference" => $reference
                ];
    
                $tableauClient['clients'][] = $c;
            }
    
    
            // // On encode en json et on envoie
            echo json_encode($tableauClient);
        }
        else
        {
            echo json_encode(
                array('message'=>'no data is here')
            );
        }
    }


    public function delete(){
        $client = new Admin();

        $donnees = json_decode(file_get_contents('php://input'));
       
    
        if(!empty($donnees->idClient)){
            
            $id = $donnees->idClient;
            
            if($client->deleteClient($id)){
                echo json_encode(["message" => "La suppression a  effectuee"]);
            }else{
                echo json_encode(["message" => "La suppression n a pas effectuée"]);         
            }
        }
    else{
        // On gère l'erreur
        echo json_encode(["message" => "La méthode n'est pas autorisée"]);
    }   
}

public function oneclient()
    {
        $id = $_GET['id'];
        $client = new Admin();
        $oneClient = $client->one($id);
        
        


        if($oneClient){
            extract($oneClient);

            $result = array(
                'idClient'=>$idClient,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'age'=>$age,
                'profession'=>$profession,
            );
            
            echo json_encode($result);
        }
    }




public function update(){
   

    $donnees = json_decode(file_get_contents('php://input'));
    
    if(!empty($donnees->nom) && !empty($donnees->prenom) && !empty($donnees->age) && !empty($donnees->profession) ){

        $nom = $donnees->nom;
        $prenom = $donnees->prenom;
        $age = $donnees->age;
        $profession = $donnees->profession;
        $idClient= $donnees->idClient ;

        $clients = new Admin();
        if($clients-> updateClient($nom,$prenom, $age,$profession, $idClient)){
           
            echo json_encode(["message" => "La modification a été effectuée"]);
        }else{
            echo json_encode(["message" => "La modification n'a pas été effectuée"]);         
        }
    }
else{
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);

} 

}
// public function removeClient()
//     {
//         $data =json_decode(file_get_contents("php://input"));
//         $idClient = $data->idClient;

//         $rdv = new Admin();
//         // $rdv->deleteClient($idClient);

//         if($rdv->deleteClient($idClient)){
//             echo json_encode(
//                 array("message"=>"client deleted")
//             );
//         }else
//         {
//             echo json_encode(
//             array("message"=>"client not deleted")
//             );

//     }
//     }

  
}