]<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Availability</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include ChartJS library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>
    <div class="container-fluid mt-3">
        <h2 class="text-center">Website Availability</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <?php
                    // Array of websites to check
                    $websites = array(
    "https://www.schelps.com.ng",
    "https://www.fppschools.com.ng",
    "https://www.dwatschools.com.ng",
    "https://www.firsthonourschools.com.ng",
    "https://www.eminentkidsschool.com",
    "https://www.eforbnigeria.com",
    "https://www.cruncheconometrix.com",
    "https://www.temperance.sch.ng",
    "https://www.valuecrestschools.com.ng",
    "https://www.rebic.org.ng",
    "https://www.rabbischools.com.ng",
    "https://www.stjohnsschools.com.ng",
    "http://brighterschools.com.ng/learnable",
    "http://peculiargiftschools.com.ng/learnable"
);
                    // Initialize variables
                    $results = array();
                    $response_times = array();
                    $chart_labels = array();
                    $chart_data = array();
                    // Loop through each website
                    foreach ($websites as $website) {
                        $start_time = microtime(true);
                        // Check if website is reachable
                        $ch = curl_init($website);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                        $response = curl_exec($ch);
                        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        $total_time = microtime(true) - $start_time;
                        curl_close($ch);
                        // Store result in array
                        $result = array(
                            "website" => $website,
                            "http_code" => $http_code,
                            "response_time" => $total_time
                        );
                        array_push($results, $result);
                        array_push($response_times, $total_time);
                        array_push($chart_labels, $website);
                        array_push($chart_data, $total_time);
                    }
                    // Sort results by response time in ascending order
                    usort($results, function($a, $b) {
                        return $a['response_time'] <=> $b['response_time'];
                    });
                    // Output results in a table
                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr><th>Website</th><th>HTTP Code</th><th>Response Time (seconds)</th></tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($results as $result) {
                        echo '<tr>';
                        echo '<td>' . $result['website'] . '</td>';
                        echo '<td>' . $result['http_code'] . '</td>';
                        echo '<td>' . number_format($result['response_time'], 4) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    // Create a bar chart of response times
                    echo '<canvas id="response-times-chart" style="height:400px; width:100%;"></canvas>';
                ?>
            </div>
        </div>
    </div>
    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
            integrity="sha384-DUw8/5h5ryUJ/6vam2aqN/kDdUkclGTxrHwbwvPz7R+lfxb4XV7Q/+t4q3tw7CX1"
            crossorigin="anonymous"></script>
            
    <script>
    // Initialize chart data
    var chartData = {
        labels: <?php echo json_encode($chart_labels); ?>,
        datasets: [{
            label: 'Response Times (seconds)',
            data: <?php echo json_encode($chart_data); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };
    // Create bar chart
    var ctx = document.getElementById('response-times-chart');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

    </body>
</html>
