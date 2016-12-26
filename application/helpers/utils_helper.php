<?PHP

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }          

    function generateRandomCode($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    }          

    function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }

    function object_array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $obj) {
            $sort_col[$key] = $obj->{$col};
        }

        array_multisort($sort_col, $dir, $arr);
    }

    function humanReadableTime($timestamp)
    {
        // Get time difference and setup arrays
        $difference = time() - $timestamp;
        $periods = array("second", "minute", "hour", "day", "week", "month", "years");
        $lengths = array("60","60","24","7","4.35","12");

        // Past or present
        if ($difference >= 0) 
        {
            $ending = "ago";
        }
        else
        {
            $difference = -$difference;
            $ending = "to go";
        }

        // Figure out difference by looping while less than array length
        // and difference is larger than lengths.
        $arr_len = count($lengths);
        for($j = 0; $j < $arr_len && $difference >= $lengths[$j]; $j++)
        {
            $difference /= $lengths[$j];
        }

        // Round up        
        $difference = round($difference);

        // Make plural if needed
        if($difference != 1) 
        {
            $periods[$j].= "s";
        }

        // Default format
        $text = "$difference $periods[$j] $ending";

        // over 24 hours
        if($j > 2)
        {
            // future date over a day formate with year
            if($ending == "to go")
            {
                if($j == 3 && $difference == 1)
                {
                    $text = "Tomorrow at ". date("g:i a", $timestamp);
                }
                else
                {
                    $text = date("F j, Y \a\\t g:i a", $timestamp);
                }
                return $text;
            }

            if($j == 3 && $difference == 1) // Yesterday
            {
                $text = "Yesterday at ". date("g:i a", $timestamp);
            }
            else if($j == 3) // Less than a week display -- Monday at 5:28pm
            {
                $text = date("l \a\\t g:i a", $timestamp);
            }
            else if($j < 6 && !($j == 5 && $difference == 12)) // Less than a year display -- June 25 at 5:23am
            {
                $text = date("F j \a\\t g:i a", $timestamp);
            }
            else // if over a year or the same month one year ago -- June 30, 2010 at 5:34pm
            {
                $text = date("F j, Y \a\\t g:i a", $timestamp);
            }
        }

        return $text;
    }
    
    function getImageRealPath($image_url, $type){ 
        if(file_exists(FCPATH.$image_url)) return $image_url;
        
        switch($type) {
            case 'user':
                return '/assets/common/image/male.png';
        }
    }
?>