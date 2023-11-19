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
$result = $conn->query("SELECT date, AVG(colA) as avgColA FROM test_spovum GROUP BY date");

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
<div id="zoomable-bar-chart-container"></div>

<script>
// Data fetched from the database using PHP
var data = <?php echo json_encode($result->fetch_all(MYSQLI_ASSOC)); ?>;

// Set up the dimensions of the chart
var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 600 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

// Parse the date string to a JavaScript Date object
var parseDate = d3.timeParse("%Y-%m-%d");

// Set up the scales
var x = d3.scaleTime()
    .range([0, width])
    .domain(d3.extent(data, function(d) { return parseDate(d.date); }));

var y = d3.scaleLinear()
    .range([height, 0])
    .domain([0, d3.max(data, function(d) { return d.avgColA; })]);

// Create the SVG container for the chart
var svg = d3.select("#zoomable-bar-chart-container")
    .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// Create the bars for avgColA
svg.selectAll(".bar")
    .data(data)
    .enter().append("rect")
    .attr("class", "bar")
    .attr("x", function(d) { return x(parseDate(d.date)); })
    .attr("width", width / data.length)
    .attr("y", function(d) { return y(d.avgColA); })
    .attr("height", function(d) { return height - y(d.avgColA); })
    .style("fill", "steelblue");

// Add axes
svg.append("g")
    .attr("class", "x-axis")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(x));

svg.append("g")
    .call(d3.axisLeft(y));

// Add zoom behavior
var zoom = d3.zoom()
    .scaleExtent([1, 8])
    .on("zoom", zoomed);

svg.call(zoom);

function zoomed() {
    // Update the x-axis scale during zoom
    x.range([0, width].map(d => d3.event.transform.applyX(d)));

    // Update the bars
    svg.selectAll(".bar")
        .attr("x", function(d) { return x(parseDate(d.date)); })
        .attr("width", width / data.length);
    
    // Update the x-axis
    svg.select(".x-axis").call(d3.axisBottom(x));
}
</script>

</body>
</html>
