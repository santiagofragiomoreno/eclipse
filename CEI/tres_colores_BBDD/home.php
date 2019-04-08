
<body>
<nav>
	<ul>
		<!--<pre><?php print_r($json); ?><</pre>-->
		<!--<li><a href="azul.html"><span class="texto">azul</span></a></li>
		<li><a href="blanco.html"><span class="texto">blanco</span></a></li>
		<li><a href="rojo.html"><span class="texto">rojo</span></a></li>-->
		<?php for($i=1; $i<=3;$i++){ ?>
			<li>
				<a href="<?php echo $directorio_base.$ruta[0]; ?>/<?php echo $paginas[$i]->url;?>">
					<span class="texto"><?php echo $paginas[$i]->nombre; ?></span>
				</a>
			</li>
		<?php } ?>
	</ul>
</nav>
<header>
	<p class="idiomas"><a href="<?php echo $directorio_base."es";?>">es</a> | <a href="<?php echo $directorio_base."fr";?>">fr</a> | <a href="<?php echo $directorio_base."en";?>">en</a></p>	
	<h1>Krzysztof Kieślowski <span class="titulo"><?php echo $titulo[$idioma]; ?></span></h1>
	<p><a href="<?php echo $directorio_base.$ruta[0]; ?>/<?php echo $json->paginas[4]->pagina->url;?>">biografía +</a></p>
</header>
</body>