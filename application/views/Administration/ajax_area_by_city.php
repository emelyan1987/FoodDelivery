<?PHP
if($type == 1)
{
                              foreach($area_list as $ks=>$vs):
                              
                                  ?>

                                  <option value="<?PHP  echo $vs->id; ?>"> <?PHP echo $vs->name; ?></option>

                               <?PHP
                               endforeach;
}
else
{



                                              foreach($area_list as $ks=>$vs)
                                              {
                                              
                                                echo "<option value='$vs->id,$vs->name'>$vs->name</option>";
                                              }
}
?>

                                             
                                             