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
            return $this->helper->msgSuccess( $this->lang->t("yes")  , 201);

        }
        return $this->helper->msgError( $this->lang->t("json_invalid") );
    }
    public function updateAction($oid){

        $msg  = $this->lang->t("json_invalid") ;
        $json = $this->request->getJsonRawBody();
        if( !empty( $json ) ){
            $author = Author::findById($oid);
            if( !empty( $author ) ){
                $author->name = $json->name;
                $author->address = $json->address;
                $author->phone = $json->phone;
                $author->dob = $json->dob;
                $author->save();
                return $this->helper->msgSuccess( $this->lang->t("yes")  );
            } else {
                $msg = $this->lang->t("register_not_found");
            }

        }
        return $this->helper->msgError($msg);
    }
    public function deleteAction($oid){

        $author = Author::findById($oid);
        if( !empty( $author ) ){
            if( $author->delete() ) {
                return $this->helper->msgSuccess('OK');
            } else {
                $msg = $this->lang->t("ops_delete");;
            }
        } else {
            $msg = $this->lang->t("json_invalid");
        }

        return $this->helper->msgError($msg);

    }

}
