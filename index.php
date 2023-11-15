$servername = "localhost";
$username ="Joshi"
$password  ="1234"
$dbname ="dummdb"

try {
    $conn = new PDO("mysqlhost=$servername;$dbname",$username,$password);
    //set the PDO error made to exceptionm 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<br>" . "Connected succesfully";
    $val_personID ="7001";
    $val_firstname = "John";
    $val_middle= "JD";
    $val_lastname ="Doe";
    $val_dateofbirth = "2007-04-06";
    $stmt = $conn->exec("INSERT INTO person (PersonID, FirstName, MiddleInitial, LastName, dateofbirth) VALUES
    (".$val_personID.",'".$val_firstname."','".$val_middle.'",'".$val_lastname."','"$val_dateofbirth."')");
    echo "New Record created successfully by SQL";
}catch(PDOException $e) {echo "error: " . $e->getMessage();
}
$conn = null;