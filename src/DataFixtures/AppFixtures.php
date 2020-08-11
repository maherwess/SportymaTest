<?php

namespace App\DataFixtures;

use App\Entity\But;
use App\Entity\Club;
use App\Entity\Joueur;
use App\Entity\Logo;
use App\Entity\Saison;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{

    private $webDirectory;
    public function __construct($webDirectory)
    {
        $this->webDirectory = $webDirectory;
    }


    public function load(ObjectManager $manager)
    {

        // préparer les images pour les logos des clubs

        /**
         * @var File
         */
        $arsenal = new File(__DIR__.'/arsenal.png');
        /**
         * @var File
         */
        $atletico = new File(__DIR__.'/atletico.png');
        /**
         * @var File
         */
        $barcelone = new File(__DIR__.'/barcelone.png');
        /**
         * @var File
         */
        $city = new File(__DIR__.'/city.png');
        /**
         * @var File
         */
        $dortmund = new File(__DIR__.'/dortmund.png');
        /**
         * @var File
         */
        $juventus = new File(__DIR__.'/juventus.png');
        /**
         * @var File
         */
        $lyon = new File(__DIR__.'/lyon.png');
        /**
         * @var File
         */
        $napoli = new File(__DIR__.'/napoli.jpg');
        /**
         * @var File
         */
        $psg = new File(__DIR__.'/psg.png');
        /**
         * @var File
         */
        $real = new File(__DIR__.'/real.jpg');



        $uploads_dir = '%kernel.project_dir%/public';


        // liste des clubs
        $clubsFixture = array(
            ['nom'=>'arsenal' , 'logo'=>$arsenal],
            ['nom'=>'atletico' , 'logo'=>$atletico],
            ['nom'=>'barcelone' , 'logo'=>$barcelone],
            ['nom'=>'city' , 'logo'=>$city],
            ['nom'=>'dortmund' , 'logo'=>$dortmund],
            ['nom'=>'juventus' , 'logo'=>$juventus],
            ['nom'=>'lyon' , 'logo'=>$lyon],
            ['nom'=>'napoli' , 'logo'=>$napoli],
            ['nom'=>'psg' , 'logo'=>$psg],
            ['nom'=>'real' , 'logo'=>$real],
        );

        //Liste des saisons

        $saisonsFixture = array(
            ['anneeDebut'=> 2000, 'anneFin'=>2001],
            ['anneeDebut'=> 2001, 'anneFin'=>2002],
            ['anneeDebut'=> 2002, 'anneFin'=>2003],
            ['anneeDebut'=> 2003, 'anneFin'=>2004],
            ['anneeDebut'=> 2004, 'anneFin'=>2005],
            ['anneeDebut'=> 2005, 'anneFin'=>2006],
            ['anneeDebut'=> 2006, 'anneFin'=>2007],
            ['anneeDebut'=> 2007, 'anneFin'=>2008],
            ['anneeDebut'=> 2008, 'anneFin'=>2009],
            ['anneeDebut'=> 2009, 'anneFin'=>2010],
            ['anneeDebut'=> 2010, 'anneFin'=>2011],
            ['anneeDebut'=> 2011, 'anneFin'=>2012],
            ['anneeDebut'=> 2012, 'anneFin'=>2013],
            ['anneeDebut'=> 2013, 'anneFin'=>2014],
            ['anneeDebut'=> 2014, 'anneFin'=>2015],
            ['anneeDebut'=> 2015, 'anneFin'=>2016],
            ['anneeDebut'=> 2016, 'anneFin'=>2017],
            ['anneeDebut'=> 2017, 'anneFin'=>2018],
            ['anneeDebut'=> 2018, 'anneFin'=>2019],
            ['anneeDebut'=> 2019, 'anneFin'=>2020],
            ['anneeDebut'=> 2020, 'anneFin'=>2021]
        );

        //Liste des joueurs

        $joueursFixture = array(
            ['nom'=> 'messi', 'prenom'=>'leonel'],
            ['nom'=> 'salah', 'prenom'=>'mohamed'],
            ['nom'=> 'pique', 'prenom'=>'gerrard'],
            ['nom'=> 'moussa', 'prenom'=>'ahmed'],
            ['nom'=> 'suarez', 'prenom'=>'luis'],
            ['nom'=> 'ronaldo', 'prenom'=>'cristiano'],
            ['nom'=> 'varane', 'prenom'=>'raphael'],
            ['nom'=> 'custavo', 'prenom'=>'luis'],
            ['nom'=> 'palacio', 'prenom'=>'rodrigo'],
            ['nom'=> 'neymar', 'prenom'=>'junior'],
            ['nom'=> 'shtegen', 'prenom'=>'ter'],
            ['nom'=> 'umtiti', 'prenom'=>'samuel'],
            ['nom'=> 'griezman', 'prenom'=>'antoine'],
            ['nom'=> 'giroud', 'prenom'=>'olivier'],
            ['nom'=> 'matudi', 'prenom'=>'blaize'],
            ['nom'=> 'benzema', 'prenom'=>'karim'],
            ['nom'=> 'mbappe', 'prenom'=>'kylian'],
            ['nom'=> 'dembele', 'prenom'=>'osman'],
            ['nom'=> 'dimaria', 'prenom'=>'angel'],
            ['nom'=> 'carlos', 'prenom'=>'roberto'],
            ['nom'=> 'firminio', 'prenom'=>'roberto'],
            ['nom'=> 'mandanda', 'prenom'=>'steve'],
            ['nom'=> 'pirez', 'prenom'=>'robert'],
            ['nom'=> 'viera', 'prenom'=>'patrik'],
            ['nom'=> 'virati', 'prenom'=>'marco'],
            ['nom'=> 'lenglet', 'prenom'=>'clement'],
            ['nom'=> 'stopyra', 'prenom'=>'bufon'],
            ['nom'=> 'matta', 'prenom'=>'khuan'],
            ['nom'=> 'ramos', 'prenom'=>'sergio'],
            ['nom'=> 'stirling', 'prenom'=>'raheem'],
        );

        $clubObj = [];


        //Ajout des club dans la base de données
        foreach ($clubsFixture as $key => $clubProvider){
            $club = new Club();
            $club->setNom( $clubProvider['nom']  );
            /**
             * @var File
             */
            $file = $clubProvider['logo'];

            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where logos are stored
            try {
                $file->move($this->webDirectory,$filename);
            } catch (FileException $e) {
            }
            $logo = new Logo();
            $logo->setPath($filename);
            $date = new DateTime();
            $date->modify('-1 month');

            //Première ajout du logo (ça sera le meme logo)
            $logo->setCreatedAt($date);
            $club->addLogo($logo);

            $logo = new Logo();
            $logo->setPath($filename);
            $date = new DateTime();

            //Première ajout du logo (ça sera le meme logo mais avec une date differente)
            $logo->setCreatedAt($date);
            $club->addLogo($logo);

            $manager->persist($logo);
            $manager->persist($club);
            $clubObj[]=$club;
        }

        $saisonObj = [];

        //Ajout des saisons dans la base de données
        foreach ($saisonsFixture as $key => $saisonProvider){
            $saison = new Saison();
            $saison->setAnneedebut($saisonProvider['anneeDebut']);
            $saison->setAnneefin($saisonProvider['anneFin']);
            $manager->persist($saison);
            $saisonObj[] = $saison;
        }

        $joueurObj = [];
        //Ajout des joueurs dans la base de données
        foreach ($joueursFixture as $key => $joueurProvider){
            $joueur = new Joueur();
            $joueur->setNom($joueurProvider['nom']);
            $joueur->setPrenom($joueurProvider['prenom']);
            $manager->persist($joueur);
            $joueurObj[] = $joueur;
        }

        // inscrire des clubs à des saisons en jouant par pair et impaire les index
            foreach ($saisonObj as $keySaison => $saison){
                if($keySaison % 2 == 0){
                    foreach ($clubObj as $key => $club){
                        if($key % 2 == 0){
                            $club->addSaison($saison);
                            $manager->persist($club);
                        }
                    }
                }else{
                    foreach ($clubObj as $key => $club){
                        if($key % 2 != 0){
                            $club->addSaison($saison);
                            $manager->persist($club);
                        }
                    }
                }
            }



        //Ajouter 3 historiques pour chaque équipe
        $reversedClubObj = array_reverse($clubObj);

        $n =0;
        foreach ($reversedClubObj as $key => $club){

            for($i = $n; $i < $n+3 ; $i++){
                $joueur = $joueurObj[$i];
                $joueur->addHistorique($club);
                $manager->persist($joueur);
            }

        }


        //Ajouter 3 joueurs pour chaque équipe
        $n =0;
        foreach ($clubObj as $key => $club){

            for($i = $n; $i < $n+3 ; $i++){
                $joueur = $joueurObj[$i];
                $club->addJoueur($joueur);
                $joueur->setNum($joueur->getNom().$club->getNom().$key);
                $joueur->addHistorique($club);
                $manager->persist($joueur);
                $manager->persist($club);
            }
            $n = $n + 3;
        }

        //Ajouter des but pour chaque joueur dans une équipe pour une saison
        foreach ($clubObj as $keyClub => $club){

            $joueurs = $club->getJoueurs();
            $saisons = $club->getSaisons();
            foreach ($joueurs as $keyJoueur => $joueur){
                foreach ($saisons as $keySaison => $saison){
                        $but = new But();
                        $but->setNombre($keySaison);
                        $but->setSaison($saison);
                        $but->setClub($club);
                        $joueur->addBut($but);
                        $manager->persist($but);
                        $manager->persist($joueur);
                }
            }

        }





        $manager->flush();
    }
}
