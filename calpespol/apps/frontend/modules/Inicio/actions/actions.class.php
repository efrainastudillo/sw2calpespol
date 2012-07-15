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
//      $handler = new WSDLHandler();
//      $handler->initWSSAACHandler();
//      $this->variable=$handler->scheduler("200801033");
      $primera=date("13/01/2013");
      $this->fecha=$primera;
      $segunda="18/10/2012";
      $tercera="14/01/2013";
        $result=Utility::fechaEstaEnRango($primera, $segunda, $tercera);
        if($result){
            $this->variable="Esta en el rango";
        }  
        else if(!$result){
             $this->variable="NO Esta en el rango";
        }
        else{
            $this->variable="ERROR";
        }
      
//      $this->client = new SoapClient("https://www.academico.espol.edu.ec/Services/wsSAAC.asmx?WSDL", array());
//      $results = (array) ($this->client->InfoProfesoresEstudiantesIds(array("anio" => 2012, "termino" => 1)));
//            $results = (array) ($results['InfoProfesoresEstudiantesIdsResult']);
//            $results = $this->cleanWSUsuarios($results['any']);
//            $this->variable=$results;
//            
      //$this->results = $this->cleanWSPlanificacion($this->results['any']);
  }
  private function cleanWSUsuarios($xmlstr){        
        /*$results = "<?xml version='1.0' encoding='utf-8'?>" . $xmlstr;*/
        $results = $xmlstr;
        /*$results = str_replace('<xs:schema id="NewDataSet" xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata"><xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="PROFESOR"><xs:complexType><xs:sequence><xs:element name="IDENTIFICACION" type="xs:string" minOccurs="0" /><xs:element name="NOMBRE_COMPLETO" type="xs:string" minOccurs="0" /><xs:element name="FACULTAD" type="xs:string" minOccurs="0" /></xs:sequence></xs:complexType></xs:element><xs:element name="ESTUDIANTE"><xs:complexType><xs:sequence><xs:element name="MATRICULA" type="xs:string" minOccurs="0" /></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1"><NewDataSet xmlns="">', "<NewDataSet>", $results);*/
        $results = str_replace('<NewDataSet xmlns="">', "<NewDataSet>", $results);
        $results = str_replace('</diffgr:diffgram>', "", $results);
        $results = str_replace('</InfoProfesoresEstudiantesIdsResult>', "", $results);
        $results = str_replace('</InfoProfesoresEstudiantesIdsResponse>', "", $results);
        $results = str_replace('</soap:Body>', "", $results);
        $results = str_replace('</soap:Envelope>', "", $results);
        $results = str_replace('msdata:', "", $results);
        $results = str_replace('diffgr:', "", $results);
        $results = substr($results,strpos($results,"<NewDataSet>"),strlen($results));
        return $results;
    }
 private function cleanWSPlanificacion($xmlstr){        
        $results = "<?xml version='1.0' encoding='utf-8'?>" . $xmlstr;
        $results = str_replace('<xs:schema xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" id="NewDataSet"><xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="MATERIA_PARALELO"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="NOMBREMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/><xs:element name="EXAMENPARCIAL" type="xs:dateTime" minOccurs="0"/><xs:element name="EXAMENFINAL" type="xs:dateTime" minOccurs="0"/><xs:element name="EXAMENMEJORAMIENTO" type="xs:dateTime" minOccurs="0"/><xs:element name="NUMCREDITOS" type="xs:short" minOccurs="0"/><xs:element name="CODUNIDAD" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="PARALELO_PROFESOR"><xs:complexType><xs:sequence><xs:element name="IDENTIFICACION" type="xs:string" minOccurs="0"/><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="PARALELO_ESTUDIANTE"><xs:complexType><xs:sequence><xs:element name="MATRICULA" type="xs:string" minOccurs="0"/><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="HORARIO_PARALELO"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/><xs:element name="NUMDIA" type="xs:string" minOccurs="0"/><xs:element name="HI" type="xs:duration" minOccurs="0"/><xs:element name="HF" type="xs:duration" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="REQUISITOS_MATERIA"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="NUMCREDITOS" type="xs:short" minOccurs="0"/><xs:element name="CODIGOMATREQ" type="xs:string" minOccurs="0"/><xs:element name="NOMBREMATREQ" type="xs:string" minOccurs="0"/><xs:element name="TIPO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1"><NewDataSet xmlns="">', "<NewDataSet>", $results);
        $results = str_replace('</diffgr:diffgram>', "", $results);
        $results = str_replace('</InformacionPlanficacionResult>', "", $results);
        $results = str_replace('</InformacionPlanficacionResponse>', "", $results);
        $results = str_replace('</soap:Body>', "", $results);
        $results = str_replace('</soap:Envelope>', "", $results);
        $results = str_replace('msdata:', "", $results);
        $results = str_replace('diffgr:', "", $results);
        return $results;
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
            
            $results = $handler->userData($user, $password);
            $doc = new DOMDocument();
            $doc->loadXML($results);
            $elements = $doc->getElementsByTagName("DATOS_USUARIO");
            $node = $elements->item(0);
            $matricula=$node->getElementsByTagName("MATRICULA")->item(0)->nodeValue ;
            $nombres=$node->getElementsByTagName("NOMBRES")->item(0)->nodeValue ;
            $apellidos=$node->getElementsByTagName("APELLIDOS")->item(0)->nodeValue ;
            $mail=$node->getElementsByTagName("CORREO")->item(0)->nodeValue ;
            $userEspol=$user;
            $usuario=new Usuario();
            $usuario->setNombre($nombres);
            $usuario->setApellido($apellidos);
            $usuario->setMail($mail);
            $usuario->setUsuarioEspol($userEspol);
            $usuario->setMatricula($matricula);
            $usuario->save();
            
            return true;

        } else {
            return false;
        }
     }

}
