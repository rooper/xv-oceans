<!-- USAGE
call the url with the following attributes:
sensor = (int)
source = (string)
name = (string)
eg. graph_canvas.php?sensor=0&source=http://localhost/xv/info.html&name=light(lux)
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
    Data reference </title>
    <link rel="stylesheet" type="text/css" href="jquery.jqChart.css" />
    <link rel="stylesheet" type="text/css" href="jquery.jqRangeSlider.css" />
    <link rel="stylesheet" type="text/css" href="jquery-ui-1.8.20.css" />
    <script src="jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="jquery.jqChart.min.js" type="text/javascript"></script>
    <script src="jquery.jqRangeSlider.min.js" type="text/javascript"></script>
    
     <style>
    	#float { position:absolute; z-index:9999; }
    	
    </style>
	<script>
	 $(document).ready(function () {
			var data = [];
			data = window.JSON.parse("<?php echo $_POST['data']; ?>");
			//alert("<?php echo $_POST['data']; ?>");
            var background = {
                type: 'linearGradient',
                x0: 0,
                y0: 0,
                x1: 0,
                y1: 1,
                colorStops: [{ offset: 0, color: '#d2e6c9' },
                             { offset: 1, color: 'white'}]
            };

	$('#jqChart').jqChart({
                title: 'data reference',
                legend: { visible: false },
                border: { strokeStyle: '#6ba851' },
                background: background,
                animation: { duration: 2 },
                tooltips: { type: 'shared' },
                crosshairs: {
                    enabled: true,
                    hLine: false,
                    vLine: { strokeStyle: '#cc0a0c' }
                },
                axes: [
                        {
                            type: 'index',
                            location: 'bottom',
                            zoomEnabled: true
                        }
                      ],
                series: [
                            {
                                title: 'main',
                                type: 'area',
                                data: data,
                                markers: null
                            }
                           
                        ]
            });


            
        });
    </script>

</head>
<body>

        <div id="jqChart" style="width: 500px; height: 300px;">
        </div>

<?php
//echo $_POST['data'];
?>

</body>
</html>
