
<?php
header("Content-type: application/json");
header ( "Access-Control-Allow-Origin: *");
require 'data.php';


$req = $_GET['req'] ?? null;

if ($req) {
    $jsonData = file_get_contents("restaurant.json");
    $menulist = json_decode($jsonData, true)['menu_items'];
    try {

        $menuitems  = new restuarantdata($menulist);
    } catch (Exception $th) {
        echo json_encode([$th->getMessage()]);
        return;
    }
}

switch ($req) {
    case 'menuitems':
        echo  ($menuitems->getMenuItemlist());
        break;

    case "item":
        $id = $_GET['id'] ?? null;
        echo ($menuitems->getMenuItemDetails($id));
        break;
    
    default:
        echo json_encode(["In-valid request"]);
        break;
}
