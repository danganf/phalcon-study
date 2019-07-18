<?php

use Phalcon\Mvc\Model\Resultset;

class AuthorsController extends ControllerBase
{
    public function indexAction()
    {
        $results = Author::find([
            "hydration" => Resultset::HYDRATE_OBJECTS,
        ]);
        return $this->helper->msgJson( $this->helper->objectToArray( $results ) );
    }
    public function saveAction(){
        $json = $this->request->getJsonRawBody();
        if( !empty( $json ) ){
            $author          = new Author();
            $author->name    = $json->name;
            $author->address = $json->address;
            $author->phone   = $json->phone;
            $author->dob     = $json->dob;
            $author->save();
            return $this->helper->msgSuccess('OK');

        }
        return $this->helper->msgError('Json invalido');
    }
    public function updateAction($oid){

        $msg  = 'Json invalido';
        $json = $this->request->getJsonRawBody();
        if( !empty( $json ) ){
            $author = Author::findById($oid);
            if( !empty( $author ) ){
                //$this->helper->dd( $this->helper->objectToArray( $author ) );
                $author->name = $json->name;
                $author->address = $json->address;
                $author->phone = $json->phone;
                $author->dob = $json->dob;
                $author->save();
                return $this->helper->msgSuccess('OK');
            } else {
                $msg = 'registro nao encontrado';
            }

        }
        return $this->helper->msgError($msg);
    }

}
