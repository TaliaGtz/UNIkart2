<?php

    include("../PhpDocs/Conexion.php");

    $IDNeg = $_SESSION['IDNegocio'];
    $consulta = "SELECT ID_Producto, Nombre 
                FROM productos 
                WHERE Negocio='$IDNeg'";
    $ejecutar = $conexion->query($consulta);
    while($fila = $ejecutar->fetch_array()):
                    
?>
                  
    <div class="card">
        <a href="../Producto/Producto.php?IDBtn=<?php echo $fila['ID_Producto']; ?>">
        <div>
            <img src="../ExtraDocs/HDBlack.png" width="80px" height="80px">
            <h3><?php echo $fila['Nombre'] ?></h3>
            <a href="../WishList/WishList.php"><i id="add" class="fa-solid fa-heart-circle-plus"></i></a>
            <!--div class="dropdown">
                <i id="add" class="fa-solid fa-heart-circle-plus" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu">
                    <?php //include("../Producto/WLists.php"); ?>
                </ul>
            </!--div-->
            <a href="#" onclick="addCart()"><i id="addCart" class="fa-solid fa-cart-plus"></i></a>
        </div>
        </a>
    </div>

<?php endwhile; ?> 