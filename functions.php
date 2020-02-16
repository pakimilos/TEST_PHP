<?php
session_start();
class Database {

    public $conn;

    function __construct($project = 0) {
        $servername = "localhost";
        $password = "";
        $username = "root";
        $dbname = "milosdb";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->$conn->error);
        }

        // germans activated
        $this->conn->query("SET NAMES utf8;");
    }

    function __destruct() {
        $this->conn->close();
    }

}

/*
 * get all user types
 * 
 */

function get_types() {
    $db = new Database;
    $user_types = array();
    //$sql = "SELECT user_type.type as type_name,user_type.parent, user.*, COUNT(*) as count FROM user_type INNER JOIN user ON user_type.id = user.type GROUP BY user.type";
	$sql="SELECT user_type.type as type_name,user_type.parent as parent, user_type.id as tid, t1.* FROM user_type LEFT JOIN ( SELECT *, COUNT(*) as count FROM user GROUP BY user.type) as t1 ON t1.type=user_type.id";
    $all_types_res = $db->conn->query($sql);
    while ($row = mysqli_fetch_array($all_types_res)) {
		$user_types[$row['tid']]['id'] = $row['tid'];
        $user_types[$row['tid']]['name'] = $row['type_name'];
        $user_types[$row['tid']]['parent'] = $row['parent'];
		$user_types[$row['tid']]['count'] = $row['count'];
    }

    return $user_types;
}


function add_user($name, $email, $password, $type) {
    $db = new Database;
    $name = mysqli_real_escape_string($db->conn, $name);
    $email = mysqli_real_escape_string($db->conn, $email);
    $password = mysqli_real_escape_string($db->conn, $password);
    $type = mysqli_real_escape_string($db->conn, $type);

    $message = "";
    $sql = "INSERT INTO user (name, email, password, type) VALUES ('$name', '$email', '$password', '$type')";
    if ($db->conn->query($sql) === TRUE) {
        $message = "New user register successfully";
    } else {
        
        $message = "<div class='alert alert-danger' role='alert'> User already exist with this e-mail</div>";
    }

    return $message;
}




function log_user($email, $password){
    $db = new Database;
    $email = mysqli_real_escape_string($db->conn, $email);
    $password = mysqli_real_escape_string($db->conn, $password);

    $message ='';
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

    $res = $db->conn->query($sql);
    $id =  false;

    $user = mysqli_fetch_assoc($res);

    if(isset($user['id'])){
        $id = $user['id'];
    }

    if($id){
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $user['name'];
        header('Location: results.php');
    }else {

        $message = "<div class='alert alert-danger' role='alert'> Wrong e-mail or password</div>";
        
    }
   echo $message;
}


function build_hierarchy($elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent'] == $parentId) {
            $children = build_hierarchy($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}


function display_types($array){
    echo "<ul class='types'>";
	$count = 0;
        foreach($array as $value){
			//$count += $value['count'];
			if(empty($value['count'])){
				$value['count'] = 0;
			}
			$count+=$value['count'];
			echo "<li>".$value['name']."(". $count.")";
			//echo "<li>".$value['name'];
			
				if(isset($value['children']) && !empty($value['children'])){
					
					display_types($value['children']);
					
					
				}
			
						
			
        }
    echo "</ul>";
}


function display_select($array, $level = 0)
{
    foreach($array as $node)
	{
		$t = "";
		
		for($i=0; $i<=$level; $i++){
			$t .="-";
		}
        
		echo "<option value='".$node['id']."'>".$t.$node['name']."</option>";
        if(isset($node['children'])) {         
            display_select($node['children'], $level + 1);  
        }
	
    }
}

 

function search($name, $type){
	$db = new Database;
	$users = array();
	$sql = "SELECT * FROM user_type INNER JOIN user ON user_type.id=user.type WHERE user.name LIKE '%".$name."%' AND user_type.id = ".$type;
	$all_types_res = $db->conn->query($sql);
    while ($row = mysqli_fetch_array($all_types_res)) {
		$users[$row['id']]['id'] = $row['id'];
        $users[$row['id']]['name'] = $row['name'];
        $users[$row['id']]['type'] = $row['type'];
		$users[$row['id']]['email'] = $row['email'];
    }

    return $users;
}