<?php
    require_once "../php/conexion.php";
    class Product extends dbconexion{

        public function select_products(){
            $sql = "SELECT p.product_name, p.description, c.category_name FROM producto p INNER JOIN categoria c ON p.category_id = c.id ORDER BY p.product_name ASC";
            $consulta = dbconexion::conexion()->prepare($sql);
            $consulta->execute();
            return $array = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        public function select_categories(){
            $sql = "SELECT * FROM categoria";
            $consulta = dbconexion::conexion()->prepare($sql);
            $consulta->execute();
            return $array = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_product($productName, $productDescription, $category_id){
            $sql = dbconexion::conexion()->prepare("INSERT INTO producto(product_name, description, category_id) VALUES('$productName','$productDescription', '$category_id')");
            if ($sql->execute()) {
                $resultado = self::select_products();
                return $resultado;
            }
        }

    }