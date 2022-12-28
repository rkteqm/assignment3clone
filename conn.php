<?php

use LDAP\Result;

session_start();

class Users
{
    public $que;
    private $servername = 'localhost';
    private $username = 'root';
    private $password = 'password';
    private $dbname = 'assignment3clone';
    private $result = array();
    private $mysqli = '';

    public function __construct()
    {
        $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function insert($table, $para = array())
    {
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);

        $sql = "INSERT INTO $table($table_columns) VALUES('$table_value')";
        $result = $this->mysqli->query($sql);
    }

    public function update($table, $para = array(), $id)
    {
        $args = array();

        foreach ($para as $key => $value) {
            $args[] = "$key = '$value'";
        }
        $fname = $para['first_name'];
        $lname = $para['last_name'];
        $email = $para['email'];
        $phone = $para['phone_number'];
        $gender = $para['gender'];
        $file = $para['file'];
        $modified_date = $para['modified_date'];
        $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', `email` = '$email', `phone_number` = '$phone', `gender` = '$gender', `file` = '$file', `modified_date` = '$modified_date' where `id` = '$id'";
        $this->sql = $result = $this->mysqli->query($sql);
        echo mysqli_error($this->mysqli);
    }

    public function delete($table, $id)
    {
        $sql = "UPDATE $table SET `soft_delete` = '0' WHERE `id` = $id";
        $this->sql = $result = $this->mysqli->query($sql);
    }

    public $sql;

    public function select($table, $rows = "*", $where = null)
    {
        if ($where != null) {
            $sql = "SELECT $rows FROM $table WHERE `id` = $where AND `soft_delete` = '1' ";
        } else {
            $sql = "SELECT $rows FROM $table WHERE `soft_delete` = '1' AND `user_type` = '1'";
        }

        $this->sql = $result = $this->mysqli->query($sql);
    }

    public function selectByEmail($table, $rows = "*", $where = null)
    {
        $sql = "SELECT $rows FROM $table WHERE `email` = '$where'";
        $this->sql = $result = $this->mysqli->query($sql);
    }

    public function login($table, $para = array())
    {
        $table = $table;
        $email = $para['email'];
        $password = $para['password'];
        $password = md5($password);
        $sql = "SELECT * FROM $table WHERE `email`='$email' AND `password`='$password' AND `soft_delete` = '1' ";
        $this->sql = $result = $this->mysqli->query($sql);

        echo mysqli_error($this->mysqli);
    }

    public function reset($table, $para = array(), $id)
    {
        $table = $table;
        $password = $para['password'];
        $password = md5($password);
        $sql = "UPDATE $table SET `password`='$password' WHERE `id`='$id' ";
        $this->sql = $result = $this->mysqli->query($sql);

        echo mysqli_error($this->mysqli);
    }

    public function emailExist($table, $para = array())
    {
        $table = $table;
        $email = $para['email'];
        $sql = "SELECT * FROM $table WHERE `email`='$email'";
        $this->sql = $result = $this->mysqli->query($sql);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}
