<ul>
	<li>
		<ul>
			<li><strong>Ayuda del juego</strong></li>
			<li>Heroes de Nomariarka es un juego de tipo 'Elige tu propia aventura' con toques de RPG ambientado en el mundo mediaval fantástico de Nomariarka.</li>
		</ul>
	</li>
	<li>
		<ul>
			<li><strong>Creación de personajes</strong></li>
			<li>Para crear un personaje deberás elegir una clase, una raza y el dios al que reza el personaje. Cada elección le da al personaje unos bonos en los diferentes atributos que le definen.</li>
			<li>Clases</li>
			<li>
				<table>
					<thead>
						<tr><td>Clase</td><td>FUE</td><td>DES</td><td>CON</td><td>INT</td><td>SAB</td><td>CAR</td><td>Ataque</td><td>Arma</td></tr>
					</thead>
					<tbody>
                        		{foreach from=$player_classes key=k item=v}
					<tr><td>{$k}</td>
						{foreach from=$v key=k2 item=bonus}
						{if $k2 neq 'charattack'}<td>{$bonus}</td>{/if}
						{/foreach}
					</tr>
					{/foreach}
					</tbody>
				</table>
			</li>
			<li>Razas</li>
			<li>
				<table>
					<thead>
						<tr><td>Raza</td><td>FUE</td><td>DES</td><td>CON</td><td>INT</td><td>SAB</td><td>CAR</td></tr>
					</thead>
					<tbody>
                        		{foreach from=$player_races key=k item=v}
					<tr><td>{$k}</td>
						{foreach from=$v item=bonus}
						<td>{$bonus}</td>
						{/foreach}
					</tr>
					{/foreach}
					</tbody>
				</table>
			</li>
			<li>Dioses</li>
			<li>
				<table>
					<thead>
						<tr><td>Nombre</td><td>FUE</td><td>DES</td><td>CON</td><td>INT</td><td>SAB</td><td>CAR</td><td>Dios de</td></tr>
					</thead>
					<tbody>
                        		{foreach from=$player_gods key=k item=v}
					<tr><td>{$k}</td>
						{foreach from=$v item=bonus}
						<td>{$bonus}</td>
						{/foreach}
					</tr>
					{/foreach}
					</tbody>
				</table>
			</li>
		</ul>
	</li>
	<li>
		<ul>
			<li><strong>Equipo</strong></li>
			<li>Cada heroe tiene una serie de ranuras donde puede colocar equipo que le ayudaran en sus aventuras. Solo puede tenerse un objeto por ranura. El equipo puedes adquirirlo en la tienda con el dinero que ganes en cada aventura. También puedes venderlo a mitad de precio.</li>
			<li>
				<table>
					<thead>
						<tr><td>Ranura</td><td>Tipo de objetos</td></tr>
					</thead>
					<tbody>
						<tr><td>Arma</td><td>Espadas, mazas, hachas, ...</td></tr>
						<tr><td>Armadura</td><td>Armaduras de cueros, corazas, ...</td></tr>
						<tr><td>Cabeza</td><td>Gorros, yelmos, ...</td></tr>
						<tr><td>Cuello</td><td>Colgantes, talismanes, ...</td></tr>
						<tr><td>Espalda</td><td>Capas, sobretodos, ...</td></tr>
						<tr><td>Manos</td><td>Anillos, guanteletes, ...</td></tr>
						<tr><td>Cintura</td><td>Cinturones, fajas, ...</td></tr>
						<tr><td>Piernas</td><td>Botas, sandalias, ...</td></tr>
					</tbody>
				</table>

			</li>
		</ul>
	</li>
	<li>
		<ul>
			<li><strong>Bestiario</strong></li>
			<li>En Nomariarka hay una gran cantidad de enemigos y monstruos que te pondrán las cosas duras. Este es el listado de los más comunes.</li>
			<li>
				<table>
					<thead>
						<tr><td>Bestia</td><td>DEFENSA</td><td>ATAQUE</td><td>MENTE</td><td>PX</td></tr>
					</thead>
					<tbody>
						<tr><td>Goblín</td><td>10</td><td>10</td><td>10</td><td>100</td></tr>
						<tr><td>Lobo</td><td>15</td><td>10</td><td>10</td><td>150</td></tr>
						<tr><td>Jabalí</td><td>15</td><td>15</td><td>10</td><td>200</td></tr>
						<tr><td>Ladrón</td><td>15</td><td>10</td><td>15</td><td>200</td></tr>
						<tr><td>Orco</td><td>20</td><td>15</td><td>15</td><td>250</td></tr>
						<tr><td>Enano</td><td>20</td><td>20</td><td>15</td><td>300</td></tr>
					</tbody>
				</table>

			</li>
		</ul>
	</li>
</ul>
