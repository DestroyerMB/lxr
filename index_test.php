<? require_once "sections/head_section.php" ?>

<body>

<div id="maincontainer">

<? require_once "sections/top_section.php" ?>

<div id="contentwrapper">
<div id="contentcolumn">
	<div class="innertube">
		<div id="results" class="text ui-widget-content ui-corner-all">
			
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="margin: 8px; background: #BED994;">
					<h3>&nbsp;&nbsp;5 objects found</h3>
				</div>
			</div>
			
			<div class="results_table">
				<div class="results_row">
					<div class="results_img"><img src="content/1.jpg" width=135 height=90></div>
					<div class="results_cell">
									<h3><a href="ad.php?id=1">Apartments in Luxembourg</a></h3>
									Region: Center, Gare<br>
									Boulevard Dr. Charles Marx, 17<br>
									Published: <span>4 minutes ago</span>
					</div>
					<div class="results_img"><h2>1250 €<h2></div>
				</div>
			</div>
			
			<hr class="results_spacer">
			
			<div class="results_table">
				<div class="results_row">
					<div class="results_img"><img src="content/2.jpg" width=135 height=90></div>
					<div class="results_cell">
									<h3><a href="ad.php?id=2">Nice room in Trier</a></h3>
									Region: Trier<br>
									Masternach strassen, 56<br>
									Published: <span>2 days ago</span>
					</div>
					<div class="results_img"><h2>500 €</h2></div>
				</div>
			</div>
			
			<hr class="results_spacer">
			
			<div class="results_table">
				<div class="results_row">
					<div class="results_img"><img src="content/3.jpg" width=135 height=90></div>
					<div class="results_cell">
									<h3><a href="ad.php?id=3">Apartments near Wormeldange</a></h3>
									Region: Wormeldange, Gemeng<br>
									Route du Vin, 69<br>
									Published: <span>5 days ago</span>
					</div>
					<div class="results_img"><h2>1500 €</h2></div>
				</div>
			</div>
			
			<hr class="results_spacer">
			
			<div class="results_table">
				<div class="results_row">
					<div class="results_img"><img src="content/4.jpg" width=135 height=90></div>
					<div class="results_cell">
									<h3><a href="ad.php?id=4">Shared room in Remich</a></h3>
									Region: Remich<br>
									Route du Fonra Percatore, 117<br>
									Published: <span>6 days ago</span>
					</div>
					<div class="results_img"><h2>1200 €</h2></div>
				</div>
			</div>
			
			<hr class="results_spacer">
			
			<div class="results_table">
				<div class="results_row">
					<div class="results_img"><img src="content/5.jpg" width=135 height=90></div>
					<div class="results_cell">
									<h3><a href="ad.php?id=5">House in Grevenmacher</a></h3>
									Region: Grevenmacher<br>
									Martolen strasse, 6<br>
									Published: <span>9 days ago</span>
					</div>
					<div class="results_img"><h2>1500 €</h2></div>
				</div>
			</div>
			
		</div>
	</div>
</div>
</div>

<div id="leftcolumn">
<div class="innertube">
	<h3>Region</h3>
	<select id="select_region" class="ui-selectmenu ui-widget ui-state-default ui-corner-all ui-selectmenu-dropdown">
		<option>Luxembourg</option>
		<option>Trier</option>
		<option>Wormeldange</option>
		<option>Remich</option>
		<option>Center, Gare</option>
	</select>
	<h3>Type</h3>
	<select id="select_type" class="ui-selectmenu ui-widget ui-state-default ui-corner-all ui-selectmenu-dropdown">
		<option>Apartments</option>
		<option>Room</option>
	</select>
	
	<br><br>
	
	<h3>Options</h3>
	<div class="results_table">
		<div class="results_row">
			<div class="options_cell"><input type="checkbox" id="prop12" value="prop12">Iternet</div>
		</div>
		<div class="results_row">
			<div class="options_cell"><input type="checkbox" id="prop12" value="prop12">Kitchen</div>
		</div>
		<div class="results_row">
			<div class="options_cell"><input type="checkbox" id="prop12" value="prop12">Garage</div>
		</div>
		<div class="results_row">
			<div class="options_cell"><input type="checkbox" id="prop12" value="prop12">Pets allowed</div>
		</div>
	</div>
	
	<br>
	
	<button id="find_button" class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-circle-zoomin"></span><b>&nbsp;&nbsp;&nbsp;&nbsp;Find</b></button>
</div>
</div>

<? require_once "sections/bottom_section.php" ?>

</div>

<!--<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script>

//$( "#selectmenu" ).selectmenu();

</script>-->
</body>
</html>
