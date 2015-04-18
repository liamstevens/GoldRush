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

function createSQLConn(){
    if(mysql_select_db($
    

}


?>
