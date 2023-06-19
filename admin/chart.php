<div class="row mx-auto" style="margin-top: 2%">
	<div class="col-md-12">
		<!-- LINE CHART -->
		<div class="info-box">
			<div class="box-body">
				<div class="chart">
					<canvas id="topSales" style="height:350px; width:100%"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	</div>

	<div class="row mx-auto" style="margin-top: 2%">
	<div class="col-md-6">
		<!-- LINE CHART -->
		<div class="info-box">
			<div class="box-body">
				<div class="chart">
					<canvas id="topSalesWeek" style="height:350px; width:100%"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>

	<div class="col-md-6">
		<!-- LINE CHART -->
		<div class="info-box">
			<div class="box-body">
				<div class="chart">
					<canvas id="topSalesMonth" style="height:350px; width:100%"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	</div>

	<div class="row mx-auto" style="margin-top: 2%">
	<div class="col-md-6">
		<!-- LINE CHART -->
		<div class="info-box">
			<div class="box-body">
				<div class="chart">
					<canvas id="inventoryChart" style="height:350px; width:100%"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
    <div class="col-md-6">
        <!-- STACKED BAR CHART -->
        <div class="info-box">
            <div class="box-body">
                <canvas id="stackedBarChart" style="height:350px; width:100%"></canvas>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<?php
// Assuming you have already established a database connection
// Replace 'your_database_host', 'your_database_name', 'your_username', and 'your_password' with the actual values
$host = 'localhost';
$dbname = 'cscs';
$username = 'root';
$password = '';

// Connect to the database
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Get the current date
$currentDate = date('Y-m-d');

// Calculate the start and end dates of the week
$startDate = date('Y-m-d', strtotime('-6 days', strtotime($currentDate)));
$endDate = $currentDate;

// Prepare the SQL query to retrieve weekly sales
$query = "SELECT DATE(date_created) AS sale_date, SUM(amount) AS total_sales FROM sale_list WHERE DATE(date_created) >= :start_date AND DATE(date_created) <= :end_date GROUP BY DATE(date_created)";

// Prepare and execute the query
$statement = $db->prepare($query);
$statement->bindParam(':start_date', $startDate);
$statement->bindParam(':end_date', $endDate);
$statement->execute();

// Fetch the results
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for the chart
$labels = [];
$datasets = [];

foreach ($results as $row) {
    $labels[] = date('D', strtotime($row['sale_date'])); // Get day of the week abbreviation (e.g., Mon, Tue)
    $datasets[] = [
        'label' => $row['sale_date'],
        'data' => [$row['total_sales']],
        'backgroundColor' => 'rgba(54, 162, 235, 0.5)'
    ];
}

// Generate the JavaScript code to populate and render the chart
$chartData = [
    'labels' => $labels,
    'datasets' => $datasets
];

$chartDataJson = json_encode($chartData);
?>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // JavaScript code to populate and render the chart
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('stackedBarChart').getContext('2d');
        var stackedBarChart = new Chart(ctx, {
            type: 'bar',
            data: <?php echo $chartDataJson; ?>,
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });
    });
</script>


</div>
