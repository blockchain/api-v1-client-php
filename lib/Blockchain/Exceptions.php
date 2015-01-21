<?php

class Blockchain_Error extends Exception {}
class Blockchain_HttpError extends Blockchain_Error {}
class Blockchain_ApiError extends Blockchain_Error {}
class Blockchain_FormatError extends Blockchain_Error {}
class Blockchain_ParameterError extends Blockchain_Error {}
class Blockchain_CredentialsError extends Blockchain_Error {}

function default_exception_handler(Exception $e){
          // show something to the users letting them know something's down
			// hacky fix on maintanence downtime on Jan 21,2015
          echo ("{\"status\":\"error\",\"reason\":\"".substr($e->getMessage(), 0, 50).".\"}");
 }
 
 set_exception_handler("default_exception_handler");


?>