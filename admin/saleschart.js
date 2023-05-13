$(function () {
		/* ChartJS
		 * -------
		 * Here we will create a few charts using ChartJS
		 */

		var areaChartOptions = {
		  //Boolean - If we should show the scale at all
		  showScale               : true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines      : false,
		  //String - Colour of the grid lines
		  scaleGridLineColor      : 'rgba(0,0,0,.05)',
		  //Number - Width of the grid lines
		  scaleGridLineWidth      : 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines  : true,
		  //Boolean - Whether the line is curved between points
		  bezierCurve             : true,
		  //Number - Tension of the bezier curve between points
		  bezierCurveTension      : 0.3,
		  //Boolean - Whether to show a dot for each point
		  pointDot                : false,
		  //Number - Radius of each point dot in pixels
		  pointDotRadius          : 4,
		  //Number - Pixel width of point dot stroke
		  pointDotStrokeWidth     : 1,
		  //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		  pointHitDetectionRadius : 20,
		  //Boolean - Whether to show a stroke for datasets
		  datasetStroke           : true,
		  //Number - Pixel width of dataset stroke
		  datasetStrokeWidth      : 2,
		  //Boolean - Whether to fill the dataset with a color
		  datasetFill             : true,
		  //String - A legend template
		  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio     : true,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive              : true
		}

		var barChartOptions                  = {
		  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		  scaleBeginAtZero        : true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines      : true,
		  //String - Colour of the grid lines
		  scaleGridLineColor      : 'rgba(0,0,0,.05)',
		  //Number - Width of the grid lines
		  scaleGridLineWidth      : 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines  : true,
		  //Boolean - If there is a stroke on each bar
		  barShowStroke           : true,
		  //Number - Pixel width of the bar stroke
		  barStrokeWidth          : 2,
		  //Number - Spacing between each of the X value sets
		  barValueSpacing         : 5,
		  //Number - Spacing between data sets within X values
		  barDatasetSpacing       : 1,
		  //String - A legend template
		  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		  //Boolean - whether to make the chart responsive
		  responsive              : true,
		  maintainAspectRatio     : true
		}

		$.post("../classes/gettopsales.php",		
		function (data)
		{
			var products = [];
			var tally = [];
			//var colors = [];
					
			for (var i in data) {						
				products.push(data[i].name);
				tally.push(data[i].TotalSales);
			}		
			
			//colors[0] = '#ff6384';
			//colors[2] = '#36a2eb';
			//colors[1] = '#ffcd56';

			var chartdata = {
				labels: products,
				datasets: [
					{
						label: 'Sales Today',
						type: 'line',
						borderColor: '#009688',
						backgroundColor: '#009688',
						fill: false,
						data: tally
					}
				]
			};
			
			if ($('#topSales') !== undefined && $('#topSales').get(0) !== undefined){
				var lineChartCanvas          = $('#topSales').get(0).getContext('2d');
				var lineChartOptions         = areaChartOptions;
				//alert(lineChartCanvas);
				
				var lineChart = new Chart(lineChartCanvas,{
					type: 'line',
					data: chartdata,
					options: lineChartOptions
				});
				lineChartOptions.datasetFill = false;
			}
		});

		$.post("../classes/getsalesweekly.php",		
		function (data)
		{
			var products = [];
			var tally = [];
			//var colors = [];
					
			for (var i in data) {						
				products.push(data[i].name);
				tally.push(data[i].TotalSales);
			}		
			
			//colors[0] = '#ff6384';
			//colors[2] = '#36a2eb';
			//colors[1] = '#ffcd56';

			var chartdata = {
				labels: products,
				datasets: [
					{
						label: 'Sales This Week',
						type: 'line',
						borderColor: '#009688',
						backgroundColor: '#009688',
						fill: false,
						data: tally
					}
				]
			};
			
			if ($('#topSalesWeek') !== undefined && $('#topSalesWeek').get(0) !== undefined){
				var lineChartCanvas          = $('#topSalesWeek').get(0).getContext('2d');
				var lineChartOptions         = areaChartOptions;
				//alert(lineChartCanvas);
				
				var lineChart = new Chart(lineChartCanvas,{
					type: 'line',
					data: chartdata,
					options: lineChartOptions
				});
				lineChartOptions.datasetFill = false;
			}
		});
		
		$.post("../classes/getsalesmonthly.php",		
		function (data)
		{
			var products = [];
			var tally = [];
			//var colors = [];
					
			for (var i in data) {						
				products.push(data[i].name);
				tally.push(data[i].TotalSales);
			}		
			
			//colors[0] = '#ff6384';
			//colors[2] = '#36a2eb';
			//colors[1] = '#ffcd56';

			var chartdata = {
				labels: products,
				datasets: [
					{
						label: 'Sales This Month',
						type: 'line',
						borderColor: '#009688',
						backgroundColor: '#009688',
						fill: false,
						data: tally
					}
				]
			};
			
			if ($('#topSalesMonth') !== undefined && $('#topSalesMonth').get(0) !== undefined ){
				var lineChartCanvas          = $('#topSalesMonth').get(0).getContext('2d');
				var lineChartOptions         = areaChartOptions;
				//alert(lineChartCanvas);
				
				var lineChart = new Chart(lineChartCanvas,{
					type: 'line',
					data: chartdata,
					options: lineChartOptions
				});
				lineChartOptions.datasetFill = false;
			}
		});
		
		$.post("../classes/getinventory.php",	
		function (data)
		{
			var products = [];
			var tally = [];

			for (let i in data) {	
				products.push(data[i].name);
				tally.push(data[i].TotalStock);
			}		
			
			//colors[0] = '#ff6384';
			//colors[2] = '#36a2eb';
			//colors[1] = '#ffcd56';

			var chartdata = {
				labels: products,
				datasets: [
					{
						label: 'Stocks',
						type: 'line',
						borderColor: '#009688',
						backgroundColor: '#009688',
						fill: false,
						data: tally
					}
				]
			};
			
			if ($('#inventoryChart') !== undefined && $('#inventoryChart').get(0) !== undefined  ){
				var lineChartCanvas          = $('#inventoryChart').get(0).getContext('2d');
				var lineChartOptions         = barChartOptions;
				
				var lineChart = new Chart(lineChartCanvas,{
					type: 'line',
					data: chartdata,
					options: lineChartOptions
				});
				lineChartOptions.datasetFill = false; 
			}
		});

	  })