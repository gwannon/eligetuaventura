	<!-- Lungo - Dependencies -->
	<script src="/components/quojs/quo.js"></script>
	<script src="/components/lungo/lungo.js"></script>
	<script src="/skins/{$Skin}/js/general.js"></script>
	<!-- Lungo - Sandbox App -->
	<script>
	Lungo.init({
		name: '{$Name}'
	});
	var skinDir = '/skins/{$Skin}';
	var currentCharId;
	{if $user}var currentSection = 'chars-list';{else}var currentSection = 'presentation';{/if}
	var currentSectionTitle = '{$Name}';		
	{if $user_profile.id}var currentUserId = {$user_profile.id};{/if}
	{if $session.step}
	currentCharId = {$session.charid};
	initAdventure({$session.step});
	{/if}		
	</script>
</body>
</html>
