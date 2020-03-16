<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/DBConfig.php';
include_once '../../models/boutique.php';
include_once '../../models/agriculteur.php';
include_once '../../contoller/BoutiqueController.php';

// instantiate DB & Connect
$db_config = new DBConfig();
$db = $db_config->connect();

// instantiate Boutique Controller
$controller = new BoutiqueController($db);

// get data send from Android + Clean Data
$data = json_decode(file_get_contents("php://input"));

$id_agriculteur = htmlspecialchars(strip_tags($data->id_agriculteur));
$categorie = htmlspecialchars(strip_tags($data->categorie));
$nom_produit = htmlspecialchars(strip_tags($data->nom_produit));
$description = htmlspecialchars(strip_tags($data->description));
$quantite_totale = htmlspecialchars(strip_tags($data->quantite_totale));
$prix_unitaire = htmlspecialchars(strip_tags($data->prix_unitaire));

// instantiate Agr
$agriculteur = new Agriculteur();
$agriculteur->setId($id_agriculteur);

// instantiate Boutique
$boutique = new Boutique();
$boutique->setAgriculteur($agriculteur);
$boutique->setCategorie($categorie);
$boutique->setNomProduit($nom_produit);
$boutique->setDescription($description);
$boutique->setQuantiteTotale($quantite_totale);
$boutique->setPrixUnitaire($prix_unitaire);

// result
echo json_encode($controller->delete($boutique));
