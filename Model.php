<?php 
include "config.php" ; 
class Model{

    public $numero_model , $nom_model ; 

    public function __construct($numero_model,$nom_model) {
        $this->numero_model = $numero_model ;
        $this->nom_model = $nom_model;
    }
}

class marque {
    public $numero_marque , $nom_marque,$Prix ; 

    public function __construct($numero_marque , $nom_marque,$Prix) {
        $this->numero_marque =$numero_marque; 
        $this->nom_marque = $nom_marque ; 
        $this->Prix = $Prix;
    }

    public function getNumeroMarque() {return $this->numero_marque;}
    public function getNomMarque() { return $this->nom_marque;}
    public function getPrix() {return $this->Prix;}

}
 
class Client {
     public $Email , $Motdepasse , $civilite , $nom , $prenom , $adresse , $TVA , $code_postale , $Num_tel,$Ville,$Pays ; 

    public function __construct($Email , $Motdepasse , $civilite , $Nom , $Prenom , $Adresse , $TVA , $code_postale , $Ville,$Pays, $Num_tel ) {
        $this->Email = $Email ;
        $this->Motdepasse = $Motdepasse ; 
        $this->civilite = $civilite ; 
        $this->Nom = $Nom ; 
        $this->Prenom = $Prenom  ; 
        $this->Adresse = $Adresse ; 
        $this->TVA = $TVA ;
        $this->code_postale = $code_postale; 
        $this->Ville = $Ville ; 
        $this->Pays = $Pays;
        $this->Num_tel = $Num_tel ; 
    }
    
  
        
    public function getEmail() { return $this->Email;}
    public function getMot2passe() { return $this->Motdepasse;}
    public function getCivilite() { return $this->civilite;}
    public function getNom() { return $this->Nom;}
    public function getPrenom() { return $this->Prenom;}
    public function getAdresse() { return $this->Adresse;}
    public function getTva() { return $this->TVA;}
    public function getCodePostal() { return $this->code_postale;}
    public function getVille() { return $this->Ville;}
    public function getPays() { return $this->Pays; }
    public function AjoutClient() {

        if(Connexion::getInstance())
           {
               $query = "insert into client Values('$this->Email','$this->Motdepasse','$this->civilite' , '$this->Nom' , '$this->Prenom' , '$this->Adresse' , '$this->TVA' , '$this->code_postale','$this->Ville','$this->Pays','$this->Num_tel')"; 
               if(Connexion::query($query))
               echo "Client Inscrit Avec Success" ; 
               else 
               echo "Client est deja exisite";
           }
    
        }
    public function login($Email,$Pasword) {
            $query = "select * from client where email='$Email' and motpass='$Pasword'";
            if(Connexion::getInstance())
            $exec = Connexion::query($query);
            if($exec) 
            $rowcount = mysqli_num_rows($exec);
            if($rowcount==0)
            echo "verfifié votre Email ou Mot de passe"; 
            else 
            echo "Login Avec Success";

    }

    }
class Commande {

    public $qte, $numero_commande , $date_commande , $client , $marque = array() ; 


    public function __construct($numero_commande,$date_commande,$Client,$Marque,$qte) {

        $this->numero_commande = $numero_commande; 
        $this->date_commande = $date_commande ; 
        $this->client = $Client ; 
        $this->qte = $qte;
        array_push($this->marque,$Marque) ; 
    }
    public function getNumeroCommande() { return $this->numero_commande; }
    public function getDateCommande() { return $this->date_commande;}
    public function getClient() { return $this->client; }
    public function getMarque() { return $this->marque;}
    public function getQte() { return $this->qte;}
    public function getPrix() {

        $sum_prix = 0 ; 

    }
}

$Ghassen  = new Client("ghassenkahlaoui@gmail.com","iset@2020","Mr","ghasesen","kahlaoui","75 cite amen jendouba","TVA","8100","Jendouba","Tunisie","51506788");
$Ghassen->AjoutClient() ; echo "<br>";
$Ghassen->login("ghassenkahlaoui@gmail.com","iset@2020");
$hp = new Marque("HP07","HP","10000"); 
$commande = new Commande("Commande".$Ghassen->getEmail()."01","09-12-2020",$Ghassen,$hp,"1") ;  
echo "<br>Votre Panier :<br>";
echo "<hr>";
for($counter=0;$counter<count($commande->getMarque());$counter++) {
echo "Numero Marque :". $commande->getMarque()[$counter]->getNumeroMarque();
echo "<br>Nom Marque :". $commande->getMarque()[$counter]->getNomMarque();
echo "<br> Quantite :" . $commande->getQte();
echo "<br> Prix : " . $commande->getMarque()[$counter]->getPrix();

}
echo "<hr>";
echo "<br>Information personel<br>" ; 
echo "<br>Civilite :" .$commande->getClient()->getCivilite();
echo "<br>Nom :" .$commande->getClient()->getNom();
echo "<br>PreNom :" .$commande->getClient()->getPrenom();
echo "<br>Email :" .$commande->getClient()->getEmail();
echo "<br>Mot de passe :" .$commande->getClient()->getMot2passe();

echo "<br>Adresse :" .$commande->getClient()->getAdresse();
echo "<br>Ville :" .$commande->getClient()->getVille();
echo "<br>Pays :" .$commande->getClient()->getPays();
echo "<br>Code Postale :" .$commande->getClient()->getCodePostal();
echo "<br>TVA :" .$commande->getClient()->getTva();

echo " <br><hr>Information commande :<br>";
echo "Numero Commande : ". $commande->getNumeroCommande();
echo "<br> Date Commande :". $commande->getDateCommande();



/*
public function getVille() { return $this->Ville;}
    public function getPays() { return $this->Pays; }
public function getEmail() { return $this->Email;}
public function getMot2passe() { return $this->Motdepasse;}
public function getCivilite() { return $this->Civilite;}
public function getNom() { return $this->Nom;}
public function getPrenom() { return $this->Prenom;}
public function getAdresse() { return $this->Adresse;}
public function getTva() { return $this->TVA;}
public function getCodePostal() { return $this->code_postale;}
*/

?>