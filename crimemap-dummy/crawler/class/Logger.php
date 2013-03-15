<?php

class Logger
{

    private $lName = null;
    private $handle = null;

    public function __construct($logName = null)
    {
        if ($logName)
        {
            $this->lName = $logName; //Define Log Name!
        }
        else
        {
            $this->lName = "Log"; //Default name
        }
        echo $this->logOpen(); //Begin logging.		
    }

    function __destruct()
    {
		if($this->handle != null)
			fclose($this->handle); //Close when php script ends (always better to be proper.)
    }

    //Open Logfile
    private function logOpen()
    {
        $today = date('Y-m-d'); //Current Date
        $this->handle = fopen($this->lName . '_' . $today . '.txt', 'a') or exit("Can't open " . $this->lName . "_" . $today); //Open log file for writing, if it does not exist, create it.
    }

    //Write Message to Logfile
    public function logWrite($message)
    {
        $time = date('d.m.Y @ H:i:s '); //Grab Time
        fwrite($this->handle, $time . "=== " . $message . "\n"); //Output to logfile
    }

    public function logWriteNewLine()
    {
        fwrite($this->handle, "\n"); //Output to logfile
    }

    //Clear Logfile
    public function logClear()
    {
        ftruncate($this->handle, 0);
    }

}

?>
