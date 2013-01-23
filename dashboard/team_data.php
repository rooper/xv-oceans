		<?php
		$source = $_GET['source'];
		$team = $_GET['team'];
		if ($team == 'reeners') { 
					//someday it might be a good idea to refactor into this:
					//$url = "dashboard.php?team=reeners&source=&actuator_add=int_servo";	
					//echo "window.location.href = '".$url."'";
					
					echo '
						<div class="nopad" id="sensor'.$sensor_id.'" style="overflow:hidden; display:none;">
							<iframe src="module_control.php?actuate=0&source='.$source.'&name=internal servo&range_low=0&range_high=180" frameBorder="0" height="100%" width="100%" ></iframe>
						</div>
						<script>
						  $(document).ready(function() {
							$("#sensor'.$sensor_id.'").show();
							$("#sensor'.$sensor_id.'").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [300,200]  });
						 	
						  });
						</script>
					
						';
						$sensor_id = rand();
						echo '
						<div class="nopad" id="sensor'.$sensor_id.'" style="overflow:hidden; display:none;">
							<iframe src="graph_canvas.php?sensor=2&source='.$source.'&name=light intensity" frameBorder="0" height="100%" width="100%" ></iframe>
						</div>
						<script>
						  $(document).ready(function() {
							$("#sensor'.$sensor_id.'").show();
							$("#sensor'.$sensor_id.'").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [100,200]  });
						  });
						</script>
						';
		}
		if ($team == 'huntards') { echo '
		<div class="nopad" id="sensor0" style="overflow:hidden; display:none;">
			<iframe src="graph_canvas.php?sensor=0&source='.$source.'&name=internal temperature" frameBorder="0" height="100%" width="100%" ></iframe>
		</div>
		<div class="nopad" id="sensor1" style="overflow:hidden; display:none;">
			<iframe src="graph_canvas.php?sensor=1&source='.$source.'&name=external temperature" frameBorder="0" height="100%" width="100%" ></iframe>
		</div>
		
			<script>
		  $(document).ready(function() {
			$("#sensor0").show();
			$("#sensor0").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [100,200]  });
			$("#sensor1").show();
			$("#sensor1").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [200,200]  });
			
		  });
		</script>
		';}
		if ($team == 'sandy') { echo '
		<div class="nopad" id="sensor0" style="overflow:hidden; display:none;">
			<iframe src="graph_canvas.php?sensor=2&source='.$source.'&name=light intensity" frameBorder="0" height="100%" width="100%" ></iframe>
		</div>

			<script>
		  $(document).ready(function() {
			$("#sensor0").show();
			$("#sensor0").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [300,200]  });
	
		  });
		</script>
		';
		}
		//add all the requested sensors and actuators
		//pull all the GET information from the URL
		$query  = explode('&', $params);
		$paramz = array();
		foreach( $query as $param )
		{
		  list($name, $value) = explode('=', $param);
		  $paramz[urldecode($name)][] = urldecode($value);
		}
		
		//iterate through the sensor array
		if (!empty($paramz[sensor_add])) {
			foreach ($paramz[sensor_add] as $key => $value) {
				//echo $value."<br>";
				//echo the Jquery for the requested widget
				switch ($value) {
					case "int_temp":
						$sensor_id = rand();
						echo '
						<div class="nopad" id="sensor'.$sensor_id.'" style="overflow:hidden; display:none;">
							<iframe src="graph_canvas.php?sensor=0&source='.$source.'&name=internal temperature" frameBorder="0" height="100%" width="100%" ></iframe>
						</div>
						<script>
						  $(document).ready(function() {
							$("#sensor'.$sensor_id.'").show();
							$("#sensor'.$sensor_id.'").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [100,200]  });
						  });
						</script>
						';
						break;
					case "int_humid":
						$sensor_id = rand();
						echo '
						<div class="nopad" id="sensor'.$sensor_id.'" style="overflow:hidden; display:none;">
							<iframe src="graph_canvas.php?sensor=1&source='.$source.'&name=internal humidity" frameBorder="0" height="100%" width="100%" ></iframe>
						</div>
						<script>
						  $(document).ready(function() {
							$("#sensor'.$sensor_id.'").show();
							$("#sensor'.$sensor_id.'").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [100,200]  });
						  });
						</script>
						';
						break;
					case "light":
						$sensor_id = rand();
						echo '
						<div class="nopad" id="sensor'.$sensor_id.'" style="overflow:hidden; display:none;">
							<iframe src="graph_canvas.php?sensor=2&source='.$source.'&name=light intensity" frameBorder="0" height="100%" width="100%" ></iframe>
						</div>
						<script>
						  $(document).ready(function() {
							$("#sensor'.$sensor_id.'").show();
							$("#sensor'.$sensor_id.'").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [100,200]  });
						  });
						</script>
						';
						break;
					case "ext_temp":
						$sensor_id = rand();
						echo '
						<div class="nopad" id="sensor'.$sensor_id.'" style="overflow:hidden; display:none;">
							<iframe src="graph_canvas.php?sensor=3&source='.$source.'&name=external temperature" frameBorder="0" height="100%" width="100%" ></iframe>
						</div>
						<script>
						  $(document).ready(function() {
							$("#sensor'.$sensor_id.'").show();
							$("#sensor'.$sensor_id.'").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [100,200]  });
						  });
						</script>
						';
						break;
					default:
						break;
				}
				
				
			}
		}
		//iterate through the actuator array
		if (!empty($paramz[actuator_add])) {
			foreach ($paramz[actuator_add] as $key => $value) {
				//echo $value."<br>";
				//echo the Jquery for the requested widget
				switch ($value) {
					case "int_servo":
						$sensor_id = rand();
						echo '
						<div class="nopad" id="sensor'.$sensor_id.'" style="overflow:hidden; display:none;">
							<iframe src="module_control.php?actuate=0&source='.$source.'&name=internal servo&range_low=0&range_high=180" frameBorder="0" height="100%" width="100%" ></iframe>
							
						</div>
						<script>
						  $(document).ready(function() {
							$("#sensor'.$sensor_id.'").show();
							$("#sensor'.$sensor_id.'").dialog({ closeOnEscape: true, height: 350, width: 550, title: "",  position: [100,200]  });
						 	
						  });
						</script>
					
						';
						
						break;
					default:
						break;
				}
				
				
			}
		}
		?>