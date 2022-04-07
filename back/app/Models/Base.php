 <?php 


class Base
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    // private $database = "";
    protected $conn;


    public function connect()
    {
        try{
            $this->conn = new PDO("mysql:host=$this->servername;dbname=architecte",$this->username, $this->password);
            return $this->conn;
        }
        catch(PDOException $e){ 
            echo "No Connection with DB  : ".$e->getMessage();
        }
        
    }
}