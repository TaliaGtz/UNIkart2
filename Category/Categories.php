<?php
    
    include("../PhpDocs/PhpInclude.php");

    //Queremos el ID de la categoría accedida
    $IDCat      = $_SESSION['IDCategory'];

    $consultaCatNeg  = mysqli_query($conexion,'CALL sp_cat(3, "'.$IDCat.'");');
    //$consultaCatNeg = mysqli_fetch_array($consultaCatNeg);  //Devuelve un array o NULL

    //$consultaCatNeg  =  "SELECT C.ID_Categoria, CN.ID_negocio, N.Nombre
    //                    FROM categorias C
    //                    INNER JOIN categoriaxnegocio CN ON C.ID_Categoria = CN.ID_categoria
    //                    INNER JOIN negocios N ON CN.ID_negocio = N.ID_Negocio
    //                    WHERE C.ID_Categoria = '$IDCat'";
    //$ejecutar = $conexion->query($consultaCatNeg);
    
    while($fila = $consultaCatNeg->fetch_array()):
        while(mysqli_next_result($conexion)){;}
?>

    <a href="../Menu/Menu.php?IDBtn=<?php echo $fila['ID_negocio']; ?>" class="card">
        <div>
            <div>
                <img class="text" src="../ExtraDocs/OrangeBlack.png" width="150px" height="150px">
                <h3 class="text"><?php echo $fila['Nombre']; ?></h3>
            </div>
        </div>
    </a>

<?php endwhile; ?>  

<?php

    //Queremos el ID de la categoría accedida
    $IDCat      = $_SESSION['IDCategory'];
    while(mysqli_next_result($conexion)){;}
    $consultaCatNeg  = mysqli_query($conexion,'CALL sp_cat(4, "'.$IDCat.'");');
    //$consultaCatNeg = mysqli_fetch_array($consultaCatNeg);  //Devuelve un array o NULL

    //$consultaCatNeg  =  "SELECT C.ID_Categoria, CN.ID_Producto, N.Nombre
    //                    FROM categorias C
    //                    INNER JOIN productoxcat CN ON C.ID_Categoria = CN.ID_Categoria
    //                    INNER JOIN productos N ON CN.ID_Producto = N.ID_Producto
    //                    WHERE C.ID_Categoria = '$IDCat'";
    //$ejecutar = $conexion->query($consultaCatNeg);

    while($fila = $consultaCatNeg->fetch_array()):
        
?>

    <a href="../Producto/Producto.php?IDBtn=<?php echo $fila['ID_Producto']; ?>" class="card">
        <div>
            <div>
                <img class="text" src="../ExtraDocs/OrangeBlack.png" width="150px" height="150px">
                <h3 class="text"><?php echo $fila['Nombre']; ?></h3>
            </div>
        </div>
    </a>

<?php endwhile; ?> 