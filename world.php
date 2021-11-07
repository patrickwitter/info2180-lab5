<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET, 'context', FILTER_SANITIZE_STRING);

$isCountryLookup = $context =='countries';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if($isCountryLookup){
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}
else{
  $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$country%'");
}


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
echo "<thead>";
echo    "<tr>";
if($isCountryLookup){
  echo      "<th>Country Name</th>";
  echo      "<th>Continent</th>";
  echo      "<th>Independence Year</th>";
  echo      "<th>Head of State</th>";
} else {
  echo      "<th>City Name</th>";
  echo      "<th>District</th>";
  echo      "<th>Population</th>";
}
echo    "</tr>";
echo "</thead>";

if($isCountryLookup){
  foreach ($results as $row){
    $name = $row['name'];
    $continent = $row['continent'];
    $independence_year = $row['independence_year'];
    $head_of_state = $row['head_of_state'];
    echo "<tbody>
      <tr>
        <td>$name</td>
        <td>$continent</td>
        <td>$independence_year</td>
        <td>$head_of_state</td>
      </tr>
    </tbody>";
  }
}
else{
  foreach ($results as $row){
    $name = $row['name']; $district = $row['district'];
    $population = $row['population'];
    echo "<tbody>
      <tr>
        <td>$name</td>
        <td>$district</td>
        <td>$population</td>
      </tr>
    </tbody>";
  }
}
echo "</table>";

?>

