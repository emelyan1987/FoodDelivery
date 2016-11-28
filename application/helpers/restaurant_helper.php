<?PHP
function getServices($restroId) {
	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');
	//$conditions = array('restro_services_commission.service_type'=>$id);
	$results = $CI->Restaurant_management->getServices($restroId);
	return $results;
}
function getRestaurantType($restroId) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');
	//$conditions = array('restro_services_commission.service_type'=>$id);
	$results = $CI->Restaurant_management->getRestaurantType($restroId);
	return $results;

}

function getOwnerCode($restroId) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');
	//$conditions = array('restro_services_commission.service_type'=>$id);
	$results = $CI->Restaurant_management->getOwnerCode($restroId);
	return $results['owner_id'];

}

function getCuisine($restroId) {
	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');
	//$conditions = array('restro_services_commission.service_type'=>$id);
	$results = $CI->Restaurant_management->getCuisine($restroId);
	return $results;

}

function check_cuisine($cID, $rID) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->check_cuisine($cID, $rID);
	return $results;
}

function getuseremail($id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	//$results = $CI->Restro_Owner_Model->getuseremail($id);
	$results = $CI->Restro_Owner_Model->getuserename($id);
	echo $results['f_name'] . ' ' . $results['l_name'];
}
function getImagePath($img) {
	$CI = &get_instance();

	$arr = explode('public_html', $img);
	echo isset($arr[1]) ? $arr[1] : "/assets/Customer/img/default_item.png";
}
function getImageLink($img) {
	$CI = &get_instance();

	$arr = explode('public_html', $img);
	echo isset($arr[1]) ? base_url($arr[1]) : base_url("/assets/Customer/img/default_item.png");
}
function restroseoCatChk($cID, $rID) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->restroseoCatChk($cID, $rID);
	return $results;
}
function getCategoryName($id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->getCategoryName($id);
	echo ucwords($results['cat_name']);
}

function chkRestropaymethod($method, $restroid) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->chkRestropaymethod($method, $restroid);
	return $results;
}

function check_foodtype($foodtype, $restroid) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->chk_restro_food_type($foodtype, $restroid);
	return $results;
}

function getcatByItem($id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->getcatByItem($id);
	return $results;
}
function chkitemcategory($catid, $itemid) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->chkitemcategory($catid, $itemid);
	return $results;
}

function categoryCountByService($service, $restro, $location_id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->categoryCountByService($service, $restro, $location_id);
	return $results;
}

function chckrestroService($restro_id, $service, $location_id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->chckrestroService($restro_id, $service, $location_id);
	return $results;
}

function getCityName($id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->getCityName($id);
	echo ucwords($results['city_name']);
}

function getAreaName($id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->getAreaName($id);
	echo ucwords($results['name']);

}
function restroCateChkByLocation($cat_id, $restro_id, $location_id, $service_id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->restroCateChkByLocation($cat_id, $restro_id, $location_id, $service_id);
	return $results;

}

function get_All_Variation_Data($variation_id, $item_id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Cuisine_management");

	$results = $CI->Cuisine_management->get_All_Variation_Data($variation_id, $item_id);
	return $results;
}

function get_item_varation($item_id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Cuisine_management");

	$results = $CI->Cuisine_management->get_item_varation($item_id);
	return $results;
}

function get_data_item_variation($promotion_id, $item_id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Promotion_management");

	$results = $CI->Promotion_management->get_data_item_variation($promotion_id, $item_id);
	return $results;
}

function get_Alldata_item_variation($promotion_id, $item_id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Promotion_management");

	$results = $CI->Promotion_management->get_data_item_variation($promotion_id, $item_id);
	return $results;
}

function getvarAllData($promotion_id, $item_id, $variation_id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Promotion_management");

	$results = $CI->Promotion_management->getvarAllData($promotion_id, $item_id, $variation_id);
	return $results;
}

function getvarAllData12($promotion_id, $item_id, $variation_id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Promotion_management");

	$results = $CI->Promotion_management->getvarAllData12($promotion_id, $item_id, $variation_id);
	return $results;
}

function getAreaPrice($area_id, $restro_id, $location_id, $service_id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->getAreaPrice($area_id, $restro_id, $location_id, $service_id);

	$ex_arr = explode(',', $results['area']);
	$exprice = explode(',', $results['delivery_price']);

	$indexId = array_search($area_id, $ex_arr);

	echo $myPrice = $exprice[$indexId];
	// print $myPrice;

}

function getAdvertData($advert_type, $service_type) {
	$CI = &get_instance();

	$mod = $CI->load->model('Administration/Advertise_management');

	$results = $CI->Advertise_management->getAdvertData($advert_type, $service_type);

	return $results;
}

function getUserMobileNo($id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->getUserMobileNo($id);
	echo $results['mobile_no'];
}

function getAdminImage($id) {
	$CI = &get_instance();

	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');

	$results = $CI->Restro_Owner_Model->getAdminImage($id);
	return getImagePath($results['image']);
}
function getAdminName($id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Restaurant_Owner/Restro_Owner_Model');
	$results = $CI->Restro_Owner_Model->getAdminName($id);
	return $results['f_name'];

}

function getFaqCat($id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Restaurant_Owner/Dashboard_management');
	$results = $CI->Dashboard_management->getFaqCat($id);
	return $results['name'];

}

function getordercount($service_id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Order_Management');
	if ($service_id == 1) {
		echo $results = $CI->Order_Management->get_delivery_orders_count();
	} elseif ($service_id == 2) {
		echo $results = $CI->Order_Management->get_catering_orders_count();
	} elseif ($service_id == 3) {
		echo $results = $CI->Order_Management->get_reservation_orders_count();
	} elseif ($service_id == 4) {
		echo $results = $CI->Order_Management->get_pickup_orders_count();
	}

}

function getpendingordercount($service_id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Order_Management');
	if ($service_id == 1) {
		echo $results = $CI->Order_Management->get_delivery_pending_count();
	} elseif ($service_id == 2) {
		echo $results = $CI->Order_Management->get_catering_pending_count();
	} elseif ($service_id == 3) {
		echo $results = $CI->Order_Management->get_reservation_pending_count();
	} elseif ($service_id == 4) {
		echo $results = $CI->Order_Management->get_pickup_pending_count();
	}

}

function getRestroRatingValues($restro_id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Rating_management');
	$results = $CI->Rating_management->getRestroRatingValues($restro_id);
	$ratV = 0;
	$i = 0;
	foreach ($results as $ratingD => $rat) {
		$ratV = $ratV + $rat->star_value;
		$i++;
	}

	$RatArray['rating_value'] = $ratV;
	$RatArray['rating_num'] = $i;

	return $RatArray;

}

function getownerordercount($service_id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Order_Management');
	if ($service_id == 1) {
		echo $results = $CI->Order_Management->get_owner_delivery_orders_count();
	} elseif ($service_id == 2) {
		echo $results = $CI->Order_Management->get_owner_catering_orders_count();
	} elseif ($service_id == 3) {
		echo $results = $CI->Order_Management->get_owner_reservation_orders_count();
	} elseif ($service_id == 4) {
		echo $results = $CI->Order_Management->get_owner_pickup_orders_count();
	}

}

function getownerordercountPendding($service_id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Order_Management');
	if ($service_id == 1) {
		echo $results = $CI->Order_Management->get_owner_delivery_orders_countP();
	} elseif ($service_id == 2) {
		echo $results = $CI->Order_Management->get_owner_catering_orders_countP();
	} elseif ($service_id == 3) {
		echo $results = $CI->Order_Management->get_owner_reservation_orders_countP();
	} elseif ($service_id == 4) {
		echo $results = $CI->Order_Management->get_owner_pickup_orders_countP();
	}

}

/*function getTableName($id){
$CI =& get_instance();
$mod = $CI->load->model("Restaurant_Owner/Restro_Owner_Model");

$results = $CI->Restro_Owner_Model->getTableName($id);
return $results['table_no'];
}*/

function mycartValue($user_id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Customer/Home_Restro');
	$data['DcartData'] = $CI->Home_Restro->view_my_cart($user_id);
	$data['PcartData'] = $CI->Home_Restro->view_my_pickup_cart($user_id);
	$data['CcartData'] = $CI->Home_Restro->view_my_catering_cart($user_id);
	$data['RcartData'] = $CI->Home_Restro->view_my_table_cart($user_id);

	echo count($data['DcartData']) + count($data['PcartData']) + count($data['CcartData']) + count($data['RcartData']);
}

function getOwnerIdByCode($code) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	$results = $CI->Restaurant_management->getOwnerIdByCode($code);
	return $results['id'];

}

function getOwnerCodeById($id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	$results = $CI->Restaurant_management->getOwnerCodeById($id);
	return $results['owner_id'];

}

function getOwnerlocationByLId($id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	$results = $CI->Restaurant_management->getOwnerlocationByLId($id);
	return $results['location_name'];

}
function getLocationCityArea($id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	$results = $CI->Restaurant_management->getLocationCityArea($id);
	return $results;

}

function getRestroCommissionData($restro_id, $location_id, $service_id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	$results = $CI->Restaurant_management->getRestroCommissionData($restro_id, $location_id, $service_id);
	return $results;

}

function getOrderItemDetails($order_id, $service_id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Order_Management');

	if ($service_id == 1) {
		$results = $CI->Order_Management->delivery_orders_item_details($order_id);
	}
	if ($service_id == 2) {
		$results = $CI->Order_Management->catering_orders_item_details($order_id);
	}
	if ($service_id == 4) {
		$results = $CI->Order_Management->pickup_orders_item_details($order_id);
	}
	$i = 0;
	foreach ($results as $res => $re) {
		if ($i == 0) {
			echo $re->item_name;
		} else {
			echo ", " . $re->item_name;
		}

		$i++;
	}

}

function getCommissionCount($service_id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Order_Management');

	if ($service_id == 1) {
		$results = $CI->Order_Management->delivery_commission_reports();
	} elseif ($service_id == 2) {
		$results = $CI->Order_Management->catering_commission_reports();
	} elseif ($service_id == 4) {
		$results = $CI->Order_Management->pickup_commission_reports();
	}

	$tot_com = 0;
	foreach ($results as $res => $ord) {

		$mod = $CI->load->model('Administration/Restaurant_management');

		if ($service_id == 4) {
			$locData = $CI->Restaurant_management->getRestroCommissionData($ord->order_restro_id, $ord->location_id, $service_id);
		} else {
			$locData = $CI->Restaurant_management->getRestroCommissionData($ord->order_restro_id, $ord->restro_location_id, $service_id);
		}

		if ($locData['service_commision'] != '') {
			$tot = ($ord->order_total + $ord->order_charges) - $ord->order_discount;
			$com_amount = ($tot * $locData['service_commision']) / 100;

		} else {
			$com_amount = $locData['service_amount'];

		}

		$tot_com = $tot_com + $com_amount;
	}

	echo "KD " . $tot_com;

}

function getAllRestroLocationServiceName($restro_id, $location_id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	$results = $CI->Restaurant_management->getAllRestroLocationServiceName($restro_id, $location_id);

	foreach ($results as $key => $res) {
		if ($res->service_id == 1) {
			echo " DELIVERY <br>";
		} elseif ($res->service_id == 2) {
			echo " CATERING <br>";
		} elseif ($res->service_id == 3) {
			echo " RESERVATION <br>";
		} elseif ($res->service_id == 4) {
			echo " PICKUP <br>";
		}
	}
}

function CityExistWithRestro($city_id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	return $results = $CI->Restaurant_management->CityExistWithRestro($city_id);
}

function AreaExistWithRestro($city_id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	return $results = $CI->Restaurant_management->AreaExistWithRestro($city_id);
}

function getordercount_filter($service_id, $restro_id, $location_id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Order_Management');
	if ($service_id == 1) {
		echo $results = $CI->Order_Management->get_delivery_orders_count_filter($restro_id, $location_id);
	} elseif ($service_id == 2) {
		echo $results = $CI->Order_Management->get_catering_orders_count_filter($restro_id, $location_id);
	} elseif ($service_id == 3) {
		echo $results = $CI->Order_Management->get_reservation_orders_count_filter($restro_id, $location_id);
	} elseif ($service_id == 4) {
		echo $results = $CI->Order_Management->get_pickup_orders_count_filter($restro_id, $location_id);
	}

}

function chkTableBookedOnTime($res_time) {
	$table_id = $_SESSION['table_id'];
	$restro_id = $_SESSION['order_restro_id'];
	$res_date = $_SESSION['res_date'];
	$CI = &get_instance();

	$timestamp = strtotime($res_time) - 60 * 5;
	$from_time = date('h:i A', $timestamp);
	$timestamp1 = strtotime($res_time) + 60 * 60;
	$to_time = date('h:i A', $timestamp1);

	return $results = $CI->Home_Restro->chkTableBooedOnTime($restro_id, $table_id, $res_date, $from_time, $to_time);
}

function getRestroName($id) {

	$CI = &get_instance();
	$mod = $CI->load->model('Administration/Restaurant_management');

	$results = $CI->Restaurant_management->getRestroName($id);
	return $results['restro_name'];
}

function get_variation_Data($id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Restaurant_management");

	$results = $CI->Restaurant_management->get_variation_Data($id);
	return $results;
}

function getlocationAllDetails($id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Order_Management");

	$results = $CI->Order_Management->getlocationAllDetails($id);
	return $results;
}

function getRestroNameByOwnerCode($ownerCode) {
	$CI = &get_instance();
	$mod = $CI->load->model("Administration/Restaurant_management");

	$results = $CI->Restaurant_management->getRestroNameByOwnerCode($ownerCode);
	return ucwords($results['restro_name']);
}

function getEditItemCategory($owner_id, $location_id, $service_id) {
	$CI = &get_instance();
	$mod = $CI->load->model("Restaurant_Owner/Restro_Owner_Model");

	$results = $CI->Restro_Owner_Model->restro_all_item_category_onEdit($owner_id, $location_id, $service_id);
	return $results;
}

function My_captcha($value) {

}
function getCuisineById($cuisine_id) {
	$CI = &get_instance();
	$mod = $CI->load->model('Customer/Home_Restro');
	//$conditions = array('restro_services_commission.service_type'=>$id);
	$results = $CI->Home_Restro->getCuisineRES($cuisine_id);
	return $results['name'];
	//print_r($results);die;

}

?>