<?php
namespace Navigation;
use \PDO;
class Stagiaire{

    public $id;
    public $nom;
    public $prenom;
    public $entreprise;
    public $linkStagiaire;
    public $linkEntreprise;
    public $linkStage;
    public $linkTuteur;
    public $linkPdf;

    public function __construct($dbh){

        if(isset($_GET["id"]) || $_SESSION["profile"] == "etudiant"){
            if($_SESSION["profile"] == "etudiant"){
                $href = "/Convention/index.php?controller=stagiaire&task=show";
                $array = array(":id"=>$_SESSION["id"]);
                $this->id = $_SESSION["id"];
            }else{
                $this->id = $_GET["id"];
                $array = array(":id"=>$_GET["id"]);
                $href = "/Convention/index.php?id=$this->id&controller=stagiaire&task=show";
                $bool = 0;
            }
            $request = 'SELECT nom_stagiaire,prenom_stagiaire FROM stagiaire WHERE id_stagiaire = :id';
            $result = tryPrepare($dbh,$request,$array,true);
            $this->nom = $result["nom_stagiaire"];
            $this->prenom = $result["prenom_stagiaire"];

            if(!empty($_GET["controller"])){
                $file = $_GET["controller"];
                if($file == "stagiaire"){
                    $this->linkStagiaire = "active";
                }
                elseif($file == "entreprise"){
                    $this->linkEntreprise = "active";
                }
                elseif($file == "stage" || $file == "stage_pbm"){
                    $this->linkStage = "active";
                }
                elseif($file == "tuteur"){
                    $this->linkTuteur = "active";
                }
            }
            
            if(empty($this->nom) && empty($this->prenom)){
                $label = "Stagiaire";
            }else{
                $label = $this->nom." ".$this->prenom;
            }
            
            $this->nav($label,$href);            
            if($_GET["controller"] == "entreprise" && $_SESSION["profile"] == "etudiant" && !isset($_GET["id_entreprise"])){
                rechercher();
            }
        }
    }

    public function nav($label,$href){
        ?>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link <?=$this->linkStagiaire?>" href="<?=$href?>"><?=$label?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkEntreprise?>" href="/Convention/index.php?controller=entreprise&task=liste&id=<?=$this->id?>">Entreprise</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkTuteur?>" href="/Convention/index.php?controller=tuteur&task=liste&id=<?=$this->id?>">Tuteur</a>
            </li>
            <li class="nav-item">
                <div > <!--class="dropdown show" -->
                    <a class="btn dropdown-toggle nav-link" href="#" role="button" data-toggle="dropdown">Stage<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Convention/index.php?task=liste&controller=Stage">Stage MscMba</a></li>
                        <li><a href="/Convention/index.php?task=liste&controller=Stage_pbm">Stage Pbm</a></li>
                    </ul>
                <!-- <a class="nav-link <?=$this->linkStage?>" href="/Convention/index.php?controller=stage&task=liste&id=<?=$this->id?>">Stage</a> -->
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown show">
                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aide
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <!--<a  data-toggle="modal" data-target="#documentNecessaire">-->
			<a  href="/Convention/fichier/Vademecum.docx">
                            Vademecum
                        </a></br>
			<a  href="/Convention/fichier/Convention.pptx">
			    TutoPPT
			</a>
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </div>
            </li>
        </ul>
        <br/>
        <?php
    }

}