<?php
class Config {
    public $appName = 'todolist';
    protected $appVersion = 'v1.0';


    public function setConf(){

    }

    public function getConf(){

    }
}

class DbConfig extends Config {

    private $dbPath = 'data'.DIRECTORY_SEPARATOR;
    private $dbFile;

    public function __construct(string $dbFile)
    {
        $this->dbFile = $dbFile;
        $dirCheck = is_dir($this->dbPath); //If dbPath is absent, dbPath is created.
        // Data is not retrieved from database. For this reason, dbPath and dbFile are created.
        $fileCheck = file_exists($this->dbPath . $this->dbFile . '.json');
        if (!$dirCheck){
            $this->dirCreate();
        }
        if (!$fileCheck){
            $this->dbCreate($dbFile);
        }
    }

    private function dirCreate() : bool {
        return mkdir($this->dbPath);
    }

    // $todoList=[];empty array
    // Object formating data is converted into string to handle data by json_encode function.
    private function dbCreate(string $dbName): bool {
        return file_put_contents($this->dbPath . $dbName . '.json', json_encode([]));
    }

    public function getDbFile() : string {
        return $this->dbPath . $this->dbFile . '.json';
    }


}