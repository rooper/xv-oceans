<?php
//GET URL PARAMS
$url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo "<url>".$url."</url>";
$o = (parse_url($url));
//print_r($o);
$params = $o[query];
$url_params = basename($o[path])."?".$params;
//echo $url_params."<br>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>XV:O DASHBOARD</title>
		<link rel="stylesheet" type="text/css" href="dashboard.css" />
		<link rel="stylesheet" href="jquery-ui.css" />
		<script src="jquery-1.8.3.js"></script>
    	<script src="jquery-ui.js"></script>
		
		<script>
			$(function() {
				$( "#menu" ).menu().css('zIndex', 9999);
			});
			
			
			
    	</script>
		<style>
			.ui-menu { width: 150px; font-size:small; }
			.ui-dialog-titlebar { height:10px; } /*display:none;*/
				
			h2 { display:inline; } 
			#title_bar { background-color:#ddd; }
			#dashboard_title
			iframe {
				margin: none;
				padding: none;
				background: blue; /* this is just to make the frames easier to see */
				border: none;
			}
			.nopad {
				padding: 0;
				position:absolute;
				left:-60px;
				top:-10px;
				
			}
		</style>
	</head>
	<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0">
	<div id="title_bar">
		<img src="logo.png" width="40px" style="position:absolute; left:8px; top:-2px;"/>
		<h2> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dashboard</h2> ~ Click <a href="help.php">here</a> for help.
		<hr>
	</div>	
	
	<?php include 'team_data.php'; ?>
		
		<ul id="menu">
			<li><a href="?team=&source=<?php echo $source;?>"><span class=""></span>Clear team</a></li>
			<li><a href="?team=reeners&source=<?php echo $source;?>"><span class="ui-icon ui-icon-extlink"></span>Team 1</a></li>
			<li><a href="?team=huntards&source=<?php echo $source;?>"><span class="ui-icon ui-icon-extlink"></span>Team 2</a></li>
			<li><a href="?team=sandy&source=<?php echo $source;?>"><span class="ui-icon ui-icon-extlink"></span>Team 3</a></li>
			<!--<li class="ui-state-disabled"><a href="?team=godzilla&source=<?php echo $source;?>"><span class="ui-icon ui-icon-extlink"></span>Team 4</a></li>-->
			<hr>
			<li><a href="?team=<?php echo $team;?>&source=<?php echo $_GET['source'];?>">Clear sensors</a></li>
			<li><a href=""><span class="ui-icon ui-icon-plusthick"></span>Add Sensor</a>
				<ul>
					
					<li><a href="<?php echo $url_params?>&sensor_add=int_temp"><span class="ui-icon ui-icon-extlink"></span>Internal Temperature</a></li>
					<li><a href="<?php echo $url_params?>&sensor_add=int_humid"><span class="ui-icon ui-icon-extlink"></span>Internal Humidity</a></li>
					<li><a href="<?php echo $url_params?>&sensor_add=light"><span class="ui-icon ui-icon-extlink"></span>Light Intensity</a></li>
					<li><a href="<?php echo $url_params?>&sensor_add=ext_temp"><span class="ui-icon ui-icon-extlink"></span>External Temperature</a></li>

					
				</ul>
			</li>
			<li><a href=""><span class="ui-icon ui-icon-plusthick"></span>Add Actuator</a>
				<ul>
					
					<li><a href="<?php echo $url_params?>&actuator_add=int_servo"><span class="ui-icon ui-icon-extlink"></span>Internal servo</a></li>
					
					
					
				</ul>
			</li>
			<hr>
			
			<li>
				<a href=""><span class="ui-icon ui-icon-alert"></span>Change Source</a>
				<ul>
					<li><a href="?team=<?php echo $team;?>&source=">No source</a></li>
					<li><a href="?team=<?php echo $team;?>&source=http://localhost/xv/info.html"><span class="ui-icon ui-icon-extlink"></span>Localhost</a></li>
					<li><a href="?team=<?php echo $team;?>&source=http://169.254.63.189"><span class="ui-icon ui-icon-extlink"></span>Arduino 1</a></li>
					
				</ul>
			</li>
		
		</ul>
	</body>
</html>

