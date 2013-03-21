<?php /* Smarty version Smarty-3.1.11, created on 2013-03-21 08:51:38
         compiled from "/var/www/vhosts/eligetuaventura.gwannon.com/httpdocs/templates/inc/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1182829512514a2658bb7501-64601893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e287f857aa643df87f62aee56cb1fbbcadef785' => 
    array (
      0 => '/var/www/vhosts/eligetuaventura.gwannon.com/httpdocs/templates/inc/footer.tpl',
      1 => 1363852296,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1182829512514a2658bb7501-64601893',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_514a2658bea459_64627547',
  'variables' => 
  array (
    'user_profile' => 0,
    'session' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_514a2658bea459_64627547')) {function content_514a2658bea459_64627547($_smarty_tpl) {?>    <!-- Lungo - Dependencies -->
    <script src="components/quojs/quo.js"></script>
    <script src="components/lungo/lungo.js"></script>
    <!-- Lungo - Sandbox App -->
    
	<script>
        Lungo.init({
            name: 'eligetuaventura'
        });
		
		var currentCharId;
		
		<?php if ($_smarty_tpl->tpl_vars['user_profile']->value['id']){?>var currentUserId = <?php echo $_smarty_tpl->tpl_vars['user_profile']->value['id'];?>
;<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['session']->value['step']){?>
		currentCharId = <?php echo $_smarty_tpl->tpl_vars['session']->value['charid'];?>
;
		initAdventure(<?php echo $_smarty_tpl->tpl_vars['session']->value['step'];?>
);
		<?php }?>		
		
		
		function createChar() {
			var url = "http://eligetuaventura.gwannon.com/ajax.php";
			var data = {action: 'createchar', userid: currentUserId, charname: $$("#newname").val(), charclass: $$("#newclass").val(), charrace: $$("#newrace").val()};
			var parseResponse = function(result){
				console.log(result);
				$$("#chars-li").append("<li><a href=\"#\" onclick=\"getChar("+result.id+");\"><strong>"+result.charname+"</strong><small>"+result.charclass+"/"+result.charrace+"</small></a></li>");
			};
			Lungo.Service.json(url, data, parseResponse, "json");
		}
		
		function getChar(charid) {
			Lungo.Router.article("index", "charsheet");
			var url = "http://eligetuaventura.gwannon.com/ajax.php";
			var data = {action: 'getchar', charid: charid};
			var parseResponse = function(result){
				console.log(result);
				Lungo.View.Article.title(result.charname+" ("+result.charclass+"/"+result.charrace+")");	
				currentCharId = result.id;
				$$("#fue").text("FUE "+result.fue);				
				$$("#des").text("DES "+result.des);				
				$$("#con").text("CON "+result.con);				
				$$("#int").text("INT "+result.int);				
				$$("#sab").text("SAB "+result.sab);				
				$$("#car").text("CAR "+result.car);				
				$$("#gold").text("ORO "+result.gold);				
				$$("#xp").text("PX "+result.xp);	
				var equip = "";
				for(var z in result.equip) {
					equip = equip+ "<li>"+z+"</li> ";
				}	
				$$("#equip").prepend(equip);				
			};
			Lungo.Service.json(url, data, parseResponse, "json");
		}
		
		function initAdventure(stepId) {
			Lungo.Router.article("index", "steps");
			var url = "http://eligetuaventura.gwannon.com/ajax.php";
			var data = {action: 'initadv', stepid: stepId, charid: currentCharId, userid: currentUserId};
			var parseResponse = function(result){
				//console.log(result);
				$$("#steptext").empty();			
				$$("#steptext").prepend(result.step);
				Lungo.View.Article.title(result.adv.title);				
				
				var next = "";
				if(result.next.length == 0) {
					$$("#next").style('display', 'none');
					$$("#next").style('visibility', 'hidden');	
					$$("#endbutton").style('display', 'block');
					$$("#endbutton").style('visibility', 'visible');						
				} else {
					$$("#endbutton").style('display', 'none');
					$$("#endbutton").style('visibility', 'hidden');	
					$$("#next").style('display', 'block');
					$$("#next").style('visibility', 'visible');					
					for(var i = 0; i < result.next.length; i++) {
						next = next + "<li><a href=\"#steps\" onclick=\"initAdventure("+result.next[i].id+");\" data-router=\"article\">"+result.next[i].text+"</a></li> ";
					}	
				}

				
				var status = "<ul>";
				status = status + "<li class=\"dark button\">TURNOS: "+result.session.time+"</li> ";
				for(var i = 0; i < result.persons.length; i++) {
					status = status + "<li class=\"dark button\">"+result.persons[i].value+"</li> ";
				}	
				for(var i = 0; i < result.objects.length; i++) {
					status = status + "<li class=\"dark button\">"+result.objects[i].value+"</li> ";
				}	
				for(var i = 0; i < result.status.length; i++) {
					status = status + "<li class=\"dark button\">"+result.status[i].value+"</li> ";
				}	
				status = status + "</ul>";
				
				$$("#status").empty();
				$$("#status").prepend(status);	
				$$("#next").empty()
				$$("#next").prepend(next);
		
				if (result.message != null) {
					$$("#message").empty();	
					$$("#message").prepend(result.message);	
					$$("#message").style('display', 'block');
					$$("#message").style('visibility', 'visible');					
				} else {
					$$("#message").empty();
					$$("#message").style('display', 'none');
					$$("#message").style('visibility', 'hidden');				
				}
				
			};
			Lungo.Service.json(url, data, parseResponse, "json");			
		}
		
		function openShop(charid) {
			Lungo.Router.article("index", "shop");
			var url = "http://eligetuaventura.gwannon.com/ajax.php";
			var data = {action: 'shop', charid: charid};
			var parseResponse = function(result){
				console.log(result);
				$$("#items").empty();
				Lungo.View.Article.title("Tienda");	
				var items = "";
				for(var i = 0; i < result.length; i++) {
					if (result[i].status == 'nogold') items = items + "<li><a href=\"#\" class=\"right button dark\">Sin dinero ("+result[i].gold+")</a><strong>"+result[i].name+"</strong><small>"+result[i].bonus+"</small></li>";
					else if (result[i].status == 'bought') items = items + "<li><a href=\"#\" class=\"right button dark\">Comprado ("+result[i].gold+")</a><strong>"+result[i].name+"</strong><small>"+result[i].bonus+"</small></li>";
					else if (result[i].status == 'buy') items = items + "<li><a href=\"#\" onclick= \"buyItem (currentCharId, '"+result[i].id+"')\" class=\"right button dark\">Comprar("+result[i].gold+")</a><strong>"+result[i].name+"</strong><small>"+result[i].bonus+"</small></li>";
				}
				$$("#items").prepend(items);					
			};
			Lungo.Service.json(url, data, parseResponse, "json");
		}	
			
		function buyItem (charid, itemid) {
			var url = "http://eligetuaventura.gwannon.com/ajax.php";
			var data = {action: 'buy', charid: charid, item: itemid};
			var parseResponse = function(result){
				console.log(result);
				openShop(charid);	
			};
			Lungo.Service.json(url, data, parseResponse, "json");		
		}
		
    </script>
	
</body>
</html><?php }} ?>