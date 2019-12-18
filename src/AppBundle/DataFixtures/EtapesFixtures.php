<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Etape;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class EtapesFixtures implements FixtureInterface
{
    public function load(ObjectManager $objectManager)
    {
        $etape1 = new Etape();
        $etape1->setNomEtape('Ouverture d\'un compte bancaire indisponible pour déposer les apports en numéraire');
        $etape1->setDescription('L’ouverture d’un compte bancaire est une étape essentielle à la création d’une SARL.

        En conformité avec l’article 96 du Code des Sociétés Commerciales, l’institution bancaire ou financière habilitée à recevoir les apports de capital social en numéraire doit être mentionnée dans les statuts de la société. Vous pouvez choisir parmi des 20 institutions bancaires opérationnelles en Tunisie.
        
        Des informations relatives aux différents services bancaires fournis sont disponibles ici. Le capital social inscrit dans les statuts doit être totalement déposé dans le compte bancaire dit « indisponible » jusqu’à l’accomplissement de toute la procédure de création de la société et la fourniture d’une copie de l’avis de constitution de la société au Journal Officiel (voir l’étape 06).
        <br>Que devez-vous fournir ?
        1 copie des statuts (SARL ou SUARL) de la société (pas nécessairement signés par les associés et enregistrés à la Recette des Finances)
        1 copie de la carte d’identité nationale (CIN) du gérant désigné dans les statuts (ce gérant peut être changé dans les statuts finals ou par une décision ultérieure)
        Un formulaire d’ouverture de compte délivré par la banque et rempli par le gérant (des informations concernant la société et le spécimen de signature du gérant)');
        $etape1->setCout('0 DT');
        $etape1->setDuree('Séance tenante');
        $etape1->setQuoiObtenir('La banque délivre une attestation bancaire pour l’ouverture d’un compte indisponible au nom de la société.');
        $objectManager->persist($etape1);
        $etape2 = new Etape();
        $etape2->setNomEtape(' Enregistrement des statuts de l\'entreprise à la recette');
        $etape2->setDescription('L’enregistrement est l’inscription des données relatives à la société dans les registres de l’administration fiscale territorialement compétente moyennant le paiement d’un droit d’enregistrement. Le document enregistre obtiennent des références uniques. L’enregistrement se fait soit aux bureaux locaux de Recette des Finances (voir la liste des Recettes des Finances et leur compétence territoriale), soit aux bureaux présents aux Guichets Uniques de l’API. <br> Que devez-vous fournir ?
        copies des statuts (SARL ou SUARL) de la société (10 copies originales. NB. Les statuts doivent comporter la référence de compte bancaire dans lequel le capital a été déposé)
        Procès-verbal de nomination du ou des gérant(s) au cas où les statuts ne le précisent pas (04 originales au moins)
        En cas d’apport en nature, les statuts doivent contenir leur évaluation faite par un commissaire aux apports. Toutefois si la valeur de chaque apport ne dépasse pas la somme de trois mille dinars, les associés peuvent décider, à la majorité des voix, de ne pas recourir à un commissaire aux apports. Cf. Art.100 du CSC.');
        $etape2->setCout('150 DT (payés à la caisse de la Recette des Finances)');
        $etape2->setDuree('éance tenante au Guichet Unique de l’API, 24 heures à la Recette des Finances');
        $etape2->setQuoiObtenir('Les statuts et le procès-verbal de nomination du ou des gérant(s) enregistrés (sur lequel est apposé le cachet de la recette des finances). L\'enregistrement est effectué sous 24 heures à la recette des finances et séance tenante auprès du guichet unique.');
        $objectManager->persist($etape2);
        $etape3 = new Etape();
        $etape3->setNomEtape('Déclaration d\'existence au Bureau de Controle des impots');
        $etape3->setDescription('Fiscalement la société commence à exister à partir de sa déclaration au Bureau de contrôle des impôts est devient assujettie dès son immatriculation. La présence du gérant ou de représentant mandatée est nécessaire pour la signature de la déclaration. Les Bureaux de Contrôle des Impôts sont présents dans tous les gouvernorats (voir la liste des bureaux et leur compétence territoriale) et aux Guichets Uniques de l’API.  <br> Que devez-vous fournir ?
        Imprimé à signer (Déclaration d’existence), au bureau ;
        1 copie de la carte d’identité nationale (CIN) du ou des gérant(s) (Une copie du passeport pour les étrangers) et du mandataire le cas échéant.');
        $etape3->setCout('0 DT');
        $etape3->setDuree('Séance tenante au Guichet Unique de l’API, 24 heures au Bureau de contrôle des impôts');
        $etape3->setQuoiObtenir('L’agent du bureau remplit les cases du formulaire destines à l’administration, donne un numéro d’identification fiscale a la société et délivre instantanément une carte d’identification fiscale) (NB. Le gérant doit garder les originaux de déclaration d’existence et carte d’identification fiscale et préparer des copies pour les étapes ultérieures)');
        $objectManager->persist($etape3);
        $etape4 = new Etape();
        $etape4->setNomEtape('dépot au greffe du Tribunal de première territorialement compètent');
        $etape4->setDescription('Cette étape déclenche l’existence juridique de la société par le biais de l’immatriculation au Registre de Commerce. Un greffe existe dans tous les tribunaux de première instance (voir ici la liste des tribunaux) et un bureau représentatif dans tous les Guichets Uniques de l’API. <br>Que devez-vous fournir ?
        2 imprimés à remplir en arabe et à signer par le gérant ou son mandataire (Formulaire de déclaration d’ouverture) ;
        2 originaux de statuts enregistrés à la Recette des Finances ;
        Resumé des statuts en langue Arabe contenant des informations relatives aux : raison sociale (dénomination), capital social adresse du siège social, les noms des associes, l’objet, le gérant) ;
        2 originaux enregistrés à la Recette des Finance du procès-verbal de nomination du ou des gérant(s) au cas où les statuts ne le précisent pas ;
        2 copies de la déclaration d’existence ;
        2 copies de la carte d’identification fiscale ;
        2 exemplaires de la pièce précisant l’adresse du siège social : certificat de propriété (si le gérant est le propriétaire du local), ou un contrat de location au nom du gérant ou de la société (non obligatoirement enregistré), ou un contrat de domiciliation accompagné du contrat de location de la société domiciliataire ou du titre de propriété ;
        2 copies de l’attestation bancaire ;
        2 copies de la carte d’identité nationale du ou des gérant(s) ou 2 copies du passeport pour les étrangers;
        Quittance de paiement des droits d’immatriculation (50DT) au registre de commerce auprès del’office national de la poste ou au bureau de poste dans les Guichets Uniques de l’API) ;
        Procuration au cas où le déposant est autre que le gérant.');
        $etape4->setCout(' 50 DT (des droits d’immatriculation au registre de commerce) + 10 DT pour chaque extrait de Registre de commerce');
        $etape4->setDuree(' Séance tenante au Guichet Unique de l’API, 5 jours aux greffes de tribunaux');
        $etape4->setQuoiObtenir('Le greffier prépare et délivre le certificat de dépôt qui fera l’objet de la publication au Journal Officiel.');
        $objectManager->persist($etape4);
        $etape5 = new Etape();
        $etape5->setNomEtape('publication de l\'avis de constitution dans le J.O.R.T');
        $etape5->setDescription('Conformément à l’article 15 du Code des Sociétés, toutes les sociétés à l\'exception de la société en participation doivent procéder à la publication de leurs actes constitutifs. La publicité est faite par une insertion (avis) au Journal Officiel de la République Tunisienne et ce, dans un délai d’un mois à partir soit de la constitution définitive de la société, soit de la date du procès-verbal ou de la délibération de l’assemblée générale constitutive de la société. Les formalités de publicité sont effectuées par le représentant légal de la société et sous sa responsabilité (le gérant ou toute autre personne mandatée).L’insertion se fait aux bureaux de l’Imprimerie Officielle (voir ici la liste des bureaux) ou aux Guichets Uniques de l’API. <br> Que devez-vous fournir ?
        Textes dactylographiés de l’avis à publier en langue arabe et française (en 2 exemplaires). Voir ici un modèle de l’exemplaire fourni pour les mentions obligatoires ;
        Numéro d’immatriculation fiscale (figurant sur la carte d’identification fiscale);
        Copie de la carte d’identité nationale de l’annonceur');
        $etape5->setCout('Plus ou moins 70 DT (le cout est calculé par l’agent au guichet de Journal Officiel et dépend de la consistance du texte a publier).');
        $etape5->setDuree('Séance tenante');
        $etape5->setQuoiObtenir('L’annonceur prendra une décharge sur une des deux copies présentée pour la déposer au Registre de commerce.');
        $objectManager->persist($etape5);
        $etape6 = new Etape();
        $etape6->setNomEtape('Immatriculation au Registre du Commerce Tribual de première Instance');
        $etape6->setDescription('C’est l’étape finale de la création de la société qui permet d’obtenir le numéro définitif d’immatriculation au Registre de commerce. Désormais la société est légalement constituée. Aprés l’apparition de la publication de l’avis de constitution au Journal Officiel (15 jours) il est recommandé d’acheter le numéro de Journal Officiel correspondant. Une copie de la publication est indispensable pour l’institution bancaire afin de disposer du capital social. <br>  Que devez-vous fournir ?
        Une copie de la pièce d’encaissement des frais de publication au JORT
        Quittance de paiement des droits d’immatriculation (10 DT) au registre de commerce auprès de l’office national de la poste) pour chaque extrait du Registre de commerce demandé (Peut être payée lors du paiement du droit d’immatriculation étape « 04. Dépôt au greffe du tribunal de première instance territorialement compètent »');
        $etape6->setCout('10 DT (pour chaque extrait de Registre de commerce (normalement vous aurez besoin des trois extraits).');
        $etape6->setDuree('Séance tenante');
        $etape6->setQuoiObtenir('Extrait de Registre de Commerce.');
        $objectManager->persist($etape6);
        $etape7 = new Etape();
        $etape7->setNomEtape(' Affiliation de la société à la C.N.S.S');
        $etape7->setDescription('En conformité avec l’article 36 de la Loi n° 1960-30 du 14 décembre 1960, relative à l\'organisation des régimes de sécurité sociale les employeurs, occupant du personnel rentrant dans les définitions des articles34 et 35, doivent s\'affilier à la Caisse Nationale de Sécurité Sociale dès le moment où ils engagent des salariés. Ils doivent par la même occasion faire immatriculer leur personnel salarié.Le dossier d’affiliation est déposé au Bureau régional ou local territorialement compétent (dont relève le siège social de l’entreprise) ou au guichet unique ouvert auprès de l’API. Pour plus d’informations consultez le Guide de l’employeur dans le secteur privé non agricole sur le site web de la CNSS <br>Que devez-vous fournir ?
        Formulaire de demande d’affiliation d’employeur portant la signature et le cachet de l’employeur accompagne par la liste nominative du personnel ;
        Copie de la carte d’identité nationale de l’employeur ou du représentant légal de l’entreprise (le gérant) ou de la carte de séjour pour les étrangers ;
        Extrait original du Registre de Commerce ou copie certifiée conforme de la carte d’identification fiscale (par l’administration fiscale).');
        $etape7->setCout('0 DT');
        $etape7->setDuree('Séance tenante');
        $etape7->setQuoiObtenir('Attribution d’un numéro d’affiliation et la délivrance par la CNSS d’un certificat d’affiliation mentionnant la date d’effet.
        NB : La société doit procéder à l’immatriculation des travailleurs salariés à la CNSS dans un délai d’un mois à partir de l’embauche ');
        $objectManager->persist($etape7);
        $etape8 = new Etape();
        $etape8->setNomEtape('éclaration des établissements auprès de l\'inspection de travail');
        $etape8->setDescription('En conformité avec l’article 278 du Code du Travail tout employeur, dans toutes les activités autres que les professions domestiques, qui occupe ou envisage d\'occuper des travailleurs permanents ou non permanents à plein temps ou à temps partiel et quel que soit leur nombre et le mode de leur recrutement, est tenu de déclarer son établissement auprès de l\'inspection du travail territorialement compétente (consultez le Ministère des Affaires Sociales pour les coordonnées des bureaux régionaux) .En conformité avec l’article 279 du Code du Travail la déclaration (voir un model) doit être faite dans un délai d\'un mois à compter du démarrage effectif de l\'activité pour les établissements nouvellement créés. Toutes les modifications doivent aussi être notifiées à l’inspection du travail. La déclaration adressée sous pli recommandé en trois exemplaires, doit être datée et signée par l\'employeur.  <br> Que devez-vous fournir ?
        3 copies de déclaration des établissements à déposer auprès de l\'inspection du travail');
        $etape8->setCout('0 DT');
        $etape8->setDuree('Aucun');
        $etape8->setQuoiObtenir('Aucun document n’est délivré. Toutefois l’Inspection du Travail peut visiter les locaux et vérifier les données déclarées.');
        $objectManager->persist($etape8);
        $objectManager->flush();
    }
}
