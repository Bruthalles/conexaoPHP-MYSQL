<?php
define('HOST', 'localhost');
define('PORT', '5432');
define('DBNAME', 'cadastro');
define('USER','root');
define('PASSWORD','');

/* primeiro método: erro de drive

$php_inipath = php_ini_loaded_file();

try {
	$dsn = new PDO("pgsql:host=". HOST . ";port=".PORT.";dbname=" . DBNAME .";user=" . USER . ";password=" . PASSWORD);
	$instrucaoSQL = "Select * From aluno";
	$resultSet = $dsn->query($instrucaoSQL);
} catch (PDOException $e) {
	$erro = $e->getMessage();
	echo 'A conexão falhou e retorno a seguinte mensagem de erro: ' .$e->getMessage();
}
*/


$conn = mysqli_connect(HOST, USER, PASSWORD, DBNAME) or die( ' Não foi possível conectar.' );
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

/*inserindo dados no banco

$sql = "INSERT INTO login (nome,senha) VALUES ($nome, $senha)";
if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
*/

//Realizando uma consulta no BD
$instrucaoSQL = "Select nome, senha, id From login";
$stmt = mysqli_prepare($conn, $instrucaoSQL);
mysqli_stmt_bind_result($stmt, $nome, $senha, $id);
mysqli_stmt_execute($stmt);

while (mysqli_stmt_fetch($stmt)) {
	echo $nome . "\t";
	echo $senha . "\t";
    echo $id . "\n";
   
}

//Encerrando a conexão
mysqli_close($conn);


/*este método deu chamada pg_connect não definida

$stringConn = "host=".HOST." dbname=".DBNAME." user=".USER." password=".PASSWORD;
$conn = pg_connect($stringConn) or die( ' Ocorreu um erro e não foi possível conectar ao banco de dados.' );
*/
?>