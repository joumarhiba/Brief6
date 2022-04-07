<?php 

require_once './app/Models/Client.php';
// require './app/core/DB.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8 ");
header("Access-Control-Allow-Methods: * ");
header("Access-Control-Allow-Max-Age: 3600 ");
header("Access-Control-Allow-Headers: * ");


class ClientController
{
    public function all()
    {
        // echo json_encode('bnjour all');
        $clients = new Client();
        $results = $clients->getAllClients();


        if($results){


            $array = array();
            $array['data'] = array();

            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $clients = array(
                    // 'id'=>$idClient,
                    // 'nom'=>$nom,
                    // 'prenom'=>$prenom,
                    // 'age'=>$age,
                    // 'profession'=>$profession,
                    'reference'=>$reference
                );

                array_push($array['data'],$clients);
            }
        echo json_encode($array);
        }else
        {
            echo json_encode(
                array('message'=>'no data is here')
            );
        }
    }

    // public function single($id)
    // {
    //     $client = new Client();
    //     $results = $client->getClientById($id);

    //     $array = array();
    //     $array['data'] = array();

    //     extract($results);

    //     $pizza = array(
    //         'id'=>$id,
    //         'createdBy'=>$createdBy,
    //         'date'=>$date,
    //         'elements'=>$elements
    //     );

    //     echo json_encode($pizza);
    // }

    public function add()
    {

        // echo json_encode('add function');
        $data =json_decode(file_get_contents("php://input"));
        

        if(isset($data->prenom) && isset($data->nom) && isset($data->age) && isset($data->profession)){
            $prenom = $data->prenom;
            $nom = $data->nom;
            $age = $data->age;
            $profession = $data->profession;
            $reference  = substr($data->nom, 0, 1).substr($data->prenom, 0, 1).rand(1,1000) ; ;
        }else{
            echo json_encode(
                array("message"=>"noo data")
            );
        }


        if(isset($prenom) && isset($nom) && isset($age) && isset($profession) && isset($reference))
        {
            $client = new Client();
            if($client->addClient($prenom,$nom,$age,$profession,$reference)){
                echo json_encode(
                    array("message"=>"Client Account created")
                );
            }else
            {
                echo json_encode(
                    array("message"=>"Client Account not created")
                );
            }
        }
    }



    public function login()
    {
        $data =json_decode(file_get_contents("php://input"));
        if(isset($data->reference)){
            $referenceCheck = $data->reference;
        }
        if(isset($referenceCheck))
        {
            $data =[];
            $data['data'] =[];
            $client = new Client();
            if($result = $client->getClient($referenceCheck)){
                extract($result);
                echo $idClient;
                
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





    public function user()
    {   
        (array)$data =json_decode(file_get_contents("php://input"));
        if(isset($data)){
            $id = $data->id;
            $client = new Client();
            $getUser = $client->getClientByID($id);
    
            if($getUser){
    
                $array = array();
                $array['data'] = array();
                
                extract($getUser);
    
                $user = array(
                    'idClient'=>$idClient,
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'age'=>$age,
                    'profession'=>$profession,
                    'reference'=>$reference
    
                );
                array_push($array['data'],$user);
                echo json_encode($array);
            }else{
                echo json_encode(
                    array("message"=>"This is no id ")
                );
            }
        }else{
            echo json_encode(
                array("message"=>"data is empty")
            );
        }
    }
    

}