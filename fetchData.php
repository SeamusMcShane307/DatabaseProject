<?php 
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "card_db"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
} 
 
// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $db->query("SELECT Name FROM cards WHERE Name LIKE '%".$searchTerm."%' ORDER BY Name ASC"); 
 
// Generate array with skills data 
$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        #$data['id'] = $row['id']; 
        $data['value'] = $row['Name']; 
        array_push($skillData, $data);
        if(count($skillData)>=5){
            break;
        } 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($skillData); 
?>