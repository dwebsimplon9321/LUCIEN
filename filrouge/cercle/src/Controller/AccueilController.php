<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\fileExists;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    /**
     * @Route("/liste", name="accueil_liste")
     */
    public function liste() 
    {
        $adherants = $this->tableau();

        return $this->render('accueil/liste.html.twig', [
            'controller_name' => 'AccueilController', // nom du controller
            'adherants' => $adherants                  // variable tableau liste adherants
        ]);
    }


    /**
     * @Route("/detail/{id}", name="accueil_detail")
     */
    public function detail(int $id)
    {

        $adherants = $this->tableau();

        // boucle
        foreach($adherants as $adherant)
        {
            //print_r($adherant);

            if($adherant["adherantid"] === $id)
            {
                //print_r($adherant);
                return $this->render('accueil/detail.html.twig', [
                    'detailA' => $adherant
                ]);
            }

        }

    }


    /**
     * @Route("/update/{id}", name="accueil_update")
     */
    public function update_adherant(int $id)
    {

        $adherants = $this->tableau();

        for($i=0; $i < count($adherants); $i++ )
        {
           // print_r($adherants[$i]);

            if($adherants[$i]["adherantid"] == $id)
            {
                $replacements = array("adresse" => "rsma, la jaille", "cp" => "97122", "commune" => "Baie-Mahault");
                $adherants[$i] = array_replace($adherants[$i], $replacements);

                print_r($adherants);

                    // chemin local du fichier .json
                    $fichier = $_SERVER["DOCUMENT_ROOT"]."/../var/liste.json";

                    // Encoder un fichier au format .json
                    $json = json_encode($adherants);

                    // creer le fichier .json
                    file_put_contents($fichier, $json );

                return $this->render('accueil/update.html.twig', [
                    'detailA' => $adherants[$i]
                ]);
            }
        }

        // boucle
        
        
    }


    public function tableau()
    {
        
        
         /**
         * remplacer le tableau static par un fichier txt contenant un tableau
         */
        $datas = [
            [
                'adherantid' => 200,
                'nom'       => 'ambrosio',
                'prenom' => 'martine',
                'date_naissance' => '1969-05-07',
                'adresse' => 'Rue des rencontres',
                'suite' => '',
                'cp' => '97139',
                'commune' => 'Les abymes',
                'portable' => '0690690778',
                'email' => 'martine.ambrosio@gmail.com'

            ],
            [
                'adherantid' => 201,
                'nom'       => 'NESTOR',
                'prenom' => 'Lucien',
                'date_naissance' => '1958-07-24',
                'adresse' => '24 rue des champs de blé',
                'suite' => '',
                'cp' => '97122',
                'commune' => 'Baie-Mahault',
                'portable' => '0690632312',
                'email' => 'nestor.lucien@gmail.com'
            ],
            [
                'adherantid' => 202,
                'nom'       => 'RICHARD',
                'prenom' => 'Djibril',
                'date_naissance' => '1988-12-12',
                'adresse' => 'fond sarails',
                'suite' => '',
                'cp' => '97122',
                'commune' => 'Baie-Mahault',
                'portable' => '0690788552',
                'email' => 'drichard@gmail.com'
            ],
            [
                'adherantid' => 203,
                'nom'       => 'POPOTTE',
                'prenom' => 'Valérie',
                'date_naissance' => '1969-12-24',
                'adresse' => 'rue des roses',
                'suite' => '',
                'cp' => '97115',
                'commune' => 'Sainte-rose',
                'portable' => '0690521245',
                'email' => 'popottev@gmail.com'
            ],
            [
                'adherantid' => 204,
                'nom'       => 'LARASAMY',
                'prenom' => 'Micheline',
                'date_naissance' => '1990-04-24',
                'adresse' => 'rue des fleurs',
                'suite' => '',
                'cp' => '97139',
                'commune' => 'Les Abymes',
                'portable' => '0690124578',
                'email' => 'michelineL@gmail.com'
            ]

        ];

        // chemin local du fichier .json
        $fichier = $_SERVER["DOCUMENT_ROOT"]."/../var/liste.json";

        if (!file_exists($fichier)) {

            // Encoder un fichier au format .json
            $json = json_encode($datas);

            // creer le fichier .json
            file_put_contents($fichier, $json );

            // lire le fichier json
            $j = file_get_contents($fichier);

            // decoder et stocker les donnée du fichier .json
            $adherants = json_decode($j, true) ;
        } else {
             // lire le fichier json
             $j = file_get_contents($fichier);

             // decoder et stocker les donnée du fichier .json
             $adherants = json_decode($j, true) ;
        }

        // print_r($_SERVER);
        // print_r($fichier);
        // print_r( realpath($_SERVER["DOCUMENT_ROOT"]."/../")."/var/liste.json" );



        return $adherants;
    }

}