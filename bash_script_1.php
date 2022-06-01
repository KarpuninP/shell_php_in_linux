<?php
$a = ' 
mycomputer="Dell 9500"                        
 myos=`uname -a`                              
                                              
 echo "This script name is $0"                 
 echo "Privet $1"                              
 echo "Hello $2"                              
                                             
 num1=50                                       
 num2=45                                      
 summa=$((num1+num2))                        
                                               
 echo "$num1 + $num2 = $summa"                 
 echo "$myos"                                  
                                               
 myhost=`hostname`                            
 mygt="8.8.8.8"                                
                                               
 ping -c 4 $myhost                            
 ping -c 4 $mygt                               
                                               
 echo -n "This is done..."                     
 echo "really done" 
';

$output = shell_exec($a);
echo "<pre>$output</pre>";
?>
<p><a href="/">Вернутся назад</a></p>
