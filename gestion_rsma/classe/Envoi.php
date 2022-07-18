<?php 
# include tempo
/* +25 jours au 1er + 9 RTT - 9 RTT EMPLOYEURS */
/* -1 jours  */
session_start();

use PHPMailer\PHPMailer\PHPMailer;

include("db_connect.php");
$myC = new Connect_pdo;

class Calculer
{
    # propriete
    private $_DBC;  # dbconnect - objet PDO
    private $_debut;
    private $_fin;
    private $_typeAbsence;
    private $_personnelID;
    private $_etat;

    private $_msgPHPM;
    private $_message;






    # methode
    public function __construct($db, $sendM)
    {
        $this->set_DBC($db);

        # timezone America/Guadeloupe
        date_default_timezone_set('America/Guadeloupe');

        $this->set_msgPHPM($sendM);
        
    }

    public function compter(array $datas)
    {
        // $_SESSION['id'] 
        print_r($datas);
        print_r($_SESSION);

       


        $date_depart = strtotime($datas["date1"]);
        $date_fin = strtotime($datas["date2"]);

        $nb_jours_ouvres = $this->get_nb_open_days($date_depart, $date_fin);

        echo $nb_jours_ouvres;

    }

    /**
     * https://codes-sources.commentcamarche.net/source/47518-calcul-simple-du-nombre-de-jours-ouvres-entre-deux-dates-jours-feries-integres
     */

    public function get_nb_open_days($date_start, $date_stop) {	
        $arr_bank_holidays = array(); // Tableau des jours feriés	
        
        // On boucle dans le cas où l'année de départ serait différente de l'année d'arrivée
        $diff_year = date('Y', $date_stop) - date('Y', $date_start);
        for ($i = 0; $i <= $diff_year; $i++) {			
            $year = (int)date('Y', $date_start) + $i;
            // Liste des jours feriés
            $arr_bank_holidays[] = '1_1_'.$year; // Jour de l'an
            $arr_bank_holidays[] = '1_5_'.$year; // Fete du travail
            $arr_bank_holidays[] = '8_5_'.$year; // Victoire 1945
            $arr_bank_holidays[] = '14_7_'.$year; // Fete nationale
            $arr_bank_holidays[] = '15_8_'.$year; // Assomption
            $arr_bank_holidays[] = '1_11_'.$year; // Toussaint
            $arr_bank_holidays[] = '11_11_'.$year; // Armistice 1918
            $arr_bank_holidays[] = '25_12_'.$year; // Noel
                    
            // Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote	
            $easter = easter_date($year);
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + 86400); // Paques
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*39)); // Ascension
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*50)); // Pentecote	
        }
        //print_r($arr_bank_holidays);
        $nb_days_open = 0;
        // Mettre <= si on souhaite prendre en compte le dernier jour dans le décompte	
        while ($date_start < $date_stop) {
            // Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés	
            if (!in_array(date('w', $date_start), array(0, 6)) 
            && !in_array(date('j_n_'.date('Y', $date_start), $date_start), $arr_bank_holidays)) {
                $nb_days_open++;		
            }
            $date_start = mktime(date('H', $date_start), date('i', $date_start), date('s', $date_start), date('m', $date_start), date('d', $date_start) + 1, date('Y', $date_start));			
        }
        
        # add MA
        if($nb_days_open === 0 && ($date_start === $date_stop) )
        {
            $nb_days_open = 1;
        }
        return $nb_days_open;
    }

   





    # getter / setter



    /**
     * Get the value of _DBC
     */ 
    public function get_DBC()
    {
        return $this->_DBC;
    }

    /**
     * Set the value of _DBC
     *
     * @return  self
     */ 
    public function set_DBC($_DBC)
    {
        $this->_DBC = $_DBC;

        return $this;
    }

    /**
     * Get the value of _debut
     */ 
    public function get_debut()
    {
        return $this->_debut;
    }

    /**
     * Set the value of _debut
     *
     * @return  self
     */ 
    public function set_debut($_debut)
    {
        $this->_debut = $_debut;

        return $this;
    }

    /**
     * Get the value of _fin
     */ 
    public function get_fin()
    {
        return $this->_fin;
    }

    /**
     * Set the value of _fin
     *
     * @return  self
     */ 
    public function set_fin($_fin)
    {
        $this->_fin = $_fin;

        return $this;
    }

    /**
     * Get the value of _typeAbsence
     */ 
    public function get_typeAbsence()
    {
        return $this->_typeAbsence;
    }

    /**
     * Set the value of _typeAbsence
     *
     * @return  self
     */ 
    public function set_typeAbsence($_typeAbsence)
    {
        $this->_typeAbsence = $_typeAbsence;

        return $this;
    }

    /**
     * Get the value of _personnelID
     */ 
    public function get_personnelID()
    {
        return $this->_personnelID;
    }

    /**
     * Set the value of _personnelID
     *
     * @return  self
     */ 
    public function set_personnelID($_personnelID)
    {
        $this->_personnelID = $_personnelID;

        return $this;
    }

    /**
     * Get the value of _etat
     */ 
    public function get_etat()
    {
        return $this->_etat;
    }

    /**
     * Set the value of _etat
     *
     * @return  self
     */ 
    public function set_etat($_etat)
    {
        $this->_etat = $_etat;

        return $this;
    }

    /**
     * Get the value of _msgPHPM
     */ 
    public function get_msgPHPM()
    {
        return $this->_msgPHPM;
    }

    /**
     * Set the value of _msgPHPM
     *
     * @return  self
     */ 
    public function set_msgPHPM($_msgPHPM)
    {
        $this->_msgPHPM = $_msgPHPM;

        return $this;
    }

    /**
     * Get the value of _message
     */ 
    public function get_message()
    {
        return $this->_message;
    }

    /**
     * Set the value of _message
     *
     * @return  self
     */ 
    public function set_message($_message)
    {
        $this->_message = $_message;

        return $this;
    }
}

# test

$_POST["choix"] = "901";
$_POST["date1"] = "2022-06-01";
$_POST["date2"] = "2022-06-22";
$_POST["com"] = "";
$_POST["personnel_id"] = "52";



try {

    //print_r($myC->getConnectDB());
    $db = $myC->getConnectDB();


    # instancier mes classes
    $test = New Calculer($db, $phpMailer="");
    $test->compter($_POST);
    

} catch(Exception $e){
    echo $e->getMessage(), "\n";
}