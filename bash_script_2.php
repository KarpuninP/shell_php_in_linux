<?php
$a = ' 
time=`uptime`
user=`uname -a`
cpu=`lscpu`
terminal=`ps`
echo "User information "
echo
echo 
echo "Time of work:  $time"
echo
echo "-------------------------------" 
echo "Information  of system:    $user"
echo
echo "-------------------------------" 
echo "Information  of cpu:        $cpu "
echo
echo "-------------------------------" 
echo "What naw working in console:  $terminal"
';

$output = shell_exec($a);
echo "<pre>$output</pre>";
?>
<p><a href="/">Вернутся назад</a></p>
