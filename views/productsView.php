<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos JS FETCH API</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="container" id="mensajes"></div>
                <h2 class="text-info">Productos</h2>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Articulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_productos">
                        <?php 
                            require_once "../php/conexion.php";
                            require_once "../controlador/productController.php";

                            $products = new Product();
                            $mostrarProductos = $products->select_products();
                            foreach ($mostrarProductos as $value) { 
                                echo "<tr>";
                                     echo "<td>".$value["product_name"]."</td>";
                                     echo "<td>".$value["description"]."</td>";
                                     echo "<td>".$value["category_name"]."</td>";
                                     echo "<td class='text-center'>
                                     <button class='btn btn-primary btn-sm' onclick='editar($id);'>Editar...</button>
                                     <button class='btn btn-danger btn-sm'onclick='eliminar($id);'>Eliminar</button>
                                     </td>";

                                echo "</tr>";
                            }
                        ?>

                    </tbody>
                    </table>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h2 class="text-info">Nuevo Producto</h2>
                    <form class="row g-3" id="formProduct">
                    <input type="text" name="tipo_operacion" value="guardar" hidden="true">
                        <div class="col-12">
                            <label for="producto" class="form-label">Producto</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Nombre producto" require>
                        </div>
                        <div class="col-12 mt-3">
                        <div class="form-floating">
                            <label for="floatingTextarea2">Descripcion</label>
                            <textarea class="form-control" placeholder="Descripcion" id="productDescription" name="productDescription" style="height: 100px" require></textarea>
                        </div>
                        </div>

                        <div class="col-12 mt-3">
                            
                            <label for="inputState" class="form-label">Categoria</label>
                            <select id="inputState" class="form-select " name="categoria_id" id="categoria_id">
                            <option selected value="seleccionar">Seleccione una categoria...</option>
                            <?php 
                                require_once "../php/conexion.php";
                                require_once "../controlador/productController.php";

                                $categorias = new Product();
                                $consultaCategorias = $categorias->select_categories();
    
                                foreach ($consultaCategorias as $value) {
                                    echo '<option value="'.$value["id"].'">'.$value["category_name"].'</option>';                                  
                                }
                            ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-info">Guardar</button>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../js/product.js"></script>
</body>
</html>