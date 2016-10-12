<?PHP
 
 //print_r($owner_list);
  if(isset($owner_list))
  {
	  foreach($owner_list as $ks=>$vs)
	  {
	  	   echo $vs['owner_id']."<br>";

	  }
}
 

?>