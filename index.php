<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "pw3";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->query("DELETE FROM teste;");
$vetor = [["id" => '1', "nome"=>"Arroz"], ["id" => '1', "nome"=>"Feijão"]];

$sql = "INSERT INTO teste (nome)
VALUES ('".json_encode($vetor)."')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$data = [];
$result = $conn->query("SELECT * FROM teste");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = [
            'nome' => json_decode($row['nome'])
        ];
    }
}

foreach($data as $d){
    
    foreach($d['nome'] as $ingrediente){
        print $ingrediente->nome . "<br/>";
    }
    
}
$conn->close();


?>
