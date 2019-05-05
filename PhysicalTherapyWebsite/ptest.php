<?PHP
include ("header.html");
require ("conn.php");
include ("navi.html");
echo '<hr>';
echo '<h2> Patient login: </h2>';
#echo '<br>';
echo '<a href="ptest.php">Example Exercises</a>';
echo '<br> <br>';
echo '<form action = "ptest.php" method = "post">';
	echo '<input type = "text" name="username"><br> <br>';
	echo '<input type = "submit" value = "LOGIN">';
    echo '</form><br>';
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$uName = $_POST['username'];

		$sql3 = "SELECT p_name, p_address, p_phone, p_email FROM Patient WHERE p_name ='$uName'";

		$sql = "SELECT date, time, type, p_name, bodypart, t_name FROM Appointment, Patient, Therapist, Exercise WHERE Therapist.tid = Patient.tid AND Appointment.tid = Therapist.tid AND Exercise.pid = Patient.pid AND Patient.tid = Appointment.tid AND Appointment.pid = Exercise.pid having p_name = '$uName'";

		$sql2 = "SELECT date, bodypart, sets, reps, p_name, weight FROM Patient, Appointment, Exercise, Therapist WHERE Appointment.pid = Patient.pid AND Exercise.pid = Patient.pid AND Appointment.aid = Exercise.aid AND Therapist.tid = Patient.tid having p_name = '$uName' ";

		$stmt = $conn->query($sql);
		$row_count = $stmt->rowCount();
if ($row_count != NULL)
{
	echo '<h3> Your Info: </h3>';
        echo '<table border="1"; align="center";>
            <tr bgcolor=#ffc966>
            <th>Name</th>
            <th>Address</th>
            <th>Phone #</th>
            <th>Email</th>
            </tr>';
$bg = '#orange';
	foreach($conn->query($sql3) as $row)
    	{
    		$bg = ($bg == '#ffedcc' ? '#ffdb99' : '#ffedcc');
    		echo '<tr bgcolor="'.$bg.'"><td>';
    		echo $row['p_name'];
    		echo '</td><td>';
    		echo $row['p_address'];
    		echo '</td><td>';
            echo $row['p_phone'];
    		echo '</td><td>';
    		echo $row['p_email'];
    		echo '</td></tr>';
	 }
	echo '</table> <br>';


	echo '<h3> Appointments: </h3>';
        echo '<table border="1"; align="center";>
            <tr bgcolor=#ffc966>
            <th>Date</th>
            <th>Time</th>
            <th>Type</th>
            <th>Patient</th>
            <th>Body Part</th>
            <th>Therapist</th>
            </tr>';
        $bg = '#orange';
    	foreach($conn->query($sql) as $row)
    	{
    		$bg = ($bg == '#ffedcc' ? '#ffdb99' : '#ffedcc');
    		echo '<tr bgcolor="'.$bg.'"><td>';
    		echo $row['date'];
    		echo '</td><td>';
    		echo $row['time'];
    		echo '</td><td>';
            echo $row['type'];
    		echo '</td><td>';
    		echo $row['p_name'];
    		echo '</td><td>';
    		echo $row['bodypart'];
    		echo '</td><td>';
    		echo $row['t_name'];
    		echo '</td></tr>';
	 }
	echo '</table> <br>';

	echo '<h3> Appointment details: </h3>';
	echo '<table border = "1"; align = "center";>
 	     <tr bgcolor=#ffc966>
             <th>Date</th>
             <th>Body Part</th>
             <th>Sets</th>
             <th>Reps</th>
             <th>Weight</th>
	     </tr>';
	$bg = '#orange';
	foreach($conn->query($sql2) as $row)
    	{
    		$bg = ($bg == '#ffedcc' ? '#ffdb99' : '#ffedcc');
    		echo '<tr bgcolor="'.$bg.'"><td>';
    		echo $row['date'];
    		echo '</td><td>';
    		echo $row['bodypart'];
    		echo '</td><td>';
            echo $row['sets'];
    		echo '</td><td>';
    		echo $row['reps'];
    		echo '</td><td>';
    		echo $row['weight'];
    		echo '</td></tr>';
	 }


		
	
}
else
{
			echo "<font color = 'indigo'> No login found for '$uName'. </font>";
}

		 

    }#endserver request

?>
