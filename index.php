<?php include_once("config.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Hackathon</title>
	</head>
	<body>
<?php


class workingClass {
    
    public function constructor($name, $user_id, $clocktimes, $payrate, $weeklyHours, $salary) {
        $this->EmployeName = $name;
        $this->userId = $user_id;
        $this->clocktimes = $clocktimes;
        $this->payrate = $payrate;
        $this->hours = $weeklyHours;
        $this->salary = $salary;
    }

    public function generate_SQL_str() {
        $SQLString .= $this->EmployeeName;
        $SQLString .= $this->userId;
        $SQLString .= (string) $this->clocktimes;//Could be interesting to try and add to a string
        $SQLString .= $this->payrate;
        $SQLString .= $this->hours;
        $SQLString .= $this->salary;
        
        return $SQLString;
    }
}


function incomeRatios() {
    $lowQ = "SELECT * FROM `employee` WHERE hourly_rate < 15";
    $low = mysql_query($lowQ);
    $lowCount = count($low);

    $middleQ = "SELECT * FROM `employee` WHERE hourly_rate > 15 AND hourly_rate < 25";
    $middle = mysql_query($middleQ);
    $middleCount = count($middle);

    $highQ = "SELECT * FROM `employee` WHERE hourly_rate > 25";
    $high = mysql_query($highQ);
    $highCount = count($high);

    $ratios = array("low" => $lowCount, "medium" => $middleCount, "high" => $high);
}

$result = mysql_query("SELECT * FROM test");

while ($row = mysql_fetch_array($result)) {
	echo "<p><b>ID</b>: " . $row{'id'} . " <b>Thing</b>: " . $row{'thing'} . "</p>";
}
?>
	</body>
</html>
