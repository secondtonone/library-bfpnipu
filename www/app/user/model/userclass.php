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
	
	function update_user($query,$updatequery,$data,$data2,$id,$dbh){
	$this->data=$dbh->prepare($updatequery);
    $this->data->execute(array($data,$data2,$id));
	$this->data=$this->check_data($query,$id,$dbh);
	return $this->data;
	}	
	
	function update_ppl($query,$updatequery,$data,$data2,$data3,$data4,$id,$dbh){
	$this->data=$dbh->prepare($updatequery);
    $this->data->execute(array($data,$data2,$data3,$data4,$id));
	$this->data=$this->check_data($query,$id,$dbh);
	return $this->data;
	}	
	
    
	function __destruct() {
         }
	

      
}
?>