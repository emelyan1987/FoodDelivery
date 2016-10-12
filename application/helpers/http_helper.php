<?PHP

    function getHttpErrorStatus($code){
        $status = REST_Controller::HTTP_BAD_REQUEST;

        switch ($code) {
            case RESULT_ERROR_ID_REQUIRED:
            case RESULT_ERROR_PARAMS_INVALID:
                $status = REST_Controller::HTTP_BAD_REQUEST;
                break;
            case RESULT_ERROR_NOT_FOUND:
                $status =  REST_Controller::HTTP_NOT_FOUND;
                break;
        }

        return $status;
    }


?>