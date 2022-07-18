<?php 

class Application
{
    # propriete
    private $_DBC;  # dbconnect - objet PDO






    # methodes
    public function __construct($db)
    {
        $this->set_DBC($db);

        # timezone America/Guadeloupe
        date_default_timezone_set('America/Guadeloupe');
        
    }

    /**
     * liste de tous le personnel civil
     */
    public function personnels()
    {
        # liste de tous le personnel
        $req = "SELECT * FROM personnel";

        ob_start(); // ouverture de la mise en tampon
        $tampon = ob_get_contents(); // stockage du tampon dans une chaîne de caractères
        try {
            $resultat = $this->get_DBC()->query($req);
            $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);

            return $rows;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ob_end_clean(); // fermeture de la tamporisation de sortie et effacement du tampon
        echo $tampon ;
    }

    /**
     * affiche le contenu d'une fiche du personnel civil
     */
    public function fiche(int $id)
    {
        # 
        $req = "SELECT *
        FROM personnel
        INNER JOIN users ON personnel.id = users.personnel_id
        INNER JOIN compteur ON compteur.personnel_id = personnel.id
        WHERE personnel.id = :id";

        ob_start(); // ouverture de la mise en tampon
        $tampon = ob_get_contents(); // stockage du tampon dans une chaîne de caractères
        try {
            $resultat = $this->get_DBC()->prepare($req);
            $resultat->bindParam(':id', $id);
            $resultat->execute();
            $row = $resultat->fetch(PDO::FETCH_ASSOC);

            return $row;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ob_end_clean(); // fermeture de la tamporisation de sortie et effacement du tampon
        echo $tampon ;

    }

    /**
     * affiche la liste complete des demandes d'absences
     */
    public function absences()
    {
        # liste de toutes les demandes absences
        $req = "SELECT * 
        FROM absences
        INNER JOIN personnel ON absences.personnel_id = personnel.id
        INNER JOIN types_absences ON absences.type_id = types_absences.id
        ORDER BY date_demande DESC";

        ob_start(); // ouverture de la mise en tampon
        $tampon = ob_get_contents(); // stockage du tampon dans une chaîne de caractères
        try {
            $resultat = $this->get_DBC()->query($req);
            $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);

            return $rows;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ob_end_clean(); // fermeture de la tamporisation de sortie et effacement du tampon
        echo $tampon ;


    }

    /**
     * affiche la liste des jours ferie local
     */
    public function liste_ferie()
    {
        # affiche liste des jours feries
        $reqS = "SELECT * FROM ferie_local ORDER BY nouvelleDate";

        try {
            $resultat = $this->get_DBC()->prepare($reqS);
            $resultat->execute();
            $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);

            return $rows;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * affiche la liste des demandes par personnel_id
     */
    public function liste_absence(int $id)
    {
        $resultats = $this->absences();
        $rows = [];

        foreach ($resultats as $key => $resultat) {
            # code...
            if($resultat["personnel_id"] === "$id")
            {
                $rows[] = $resultat;
            }
        }

        return $rows;
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