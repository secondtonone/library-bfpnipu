<?php 

class UserClass {
	
      public $data;
	  
	  	
	function UserClass(){
		$this->data="";
		}
		
	public function check_data ($string){
	$this->data=$string;
	$this->data=trim($this->data);
    $this->data=htmlspecialchars($this->data);
	return $this->data;
	}
	
	function get_data ($query,$data,$dbh){
    $this->data=$dbh->prepare($query);
    $this->data->execute(array($data));
    $this->data=$this->data->fetch(PDO::FETCH_ASSOC);
	return $this->data;
	}
	
	function update_user($updatequery,$data,$data2,$id,$dbh){
	$this->data=$dbh->prepare($updatequery);
    $this->data->execute(array($data,$data2,$id));
	}	
	
	function update_ppl($updatequery,$data,$data2,$data3,$data4,$id,$dbh){
	$this->data=$dbh->prepare($updatequery);
    $this->data->execute(array($data,$data2,$data3,$data4,$id));
	}	
	
	function check_number ($string){
	$this->data=$this->check_data($string);
	if(!preg_match('/[0-9]/', $this->data)){
    echo "Неверный номер!";
	return false;}
	else{	
    return $this->data;}
	}
	

      
}
?>