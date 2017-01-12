<?PHP
    function getPoint($carts, $user_id, $service_type, $restro_id, $location_id, $cartIds=null) {  
        $CI = & get_instance();
        
        $total_amount = 0; 
        $loyalty_gained_points = 0;
        foreach($carts as $cart) {
            $total_amount += $cart->price * $cart->quantity;
            $item = $CI->RestroItemModel->findById($cart->product_id);    
            $loyalty_gained_points += $item->redeem_point * $cart->quantity;
        }
        // Calculate Loyalty Point 
        $user_profile = $CI->UserProfileModel->findByUserId($user_id);
        $user_loyalty_points = $user_profile->points;
        $loyalty_point = $CI->LoyaltyPointModel->findOne(array(
            "restro_id"     => $restro_id,
            "location_id"   => $location_id,
            "service_id"    => $service_type
        ));
        $loyalty_discount = 0; $loyalty_used_points = 0;  
        if($loyalty_point) {
            if($user_loyalty_points >= $loyalty_point->from1) {
                $loyalty_discount = $loyalty_point->discount1;
                $loyalty_used_points = $loyalty_point->from1;
            }
            if($user_loyalty_points >= $loyalty_point->from2 && $loyalty_discount < $loyalty_point->discount2) {
                $loyalty_discount = $loyalty_point->discount2;
                $loyalty_used_points = $loyalty_point->from2;
            }
            if($user_loyalty_points >= $loyalty_point->from3 && $loyalty_discount < $loyalty_point->discount3) {
                $loyalty_discount = $loyalty_point->discount3;
                $loyalty_used_points = $loyalty_point->from3;
            }
        }
        $loyalty_discount_amount = $total_amount * $loyalty_discount / 100;
        // Calculate Mataam Point
        $user_profile = $CI->UserProfileModel->findByUserId($user_id);
        $user_mataam_points = $user_profile->mataam_points;
        $mataam_point = $CI->MataamPointModel->findByServiceId($service_type);                    
        $mataam_discount = 0; $mataam_used_points = 0; $mataam_gained_points = 0;
        if($mataam_point) {                
            if($user_mataam_points >= $mataam_point->from) {
                $mataam_discount = $mataam_point->discount;
                $mataam_used_points = $mataam_point->from;    
            }
            if($mataam_point->amount > 0) {
                $mataam_gained_points = round(($total_amount / $mataam_point->amount) * $mataam_point->point);
            }
        }
        $mataam_discount_amount = ($total_amount * $mataam_discount) / 100;
        $result = array(
            'loyalty'=>array(
                'gained_points'     => $loyalty_gained_points, 
                'used_points'       => $loyalty_used_points,
                'discount_amount'   => $loyalty_discount_amount,
                'balance'           => $user_loyalty_points
            ), 
            'mataam'=>array(
                'gained_points'     => $mataam_gained_points, 
                'used_points'       => $mataam_used_points,
                'discount_amount'   => $mataam_discount_amount,
                'balance'           => $user_mataam_points
            )
        );
        return $result;
    }

    function getMataamPoint($user_id, $service_type, $restro_id, $location_id, $total_amount) {  
        $CI = & get_instance();                     

        // Calculate Mataam Point
        $user_profile = $CI->UserProfileModel->findByUserId($user_id);
        $user_mataam_points = $user_profile->mataam_points;
        $mataam_point = $CI->MataamPointModel->findByServiceId($service_type);                    
        $mataam_discount = 0; $mataam_used_points = 0; $mataam_gained_points = 0;
        if($mataam_point) {                
            if($user_mataam_points >= $mataam_point->from) {
                $mataam_discount = $mataam_point->discount;
                $mataam_used_points = $mataam_point->from;    
            }
            if($mataam_point->amount > 0) {
                $mataam_gained_points = round(($total_amount / $mataam_point->amount) * $mataam_point->point);
            }
        }
        $mataam_discount_amount = ($total_amount * $mataam_discount) / 100;
        $result = array(
            'gained_points'     => $mataam_gained_points, 
            'used_points'       => $mataam_used_points,
            'discount_amount'   => $mataam_discount_amount,
            'balance'           => $user_mataam_points
        );
        return $result;
    }

    function getSum($carts, $service_type, $restro_id, $location_id, $area_id=null) {                       
        $CI = & get_instance();   
        
        $total_amount = 0; 
        foreach($carts as $cart) {
            $total_amount += $cart->subtotal;
        }
        $result = array('total_amount'=>$total_amount);
        if(($service_type==1 || $service_type==2) && $area_id) { // service type is "DELIVERY" or "CATERING"      
            $charge_amount = $CI->RestroCityAreaModel->getCharge($restro_id, $location_id, $area_id, $service_type);
            $result = array_merge($result, array('charge_amount'=>$charge_amount));
        }
        return $result;
    }

    function getDiscount($carts, $redeem_type, $user_id, $service_type, $restro_id, $location_id, $coupon_code) {
        $CI = & get_instance();                     
        
        
        $total_amount = 0; 
        foreach($carts as $cart) {
            $total_amount += $cart->price * $cart->quantity;
        }
        if($redeem_type == 1) { // Coupon
            $coupon = $CI->CouponModel->findOne(array(
                "coupon_code"   => $coupon_code, 
                "location_id"   => $location_id, 
                "restro_id"     => $restro_id
            ));
            if(!$coupon) {
                throw new Exception($CI->lang->line('coupon_code_invalid'), RESULT_ERROR_PARAMS_INVALID);
            }
            if($coupon->from_date != '')
            {
                $today = date('Y-m-d');
                if($today >= $coupon->from_date && $today <= $coupon->to_date)
                {                                 
                    return array('discount_amount'=>($total_amount * $coupon->discount) / 100);
                } else {
                    throw new ApiException($CI->lang->line('coupon_code_expired'), RESULT_ERROR_PARAMS_INVALID, "coupon_code");
                }
            } else {
                throw new ApiException($CI->lang->line('paramter_invalid'), RESULT_ERROR_PARAMS_INVALID, "coupon_code");
            }
        } else if($redeem_type == 2) {  // Loyalty Point
            // Calculate Loyalty Point 
            $user_profile = $CI->UserProfileModel->findByUserId($user_id);
            $user_points = $user_profile->points;
            $loyalty_point = $CI->LoyaltyPointModel->findOne(array(
                "restro_id"     => $restro_id,
                "location_id"   => $location_id,
                "service_id"    => $service_type
            ));
            $discount = 0;  
            if($loyalty_point) {
                if($user_points >= $loyalty_point->from1) {
                    $discount = $loyalty_point->discount1;
                }
                if($user_points >= $loyalty_point->from2 && $discount < $loyalty_point->discount2) {
                    $discount = $loyalty_point->discount2;
                }
                if($user_points >= $loyalty_point->from3 && $discount < $loyalty_point->discount3) {
                    $discount = $loyalty_point->discount3;
                }
            }
            return array('discount_amount'=>($total_amount * $discount) / 100);
        } else if($redeem_type == 3) {  // Mataam Point
            // Calculate Mataam Point
            $user_profile = $CI->UserProfileModel->findByUserId($user_id);
            $user_points = $user_profile->mataam_points;
            $mataam_point = $CI->MataamPointModel->findByServiceId($service_type);                    
            $discount = 0; 
            if($mataam_point) {                
                if($user_points >= $mataam_point->from) {
                    $discount = $mataam_point->discount;   
                }
            }
            return array('discount_amount'=>($total_amount * $discount) / 100);
        } else {
            return array('discount_amount'=>0);
        }
    }


    function getSeatingInfo($restro_id, $location_id, $weekday, $reserve_time) {
        $CI = & get_instance();                     
        $seating_infos = $CI->RestroSeatingHourModel->find(array(
            'restro_id'     => $restro_id,
            'location_id'   => $location_id   
        )); //echo json_encode($seating_infos);
        $seating_info = null;

        $time = strtotime($reserve_time);
        foreach($seating_infos as $item) {
            $from_time = strtotime($item->{$weekday.'_from'});
            $to_time = strtotime($item->{$weekday.'_to'});

            if($time>=$from_time && $time<=$to_time) {
                $seating_info = array(
                    'from'=>$item->{$weekday.'_from'},
                    'to'=>$item->{$weekday.'_to'},
                    'max_cover'=>$item->{$weekday.'_max_cover'},
                    'largest_party_size'=>$item->{$weekday.'_largest_party_size'},
                    'booking_limit'=>$item->{$weekday.'_booking_limit'},
                    'cover_count'=>$item->{$weekday.'_cover_count'},
                    'point'=>$item->{$weekday.'_point'},
                    'deposit'=>$item->{$weekday.'_deposit'}
                );
                return $seating_info;  
            }
        }

        return null;
    }

    function getTimeSlots($restro_id, $location_id, $reserve_time, $people_number) {
        if($reserve_time < time()) return null;
        $CI = & get_instance();                     
        $CI->load->model('RestroSeatingHourModel');
        $CI->load->model('RestroTableOrderModel');
        
        $weekday = strtolower(date('l', $reserve_time));
        $seating_infos = $CI->RestroSeatingHourModel->find(array(
            'restro_id'     => $restro_id,
            'location_id'   => $location_id   
        ));
        $times = array();
        foreach($seating_infos as $item) {
            $from_time = $item->{$weekday.'_from'};
            $to_time = $item->{$weekday.'_to'};
            if($from_time!=''&&$to_time!='') {
                $from_time = strtotime($from_time);
                $to_time = strtotime($to_time);
                $interval = $item->{$weekday.'_booking_limit'}?$item->{$weekday.'_booking_limit'}:30;
                $min = $interval * 60;
                if($from_time % $min>0) $from_time += ($min - $from_time % $min);
                if($to_time % $min>0) $to_time -= ($min - $to_time % $min);
                for($t=$from_time; $t<=$to_time; $t+=$min) {
                    $times[] = array(
                        'time'=>$t,
                        'seating_info'=>array(
                            'from'=>$item->{$weekday.'_from'},
                            'to'=>$item->{$weekday.'_to'},
                            'max_cover'=>$item->{$weekday.'_max_cover'},
                            'largest_party_size'=>$item->{$weekday.'_largest_party_size'},
                            'booking_limit'=>$item->{$weekday.'_booking_limit'},
                            'cover_count'=>$item->{$weekday.'_cover_count'},
                            'point'=>$item->{$weekday.'_point'},
                            'deposit'=>$item->{$weekday.'_deposit'}
                        )
                    );
                }   
            }
        }
        $time_cnt = count($times);
        if($time_cnt == 0) {
            return null;
        }
        array_sort_by_column($times, 'time');
        $selected_times = array();
        if($time_cnt <= 5) {                        
            $selected_times = $times;
        } else {
            $closest = null; $index = null;
            $r_time = strtotime(date('H:i', $reserve_time));
            foreach ($times as $i=>$t) {
                if ($closest === null || abs($r_time - $closest) > abs($t['time'] - $r_time)) {
                    $closest = $t['time'];
                    $index = $i;
                }
            }                   
            if($index < 2) $index = 0;
            else if($index >= $time_cnt-2) $index = $time_cnt-5;
                else $index -= 2;
            for($i=$index; $i<$index+5; $i++) {
                $selected_times[] = $times[$i];
            }
        }
        $time_slots = array();
        foreach($selected_times as $t) {
            $time_slots[] = array(
                'time'=>date('H:i', $t['time']),
                'available'=>isAvailableTime(date('Y-m-d', $reserve_time), date('H:i', $t['time']), $t['seating_info'], $people_number, $restro_id, $location_id),
                'seating_info'=>$t['seating_info']
            );
        }

        return $time_slots;
    }

    function isAvailableTime($date, $time, $seating_info, $people_number, $restro_id, $location_id) {
        $CI = & get_instance();                     

        $orders = $CI->RestroTableOrderModel->find(array(
            'restro_id'=>$restro_id,
            'location_id'=>$location_id,
            'date'=>$date,
            'from_time'=>$seating_info['from'],
            'to_time'=>$seating_info['to']
        ));
        $table_count = 0; $cover_count = 0;
        foreach($orders as $order) {
            $table_count += $order->table_count;
            if(strtotime($order->time) == strtotime($time)) {
                $cover_count += $order->table_count;
            }
        }
        if($table_count >= $seating_info['max_cover']) return false;
        if($cover_count >= $seating_info['cover_count']) return false;
        $largest_party_size = $seating_info['largest_party_size'];
        if($largest_party_size > 0) {             
            $order_table_count = ($people_number / $largest_party_size) + 1;    
        } else {
            $order_table_count = 1;
        }
        if($cover_count+$order_table_count > $seating_info['cover_count']) return false;
        return true;
    }
?>