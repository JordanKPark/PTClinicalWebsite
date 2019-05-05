<?PHP
    $host='courses';
    $user='cs566102';
    $password='i3JDELtTwe';
    $db='cs566102';

    $conn= new PDO ("mysql:host=$host;dbname=$db",$user,$password);

    try
    {
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e)
    {
    	echo 'ERROR' . $e->getMessage();
    }
?>
