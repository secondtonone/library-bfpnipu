<?php 

class UserClass {
	
      public $data;
	  
	  	
	function UserClass(){
		$this->data="";
		}
	
	function get_data ($query,$data,$dbh){
    $this->data=$dbh->prepare($query);
    $this->data->execute(array($data));
    $this->data=$this->data->fetch(PDO::FETCH_ASSOC);
	return $this->data;
	}
	
	function update_pass($updatequery,$query,$data,$data2,$dbh){
	$this->data=$dbh->prepare($updatequery);
    $this->data->execute(array($data,$data2));
	$this->data=$this->get_data($query,$data2,$dbh);
	return $this->data;
	}	
	

      
}
?>