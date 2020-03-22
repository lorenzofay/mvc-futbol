<?php require RUTA_APP . '/views/inc/header.php'; ?>
<h1>Bienvenido al HOME</h1>
<p><?php echo $datos['titulo']; ?></p>
<ul>
    <?php foreach($datos['articulos'] as $articulo) { ?>
        <li>
        <?php echo $articulo->nombre; ?></li>
        <li><?php echo $articulo->precio; ?></li>
    <?php } ?> 
</ul>
<?php require RUTA_APP . '/views/inc/footer.php'; ?>