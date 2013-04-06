{include file="inc/header.tpl"}
    <section id="index">
        <header data-title="{$Name}">
			<nav class="right">
			{if $user}
				<a href="{$logout_url}" data-icon="close" class="button"></a>
			{/if}
			</nav>
		</header>
		{if $user}		
		<article id="chars-list" class="{if !$session.step}active {/if}list indented scroll">
			<ul id="chars-li">
				<li class="dark"><strong>Héroes</strong></li>
			{if $chars}
				
				{section name=inc loop=$chars}
				<li class="arrow"><img src="/objects/class_{$chars[inc].charclass}.jpg"><a href="#" onclick="getChar('{$chars[inc].id}');"><strong>{$chars[inc].charname}</strong><small>{$chars[inc].charclass}/{$chars[inc].charrace}</small></a></li>
				{/section}
			{/if}
			</ul>
			<ul>
				<li class="dark"><strong>Crear héroe</strong></li>
			</ul>
			<div class="form">
				<fieldset data-icon="plus">
					<label>Nombre</label>
					<input type="text" id="newname">
				</fieldset>
				<label><strong>Clase</strong></label>
				<label class="select">
				    <select class="custom" id="newclass">
				        {foreach from=$player_classes key=k item=v}
					<option value="{$k}">{$k}</option>
					{/foreach}
				    </select>
				</label>
				<label><strong>Raza</strong></label>
				<label class="select">
				    <select class="custom" id="newrace">
				        {foreach from=$player_races key=k item=v}
					<option value="{$k}">{$k}</option>
					{/foreach}
				    </select>
				</label>
				<label><strong>Reza al Dios</strong></label>
				<label class="select">
				    <select class="custom" id="newgod">
				        {foreach from=$player_gods key=k item=v}
					<option value="{$k}">{$k} - {$v.desc}</option>
					{/foreach}
				    </select>
				</label>
				<a href="#" onclick="createChar();" class="button dark">Crear</a>
			</div>
			<br/><br/><br/><br/>
		</article>
		<article id="charsheet" class="list indented scroll">
			<ul>
				<li class="dark"><a href="#chars-list" onclick="getCharList();" data-router="article" data-title="{$Name}" class="button right">Cambiar personaje</a><strong>Atributos</strong><small>Atributos y nivel del personaje</small></li>
				<li>
					<ul>
						<li id="charinfo"></li>
						<li><img src="/objects/atr_fue.jpg"><small>FUE</small><strong id="fue">0</strong></li> 
						<li><img src="/objects/atr_des.jpg"><small>DES</small><strong id="des">0</strong></li>	
						<li><img src="/objects/atr_con.jpg"><small>CON</small><strong id="con">0</strong></li>
						<li><img src="/objects/atr_int.jpg"><small>INT</small><strong id="int">0</strong></li>
						<li><img src="/objects/atr_sab.jpg"><small>SAB</small><strong id="sab">0</strong></li>	
						<li><img src="/objects/atr_car.jpg"><small>CAR</small><strong id="car">0</strong></li>
					</ul>
				</li>
				<!-- <li><img src="/objects/atr_xp.jpg"><small>PX</small><strong id="xp">0</strong></li> -->					
				<li class="dark"><a href="#" onclick="openShop(currentCharId);" class="button right">Comprar</a><strong>Equipo</strong><small>Equipo especial y dinero del personaje</small></li>
				<li><img src="/objects/atr_gold.jpg"><small>ORO</small><strong id="gold">0</strong></li>
				
				<li>
					<ul id="equip"></ul>
				</li>
				<br/>
				{if $adventures}
				<li class="dark"><strong>Jugar aventura</strong></li>
				<li>
					<ul>	
						{section name=inc loop=$adventures}
						<li class="arrow"><a href="#" onclick="initAdventure({$adventures[inc].first});" data-router="article" data-title="{$adventures[inc].title}"><strong>{$adventures[inc].title}</strong><small>{$adventures[inc].text}</small></a></li>
						{/section}
					</ul>
				</li>	
				{/if}
			</ul>
			<br/><br/><br/><br/>			
		</article>
		<article id="steps" class="{if $session.step}active {/if}list indented scroll">
			<p id="steptext"></p>
			<ul id="next"></ul>
			<ul>
				<li id="endbutton"><a href="#chars-list" onclick="getCharList();" data-router="article" data-title="{$Name}" class="button dark">Terminar</a></li>
				<li id="message"></li>
				<li id="status"></li>				
			</ul>
			<br/><br/><br/><br/>
		</article>
		<article id="shop" class="list indented scroll">
			<ul>
				<li class="dark"><a href="#" onclick="getChar(currentCharId);" class="button right">Salir</a><strong>Comprar</strong><small>Compra y vende objetos mágicos que te ayuden en tus aventuras</small></li>

			</ul><ul id="items"></ul>
			<br/><br/><br/><br/>			
		</article>
		{else}
		<article id="presentation" class="active list indented scroll">
			<ul>
				<li>Crea tu heroe y adentrate en el mundo de espada y magia de Nomariarka.</li>
				<li class="center">
					<small>Logeate con Facebook para poder jugar.</small><br/> <fb:login-button></fb:login-button>
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
				</li>
				{if $adventures}
				<li class="dark"><strong>Aventuras para jugar</strong></li>
				<li>
					<ul>	
						{section name=inc loop=$adventures}
						<li><strong>{$adventures[inc].title}</strong><small>{$adventures[inc].text}</small></li>
						{/section}
					</ul>
				</li>	
				{/if}
			</ul>
		</article>			
		{/if}
		<article id="ranking" class="list indented scroll">
			<ul>
				{section name=inc loop=$rchars}
				<li><img src="/objects/class_{$rchars[inc].charclass}.jpg"><strong>{$rchars[inc].xp} {$rchars[inc].charname}</strong> <small>{$rchars[inc].charclass}/{$rchars[inc].charrace}</small></li>
				{/section}
			</ul>
			<br/><br/><br/><br/>
		</article>
		<article id="legal" class="list indented scroll">
			{include file="inc/legal.tpl"}
			<br/><br/><br/><br/>			
		</article>
		<article id="info" class="list indented scroll">
			{include file="inc/help.tpl"}
			<br/><br/><br/><br/>			
		</article>	
		<footer>
			<nav>
				<a href="#" onclick="moveCurrentSection();" id="footer_home" class="active" data-router="article"><img src="/objects/home.png" /></a>
				<a href="#ranking" data-router="article" data-title="Ranking"><img src="/objects/ranking.png" /></a>
				<a href="#info" data-router="article" data-title="Ayuda"><img src="/objects/info.png" /></a>
				<a href="#legal" data-router="article" data-title="Aviso legal"><img src="/objects/legal.png" /></a>
			</nav>
		</footer>
    </section>
{include file="inc/footer.tpl"}
