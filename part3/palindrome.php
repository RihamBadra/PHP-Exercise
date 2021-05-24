<?php
function Check_Palindrome($arr){   
	 if (strrev($arr) == $arr){   
        return true;   
    } 
    else{ 
        return false; 
    } 
}   
  
//Check Palindrome using strrev()
$palindrome = array('MAAM', 'SUPER', 'DAD', 'WOW');  
foreach($palindrome as $p){
	if(Check_Palindrome($p)){   
		echo $p." is a Palindrome.<br/>";   
	}  
	else {   
		echo $p." is not a Palindrome.<br/>";   
	} 
}
?>