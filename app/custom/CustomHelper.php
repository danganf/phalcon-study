<?php

namespace App\Custom;

class CustomHelper{

    public function dd($array){
        exit( var_dump( $array ) );
    }

    public function msgError($msg){
        return $this->msgJson( [ 'message' => $msg ], 400 );
    }

    public function msgSuccess($msg){
        return $this->msgJson( [ 'message' => $msg ] );
    }

    public function msgJson($array, $code=200)
    {
        //Create a response instance
        $response = new \Phalcon\Http\Response();

        $response->setStatusCode($code);
        $response->setContentType('application/json', 'UTF-8');
        $response->setContent(json_encode($array));

        return $response;
    }

    public function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {

            foreach ( $d as $key => $line ){
                if( $key === '_id' ){
                    $d['_oid'] = (string)$d[$key];
                }
                if( $key !== '_oid' && substr($key,0, 1) === '_' ){
                    unset( $d[$key] );
                }
            }

            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__METHOD__, $d);
        }
        else {
            // Return array
            return $d;
        }
    }

}
