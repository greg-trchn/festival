<?php

class ErrorService {

    public function log (
        $errno,
        $errstr,
        $errfile,
        $errline
    ) {
        $error = "Date : " . date("d-m-Y H:i:s") . "\n";
        $error .= "Type : $errno\n";
        $error .= "Message : $errstr\n";
        $error .= "File : $errfile\n";
        $error .= "Line : $errline\n";

        $log = fopen(__DIR__.'/../../log/' .date("d-m-Y"). '.log', "a+");
        fwrite($log, $error);
        fclose($log);
    }

    public function shutdown ($error = null) {
        if ($error || ($error = error_get_last())) {
            $this->log(
                $error["type"],
                $error["message"],
                $error["file"],
                $error["line"]
            );
        }

    }

}