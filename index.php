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

//Returns all valid checkins and outs within a ~11km square of the supplied lat and long
function arrivalTraffic($lat, $long){
    $latRangeLess = $lat-0.1; //10km "radius"
    $latRangeMore = $lat+0.1;
    $longRangeLess = $long-0.1;
    $longRangeMore = $long+0.1;

    $queryString = "SELECT in_time FROM `clocks` WHERE latitude <" . $latRangeMore . " AND latitude > " . $latRangeLess . " AND longitude < " . $longRangeMore . " AND longitude > " . $longRangeLess;

    $validListings = mysql_query($queryString) or die("Death");

    while($row = mysql_fetch_array($validListings)) {
    echo $row['in_time'];
    }

    return $validListings; 
}

function leavingTraffic($lat, $long){
    $latRangeLess = $lat-0.1; //10km "radius"
    $latRangeMore = $lat+0.1;
    $longRangeLess = $long-0.1;
    $longRangeMore = $long+0.1;

    $queryString = "SELECT out_time FROM `clocks` WHERE latitude <" . $latRangeMore . " AND latitude > " . $latRangeLess . " AND longitude < " . $longRangeMore . " AND longitude > " . $longRangeLess;

    $validListings = mysql_query($queryString) or die("Death");

    while($row = mysql_fetch_array($validListings)) {
    echo $row['in_time'];
    }
    return $validListings; 
}

function timeTraffic($validTraffic) {
    date_default_timeset_set('UTC');
    $earlyStart = strtotime("06:00:00",0);
    $lateStart = strtotime("09:00:00",0);

    $earlyLunch = strtotime("10:00:00",0);
    $lateLunch = strtotime("14:00:00", 0);
    
    $finish = strtotime("16:00:00", 0);

    $arriving = 0;

    $lunch = 0;

    $leaving = 0;


    foreach($validTraffic as $value) {
        if((strtotime($value['in_time']) <  $lateStart) && (strtotime($value['in_time']) > $earlyStart)) {
            //arriving
            $arriving++;
       } else if((strtotime($value['out_time']) > $earlyLunch) || strtotime($value['in_time']) < $lateLunch) {
            $lunch++; 
    }else if((strtotime($value['out_time']) > $finish)) {
            //leaving
            $leaving++;
        }
    }
    $returnval = array("arriving" => $arriving, "lunch" => $lunch, "leaving" => $leaving);
    return $returnVal;
}

?>
	</body>
</html>
