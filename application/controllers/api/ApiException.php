<?php
   class ApiException extends Exception {       
        private $parameter;
        
        function __construct($message, $code, $parameter="")
        {
            parent::__construct($message, $code);           
            
            $this->parameter = $parameter;
        }
        
        function getParameter() {
            return $this->parameter;
        }
   }
           