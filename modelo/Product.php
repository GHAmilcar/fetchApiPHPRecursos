<?php
    require_once "../php/conexion.php";
    require_once "../controlador/productController.php";
    
    $tipoOperacion = $_POST['tipo_operacion'];

    switch ($tipoOperacion) {
        case 'guardar':
            $name = $_POST['productName'];
            $description = $_POST['productDescription'];
            $category_id = $_POST['categoria_id'];
            
            $ejecutar = new Product();
            $consulta = $ejecutar->insert_product($name, $description, $category_id);
            echo json_encode($consulta);
            break;
        
        default:
            # code...
            break;
    }

?>
