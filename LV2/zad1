<?php
// Postavljanje podataka za prijavu u bazu podataka
$servername = "localhost";
$username = "korisnik";
$password = "lozinka";
$dbname = "imeBazePodataka";

// Stvaranje veze s bazom podataka
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera veze s bazom podataka
if ($conn->connect_error) {
  die("Povezivanje nije uspjelo: " . $conn->connect_error);
}

// Dohvaćanje imena svih tablica u bazi podataka
$tables = array();
$result = $conn->query('SHOW TABLES');
while($row = $result->fetch_array(MYSQLI_NUM)) {
  $tables[] = $row[0];
}

// Izrada sigurnosne kopije za svaku tablicu
foreach($tables as $table) {
  // Dohvaćanje strukture tablice
  $result = $conn->query('SHOW CREATE TABLE '.$table);
  $row = $result->fetch_array(MYSQLI_NUM);
  $create_table_query = $row[1];

  // Dohvaćanje podataka iz tablice
  $result = $conn->query('SELECT * FROM '.$table);
  $rows = array();
  while($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }

  // Izrada naredbe INSERT za svaki redak u tablici
  $insert_rows_queries = array();
  foreach ($rows as $row) {
    $columns = array();
    $values = array();
    foreach ($row as $key => $value) {
      $columns[] = "`" . $key . "`";
      $values[] = "'" . $conn->real_escape_string($value) . "'";
    }
    $insert_rows_queries[] = "INSERT INTO `" . $table . "` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";
  }

  // Spremanje strukture i podataka u .txt datoteku
  $filename = 'backup_' . $table . '_' . date('Ymd_His') . '.txt';
  $file = fopen($filename, 'w');
  fwrite($file, "-- Struktura tablice " . $table . "\n");
  fwrite($file, $create_table_query . ";\n\n");
  fwrite($file, "-- Podaci za tablicu " . $table . "\n");
  foreach ($insert_rows_queries as $insert_query) {
    fwrite($file, $insert_query . ";\n");
  }
  fclose($file);
}

// Zatvaranje veze s bazom podataka
$conn->close();

echo "Sigurnosna kopija je uspješno izrađena.";
?>
