<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spovum";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$result = $conn->query("SELECT slno, colB FROM test_spovum");

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoomable Bar Chart</title>
    <!-- Add D3.js library -->
    <script src="https://d3js.org/d3.v5.min.js"></script>
</head>
<body>

<!-- Create a container for the chart -->
<div id="bar-chart-container"></div>

<script>
// Data fetched from the database using PHP
var data = <?php echo json_encode($result->fetch_all(MYSQLI_ASSOC)); ?>;

// Set up the dimensions of the chart
var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 600 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

// Create the SVG container for the chart
var svg = d3.select("#bar-chart-container")
    .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// Set up the scales
var x = d3.scaleBand()
    .range([0, width])
    .padding(0.1)
    .domain(data.map(function(d) { return d.slno; }));

var y = d3.scaleLinear()
    .range([height, 0])
    .domain([0, d3.max(data, function(d) { return d.colB; })]);

// Create bars for each data point
svg.selectAll("rect")
    .data(data)
    .enter().append("rect")
    .attr("x", function(d) { return x(d.slno); })
    .attr("width", x.bandwidth())
    .attr("y", function(d) { return y(d.colB); })
    .attr("height", function(d) { return height - y(d.colB); })
    .style("fill", "steelblue");

// Add axes
svg.append("g")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(x));

svg.append("g")
    .call(d3.axisLeft(y));

// Add zoom behavior
var zoom = d3.zoom()
    .scaleExtent([1, Infinity])
    .translateExtent([[0, 0], [width, height]])
    .extent([[0, 0], [width, height]])
    .on("zoom", zoomed);

svg.call(zoom);

function zoomed() {
    // Update the x-axis based on the zoom scale and translation
    var new_x = d3.event.transform.rescaleX(x);
    svg.select(".x-axis").call(d3.axisBottom(new_x));
    svg.selectAll("rect")
        .attr("x", function(d) { return new_x(d.slno); })
        .attr("width", new_x.bandwidth());
}

</script>

</body>
</html>
