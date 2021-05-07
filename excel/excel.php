<?php



Namespace excel;




require_once '../vendor/mk-j/php_xlsxwriter/xlsxwriter.class.php';

require_once '../modele.php';

require_once '../classes/Database.class.php';

require_once '../classes/Utils.class.php';



//require_once('vendor/autoload.php');

//require("../classes/autoload.php");

use \PDO;






$tablesname=["stage","tuteur","entreprise","referent","etablissement","utilisateur","stagiaire"];

$columnlist=[];

$mergelist=[];

foreach ($tablesname as $tablename) {

    $columnlist[$tablename]=getColumnNames($tablename);

    $mergelist=array_merge($mergelist,$columnlist[$tablename]);

}

//$columnslist=array_merge(getColumnNames("stage"),getColumnNames("tuteur"),getcolumnNames("entreprise"),getColumnNames("referent"),getColumnNames("etablissement"),getColumnNames("utilisateur"),getColumnNames("stagiaire"));





$columns_and_types=array_merge(getColumnsAndTypes("stage"),getColumnsAndTypes("tuteur"),getColumnsAndTypes("entreprise"),getColumnsAndTypes("referent"),getColumnsAndTypes("etablissement"),getColumnsAndTypes("utilisateur"),getColumnsAndTypes("stagiaire"));




$dbh = \Database::pdo();

//if(is_null($_POST['envoi_excel'])){

// if (empty($_POST)){

//     $excelform = new ExcelForm($dbh,$columnlist);

// }

// else {



     $columns_to_string = $mergelist[0];

     for($i=1;$i<count($mergelist);$i++) {

         $columns_to_string = $columns_to_string . ", " .$mergelist[$i];

        }







$requestStage = 'SELECT '.$columns_to_string.' FROM stage 

INNER JOIN tuteur ON stage.fk_tuteur_stage = tuteur.id_tuteur

INNER JOIN entreprise ON tuteur.fk_entreprise = entreprise.id_entreprise

INNER JOIN referent ON stage.fk_referent_stage = referent.id_referent

INNER JOIN etablissement ON etablissement.id_etablissement = referent.fk_enseignement_referent

INNER JOIN utilisateur ON stage.fk_utilisateur_stage = utilisateur.id

INNER JOIN stagiaire ON stagiaire.id_stagiaire = utilisateur.id

WHERE stage.statut = "Stage validé"';



/* $requestStage = 'SELECT id_stage,annee_universitaire, date_debut,date_fin,duree_totale,temps_complet,heure_partiel,obligatoire,lundi,mardi,mercredi,jeudi,vendredi,samedi,cas_particulier,gratification,gratification_par,activites_missions,competences_developper,conditions_remboursement,



nom_stagiaire,prenom_stagiaire,adresse_stagiaire,date_naissance_stagiaire,ville_stagiaire,telephone_stagiaire,nationalite,mail_stagiaire,classe,numero_securite_social,adresse_caisse_assurance,ville_secu,code_postal_stagiaire,numero_rue_stagiaire,complement_adresse_stagiaire,



nom_etablissement,adresse_etablissement,ville_etablissement,telephone_etablissement,nom_representant_etablissement,fonction_representant_etablissement,mail_etablissement,numero_rue_etablissement,complement_adresse_etablissement,code_postal_etablissement,



nom_referent,prenom_referent,fonction_referent,telephone_referent,mail_referent,



nom_entreprise,adresse_entreprise,ville_entreprise,telephone_entreprise,mail_entreprise,secteur_activite_entreprise,nom_representant_entreprise,fonction_representant_entreprise,services_entreprise,lieu_bis_entreprise,date_debut_fermeture_entreprise,date_fin_fermeture_entreprise,numero_rue_entreprise,code_postal_entreprise,fermeture_entreprise,complement_adresse_entreprise,



nom_tuteur,prenom_tuteur,fonction_tuteur,telephone_tuteur,mail_tuteur */




$resultStage = \Utils::tryFetch($requestStage,1);

//var_dump($requestStage);die;

$header=$columns_and_types;



/*$header1=array();

for ($i=1;$i<count($columnlist);$i++) {

    $header1[$columnlist[$i]]=$columnquantity[$i];

}



$header = array(

    'ID stage'=>'integer',

    'Année universitaire'=>'string',

    'Date de début'=>'string',

    'Date de fin'=>'string',

    'Durée totale'=>'integer',

    'temps'=>'string',

    'Nb d\'heure partiel'=>'integer',

    'stage'=>'string',

    'lundi'=>'string',

    'mardi'=>'string',

    'mercredi'=>'string',

    'jeudi'=>'string',

    'vendredi'=>'string',

    'samedi'=>'string',

    'cas particulier'=>'string',

    'gratification'=>'integer',

    'gratification par'=>'string',

    'activités/missions'=>'string',

    'compétences à développer'=>'string',

    'conditions de remboursement'=>'string',

    'nom du stagiaire'=>'string',

    'prenom'=>'string',

    'adresse'=>'string',

    'date de naissance'=>'string',

    'ville'=>'string',

    'telephone'=>'integer',

    'nationalite'=>'string',

    'mail'=>'string',

    'classe'=>'string',

    'numero de sécurité social'=>'integer',

    'adresse de la caisse d\'assurance'=>'string',

    'ville '=>'string',

    'code postal'=>'integer',

    'numero de rue'=>'integer',

    'complement d\'adresse'=>'string',

    'etablissement'=>'string',

    'adresse de l\'etablissement'=>'string',

    'ville etablissement'=>'string',

    'telephone etablissement'=>'string',

    'representant etablissement'=>'string',

    'fonction representant etablissement'=>'string',

    'mail etablissement'=>'string',

    'numero rue etablissement'=>'integer',

    'complement adresse etablissement'=>'string',

    'code postal etablissement'=>'integer',

    'nom referent'=>'string',

    'prenom referent'=>'string',

    'fonction referent'=>'string',

    'telephone referent'=>'integer',

    'mail referent'=>'string',

    'nom entreprise '=>'string',

    'adresse entreprise '=>'string',

    'ville entreprise '=>'string',

    'telephone entreprise '=>'integer',

    'mail entreprise '=>'string',

    'secteur activite '=>'string',

    'representant entreprise'=>'string',

    'fonction representant entreprise'=>'string',

    'service'=>'string',

    'lieu du stage(si différent)'=>'string',

    'date debut de fermeture'=>'string',

    'date fin de fermeture'=>'string',

    'numero de rue entreprise'=>'integer',

    'code postal entreprise'=>'string',

    'fermeture?'=>'string',

    'complement adresse entreprise'=>'string',

    'nom tuteur'=>'string',

    'prenom tuteur'=>'string',

    'fonction tuteur'=>'string',

    'telephone tuteur'=>'integer',

    'mail tuteur'=>'string',

);*/




//ini_set('display_errors', 0);

$writer = new \XLSXWriter();

$width_array= array_fill(0, count($mergelist), 30);

// $styles1 = array( 'font'=>'Arial','font-size'=>15,'font-style'=>'bold','wrap_text'=>true, 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom','widths'=>[10,25,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,60,60,30,15,15,25,20,20,15,15,25,15,30,30,20,15,20,20,20,35,20,35,35,35,30,30,35,30,25,25,25,30,25,25,25,25,25,25,30,30,35,25,30,35,35,30,30,30,35,25,25,25,25,25]);

$styles1 = array( 'font'=>'Arial','font-size'=>15,'font-style'=>'bold','wrap_text'=>true, 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom','widths'=>$width_array);

$format = array('halign'=>'center','wrap_text'=>true);

$writer->writeSheetHeader('Sheet1', $header, $styles1);

foreach($resultStage as $row){

	$writer->writeSheetRow('Sheet1', $row,$format);

}

$writer->writeToFile('convention_de_stage.xlsx');

$writer->finalizeSheet();



redirect("excel/convention_de_stage.xlsx");

// header("Location:$devHost/Convention/excel/convention_de_stage.xlsx");

// $writer->writeToStdOut();

// echo $writer->writeToString();



exit(0);



//}







function getColumnNames($table){


    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE (table_schema ='nxtrabqconv' and table_name = :table)";

    try {

        //$core = Core::getInstance();

        //$stmt = $core->dbh->prepare($sql);

        $dbh = \Database::pdo();

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':table', $table, PDO::PARAM_STR);

        $stmt->execute();

        $output = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $output[] = $row['COLUMN_NAME'];                

        }

        return $output; 

    }



    catch(PDOException $pe) {

        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);

    }

}



function getAllColumnNames($array_table){

    //$database = 'nxtrabqconv';

    $string_table="(";

    foreach($array_table as $table){

        $string_table = $string_table." table_name = ".$table. " or";

    }

    $string_table=rtrim($string_table,"or");

    $string_table = $string_table." )";



    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE (table_schema ='ionisbxfbzconv' and $string_table)";

    try {

        //$core = Core::getInstance();

        //$stmt = $core->dbh->prepare($sql);

        $dbh = \Database::pdo();

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':table', $table, PDO::PARAM_STR);

        $stmt->execute();

        $output = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $output[] = $row['COLUMN_NAME'];                

        }

        return $output; 

    }



    catch(PDOException $pe) {

        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);

    }

}



function getColumnType($table,$column){

    $sql = "SELECT DATA_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = :table AND COLUMN_NAME = :column";

    try {



        

        //$core = Core::getInstance();

        //$stmt = $core->dbh->prepare($sql);

        $dbh = Database::pdo();

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':table', $table, ':column',$column, PDO::PARAM_STR);

        $stmt->execute();

        $output = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $output[] = $row['DATA_TYPE'];                

        }

        return $output; 

    }



    catch(PDOException $pe) {

        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);

    }

}



function getColumnsAndTypes($table){

    $sql = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE (table_schema ='nxtrabqconv' and table_name = :table)";

    try {

        //$core = Core::getInstance();

        //$stmt = $core->dbh->prepare($sql);

        $dbh = \Database::pdo();

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':table', $table, PDO::PARAM_STR);

        $stmt->execute();

        $output = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $output[$row['COLUMN_NAME']] = $row['DATA_TYPE'];                

        }

        //var_dump($output);
        $output=array_replace($output,array_fill_keys(array_keys($output,"varchar"),"integer"));
        $output=array_replace($output,array_fill_keys(array_keys($output,"text"),"string"));
        //var_dump($output);die;

        return $output;

    }

    catch(PDOException $pe) {

        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);

    }

}