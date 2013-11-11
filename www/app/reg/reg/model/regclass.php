<?php 
/*
* Класс для проверки значений на вредоносный код
*/
class RegClass {
	
	public $data;
	public $data2;
	
	
	function RegClass(){
	$this->data="";
	$this->data2="";	
	}
	
	public function check_data ($string){
		$this->data=$string;
		$this->data=trim($this->data);
    	$this->data=htmlspecialchars($this->data);
		return $this->data;
		}
		
		
	public function check_name ($string) {
		$this->data=$string;
		if (strlen($this->data)>5){
		if(isset($this->data)and($this->data)!==''){
		$this->check_data($this->data);
		return $this->data;	}
		else{echo"Вы не ввели логин!";
		return false;
		}
		}else
		{echo"Логин должен содержать больше 5 символов!";
		return false;
		}		
		}
		
		
	public function check_sur ($string) {
		$this->data=$string;
		if(isset($this->data)and($this->data)!==''){
		$this->check_data($this->data);	
		return $this->data;}
		else{echo "Вы не ввели фамилию!";
		return false;
		}}
		
		
	public function check_num ($string) {
		$this->data=$string;
		if(isset($this->data)and($this->data)!==''){
		$this->check_data($this->data);	
		return $this->data;}
		else{echo"Вы не ввели номер зачетки!";
		return false;
		}}	
		
				
	public function check_email ($string){
		$this->data=$this->check_data($string);
		if(isset($this->data)and($this->data)!==''){	
		if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $this->data)){
    	echo "E-mail введён не корректно.";
		return false;}	
    	return $this->data;}
		else{echo "Вы не ввели электронный адрес!";
		return false;
	   }}
	   
	   
	public function check_id ($string){
		$this->data=$this->check_data($string);
		if(isset($this->data)and($this->data)!==''){	
		if(!preg_match('/[0-9a-z]/', $this->data)){
    	echo "Неверные параметры!";
		return false;}	
    	return $this->data;}
		else{echo "Вы перешли на страницу без параметров!";
		return false;
	   }}	
	 
	public function check_code ($string){
		$this->data=$string;
		if(isset($this->data)and($this->data)!==''){
		$this->check_data($this->data);
		return $this->data;	}
		else{echo "Вы перешли на страницу без параметров!";
		return false;
		}}	    
	
	public function check_pass ($string,$string2){
		$string=$this->check_data($string);
		$string2=$this->check_data($string2);
		if (strlen($string)>5 and strlen($string2)>5){
		if((isset($string)and($string)!=='')and
		 (isset($string2)and($string2)!=='')){		
		if($string==$string2){
		return $this->data=md5($string);
		    	}else{
     	echo "Введённые пароли не совпадают.";
		return false;
		}  
	   }else{
     	echo "Вы не ввели пароль!";
		return false;
		}}else{
     	echo "Пароль должен содержать больше 5 символов.";
		return false;
		}
		  
		  }
		function __destruct() {
         }
		  
	}
?>