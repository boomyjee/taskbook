<?php

namespace Models;

class Task {

    const STATUS_EMPTY = '';
    const STATUS_DONE = 'done';

    public $id = false;
    public $username = "";
    public $email = "";
    public $status = self::STATUS_EMPTY;
    public $text = "";
    public $image = false;

    static function hydrate($row) {
        $task = new self;
        foreach (['id','username','email','status','text','image'] as $f) $task->$f = $row[$f];
        return $task;
    }

    static function get($limit,$offset,$sort,$order) {
        if (!in_array($sort,['id','username','email','status','text'])) $sort = 'id';
        if (!in_array($order,['asc','desc'])) $sort = 'asc';

        $rows = Db::select("SELECT * FROM tasks ORDER BY $sort $order LIMIT $offset,$limit");
        $tasks = [];
        foreach ($rows as $row) {
            $tasks[] = self::hydrate($row);
        }
        return $tasks;
    }

    static function getById($id) {
        $rows = Db::select("SELECT * FROM tasks WHERE id = ?",[$id]);
        if (!count($rows)) return false;
        return self::hydrate($rows[0]);
    }

    static function getTotal() {
        $rows = Db::select("SELECT COUNT(*) FROM tasks");
        if (empty($rows)) return 0;
        return $rows[0][0];
    }

    function save() {
        if (!$this->id) {
            Db::execute(
                'INSERT INTO tasks (username,email,status,text,image) VALUES (?,?,?,?,?)',
                [$this->username,$this->email,$this->status,$this->text,$this->image]
            );
        } else {
            Db::execute(
                'UPDATE tasks SET username = ?,email = ?,status = ?,text = ?,image =? WHERE id = ?',
                [$this->username,$this->email,$this->status,$this->text,$this->image,$this->id]
            );            
        }
    }

}