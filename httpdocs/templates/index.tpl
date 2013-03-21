{include file="inc/header.tpl"}
    <section id="index">
        <header data-title="Elige tu aventura">
			<nav class="right">
			{if $user}
				<a href="{$logout_url}" data-icon="close" class="button"></a>
			{else}
				<fb:login-button></fb:login-button>
				<div id="fb-root"></div>
				<script>
				  window.fbAsyncInit = function() {
					FB.init({
					  appId: '{$facebook->getAppID()}',
					  cookie: true,
					  xfbml: true,
					  oauth: true
					});
					FB.Event.subscribe('auth.login', function(response) {
					  window.location.reload();
					});
					FB.Event.subscribe('auth.logout', function(response) {
					  window.location.reload();
					});
				  };
				  (function() {
					var e = document.createElement('script'); e.async = true;
					e.src = document.location.protocol +
					  '//connect.facebook.net/en_US/all.js';
					document.getElementById('fb-root').appendChild(e);
				  }());
				</script>			
			{/if}
			</nav>
		</header>
		{if $user}		
		<article id="chars-list" class="{if !$session.step}active {/if}list indented scroll">
			<ul id="chars-li">
				<li class="dark"><strong>Personajes</strong></li>
			{if $chars}
				
				{section name=inc loop=$chars}
				<li><a href="#" onclick="getChar('{$chars[inc].id}');"><strong>{$chars[inc].charname}</strong><small>{$chars[inc].charclass}/{$chars[inc].charrace}</small></a></li>
				{/section}
			{/if}
			</ul>
			<ul>
				<li class="dark"><strong>Crear personaje</strong></li>
			</ul>
			<div class="form">
				<fieldset data-icon="plus">
					<label>Nombre</label>
					<input type="text" id="newname">
				</fieldset>
				<label>Clase</label>
                <label class="select">
                    <select class="custom" id="newclass">
                        <option value="Picaro">Picaro</option>
                        <option value="Guerrero">Guerrero</option>
                        <option value="Barbaro">Barbaro</option>
						<option value="Mago">Mago</option>
						<option value="Clerigo">Clerigo</option>
                    </select>
                </label>
				<label>Raza</label>
                <label class="select">
                    <select class="custom" id="newrace">
                        <option value="Humano">Humano</option>
                        <option value="Enano">Enano</option>
                        <option value="Elfo">Elfo</option>
						<option value="Gnomo">Gnomo</option>
						<option value="Halfling">Halfling</option>
                    </select>
                </label>
				<a href="#" onclick="createChar();" class="button dark">Crear</a>
			</div>
		</article>
		<article id="charsheet" class="list indented scroll">
			<ul>
				<li class="dark"><strong>Atributos</strong></li>
				<li>
					<ul>
						<li id="fue">FUE</li> 
						<li id="con">CON</li>
						<li id="des">DES</li>	
						<li id="int">INT</li>
						<li id="sab">SAB</li>	
						<li id="car">CAR</li>
						<li id="gold">ORO</li>
						<li id="xp">PX</li>					
					</ul>
				</li>
				<li class="dark"><a href="#" onclick="openShop(currentCharId);" class="button right">Comprar</a><strong>Equipo</strong><small>Equipo especial</small></li>
				<li>
					<ul id="equip"></ul>
				</li>
				<br/>
				{if $adventures}
				<li class="dark"><strong>Jugar aventura</strong></li>
				<li>
					<ul>	
						{section name=inc loop=$adventures}
						<li><a href="#" onclick="initAdventure({$adventures[inc].first});" data-router="article" data-title="{$adventures[inc].title}"><strong>{$adventures[inc].title}</strong><small>{$adventures[inc].text}</small></a></li>
						{/section}
					</ul>
				</li>	
				{/if}
			</ul>
		</article>
		<article id="steps" class="{if $session.step}active {/if}list indented scroll">
			<p id="steptext"></p>
			<ul id="next"></ul>
			<ul>
				<li id="endbutton"><a href="#chars-list" data-router="article" data-title="Elige tu aventura" class="button dark">Terminar</a></li>
				<li id="message"></li>
				<li id="status"></li>				
			</ul>
		</article>
		<article id="shop" class="list indented scroll">
			<ul id="items"></ul>
			<a href="#" onclick="getChar(currentCharId);" class="button dark">Salir</a>
		</article>
		{else}
		<article id="presentation" class="active list indented scroll">
			<ul>
				<li>Los clásicos libros de "Elige tu propia aventura" ahora en online con un toque de RPG. Logeate con Facebook para poder jugar.</li>
			</ul>
		</article>			
		<article id="legal" class="list indented scroll">
			<ul>
				<li>
					<strong>Licencia de la aplicación web de Eligetuaventura</strong>
					<p>Esta aplicación web ha sido desarrollada con el Framework LungoJS. En cumplimiento de la Licencia de LungoJS se puede obtener todo el código usado en la aplicación web de Eligetuaventura.</p>
					<p>Sientete libre de coger este código y modificarlo a tu gusto (respetando la licencía sobre la que esta desarrollado) y si necesitas ayuda no dudes en preguntar. También te agradecemos por adelantado cualquier tipo de sugerencia o error que detectes.</p>	<br/>	
					<p><a class="button big articblue" href="https://github.com/gwannon/eligetuaventura">Descargar código fuente</a> </p><br/>
					<p><a class="button big articblue" href="https://github.com/TapQuo/Lungo.js/blob/master/LICENSE.txt" target="_blank">LUNGOJS</a></p>
				</li>
			</ul>
		</article>	
		<footer>
			<nav>
				<a href="#presentation" data-router="article" data-icon="home" class="active"></a>
				<a href="#legal" data-router="article" data-icon="info"></a>
			</nav>
		</footer>		
		{/if}
    </section>
{include file="inc/footer.tpl"}