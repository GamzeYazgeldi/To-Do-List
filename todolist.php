<?php

// Defining To Do List class:
class TodoList {

    private $todolistName;
    private $myTodoList;
    private $db;
    private $errors="";

    // init
    public function __construct(string $todoListName)
    {
        $this->todolistName = $todoListName;

        $conf = new DbConfig($todoListName);
        $this->db = $conf->getDbFile();
    }

    public function getTodos() : array { //Except array cause error.
        $this->myTodoList = json_decode(file_get_contents($this->db));
        return $this->myTodoList;
    }

    // create todolist
    // Empty because dbPath is decided to construct in only construction/init step.
    // Besides, other to do list can be created.
    private function create(){

    }

    // add
    public function add()
    {
        $task = $_POST['mytodo'];       //mytodo value is assigned to task variable.
        if (!empty($task)) {
            $this->myTodoList[] = $task;
            $this->save();
        } else {
            $errors = "Please fill this.";
        }
        header('Location: '.$_SERVER['REQUEST_URI']);    //This is added because 404 Not Found Error was taken. Solved.
    }


    // delete
    // There is a 404 Error. Could not fix.
    public function delete(int $id){
        $id--;
        unset($this->myTodoList[$id]);  //To do with chosen ID are removed from myTodoList array.
        $this->myTodoList = array_values( $this->myTodoList );
        $this->save();
    }
    // update
    public function update(){

    }
    // status change
    public function statusChange(){

    }

    // priority sort
    // Could not work. Desired workflow:
    // To take priority level from form.
    // Save with myTodoList array.
    // Sort descending according to priority level.
    private $priorityLevel;
    public function prioritySort(){
        $level = $_POST['todo_priority_level'];
        $this->priorityLevel[] = $level;
        $this->save();
    }

    // save file
    public function save(){
        file_put_contents($this->db, json_encode($this->myTodoList));   // myTodoList is added into db
        header('location:/');   //Getting data is decided to save into .json.
        //Header function provides saving into location:/
    }

}