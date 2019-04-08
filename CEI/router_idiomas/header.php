<h1><?php echo $json->paginas[$pagina]->pagina[$idioma]->titulo; ?></h1>

<header>
    <nav>
        <ul>
            <?php for($i=0;$i<count($json->navegacion);$i++){ ?>
                <li>
                	<?php $separador = ($i != 0) ? "/" : "" ?>
                	<a href="<?php echo $directorio_base.$ruta[0].$separador; ?><?php echo $json->navegacion[$i]->item->url; ?>"><?php echo $json->navegacion[$i]->item->nombre[$idioma]->texto; ?></a></li>
            <?php } ?>
        </ul>
        <?php if($pagina != 0) {
        	$href = ($idioma == 0) ? $directorio_base.'en'.$separador.$ruta[1] : $directorio_base.'es'.$separador.$ruta[1];
        	$label = ($idioma == 0) ? "EN" : "ES";
        ?>
        <ul>
			<li><a class="idioma" href="<?php echo $href; ?>"><?php echo $label; ?></a></li> 
        </ul>
        <?php } ?>
    </nav>
</header>