<?php  

    require 'BaseModel.php';
    class TwilioStatusModel extends BaseModel
    {     

        function __construct()
        {
            parent::__construct('tbl_twilio_status');    
        }
        
}