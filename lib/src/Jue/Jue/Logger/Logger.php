<?php

/**
* @package     Logger
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2014
* @version     14.11.20
**/

/**
* File logger
* @author xiaocao
*
* 调用方式：
*
* $this->load_help('Logger');
* $log = new Logger(__Logger__.'example.log.php');
* $log->log('Example Notice', Logger::NOTICE);
* $log->log('Example Warning', Logger::WARNING);
* $log->log('Example Error', Logger::ERROR);
* $log->log('Example Fatal', Logger::FATAL);
*/

namespace Jue\Logger;
use Jue\Config;

class Logger {

    /**
    * Holds the file handle.
    *
    * @var resource
    */
    protected $fileHandle = NULL;

    /**
    * The time format to show in the log.
    *
    * @var string
    */
    protected $timeFormat = 'd.m.Y - H:i:s';
    /**
    * The file permissions.
    */
    const FILE_CHMOD = 756;

    const NOTICE = '[NOTICE]';
    const WARNING = '[WARNING]';
    const ERROR = '[ERROR]';
    const FATAL = '[FATAL]';
    /**
    * Opens the file handle.
    *
    * @param string $logfile The path to the loggable file.
    */
    public function __construct($logfile) {
        if($this->fileHandle == NULL){
            $this->openLogFile($logfile);
        }

        /*
        * Compatibility
        */
        try {
            $compat = Compatibility::check();
        } catch(CompatibilityException $e){
            die($e->getMessage());
        }
    }

    /**
    * Closes the file handle.
    */
    public function __destruct() {
        $this->closeLogFile();
    }

    /**
    * Logs the message into the log file.
    *
    * @param  string $message     The log message.
    * @param  int    $messageType Optional: urgency of the message.
    */
    public function log($message, $messageType = Logger::WARNING) {
        if($this->fileHandle == NULL){
            throw new LoggerException('Logfile is not opened.');
        }

        if(!is_string($message)){
            throw new LoggerException('$message is not a string');
        }

        if($messageType != Logger::NOTICE &&
            $messageType != Logger::WARNING &&
           $messageType != Logger::ERROR &&
            $messageType != Logger::FATAL
        ){
            throw new LoggerException('Wrong $messagetype given.');
        }

        $this->writeToLogFile("[".$this->getTime()."]".$messageType." - ".$message);
    }

    /**
    * Writes content to the log file.
    *
    * @param string $message
    */
    private function writeToLogFile($message) {
        flock($this->fileHandle, LOCK_EX);
        fwrite($this->fileHandle, $message.PHP_EOL);
        flock($this->fileHandle, LOCK_UN);
    }

    /**
    * Returns the current timestamp.
    *
    * @return string with the current date
    */
    private function getTime() {
        return date($this->timeFormat);
    }

    /**
    * Closes the current log file.
    */
    protected function closeLogFile() {
        if($this->fileHandle != NULL) {
            fclose($this->fileHandle);
            $this->fileHandle = NULL;
        }
    }

    /**
    * Opens a file handle.
    *
    * @param string $logFile Path to log file.
    */
    public function openLogFile($logFile) {
        $this->closeLogFile();

        if(!is_dir(dirname($logFile))){
            if(!mkdir(dirname($logFile), Logger::FILE_CHMOD, true)){
               throw new LoggerException('Could not find or create directory for log file.');
            }
        }

        if(!$this->fileHandle = fopen($logFile, 'a+')){
            throw new LoggerException('Could not open file handle.');
        }
    }
}

/**
* Compatibility class
* For non-supported enviroments.
*/

class Compatibility {
    const MIN_PHP_VERSION = '5.3';
    public static function check(){
        self::checkPHPVersion();
    }

    protected static function checkPHPVersion(){
        if(!version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '>=')){
            throw new CompatibilityException('PHP version must be greater than '.self::MIN_PHP_VERSION.'.');
        }
    }
}