<?php

// Function to extract data from the text document
function extract_data($file_path) {
    $data = [];
    
    // Extract folder name from the file path
    // $folderName = basename(dirname($file_path));

    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $tokens = preg_split('/\s+/', trim($line));
        if (count($tokens) == 2) {
            $data[] = [
                // 'folderName' => $folderName,
                'colA' => intval($tokens[0]),
                'colB' => intval($tokens[1]),
            ];
        }
    }
    
    return $data;
}

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the uploaded text file
    $textFile = $_FILES['textFile'];
    $textFileName = $textFile['name'];
    $textFilePath = $textFile['tmp_name'];
 
    // Check if the file is a text file
    $fileType = strtolower(pathinfo($textFileName, PATHINFO_EXTENSION));
    if ($fileType != "txt") {
        echo "Sorry, only TXT files are allowed.";
        exit();
    }

    // Process the text file
    $data = extract_data($textFilePath);

    // Insert data into the database
    foreach ($data as $row) {
        // $folderName = $row['folderName'];
        $colA = $row['colA'];
        $colB = $row['colB'];

        // Insert data into the database
        $sql = "INSERT INTO `test_spovum`(`folderName`, `date`, `fileName`, `colA`, `colB`) VALUES  ('20301112_8_20301112_23', '20301110','$textFileName', $colA, $colB)";

        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    }
}

// Close the database connection
$conn->close();
?>
