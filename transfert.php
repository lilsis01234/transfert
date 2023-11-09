<?php
// Database connection parameters
$servername = "";
$username = "";
$password = "";
$dbname = "";

require 'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\IOFactory;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$xlsxFile = 'bdd/wp_mod_immo (1).csv'; 
$spreadsheet = IOFactory::load($xlsxFile);
$worksheet = $spreadsheet->getActiveSheet();

foreach ($worksheet->getRowIterator() as $row) {
    $data = [];
    foreach ($row->getCellIterator() as $cell) {
        $data[] = $cell->getValue();
    }

        $id_page = isset($data[1]) ? $data[1] : '';
        $id_section = isset($data[2]) ? $data[2] : '';
        $reference = isset($data[3]) ? htmlspecialchars($data[3]) : '';
        $mandat = isset($data[4]) ? htmlspecialchars($data[4], ENT_QUOTES, 'UTF-8') : '';
        $type_transaction =  isset($data[5]) ? $data[5] : '';
        $type_bien =  isset($data[6]) ? htmlspecialchars($data[6]) : '';
        $adresse = isset($data[7]) ? mb_convert_encoding($data[7], 'UTF-8', 'UTF-8') : ''; 
        $ville = isset($data[8]) ? mb_convert_encoding($data[8], 'UTF-8', 'UTF-8') : ''; 
        $code_postal = isset($data[9]) ? mb_convert_encoding($data[9], 'UTF-8', 'UTF-8') : '';
        $pieces =  isset($data[10]) ? $data[10] : '';
        $surface = isset($data[11]) ? $data[11] : '';
        $prix = isset($data[12]) ? $data[12] : '';
        $prix_loc = isset($data[13]) ? $data[13] : '';
        $description = isset($data[14]) ? str_replace("'", "'", $data[14]) : '';
        $publication = isset($data[15]) ? $data[15] : '';
        $maj = isset($data[16]) ? $data[16] : '';
        $active = isset($data[17]) ? $data[17] : '';
        $featured = isset($data[18]) ? $data[18] : '';
        $accroche = isset($data[19]) ? $data[19] : '';
        $photoacceuil = isset($data[20]) ? $data[20] : '';
        $mode_location =  isset($data[21]) ? $data[21] : '';
        $garage_box = isset($data[23]) ? $data[23] : '';
        $cave = isset($data[24]) ? $data[24] : '';
        $chauffage_gaz =  isset($data[25]) ? $data[25] : '';
        $chauffage_elec =  isset($data[26]) ? $data[26] : '';
        $cuisine_equipee = isset($data[27]) ? $data[27] : '';
        $balcon = isset($data[28]) ? $data[28] : '';
        $surface_balcon = isset($data[29]) ? $data[29] : '';
        $loggia = isset($data[30]) ? $data[30] : '';
        $surface_loggia =  isset($data[31]) ? $data[31] : '';
        $terrasse =  isset($data[32]) ? $data[32] : '';
        $surface_terrasse =  isset($data[33]) ? $data[33] : '';
        $terrain =  isset($data[34]) ? $data[34] : '';
        $surface_terrain =  isset($data[35]) ? $data[35] : '';
        $piscine = isset($data[36]) ? $data[36] : '';
        $ascenseur =  isset($data[37]) ? $data[37] : '';
        $gardien = isset($data[38]) ? $data[38] : '';
        $acces_securises = isset($data[39]) ? $data[39] : '';
        $jacuzzi =  isset($data[40]) ? $data[40] : '';
        $salle_de_jeux =isset($data[41]) ? $data[41] : '';
        $equipement_enfant = isset($data[42]) ? $data[42] : '';
        $internet = isset($data[43]) ? $data[43] : '';
        $television = isset($data[44]) ? $data[44] : '';
        $cable_satellite =isset($data[45]) ? $data[45] : '';
        $lecteur_dvd =isset($data[46]) ? $data[46] : '';
        $console_de_jeux = isset($data[47]) ? $data[47] : '';
        $lave_linge = isset($data[48]) ? $data[48] : '';
        $seche_linge = isset($data[49]) ? $data[49] : '';
        $lave_vaisselle = isset($data[50]) ? $data[50] : '';
        $annee_construction = isset($data[51]) ? $data[51] : '';
        $couchages = isset($data[52]) ? $data[52] : '';
        $nb_couchages = isset($data[53]) ? $data[53] : '';
        $etq_energie = isset($data[54]) ? $data[54] : '';
        $etq_climat = isset($data[55]) ? $data[55] : '';
        // $crm_prix_net_vendeur = isset($data[56]) ? $data[56] : '';
        $immovision =isset($data[65]) ? $data[65] : '';
        $immovision_data = isset($data[66]) ? $data[66] : '';
        $boost =isset($data[67]) ? $data[67] : '';
        $tarif_option_menage = isset($data[68]) ? $data[68] : '';
        $parking_ext =  isset($data[22]) ? $data[22] : '';

        $id_shop=1;
        $id_lang=1;

        // insertIntoEquipements($conn);

        $parkingextid=searchNom($conn,'Parking extérieur');
        $garage_boxid = searchNom($conn,'Garage/Box');
        $caveid = searchNom($conn,'Cave');
        $chauffage_gazid=searchNom($conn,'Chauffage au gaz');
        $chauffage_elecId = searchNom($conn,'Chauffageélectrique');
        $cuisine_equipeeid = searchNom($conn,'Cuisineéquipée');        
        $balconid=searchNom($conn,'Balcon');
        $loggiaid = searchNom($conn,'Loggia');
        $piscineid = searchNom($conn,'Piscine');        
        $ascenseurid=searchNom($conn,'Ascenseur');
        $gardienid = searchNom($conn,'Gardien');
        $accessecuriseId = searchNom($conn,'Accès sécurisés');        
        $jacuzziId=searchNom($conn,'Jacuzzi');
        $salle_de_jeuxId = searchNom($conn,'Salle de jeux');
        $equipement_enfantId = searchNom($conn,'Equipement enfant');        
        $internetId=searchNom($conn,'Internet');
        $televisionId = searchNom($conn,'Télévision');
        $cable_satelliteId = searchNom($conn,'Câble/Satellite');        
        $lecteur_dvdId=searchNom($conn,'Lecteur DVD');
        $console_de_jeuxId = searchNom($conn,'Console de jeux');
        $lave_lingeId = searchNom($conn,'Lave linge');        
        $seche_lingeId=searchNom($conn,'Sèche linge');
        $lave_vaisselleId = searchNom($conn,'Lave vaisselle');
        $couchagesId = searchNom($conn,'Couchages');

        $link_rewrite1 = $reference." ".$type_bien." ".$surface;
        $link_rewrite = str_replace(" ","-",$link_rewrite1);
        
        $name = $reference.",".$type_bien.",".$surface."m²";

        $date_add = date('Y-m-d');

        $product_id = insertIntoProduct($conn, $id_shop, $prix, $prix_loc, $reference, $active, $type_transaction,$type_bien,$date_add);
        
        insertIntoProduitLang($conn,$product_id,$id_shop,$id_lang,$description,$link_rewrite,$name);
            if($parking_ext==1){
                InsertEquipementsProduct($conn,$product_id,$parkingextid);
            }

            if($garage_box==1){
                InsertEquipementsProduct($conn,$product_id,$garage_boxid);
            }
        
            if($cave==1){
                InsertEquipementsProduct($conn,$product_id,$caveid);
            }
           
            if($chauffage_gaz==1){
                InsertEquipementsProduct($conn,$product_id,$chauffage_gazid);
            }
            
            if($chauffage_elec==1){
                InsertEquipementsProduct($conn,$product_id,$chauffage_elecId);
            }
         
            if($cuisine_equipee==1){
                InsertEquipementsProduct($conn,$product_id,$cuisine_equipeeid);
            }
                      
            if($balcon==1){
                InsertEquipementsProduct($conn,$product_id,$balconid);
            }
                      
            if($loggia==1){
                InsertEquipementsProduct($conn,$product_id,$loggiaid);
            }
                       
            if($piscine==1){
                InsertEquipementsProduct($conn,$product_id,$piscineid);
            }
                        
            if($ascenseur==1){
                InsertEquipementsProduct($conn,$product_id,$ascenseurid);
            }         
            
            if($gardien==1){
                InsertEquipementsProduct($conn,$product_id,$gardienid);
            }
                  
            
            if($acces_securises==1){
                InsertEquipementsProduct($conn,$product_id,$accessecuriseId);
            }
                       
            
            if($jacuzzi==1){
                InsertEquipementsProduct($conn,$product_id,$jacuzziId);
            }
                       
            
            if($salle_de_jeux==1){
                InsertEquipementsProduct($conn,$product_id,$salle_de_jeuxId);
            }
                       
            
            if($equipement_enfant==1){
                InsertEquipementsProduct($conn,$product_id,$equipement_enfantId);
            }
                       
            
            if($internet==1){
                InsertEquipementsProduct($conn,$product_id,$internetId);
            }
                       
            
            if($television==1){
                InsertEquipementsProduct($conn,$product_id,$televisionId);
            }
                       
            
            if($cable_satellite==1){
                InsertEquipementsProduct($conn,$product_id,$cable_satelliteId);
            }
                      
            
            if($lecteur_dvd==1){
                InsertEquipementsProduct($conn,$product_id,$lecteur_dvdId);
            }
                      
            
            if($console_de_jeux==1){
                InsertEquipementsProduct($conn,$product_id,$console_de_jeuxId);
            }
                      
            
            if($lave_linge==1){
                InsertEquipementsProduct($conn,$product_id,$lave_lingeId);
            }          
            
            if($seche_linge==1){
                InsertEquipementsProduct($conn,$product_id,$seche_lingeId);
            }
                       
            
            if($lave_vaisselle==1){
                InsertEquipementsProduct($conn,$product_id,$lave_vaisselleId);
            }

            if($couchages==1){
                InsertEquipementsProduct($conn,$product_id,$couchagesId);
            }
           
    insertIntoService($conn,$product_id,$tarif_option_menage);
    insertIntoAdresse($conn,$product_id,$adresse, $ville, $code_postal);
    insertIntoFeature($conn,$product_id,$reference,$mandat,$pieces,$surface,$surface_balcon,$surface_loggia,$surface_terrasse,$surface_terrain,$nb_couchages,$annee_construction);

 }

 function insertIntoService($conn,$product_id,$tarif_option_menage){
    $serviceName = "Ménage";
    $stmt = $conn->prepare("SELECT * FROM sb8_prestaimmo_service WHERE title = ?");
    $stmt->bind_param("s", $serviceName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idService = $row['id_service'];
    // var_dump($idService);

    $stmt = $conn->prepare("INSERT INTO sb8_prestaimmo_product_service(id_product,id_service,price) VALUES (?,?,?)");
    $stmt->bind_param("iii",$product_id,$idService,$tarif_option_menage);
     if ($stmt->execute()) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting SERVICE: " . $stmt->error ."<br>";
        return -1;
    }

 }

function insertIntoAdresse($conn, $product_id, $adresse, $ville, $code_postal) {
    $stmt = $conn->prepare("INSERT INTO sb8_prestaimmo_address (id_product, address, city, postal_code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $product_id, $adresse, $ville, $code_postal);

    if ($stmt->execute()) {
        $stmt2 = $conn->prepare("INSERT INTO sb8_prestaimmo_location(id_product) VALUES (?)");
        $stmt2->bind_param("i", $product_id);
        if( $stmt2->execute() ) {
        echo "Record inserted successfully<br>";
        }
    } else {
        echo "Error inserting address: " . $stmt->error."<br>";
        return -1;
    }

    $stmt->close();
}
function InsertEquipementsProduct($conn,$idProduit,$idEquipement){
    $stmt = $conn->prepare("INSERT INTO sb8_prestaimmo_product_equipement (id_product,id_equipement) VALUES (?,?)");
    $stmt->bind_param("ii", $idProduit,$idEquipement);
    if ($stmt->execute()) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting address: " . $stmt->error."<br>";
        return -1;
    }

    $stmt->close();
}

function insertIntoEquipements($conn) {
    $equipments=[
                'Parking extérieur',
                 'Garage/Box',
                 'Cave',
                 'Chauffage au gaz',
                 'Chauffageélectrique',
                 'Cuisineéquipée',
                 'Balcon',
                 'Loggia',
                 'Piscine',
                 'Ascenseur',	
                 'Gardien',
                 'Accès sécurisés',	
                 'Jacuzzi',
                 'Salle de jeux',	
                 'Equipement enfant',	
                 'Internet',	
                 'Télévision',	
                 'Câble/Satellite',	
                 'Lecteur DVD',
                 'Console de jeux',	
                 'Lave linge',	
                 'Sèche linge',	
                 'Lave vaisselle',	
                 'Couchages'
    ];

    foreach ($equipments as $equipment){
    $sql = "INSERT INTO sb8_prestaimmo_equipment (title,label) VALUES (?,?)";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $equipment,$equipment);
    if ($stmt->execute()) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting address: " . $stmt->error."<br>";
        return -1;
    }

    $stmt->close();}
}

function searchNom($conn,$nom){
    $stmt = $conn->prepare("SELECT * FROM sb8_prestaimmo_equipment WHERE title = ?");
    $stmt->bind_param("s", $nom);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        // var_dump($row['id_equipment']);
        return $row['id_equipment'];
    } else {
        return null;
    }
}

function insertIntoProduitLang($conn,$product_id,$id_shop,$id_lang,$description,$link_rewrite,$name) {
    
    $sql =$conn->prepare("INSERT INTO sb8_product_lang (id_product,id_shop,id_lang,description,link_rewrite,name) VALUES (?,?,?,?,?,?)");
    $sql->bind_param("iiisss",$product_id,$id_shop,$id_lang,$description,$link_rewrite,$name);
    if ($sql->execute()) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting product_lang: " . $conn->error."<br>";
        return -1;
    }
}

function insertIntoFeature($conn, $product_id, $reference, $mandat, $pieces, $surface, $surface_balcon, $surface_loggia, $surface_terrasse, $surface_terrain, $nb_couchages, $annee_construction) {
    $reference = isset($reference) ? htmlspecialchars($reference) : '';
    $mandat = isset($mandat) ? mysqli_real_escape_string($conn, $mandat) : '';
    $pieces = !empty($pieces) ? $pieces : 0;
    $surface = !empty($surface) ? $surface : 0;
    $surface_balcon = !empty($surface_balcon) ? $surface_balcon : 0;
    $surface_loggia = !empty($surface_loggia) ? $surface_loggia : 0;
    $surface_terrasse = !empty($surface_terrasse) ? $surface_terrasse : 0;
    $surface_terrain = !empty($surface_terrain) ? $surface_terrain : 0;
    $nb_couchages = !empty($nb_couchages) ? $nb_couchages : 0;
    $annee_construction = !empty($annee_construction) ? $annee_construction : 0;

    $sql = $conn->prepare( "INSERT INTO sb8_prestaimmo_feature (id_product, reference_immo, mandate, number_of_rooms, area, balcony_area, loggia_area, terrace_area, land_area, number_sleeping, year_built) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param("issiiiiiiis",$product_id, $reference, $mandat, $pieces, $surface, $surface_balcon, $surface_loggia, $surface_terrasse, $surface_terrain, $nb_couchages, $annee_construction);
    
    if ($sql->execute()) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting feature: " . $conn->error."<br>";
        return -1;
    }
}


function insertIntoProduct($conn, $id_shop, $prix, $prix_loc, $reference, $active, $type_transaction, $type_bien,$date_add) {
    //voir l'id du categorie par le type de transaction
    $id_category = getCategoryid($conn, $type_transaction);
    // var_dump($id_category);

    //voir l'id du sous-categorie par le type du bien
    $id_sous_categories = getCategoryid($conn, $type_bien);
    // var_dump($id_sous_categories);

    if ($id_sous_categories !== null && $id_category !== null) {
        foreach($id_category as $id_pp){
        foreach ($id_sous_categories as $id_ss) {
            $id_sous_category = getProductCategoryId($conn, $id_ss, $id_pp);
            if ($id_sous_category !== null) {
                // var_dump($id_sous_category);
                $inserted = insertProductIntoDatabase($conn, $id_shop, $id_sous_category, $prix, $prix_loc, $reference, $active,$date_add);
                if ($inserted !== null) {
                    echo "Record inserted successfully<br>";
                    return $inserted;
                }
            }
        }}
    }
    else{
        $id_sous_category=null;
        $inserted = insertProductIntoDatabase($conn, $id_shop, $id_sous_category, $prix, $prix_loc, $reference, $active,$date_add);
                if ($inserted !== null) {
                    echo "Record inserted successfully<br>";
                    return $inserted;
                }
    }
    return null;
}


function insertProductIntoDatabase($conn, $id_shop, $id_sous_category, $prix, $prix_loc, $reference, $active,$date_add) {
    $id_tax_rules_group = 1;
    $sql = "INSERT INTO sb8_product (id_shop_default, id_category_default,id_tax_rules_group, price, unit_price, reference, active,date_add,date_upd) VALUES (?, ?,?, ?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiddsiss", $id_shop, $id_sous_category,$id_tax_rules_group, $prix, $prix_loc, $reference, $active,$date_add,$date_add);

    if ($stmt->execute()) {
        $product_id = $conn->insert_id;
        
        $stmt2 = $conn->prepare("INSERT INTO sb8_product_shop (id_product,id_shop, id_category_default,id_tax_rules_group, price, unit_price, active,date_add,date_upd) VALUES (?, ?, ?, ?, ?, ?,?,?,?)");
        $stmt2->bind_param("iiiddiiss",$product_id, $id_shop, $id_sous_category,$id_tax_rules_group, $prix, $prix_loc, $active,$date_add,$date_add);
    
        if($stmt2->execute()){
         echo "sb8_product_shop inséré <br>";
         $stmt3 = $conn->prepare("INSERT INTO sb8_category_product(id_category,id_product) VALUES (?,?)");
         $stmt3->bind_param("ii", $id_sous_category,$product_id);

         if($stmt3->execute()){
            echo "sb8_category_product bien inséré <br>";
         }
        } else {
            echo "Error inserting product into sb8_product_shop: " . $stmt2->error . "<br>";
        }
        
        return $product_id;
    } else {
        echo "Error inserting product into sb8_product: " . $stmt->error . "<br>";
        $stmt->close();
        return null;
    }
    
}


//fonction pour obtenir l'id du categorie et des sous-categories
function getCategoryid($conn, $categoryName) {
    $stmt = $conn->prepare("SELECT * FROM sb8_category_lang WHERE name = ?");
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($categories,$row['id_category']);
        }
        return $categories;
    } else {
        return null; 
    }
}

//fonction pour voir lequel des 3 sous-categories est au categorie parent
function getProductCategoryId($conn, $id_sous_category, $id_category) {
    $stmt = $conn->prepare("SELECT * FROM sb8_category WHERE id_category = ? AND id_parent = ?");
    $stmt->bind_param("ii", $id_sous_category, $id_category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        // var_dump($row['id_category']);
        return $row['id_category'];
    } else {
        return null;
    }
}

?>
