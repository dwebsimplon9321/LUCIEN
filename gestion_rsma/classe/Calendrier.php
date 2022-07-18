<?php 

class Calendrier
{
    # propriete
    private $_DBC;  # dbconnect - objet PDO

    private $_mois = [];

    private $_m; 
    private $_y;

    private $_mv;

    public $semaine = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];







    # methodes
    public function __construct($db, int $m, int $y)
    {
        $this->set_DBC($db);

        # timezone America/Guadeloupe
        date_default_timezone_set('America/Guadeloupe');

        $this->set_m($m);
        $this->set_y($y);

        # index tab start in 1
        $this->set_mois([1=>"Janvier","Février","Mars","Avril","Mai","Juin", "Juillet","Août","Septembre", "Octobre","Novembre","Décembre"]);

    }

    /**
     * Affiche le mois et l'année
     */
    public function afficher_mois()
    {
        //echo $m, $y;

        if($this->get_y() < 1970 )
        {
            # error exception
            echo "<pre>";
            throw new \Exception("L'année indiqué n'est pas valide", 2);
            echo "</pre>";

        } else {

            if($this->get_y() === "")
            {
                $this->set_y(date("Y"));

            }

        }

        $this->set_mv($this->get_mois()[$this->get_m()]);

        # mois[index] = mois[1] -> Janvier
        if( isset($this->get_mois()[$this->get_m()]) < 1 || isset($this->get_mois()[$this->get_m()]) > 12)
        {
            # error exception
            echo "<pre>";
            throw new \Exception("Le mois indiqué n'est pas valide", 1);
            echo "</pre>";
        } else {

            if($this->get_m() === "")
            {
                return $this->get_mois()[date('n')]." ".$this->get_y();
            } else {
                return $this->get_mois()[$this->get_m()]." ".$this->get_y();
            }

        }

    }

    /**
     * affiche le mois suivant
     */
    public function moisSuivant()
    {
        ob_start(); // ouverture de la mise en tampon
        $tampon = ob_get_contents(); // stockage du tampon dans une chaîne de caractères

        $lMois = $this->get_m() + 1;
        $lAnnee = $this->get_y();

        if($lMois > 12)
        {
            # changer d'annee
            $lMois = 1;   // 01
            $lAnnee += 1; // 2022 +1
        }

        # renvoi nouveau mois et annee dans url
        return $lMois.'&annee='.$lAnnee;
        ob_end_clean(); // fermeture de la tamporisation de sortie et effacement du tampon
        echo $tampon ;
    }


    /**
     * affiche le mois precedent
     */
    public function moisPrecedent()
    {
        ob_start(); // ouverture de la mise en tampon
        $tampon = ob_get_contents(); // stockage du tampon dans une chaîne de caractères

        $lMois = $this->get_m() - 1;
        $lAnnee = $this->get_y();

        if($lMois < 1)
        {
            # changer d'annee
            $lMois = 12;   // 12
            $lAnnee -= 1; // 2022 - 1
        }

        # cree une nouvelle date
        return $lMois.'&annee='.$lAnnee;
        ob_end_clean(); // fermeture de la tamporisation de sortie et effacement du tampon
        echo $tampon ;
    }


    /**
     * affiche 1er jour du mois
     */
    public function firstDayInMonth()
    {
        return new DateTime(intval($this->get_y())."-".intval($this->get_m())."-01");
    }

    /**
     * verifie jour dans le mois en cours
     */
    public function withInMonth(DateTime $date)
    {
        return $this->firstDayInMonth()->format("Y-m") === $date->format("Y-m");
    }


    /**
     * affiche les jours de la semaine
     */
    public function getWeeks() 
    {
        # calcule nombre de semaine par mois
        $this->set_mois($this->liste_mois($this->get_mv()));  # recupere le mois en chiffre

        # creation objet DateTime Y-m-d 01 1er jour du mois
        //$start = new DateTime($this->get_annee()."-".$this->get_mois()."-01");
        $start = $this->firstDayInMonth($this->get_mois(), $this->get_y());
        

        # Y-m-d 31/30/29/28 dernier jour du mois en faisant une copie de $start sans modifier son contenu
        $end = (clone $start)->modify('+1 month - 1 day');

        # numero de semaine du mois
        $semaines = intval($end->format('W')) - intval($start->format('W')) + 1;

        # attention pour le mois de decembre, janvier (indique -47)
        if($semaines < 0  )
        {
            $semaines = 6;
        }
        
        return $semaines;
    }


    /**
     * cherche le mois en index (voir si fonction conversion existe)
     */
    public function liste_mois($callMois)
    {
        $c = "";

        switch ($callMois) {
            case 'Janvier':
                $c = 1;
                break;

            case 'Février':
                $c = 2;
                break;

            case 'Mars':
                $c = 3;
                break;

            case 'Avril':
                $c = 4;
                break;

            case 'Mai':
                $c = 5;
                break;

            case 'Juin':
                $c = 6;
                break;

            case 'Juillet':
                $c = 7;
                break;

            case 'Août':
                $c = 8;
                break;

            case 'Septembre':
                $c = 9;
                break;

            case 'Octobre':
                $c = 10;
                break;

            case 'Novembre':
                $c = 11;
                break;

            case 'Décembre':
                $c = 12;
                break;
            
            default:
                # code...
                break;
        }
        
        return $c;

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
     * Get the value of _mois
     */ 
    public function get_mois()
    {
        return $this->_mois;
    }

    /**
     * Set the value of _mois
     *
     * @return  self
     */ 
    public function set_mois($_mois)
    {
        $this->_mois = $_mois;

        return $this;
    }

    

    /**
     * Get the value of _mv
     */ 
    public function get_mv()
    {
        return $this->_mv;
    }

    /**
     * Set the value of _mv
     *
     * @return  self
     */ 
    public function set_mv($_mv)
    {
        $this->_mv = $_mv;

        return $this;
    }

    /**
     * Get the value of _m
     */ 
    public function get_m()
    {
        return $this->_m;
    }

    /**
     * Set the value of _m
     *
     * @return  self
     */ 
    public function set_m($_m)
    {
        $this->_m = $_m;

        return $this;
    }

    /**
     * Get the value of _y
     */ 
    public function get_y()
    {
        return $this->_y;
    }

    /**
     * Set the value of _y
     *
     * @return  self
     */ 
    public function set_y($_y)
    {
        $this->_y = $_y;

        return $this;
    }
}