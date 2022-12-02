<!DOCTYPE html>
<?php

include("../PhpDocs/PhpInclude.php");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIkart - Producto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="Producto.css">
    <link rel="stylesheet" href="../AddModal/Cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/29079834be.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7e5b2d153f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../ExtraDocs/Ukart.png">
</head>
<body>
    <?php require "../PhpDocs/Nav.php"; ?>

    <?php 
        $idBtn = $_GET['IDBtn'];
        $consulta = "SELECT Nombre, Negocio, Valoracion, Precio, PrecioCant, Disponibilidad, Descripcion, Views  
                    FROM productos 
                    WHERE ID_Producto = '$idBtn'";
        $consulta = mysqli_query($conexion, $consulta);
        $consulta = mysqli_fetch_array($consulta);  //Devuelve un array o NULL
        $_SESSION['Producto'] = $consulta['Nombre'];
        $_SESSION['ID_Producto'] = $idBtn;

        $Views = $consulta['Views'];
        $Views = $Views + 1;
        $query = "UPDATE productos
                SET Views = '$Views'
                WHERE ID_Producto = '$idBtn'";
        mysqli_query($conexion, $query);
        
    ?>

    <section class="grid">
        <div class="square">
            <h1 class="h1"><?php echo $_SESSION['Producto']; ?></h1>
        </div>

        <!-- sección de Producto -->

        <section id="contenidoImg">
            <!--<img src="../ExtraDocs/chilaquiles.jpg" class="productImg">-->

            <div id="carouselExampleIndicators" class="carousel slide productImg" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="../ExtraDocs/chilaquiles1.jpg" class="d-block w-100 productImg" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../ExtraDocs/chilaquiles2.jpg" class="d-block w-100 productImg" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../ExtraDocs/chilaquiles3.jpeg" class="d-block w-100 productImg" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../ExtraDocs/chilaquiles4.jpg" class="d-block w-100 productImg" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="description">
                <p id="productName"><?php echo $_SESSION['Producto']; ?></p>
                <p>Valoración: <?php echo $consulta['Valoracion']; ?></p>
                <?php
                    if($consulta['Precio'] == 0){
                        ?><p><a id="cotiz" href="../Mensajes/mensajes.php">Cotización</a></p><?php
                    }else{
                        ?><p>$<?php echo $consulta['PrecioCant']; ?></p><?php
                    }
                ?>
                <p>Categoría</p>
                <p><?php echo $consulta['Disponibilidad']; ?> artículos disponibles</p>
                <p><?php echo $consulta['Descripcion']; ?></p>
                <a href="../WishList/WishList.php"></a>
                
                <div class="dropdown">
                    <i id="add" class="fa-solid fa-heart-circle-plus" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu">
                        <?php include("../Producto/WLists.php"); ?>
                    </ul>
                </div>

                <a href="#" onclick="addCart()"><i id="addCart" class="fa-solid fa-cart-plus"></i></a>
            </div>
        </section>

        <div class="video">
            <form action="../videos/save_video.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
					<label class="form">Subir Video</label><br>
					<input type="file" name="video" class="form-control-file form"/><br>
                    <button name="save" class="btn btn-primary form"><span class="glyphicon glyphicon-save"></span> Guardar</button>
				</div>
            </form>
            <div class="col-md-6 well">
                <?php
                    include("../PhpDocs/Conexion.php");
                    
                    $query = mysqli_query($conexion, "SELECT video_id, video_name, location FROM `video` WHERE ID_Producto = '$idBtn'") or die(mysqli_error());
                    while($fetch = mysqli_fetch_array($query)){
                ?>
                <div class="col-md-12">
                    <div class="col-md-8">
                        <video width="600px" height="auto" controls>
                            <source src="<?php echo $fetch['location']?>">
                        </video>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <!-- fin sección de Producto -->

        <!-- sección de Comentarios -->

        <div class="comments">
            <h1>Comentarios</h1>
            
            <section id="publicacion">
                <div id="commentBoxP" contenteditable="true" dir="auto" class="commentBoxP" placeholder="Agrega un comentario..."></div>
                <br>
                <!--<div class="cat">Categoría: (No editable)
                    <input type="radio" class="catRB" name="genero" id="IDCat1"/> Categoría 1
                    <input type="radio" class="catRB" name="genero" id="IDCat2"/> Categoría 2
                    <input type="radio" class="catRB" name="genero" id="IDCat3"/> Categoría 3
                </div>
                <br>-->
                <div class="valoracion"> 
                    <input type="radio" name="estrellas" id="rate5" value="5">
                    <label for="rate5" class="fas fa-star"></label>
                    <input type="radio" name="estrellas" id="rate4" value="4">
                    <label for="rate4" class="fas fa-star"></label>
                    <input type="radio" name="estrellas" id="rate3" value="3">
                    <label for="rate3" class="fas fa-star"></label>
                    <input type="radio" name="estrellas" id="rate2" value="2">
                    <label for="rate2" class="fas fa-star"></label>
                    <input type="radio" name="estrellas" id="rate1" value="1">
                    <label for="rate1" class="fas fa-star"></label>
                </div>
                <input type="date" id="datepkd" class="datepkd" value="2022-01-01">
                <button type="button" id="publicar" class="button">Publicar</button>
            </section>

            <section id="contenido">
                <section class="paginacion">
                    <ul id="ulli">
                        <li type="button" id="li1" onclick="nPags(1)">1</li>

                    </ul>
                </section>

                <div id="pag1">
                </div>
                
            </section>

            <div id="searchList" class="searchList">
                <ul id="searchUl">
                </ul>
            </div>
        
        </div>

        <!-- fin sección de Comentarios -->

        <!--Recomendaciones y productos similares-->
        <div class="prodSimi">
            <h3>Productos similares</h3>
            <div class="prodSimi">
                <?php include("../PhpDocs/ProductosPlus.php"); ?>
            </div>
        </div>

        <!-- sección de footer -->

        <div class="other">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin-top:0px"><path fill="#000" fill-opacity="1" d="M0,96L80,101.3C160,107,320,117,480,128C640,139,800,149,960,144C1120,139,1280,117,1360,106.7L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
        </div>
        <div class="footer"></div>
        <div class="imgFtr"><img src="../ExtraDocs/UK.png" height="70" width="70" class="logo"></div>
        <ul class="textContent">
            <li><i class="fa-solid fa-at"></i>   talia.gutierrezal@uanl.edu.mx</li>
            <li><i class="fa-solid fa-at"></i>   talia.gutierrezal@uanl.edu.mx</li>
        </ul>
        <ul class="socialMedia">
            <li><i class="fa-brands fa-instagram"></i>   Instagram</li>
            <li><i class="fa-brands fa-twitter"></i>   Twitter</li>
        </ul>

        <!-- fin sección de footer -->

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Producto.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>