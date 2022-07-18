<?php 

class Absence
{

    # propriete
    private $_DBC;  # dbconnect - objet PDO






    # methode
    public function __construct($db)
    {
        $this->set_DBC($db);

        # timezone America/Guadeloupe
        date_default_timezone_set('America/Guadeloupe');
    }

    
    public function demande_absence(DateTime $debut, DateTime $fin)
    {
        $id = $_SESSION["id"];
        #
        $reqS = "SELECT * FROM absences
        INNER JOIN personnel ON absences.personnel_id = personnel.id
        INNER JOIN types_absences ON absences.type_id = types_absences.id
        WHERE personnel.id = '".$id."'
       /* WHERE date_debut BETWEEN '".$debut->format("Y-m-d H:i:s")."' AND '".$fin->format("Y-m-d H:i:s")."' AND
        date_fin BETWEEN '".$debut->format("Y-m-d H:i:s")."' AND '".$fin->format("Y-m-d H:i:s")."'*/
        ORDER BY absences.personnel_id ASC";

        try {
            $resultat = $this->get_DBC()->query($reqS);
            $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);

            return $rows;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    public function demande_absence_par_Jour(DateTime $debut, DateTime $fin)
    {
        #
        $absences = $this->demande_absence($debut, $fin);
        $jours = [];

        foreach($absences as $listeA)
        {
            if($listeA["nbr_jours"] > 1)
            {
                $d = new DateTime($listeA["date_debut"]);
                $j = $d->format('Y-m-d');

                $start_date = date_create($listeA["date_debut"]);
                $end_date   = date_create($listeA["date_fin"]); // If you want to include this date, add 1 day

                $interval = DateInterval::createFromDateString('1 day'); 
                $daterange = new DatePeriod($start_date, $interval ,$end_date);

                foreach($daterange as $date1)
                {
                    if($date1->format('N') === "6" || $date1->format('N') === "7" )
                    {
                        // rien

                    } else {
                        if($date1->format('Y-m-d') !== $end_date->format("Y-m-d"))
                        {
                            $listeD = $date1->format('Y-m-d');

                            if(!isset($jours[$listeD]))
                            {
                                # creation tableau taille 1 et stocker les absences 
                                $jours[$listeD] = [$listeA];

                            } //


                        } else {


                        } // end if/else 

                    } // end if/else 


                } // end foreach


                if($end_date->format("Y-m-d") > $date1->format('Y-m-d'))
                {
                    $end = (clone $date1)->modify('+1 day');
                    $listeD = $end->format("Y-m-d");
                    
                    $jours[$listeD] = [$listeA];

                } //


            } else {

                $d = new DateTime($listeA["date_debut"]);
                $j = $d->format('Y-m-d');

                if(!isset($jours[$j]))
                {
                    # creation tableau taille 1 et stocker les absences 
                    $jours[$j] = [$listeA];

                } else {
                    # si tableau existe deja ajouter les autres absences
                    $jours[$j][] = $listeA;

                } //


            } // end if 

        } // end foreach

        return $jours;
        
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
}