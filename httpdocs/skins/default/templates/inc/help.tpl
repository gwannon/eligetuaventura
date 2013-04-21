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
			<li>
				Cada personaje tiene 6 atributos que le definen con un valor númerico. Cada dos puntos por encima de 10 se consigue un +1 a las tiradas relacionadas con ese atributo. Es decir que un heroe con FUE 22, tendrá un +6 a todas las tiradas de Fuerza.
				<ul>
					<li>Fuerza (FUE). Mide tu capacidad para levantar objetos pesados, escalar, saltar, ...</li>
					<li>Destreza (DES). Representa tu habilidad para disparar, esquivar golpes y trampas, ...</li>
					<li>Constitución (CON). Mide tu capacidad para resistir heridas, venenos, enfermedades, frio, ...</li>
					<li>Inteligencia (INT). Determina la capacidad para resolver enigmas y acertijos.</li>
					<li>Sabiduria (SAB). Determina los conocimientos y la percepción del heroe.</li>
					<li>Carisma (CAR). Muestra la capacidad del heroe para convencer, seducir o intimidar a otros personajes, animales y enemigos.</li>
				</ul>
				Para crear un personaje deberás elegir una clase, una raza y el dios al que reza el personaje. Cada elección le da al personaje unos bonos en los diferentes atributos que le definen.
			</li>
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
			<li>
				<table>
					<thead>
						<tr><td>Dios</td><td>FUE</td><td>DES</td><td>CON</td><td>INT</td><td>SAB</td><td>CAR</td><td>Dios de</td></tr>
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
			<li><strong>Experiencia y nivel</strong></li>
			<li>A medida que vaya corriendo aventuras el héroe va consiguiendo y perdiendo puntos de experiencia. Según va consiguiendo experiencia sube de nivel y consigue un bonus a todas sus tiradas.</li>
			<li>
				<table>
					<thead>
						<tr><td>PX</td><td>Nivel</td><td>Bonus</td></tr>
					</thead>
					<tbody>
						<tr>
							<td>0</td>
							<td>1</td>
							<td>0</td>
						</tr>
						{section name=inc loop=$player_levels}
						<tr>
							<td>{$player_levels[inc].px}</td>
							<td>{$player_levels[inc].level}</td>
							<td>+{$player_levels[inc].bonus}</td>
						</tr>
						{/section}
					
					</tbody>
				</table>

			</li>
		</ul>
	</li>
	<li>
		<ul>
			<li><strong>Equipo</strong></li>
			<li>Cada heroe tiene una serie de ranuras donde puede colocar equipo que le ayudara en sus aventuras. Solo puede tenerse un objeto por ranura. El equipo puedes adquirirlo en la tienda con el dinero que ganes en cada aventura. También puedes venderlo a mitad de precio.</li>
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
						<tr><td>Esqueleto</td><td>25</td><td>20</td><td>15</td><td>350</td></tr>
					</tbody>
				</table>

			</li>
		</ul>
	</li>
</ul>
