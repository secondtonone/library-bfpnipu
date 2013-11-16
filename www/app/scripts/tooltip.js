$(document).ready(function(){ 
    $(document).tooltip({show: {
        effect: "fadeIn",
        delay: 350
      },hide: {
        effect: "fadeOut",
        delay: 550
      }, position: { my: "left+15", at: "right center"}  });
	   
	 $('#regForm #login, #regForm #pass, #regForm #pass2').tooltip({show: {
        effect: "fadeIn",
        delay: 350
      },hide: {
        effect: "fadeOut",
        delay: 550
      }, position: { my: "right-15", at: "left center"}  }); 
	  
	  $('#acc #email,#acc #password,#acc #rpassword').tooltip({show: {
        effect: "fadeIn",
        delay: 350
      },hide: {
        effect: "fadeOut",
        delay: 550
      }, position: { my: "right-15", at: "left center"}  }); 
  });