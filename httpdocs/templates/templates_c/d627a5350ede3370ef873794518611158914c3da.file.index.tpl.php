<?php /* Smarty version Smarty-3.1.11, created on 2013-03-21 08:30:03
         compiled from "/var/www/vhosts/eligetuaventura.gwannon.com/httpdocs/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2054218937514a2658a97c94-47018975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd627a5350ede3370ef873794518611158914c3da' => 
    array (
      0 => '/var/www/vhosts/eligetuaventura.gwannon.com/httpdocs/templates/index.tpl',
      1 => 1363851001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2054218937514a2658a97c94-47018975',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_514a2658ba85e0_95927113',
  'variables' => 
  array (
    'user' => 0,
    'logout_url' => 0,
    'facebook' => 0,
    'session' => 0,
    'chars' => 0,
    'adventures' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_514a2658ba85e0_95927113')) {function content_514a2658ba85e0_95927113($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("inc/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <section id="index">
        <header data-title="Elige tu aventura">
			<nav class="right">
			<?php if ($_smarty_tpl->tpl_vars['user']->value){?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['logout_url']->value;?>
" data-icon="close" class="button"></a>
			<?php }else{ ?>
				<fb:login-button></fb:login-button>
				<div id="fb-root"></div>
				<script>
				  window.fbAsyncInit = function() {
					FB.init({
					  appId: '<?php echo $_smarty_tpl->tpl_vars['facebook']->value->getAppID();?>
',
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
			<?php }?>
			</nav>
		</header>
		<?php if ($_smarty_tpl->tpl_vars['user']->value){?>		
		<article id="chars-list" class="<?php if (!$_smarty_tpl->tpl_vars['session']->value['step']){?>active <?php }?>list indented scroll">
			<ul id="chars-li">
				<li class="dark"><strong>Personajes</strong></li>
			<?php if ($_smarty_tpl->tpl_vars['chars']->value){?>
				
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['inc'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['name'] = 'inc';
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['chars']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total']);
?>
				<li><a href="#" onclick="getChar('<?php echo $_smarty_tpl->tpl_vars['chars']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['id'];?>
');"><strong><?php echo $_smarty_tpl->tpl_vars['chars']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['charname'];?>
</strong><small><?php echo $_smarty_tpl->tpl_vars['chars']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['charclass'];?>
/<?php echo $_smarty_tpl->tpl_vars['chars']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['charrace'];?>
</small></a></li>
				<?php endfor; endif; ?>
			<?php }?>
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
				<?php if ($_smarty_tpl->tpl_vars['adventures']->value){?>
				<li class="dark"><strong>Jugar aventura</strong></li>
				<li>
					<ul>	
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['inc'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['name'] = 'inc';
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['adventures']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['inc']['total']);
?>
						<li><a href="#" onclick="initAdventure(<?php echo $_smarty_tpl->tpl_vars['adventures']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['first'];?>
);" data-router="article" data-title="<?php echo $_smarty_tpl->tpl_vars['adventures']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['title'];?>
"><strong><?php echo $_smarty_tpl->tpl_vars['adventures']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['title'];?>
</strong><small><?php echo $_smarty_tpl->tpl_vars['adventures']->value[$_smarty_tpl->getVariable('smarty')->value['section']['inc']['index']]['text'];?>
</small></a></li>
						<?php endfor; endif; ?>
					</ul>
				</li>	
				<?php }?>
			</ul>
		</article>
		<article id="steps" class="<?php if ($_smarty_tpl->tpl_vars['session']->value['step']){?>active <?php }?>list indented scroll">
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
		<?php }?>
    </section>
<?php echo $_smarty_tpl->getSubTemplate ("inc/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>