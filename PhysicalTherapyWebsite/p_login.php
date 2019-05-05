<?PHP
include ("header.html");
require ("conn.php");
include ("navi.html");
echo '<hr>';
echo '<h2> Patient login: </h2>';
#echo '<br>';
echo '<a href="patient.php">Example Exercises</a>';
echo '<br> <br>';
echo '<form action = "p_login.php" method = "post">';
	echo '<input type = "text" name="username"><br> <br>';
	echo '<input type = "submit" value = "LOGIN">';
    echo '</form><br>';
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$uName = $_POST['username'];
		$sql = "SELECT date, time, type, p_name, bodypart, t_name FROM Appointment, Patient, Therapist, Exercise WHERE Therapist.tid = Patient.tid AND Appointment.tid = Therapist.tid AND Exercise.pid = Patient.pid AND Patient.tid = Appointment.tid AND Appointment.pid = Exercise.pid having p_name = '$uName'";
		$stmt = $conn->query($sql);
		$row_count = $stmt->rowCount();
		if ($row_count != NULL)
		{
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
	echo '</table>';
		}
		else
		{
			echo "<font color = 'indigo'> No login found for '$uName'. </font>";
		}
    }

?>
