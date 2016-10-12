<?PHP
/*function getImagePath($img)
{
   $CI =& get_instance();

   $arr = explode('public_html',$img); 
   echo $arr[1];
}
*/
function get_itemcatName($id){
	$CI =& get_instance();

	$dataName = $CI->Home_Restro->restro_item_cat_Name($id);
	echo $dataName['cat_name'];
}

function get_item_name($id){
    $CI =& get_instance();

    $results = $CI->Home_Restro->get_item_name($id);

    echo $results['item_name'];
}

function get_item_image($id){
    $CI =& get_instance();

    $results = $CI->Home_Restro->get_item_image($id);

    if($results['image'] == '')
    {
        echo "/assets/Customer/img/default_item.png";
    }
    else
    {
        echo getImagePath($results['image']);
    }
    	
}

function tableBookedOrNot($tid,$date,$rid){
    $CI =& get_instance();

    $results = $CI->Home_Restro->get_tableBookedOrNot($tid,$date,$rid);

    return $results;
}
function getTableName($tid){
    $CI =& get_instance();

    $results = $CI->Home_Restro->get_tableData($tid);

    echo $results['table_no'];
}

function get_restro_allImage($restroid){
    $CI =& get_instance();
    $results = $CI->Home_Restro->getRestroAllImages($restroid);

    return $results;
}

function getItemVariation($itemid,$variation_type){
    $CI =& get_instance();
    $results = $CI->Home_Restro->getItemVariation($itemid,$variation_type);

    return $results;
}

function getitemPoint($itemid){
    $CI =& get_instance();
    $results = $CI->Home_Restro->getitemPoint($itemid);

    return $results;
}



?>