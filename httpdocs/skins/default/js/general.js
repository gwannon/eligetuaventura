

function buyItem (charid, itemid) {
	var url = "/ajax.php";
	var data = {action: 'buy', charid: charid, item: itemid};
	var parseResponse = function(result){
		console.log(result);
		openShop(charid);	
	};
	Lungo.Service.json(url, data, parseResponse, "json");		
}
function sellItem (charid, itemid) {
	var url = "/ajax.php";
	var data = {action: 'sell', charid: charid, item: itemid};
	var parseResponse = function(result){
		console.log(result);
		openShop(charid);	
	};
	Lungo.Service.json(url, data, parseResponse, "json");		
}
function getCharList() {
	Lungo.Router.article("index", "chars-list");
	currentSection = 'chars-list';
	$$('#footer_home').addClass('active');
}
function moveCurrentSection() {
	Lungo.Router.article("index", currentSection);
	$$('#footer_home').addClass('active');
	Lungo.View.Article.title(currentSectionTitle);
}

	function createChar() {
		var url = "/ajax.php";
		if ($$("#newname").val() != '') {
			var data = {action: 'createchar', userid: currentUserId, charname: $$("#newname").val(), charclass: $$("#newclass").val(), charrace: $$("#newrace").val(), chargod: $$("#newgod").val()};
			var parseResponse = function(result){
				console.log(result);
				$$("#chars-li").append("<li><img src=\""+skinDir+"/objects/class_"+result.charclass+".jpg\"><a href=\"#\" onclick=\"getChar("+result.id+");\"><strong>"+result.charname+"</strong><small>"+result.charclass+"/"+result.charrace+"</small></a></li>");
				/*document.location.href ='https://www.facebook.com/dialog/feed?app_id=75982369444&link=https://apps.facebook.com/heroesdenomariarka/&picture=http://heroesdenomariarka.com/skins/default/objects/class_Caballero.jpg&name=Heroes%20de%20Nomariarka&caption=Elige%20tu%20propia%20aventura&description=Ha%20creado%20un%20personaje%20en%20Heroes%20de%20Nomariarka&redirect_uri=https://apps.facebook.com/heroesdenomariarka/';*/
			};
			Lungo.Service.json(url, data, parseResponse, "json");
		}
	}
	
	function getChar(charid) {
		Lungo.Router.article("index", "charsheet");
		currentSection = 'charsheet';
		$$('#footer_home').addClass('active');
		var url = "/ajax.php";
		var data = {action: 'getchar', charid: charid};
		var parseResponse = function(result){
			console.log(result);
			Lungo.View.Article.title(result.charname);	
			currentCharId = result.id;
			$$("#charinfo").empty();
			$$("#charinfo").append("<img src=\""+skinDir+"/objects/class_"+result.charclass+".jpg\"><strong>"+result.charclass+"/"+result.charrace+"/Reza a "+result.god+"</strong><small>XP: "+result.xp+"</small>");
			$$("#fue").text(result.fue);				
			$$("#des").text(result.des);				
			$$("#con").text(result.con);				
			$$("#int").text(result.int);				
			$$("#sab").text(result.sab);				
			$$("#car").text(result.car);	
			$$("#gold").text(result.gold);				
			/*$$("#xp").text(result.xp);*/	
			var equip = "";
			for(var i = 0; i < result.equip.length; i++) {
				equip = equip+ "<li><img src=\""+skinDir+"/objects/object_"+result.equip[i].id+".jpg\"><strong>"+result.equip[i].name+"</strong><small>"+result.equip[i].bonus+" "+result.equip[i].slot+"</small></li> ";
			}	
			$$("#equip").empty();
			$$("#equip").prepend(equip);				
		};
		Lungo.Service.json(url, data, parseResponse, "json");
		
	}
	
	function initAdventure(stepId) {
		Lungo.Router.article("index", "steps");
		currentSection = 'steps';
		$$('#footer_home').addClass('active');
		var url = "/ajax.php";
		var data = {action: 'initadv', stepid: stepId, charid: currentCharId, userid: currentUserId};
		var parseResponse = function(result){
			console.log(result);
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
					next = next + "<li class=\"arrow\"><img src=\""+skinDir+"/objects/step_"+result.next[i].type+".jpg\"><a href=\"#steps\" onclick=\"initAdventure("+result.next[i].id+");\" data-router=\"article\">"+result.next[i].text+"</a></br></li> ";
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
		currentSection = 'shop';
		$$('#footer_home').addClass('active');
		var url = "/ajax.php";
		var data = {action: 'shop', charid: charid};
		var parseResponse = function(result){
			console.log(result);
			$$("#items").empty();
			Lungo.View.Article.title("Tienda");	
			var items = "";
			var slot = '';
			for(var i = 0; i < result.length; i++) {
				if (result[i].slot != slot && slot != '') {
											
					items = items + "</ul></li>";
				}
				if (result[i].slot != slot) {
					items = items + "<li><strong>"+result[i].slot+"</strong><ul>";
					slot = result[i].slot;
				} 
				if (result[i].status == 'noslot') items = items + "<li><img src=\""+skinDir+"/objects/object_"+result[i].id+".jpg\"><a href=\"#\" class=\"right button cancel\">Ranura ocupada ("+result[i].gold+")</a><strong>"+result[i].name+"</strong><small>"+result[i].bonus+" "+result[i].slot+"</small></li>";
				else if (result[i].status == 'nogold') items = items + "<li><img src=\""+skinDir+"/objects/object_"+result[i].id+".jpg\"><a href=\"#\" class=\"right button dark\">Sin dinero ("+result[i].gold+")</a><strong>"+result[i].name+"</strong><small>"+result[i].bonus+" "+result[i].slot+"</small></li>";
				else if (result[i].status == 'bought') items = items + "<li><img src=\""+skinDir+"/objects/object_"+result[i].id+".jpg\"><a href=\"#\" onclick= \"sellItem (currentCharId, '"+result[i].id+"')\" class=\"right button theme\">Vender ("+result[i].gold+")</a><strong>"+result[i].name+"</strong><small>"+result[i].bonus+" "+result[i].slot+"</small></li>";
				else if (result[i].status == 'buy') items = items + "<li><img src=\""+skinDir+"/objects/object_"+result[i].id+".jpg\"><a href=\"#\" onclick= \"buyItem (currentCharId, '"+result[i].id+"')\" class=\"right button accept\">Comprar ("+result[i].gold+")</a><strong>"+result[i].name+"</strong><small>"+result[i].bonus+" "+result[i].slot+"</small></li>";


				 
			}
			$$("#items").prepend(items);					
		};
		Lungo.Service.json(url, data, parseResponse, "json");
	}	
