<?php
//$pdf->SetAutoPageBreak(1,30);
//--------Debut article 5-------------

//$pdf->pageIf($pdf,2);
$pdf->ligneLn("Article 5 - Gratification, avantages");
$pdf->normal();


$pdf->mLigne("En France, lorsque la durée du stage est supérieure à deux mois consécutifs ou non, celui-ci fait obligatoirement l'objet d'une gratification, sauf en cas de règles particulières applicables dans certaines collectivités d'outre-mer françaises et pour les stages relevant de l'article L4381-1 du code de la santé publique.");
$pdf->mLigne("Le montant horaire de la gratification est fixé à 15 % du plafond horaire de la sécurité sociale défini en application de l'article L.241-3 du code de la sécurité sociale. Une convention de branche ou un accord professionnel peut définir un montant supérieur à ce taux.");
$pdf->mLigne("Le montant horaire de la gratification est fixé à 15 % du plafond horaire de la sécurité sociale défini en application de l'article L.241-3 du code de la sécurité sociale. Une convention de branche ou un accord professionnel peut définir un montant supérieur à ce taux.");
$pdf->mLigne("L'organisme peut décider de verser une gratification pour les stages dont la durée est inférieure ou égale à deux mois.");
$pdf->saut();

$pdf->mLigne("En cas de suspension ou de résiliation de la présente convention, le montant de la gratification due au stagiaire est proratisé en fonction de la durée du stage effectué.");
$pdf->mLigne("La durée donnant droit à gratification s'apprécie compte tenu de la présente convention et de ses avenants éventuels, ainsi que du nombre de jours de présence effective du/de la stagiaire dans l'organisme.");
$pdf->saut();


// A ETABLIR
// BOUCLE IF POUR LE MONTANT DE LA GRATIFICATION



/*

/*$pdf->Cell(100,5,"soit 3,90 ".EURO." / heure.",0,1);
$pdf->saut();*/

if($gratification == "0"){
    $pdf->wid("Le montant de la gratification est fixé à : ","$gratification euro",2,false);
}elseif($gratification_par != "Non-renseigné" && $gratification != "Non-renseigné"){
    if($gratification_par == "heure"){
        $unite = "heure";
    }elseif($gratification_par == "jour"){
        $unite = "jour";
    }elseif($gratification_par == "mois"){
        $unite = "mois";
    }
    $pdf->wid("Le montant de la gratification est fixé à : ","$gratification euro(s) par $unite après lissage",2,false);
}else{
    $pdf->wid("Le montant de la gratification est fixé à : ","Non-renseigné",2,false);
}
$pdf->saut();
$pdf->normal();


$pdf->page($pdf,270);
$pdf->gras();
$pdf->ligneLn("Article 5 bis - Accès aux droits des salariés - Avantages");
$pdf->normal();
$pdf->mLigne("(Organisme de droit privé en France sauf en cas de règles particulières applicables dans certaines collectivités d'outre-mer françaises) :");
$pdf->page($pdf,270);
$pdf->mLigne("Le stagiaire bénéficie des protections et droits mentionnés aux articles L.1121-1, L.1152-1 et L.1153-1 du code du travail, dans les mêmes conditions que les salariés.");
$pdf->page($pdf,270);
$pdf->mLigne("Le stagiaire a accès au restaurant d'entreprise ou aux titres-restaurants prévus à l'article L.3262-1 du code du travail, dans les mêmes conditions que les salariés de l'organisme d'accueil. Il bénéficie également de la prise en charge des frais de transport prévue à l'article L.3261-2 du même code.");
$pdf->page($pdf,270);
$pdf->mLigne("Le stagiaire accède aux activités sociales et culturelles mentionnées à l'article L.2323-83 du code du travail dans les mêmes conditions que les salariés.");
$pdf->saut();

$pdf->gras();
$pdf->ligneLn("Article 5ter - Accès aux droits des agents - Avantages");
$pdf->normal();
$pdf->mLigne("(Organisme de droit public en France sauf en cas de règles particulières applicables dans certaines collectivités d'outre-mer françaises) :");
$pdf->mLigne("Les trajets effectués par le stagiaire d'un organisme de droit public entre son domicile et son lieu de stage sont pris en charge dans les conditions fixées par le décret n°2010-676 du 21 juin 2010 instituant une prise en charge partielle du prix des titres d'abonnement correspondant aux déplacements effectués par les agents publics entre leur résidence habituelle et leur lieu de travail.");
$pdf->mLigne("Le stagiaire accueilli dans un organisme de droit public et qui effectue une mission dans ce cadre bénéficie de la prise en charge de ses frais de déplacement temporaire selon la réglementation en vigueur.");
$pdf->mLigne("Est considéré comme sa résidence administrative le lieu du stage indiqué dans la présente convention.");
$pdf->saut();
//$pdf->wid("AUTRES AVANTAGES ACCORDES : ",$autres_avantages,0,true,1,true);
$pdf->wid("AUTRES AVANTAGES ACCORDES : ",$droit_avantage,1,true,1,true);
$pdf->ln();

/*$pdf->page($pdf,265);

if($droit_avantage != "Non-renseigné"){
    $pdf->ligneLn("AUTRES AVANTAGES ACCORDES : ");
//     $pdf->SetTextColor(255,0,0);
//     $pdf->mLigne("$droit_avantage");
//     $pdf->SetTextColor(0,0,0);
// }else{
    $pdf->SetTextColor(0,0,255);
    $pdf->mLigne("$droit_avantage");
    $pdf->SetTextColor(0,0,0);
}
$pdf->saut();*/