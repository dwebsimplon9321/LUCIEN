<?php 
class Agent extends Gestion
{
    # propriete
    private $_choix;
    private $_dateDEB;
    private $_dateFIN;
    private $_commentaire;
    private $_personnelID;

    private $_label;
    private $_nouvelleDate;


    # method
    public function absence(array $datas)
    {
        /*print_r($_SESSION);*/
        print_r($datas); 

        # convertir date
        $dateD = new DateTime($datas["date_dbt"]);
        $dateF = new DateTime($datas["date_fn"]);

        $this->set_choix($datas["choix"]);
        $this->set_dateDEB($dateD->format('Y-m-d H:i:s'));
        $this->set_dateFIN($dateF->format('Y-m-d H:i:s'));
        $this->set_commentaire($datas["com"]);
        $this->set_personnelID($datas["personnel_id"]);


        # afficher les valeurs pour le test
        /*echo $this->get_choix();
        echo $this->get_dateDEB();
        echo $this->get_dateFIN();
        echo $this->get_commentaire();
        echo $this->get_personnelID(); */

        /**A FAIRE : PRISE EN COMPTE 1/2 JOURNEE */
        if($this->get_choix() === "908" || $this->get_choix() === "909" || $this->get_choix() === "910" || $this->get_choix() === "911")
        {
            $nbrJours = "0.5";
            $demiJournee = "1";
        } else {
            $nbrJours = $this->get_nb_open_days(strtotime($this->get_dateDEB()), strtotime($this->get_dateFIN()) );
        }

        $date = date("Y-m-d");
        $etat = "en_cours";

        echo $nbrJours;

        # insertion dans table absences
        $req = "INSERT INTO absences (personnel_id, date_demande, demi_journee, date_debut, date_fin, type_id, nbr_jours, etat)
        VALUES ('".$this->get_personnelID()."', '".$date."', '".$demiJournee."' ,'".$this->get_dateDEB()."', '".$this->get_dateFIN()."', 
        '".$this->get_choix()."', '".$nbrJours."', '".$etat."')";

        //print_r($req);

        # executer la requete
        $resultat = $this->get_DBC()->query($req);

        /**A FAIRE METTRE EN PLACE REDIRECTION */
        if($resultat->rowCount() == 1)
        {
            echo "insert ok FAIRE REDIRECTION";

        } else {
            echo "insert not ok";
        }


        
    }

    public function add_ferie(array $datas)
    {
        $year = date('Y');
        # mise en forme donnees
        $this->set_label(ucfirst(addslashes(trim($datas["label"]))));  // addslashes protection simple côte
        $this->set_nouvelleDate($datas["date"]);

        $reqI = "INSERT INTO ferie_local (label, nouvelleDate) 
        VALUES('".$this->get_label()."', '".$this->get_nouvelleDate()."')";

        # executer la requete
        $resultat = $this->get_DBC()->query($reqI);

        if($resultat->rowCount() == 1)
        {
            echo "insert ok";

            /* Ceci produira une erreur. Notez la sortie ci-dessus,
            * qui se trouve avant l'appel à la fonction header() */
            header('Location: https://'.$_SERVER["SERVER_NAME"].'/gestion/ajouter_ferie.php');
            exit;

        } else {
            echo "insert not ok";
        }
        
    }


    /**
     * https://codes-sources.commentcamarche.net/source/47518-calcul-simple-du-nombre-de-jours-ouvres-entre-deux-dates-jours-feries-integres
     */

    public function get_nb_open_days($date_start, $date_stop) {	

        # add MA
        $reqS = "SELECT * FROM ferie_local ORDER BY nouvelleDate";
        $resultat = $this->get_DBC()->prepare($reqS);
        $resultat->execute();
        $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);

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

            # add MA jour supplementaire local
            foreach($rows as $row)
            {
                # convertir les dates 'j_n_'.$year
                $date = new DateTime($row["nouvelleDate"]);
                $arr_bank_holidays[] = $date->format('j_n_'.$year);
            }

                    
            // Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote	
            $easter = easter_date($year);
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + 86400); // Paques
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*39)); // Ascension
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*50)); // Pentecote	

        }
        # add MA
        natsort($arr_bank_holidays);
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
        
        # add MA date a date = 1
        if($nb_days_open === 0 && ($date_start === $date_stop) )
        {
            $nb_days_open = 1;
        }
        return $nb_days_open;
    }




    # getter / setter


    /**
     * Get the value of _choix
     */ 
    public function get_choix()
    {
        return $this->_choix;
    }

    /**
     * Set the value of _choix
     *
     * @return  self
     */ 
    public function set_choix($_choix)
    {
        $this->_choix = $_choix;

        return $this;
    }

    /**
     * Get the value of _dateDEB
     */ 
    public function get_dateDEB()
    {
        return $this->_dateDEB;
    }

    /**
     * Set the value of _dateDEB
     *
     * @return  self
     */ 
    public function set_dateDEB($_dateDEB)
    {
        $this->_dateDEB = $_dateDEB;

        return $this;
    }

    /**
     * Get the value of _dateFIN
     */ 
    public function get_dateFIN()
    {
        return $this->_dateFIN;
    }

    /**
     * Set the value of _dateFIN
     *
     * @return  self
     */ 
    public function set_dateFIN($_dateFIN)
    {
        $this->_dateFIN = $_dateFIN;

        return $this;
    }

    /**
     * Get the value of _commentaire
     */ 
    public function get_commentaire()
    {
        return $this->_commentaire;
    }

    /**
     * Set the value of _commentaire
     *
     * @return  self
     */ 
    public function set_commentaire($_commentaire)
    {
        $this->_commentaire = $_commentaire;

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
     * Get the value of _label
     */ 
    public function get_label()
    {
        return $this->_label;
    }

    /**
     * Set the value of _label
     *
     * @return  self
     */ 
    public function set_label($_label)
    {
        $this->_label = $_label;

        return $this;
    }

    /**
     * Get the value of _nouvelleDate
     */ 
    public function get_nouvelleDate()
    {
        return $this->_nouvelleDate;
    }

    /**
     * Set the value of _nouvelleDate
     *
     * @return  self
     */ 
    public function set_nouvelleDate($_nouvelleDate)
    {
        $this->_nouvelleDate = $_nouvelleDate;

        return $this;
    }
}