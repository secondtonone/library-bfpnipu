<?php 
/*
* Класс для формирования запросов к БД для проверки совпадений
*/
class QueryClass {
	
	public $data;
	
	function QueryClass(){
	$this->data="";	
	}
	
	function check_repeat ($query,$data,$dbh){
    $this->data=$dbh->prepare($query);
    $this->data->execute(array($data));
    $this->data=$this->data->fetch(PDO::FETCH_ASSOC);
	return $this->data;
	}

	function check_login ($query,$login,$dbh){
    $this->data=$this->check_repeat($query,$login,$dbh);
    if(!empty($this->data)){ 
	echo "Такой пользователь уже существует!";
	return $this->data;}else{
	return false;}
    }	
	
	
	function check_email ($query,$email,$dbh){
    $this->data=$this->check_repeat($query,$email,$dbh);
    if(!empty($this->data)){ 
	echo "Такой электронный адрес уже использован!";
	return $this->data;}else{
	return false;}		
	} 
	
	function check_hit ($query,$fam,$num,$dbh){
    $this->data=$dbh->prepare($query);
    $this->data->execute(array($fam,$num));
    $this->data=$this->data->fetch(PDO::FETCH_ASSOC);
	if(!empty($this->data['id_man'])){ 
	return $this->data['id_man'];}else{
	echo "Пользователя с такой фамилией и номером зачетной книжки не существует!";	
	return false;}
	}
	
	function check_user ($query,$user,$dbh){
    $this->data=$this->check_repeat($query,$user,$dbh);
    if(!empty($this->data)){ 
	echo "Такой пользователь уже зарегистрирован!";
	return $this->data;}else{
		return false;}
		} 	
	
	function insert_inf ($query,$queryinsert,$login,$pass,$email,$idman,$dbh){
	$right="User";	
	$this->data=$dbh->prepare($queryinsert);
    $this->data->execute(array($login,$pass,$email,$right,$idman));
	$this->data=$this->check_repeat($query,$idman,$dbh);
	return $this->data;
	}
	
	function update_inf ($updatequery,$id,$dbh){
	$active="1";	
	$this->data=$dbh->prepare($updatequery);
    $this->data->execute(array($active,$id));
	$query='SELECT * FROM users WHERE active=? AND id=?';
    $this->data=$dbh->prepare($query);
    $this->data->execute(array($active,$id));
    $this->data=$this->data->fetch(PDO::FETCH_ASSOC);
	return $this->data;
	}
	
	function update_pass($updatequery,$pass,$id,$dbh){
	$this->data=$dbh->prepare($updatequery);
    $this->data->execute(array($pass,$id));
	$query='SELECT * FROM users WHERE id=?';
	$this->data=$this->check_repeat($query,$id,$dbh);
	return $this->data;
	}	
		
	function active_code ($query,$idman,$dbh){
    $this->data=$dbh->prepare($query);
    $this->data->execute(array($idman));
    $this->data=$this->data->fetch(PDO::FETCH_ASSOC);
	$this->data=md5($this->data["id"]).md5($this->data["name"]);	
	return $this->data;
		}
	function __destruct() {
         }
    }

?>