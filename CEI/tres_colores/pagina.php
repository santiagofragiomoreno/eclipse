<body class="<?php echo ($pagina==4)?'blanco':$json->paginas[$pagina]->pagina->url?>">
	<header class="interno">
		<p class="idiomas"><a href="<?php echo $directorio_base."es";?>">es</a> | <a href="<?php echo $directorio_base."fr";?>">fr</a> | <a href="<?php echo $directorio_base."en";?>">en</a></p>	
		<h1><a href="index.html">Krzysztof Kieślowski <span class="titulo"><?php echo $titulo[$idioma]; ?></span></a></h1>
		<nav>
			<ul>
				<?php for($i=1;$i<5;$i++){?>
				    <li><a href="<?php echo $json->paginas[$i]->pagina->url?>"><?php echo $json->paginas[$i]->pagina->nombre[$idioma]->texto?></a></li>
				<?php }?>			
			</ul>
		</nav>
		<div class="clearfix"></div>
	</header>
	<div class="contenedor">
		<h2><?php echo $json->paginas[$pagina]->pagina->titulo[$idioma]->texto?></h2>
		<?php $texto = explode("|",$json->paginas[$pagina]->pagina->copy[$idioma]->texto);?>
		<?php for($i=0;$i<count($texto);$i++){?>
		       <p><?php echo $texto[$i];?>
		<?php }?>
		
	</div>
</body>