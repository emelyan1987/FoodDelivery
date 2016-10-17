<?PHP

    function getHttpErrorStatus($code){
        $status = REST_Controller::HTTP_BAD_REQUEST;

        switch ($code) {
            case RESULT_ERROR_ID_REQUIRED:
            case RESULT_ERROR_PARAMS_INVALID:
            case RESULT_ERROR_RESOURCE_NOT_FOUND:
                $status = REST_Controller::HTTP_BAD_REQUEST;
                break;  
        }

        return $status;
    }


?>