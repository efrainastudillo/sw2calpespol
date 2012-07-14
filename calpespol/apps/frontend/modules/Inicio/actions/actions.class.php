<?php

/**
 * Inicio actions.
 *
 * @package    CALPESPOL
 * @subpackage Inicio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InicioActions extends sfActions
{
   var $matricula="";
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->hasSesion()){
        
    }else{
        //$this->redirect("Inicio/index");
    }
  }

  
  public function executeLogin(sfWebRequest $request){
      $this->mensaje="";
     // $this->estilo="visible";

      $user = $request->getParameter("userID");
      $password = $request->getParameter("userPASS");
      if(isset($user) && isset ($password)){
          $estado=$this->getAuthentication($user, $password);
          if(is_bool($estado) && $estado){
              $this->forward("Inicio", "index");
          }
        
      }else{
         
      }
  }
  
  public function executeLogout(sfWebRequest $request){
      $this->getUser()->logout();
      $this->redirect("Inicio/login");
  }
  
//  public function executeAuthentication(sfWebRequest $request)
// {
//      $this->matricula="Algo";
//      $handler = new WSDLHandler();
//      $handler->initDirectorioEspolHandler();
//
//      $user = $request->getParameter("sfUserId");
//      $password = $request->getParameter("sfPass");
// 
//      if(isset($user) && isset($password)) {
//
//          $exists = $handler->authenticate($user, $password);
//
//          if(isset($exists) && $exists) {
//              $results = $handler->userData($user, $password);
//              $this->unavariable="SE logueo";
//              $doc = new DOMDocument();
//              $doc->loadXML($results);
//              //$doc->saveXML();
//             $this->otra=$results;
//             $this->elements = $doc->getElementsByTagName("DATOS_USUARIO");
//             $this->node = $this->elements->item(0);
//             $this->matricula=$this->node->getElementsByTagName("MATRICULA")->item(0)->nodeValue ;
//             //$this->getUser()->setSesion($this->matricula);
////              if($this->elements->length>0) {
////                  $node = $this->elements->item(0);
////                  $this->matricula = $node->getElementsByTagName("MATRICULA")->length!=0 ? $node->getElementsByTagName("MATRICULA")->item(0)->nodeValue : "";
//////                  
//////                  $this->getRequest()->setParameter('matricula', $matricula);
//////                  $this->getRequest()->setParameter('internal', true);
//               // $this->redirect("Inicio/index");
////              }
//                $message = array(
//              "error" => "succes"
//              );
//    //          $message["error"] = "Petición sin usuario y contraseña";
//              $this->getResponse()->setHttpHeader('Content-type', 'application/json');
//              return $this->renderText(json_encode($message));
//              $this->redirect("Inicio/index");
//          } else {
//              $message = array(
//              "error" => "Contrasenia o Usuario equivocado"
//          );
//          $this->getResponse()->setHttpHeader('Content-type', 'application/json');
//          return $this->renderText(json_encode($message));
//               $this->unavariable="NO SE logueo";
//          }
//          
//      } else {
//          $message = array(
//              "error" => "Petición sin usuario y contraseña"
//          );
//          $this->getResponse()->setHttpHeader('Content-type', 'application/json');
//          return $this->renderText(json_encode($message));
//      }
// }
 
 private function getAuthentication($user,$password){
        $handler = new WSDLHandler();
        $handler->initDirectorioEspolHandler();
        $exists = $handler->authenticate($user, $password);
        if(isset($exists) && $exists) {
            $this->getUser()->setUserEspol($user);
            $this->getUser()->setAuthenticated(true);
        //            $results = $handler->userData($user, $password);
        //            $this->unavariable="SE logueo";
        //            $doc = new DOMDocument();
        //            $doc->loadXML($results);
        //            $this->otra=$results;
        //            $this->elements = $doc->getElementsByTagName("DATOS_USUARIO");
        //            $this->node = $this->elements->item(0);
        //            $this->matricula=$this->node->getElementsByTagName("MATRICULA")->item(0)->nodeValue ;
        //$this->getUser()->setSesion($this->matricula);
        //              if($this->elements->length>0) {
        //                  $node = $this->elements->item(0);
        //                  $this->matricula = $node->getElementsByTagName("MATRICULA")->length!=0 ? $node->getElementsByTagName("MATRICULA")->item(0)->nodeValue : "";
        ////                  
        ////                  $this->getRequest()->setParameter('matricula', $matricula);
        ////                  $this->getRequest()->setParameter('internal', true);
        // $this->redirect("Inicio/index");
        //              }
            return true;

        } else {
            return false;
        }
     }

}
