				$.getJSON("http://localhost/painel/chart/data", function(json){
					$('#container').highcharts({
						title: {
							text: 'Monthly Average Temperature',
							x: -20 //center
						},
						subtitle: {
							text: 'Source: WorldClimate.com',
							x: -20
						},
						xAxis: {
							categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
								'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
						},
						yAxis: {
							title: {
								text: 'Temperature (°C)'
							},
							plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
						},
						tooltip: {
							valueSuffix: '°C'
						},
						legend: {
							layout: 'vertical',
							align: 'right',
							verticalAlign: 'middle',
							borderWidth: 0
						},
						series: json 
						//<?php echo $nomes; ?>
						
						/*$.getJSON("<?php echo base_url(); ?>js/high", function(json){
							options.xAxis.categories = json[0]['data'];
							options.series[0] = json[1];
							options.series[1] = json[2];
							options.series[2] = json[3];
							chart = new Highcharts.Chart(options);
						
						})
						*/
					});
				});