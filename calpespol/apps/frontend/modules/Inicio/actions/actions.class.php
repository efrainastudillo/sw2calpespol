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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->hasSesion()){
        
    }else{
        $this->redirect("Inicio/authentication");
    }
//    $this->client = new  SoapClient("https://www.academico.espol.edu.ec/services/serviceDirectorio.asmx?WSDL");
////    ne
//    
//     $results = (array) ($this->client->usuarioConectado(array("strUsuario" => "ejastudi", "strContrasenia" => "091005371")));
//    $results = (array) ($results['usuarioConectadoResult']);            
//    $r = $this->cleanWSPlanificacion($results['any']);
//    $this->result= $results['any'];
//     $doc = new DOMDocument('1.0', 'utf-8');
//            $doc->loadXML($r);
           // $elements = $doc->getElementsByTagName("MATERIA_PARALELO");

        //   $this->result= "\nSe actualizaran ".$elements->length." cursos.\n";
//        $doc = new DOMDocument();
//              $doc->loadXML($result);
//              //$doc->saveXML();
//             $this->otra=$result;
  }
  private function cleanWSPlanificacion($xmlstr){        
        $results = "<?xml version='1.0' encoding='utf-8'?>" . $xmlstr;
//        $results = str_replace('<xs:schema xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" id="NewDataSet"><xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="MATERIA_PARALELO"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="NOMBREMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/><xs:element name="EXAMENPARCIAL" type="xs:dateTime" minOccurs="0"/><xs:element name="EXAMENFINAL" type="xs:dateTime" minOccurs="0"/><xs:element name="EXAMENMEJORAMIENTO" type="xs:dateTime" minOccurs="0"/><xs:element name="NUMCREDITOS" type="xs:short" minOccurs="0"/><xs:element name="CODUNIDAD" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="PARALELO_PROFESOR"><xs:complexType><xs:sequence><xs:element name="IDENTIFICACION" type="xs:string" minOccurs="0"/><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="PARALELO_ESTUDIANTE"><xs:complexType><xs:sequence><xs:element name="MATRICULA" type="xs:string" minOccurs="0"/><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="HORARIO_PARALELO"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/><xs:element name="NUMDIA" type="xs:string" minOccurs="0"/><xs:element name="HI" type="xs:duration" minOccurs="0"/><xs:element name="HF" type="xs:duration" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="REQUISITOS_MATERIA"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="NUMCREDITOS" type="xs:short" minOccurs="0"/><xs:element name="CODIGOMATREQ" type="xs:string" minOccurs="0"/><xs:element name="NOMBREMATREQ" type="xs:string" minOccurs="0"/><xs:element name="TIPO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1"><NewDataSet xmlns="">', "<NewDataSet>", $results);
//        $results = str_replace('</diffgr:diffgram>', "", $results);
//        $results = str_replace('</InformacionPlanficacionResult>', "", $results);
//        $results = str_replace('</InformacionPlanficacionResponse>', "", $results);
//        $results = str_replace('</soap:Body>', "", $results);
//        $results = str_replace('</soap:Envelope>', "", $results);
//        $results = str_replace('msdata:', "", $results);
//        $results = str_replace('diffgr:', "", $results);
        return $results;
    }
  private function cleanUserDataResult($results) {
        $results = "<?xml version=\"1.0\" encoding=\"utf-8\"?>".$results;
//        $results = str_replace('<xs:schema xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" id="NewDataSet">', "<NewDataSet>", $results);
//        $results = str_replace('<xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="DATOS_USUARIO">', "", $results);
//        $results = str_replace('<xs:complexType><xs:sequence><xs:element name="MATRICULA" type="xs:string" minOccurs="0"/><xs:element name="CEDULA" type="xs:string" minOccurs="0"/><xs:element name="APELLIDOS" type="xs:string" minOccurs="0"/><xs:element name="NOMBRES" type="xs:string" minOccurs="0"/>', "", $results);
//        $results = str_replace('<xs:element name="NOMBRE_COMPLETO" type="xs:string" minOccurs="0"/><xs:element name="UNIDAD" type="xs:string" minOccurs="0"/><xs:element name="ROL" type="xs:string" minOccurs="0"/><xs:element name="CORREO" type="xs:string" minOccurs="0"/><xs:element name="DIRECCION" type="xs:string" minOccurs="0"/><xs:element name="TELEFONO" type="xs:string" minOccurs="0"/>', "", $results);
//        $results = str_replace('<xs:element name="CELULAR" type="xs:string" minOccurs="0"/><xs:element name="SEXO" type="xs:string" minOccurs="0"/><xs:element name="CARRERA" type="xs:string" minOccurs="0"/><xs:element name="ESPECIALIZACION" type="xs:string" minOccurs="0"/><xs:element name="FECHANACIMIENTO" type="xs:string" minOccurs="0"/><xs:element name="PROMEDIO" type="xs:decimal" minOccurs="0"/><xs:element name="MATERIASAPROBADAS" type="xs:int" minOccurs="0"/><xs:element name="LASTCHANGED" type="xs:dateTime" minOccurs="0"/></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1">', "", $results);
//        $results = str_replace('<NewDataSet xmlns="">', "", $results);
//        $results = str_replace('</diffgr:diffgram>', "", $results);
//        $results = str_replace('diffgr:id="DATOS_USUARIO1"', "", $results);
//        $results = str_replace('msdata:rowOrder="0"', "", $results);
        return $results;
  }
  
  public function executeLogin(sfWebRequest $request){
      //new SoapClient();
//      $selogueo=$this->getUser()->userLogin($request);
//      if($selogueo){
//          // $this->getUser()->setAttribute('user','Efrain Astudillo');
//      }
//      $this->redirect("Inicio/index");
  }
  
  public function executeLogout(sfWebRequest $request){
      $this->getUser()->setAttribute('user',null);
      $this->redirect("Inicio/index");
  }
  
  public function executeAuthentication(sfWebRequest $request)
 {
     $this->matricula="";
      $handler = new WSDLHandler();
      $handler->initDirectorioEspolHandler();

      $user = $request->getParameter("sfUserId");
      $password = $request->getParameter("sfPass");

      if(isset($user) && isset($password)) {

          $exists = $handler->authenticate($user, $password);

          if(isset($exists) && $exists) {
              $results = $handler->userData($user, $password);
              $this->unavariable="SE logueo";
              $doc = new DOMDocument();
              $doc->loadXML($results);
              //$doc->saveXML();
             $this->otra=$results;
             $this->elements = $doc->getElementsByTagName("DATOS_USUARIO");
             $this->node = $this->elements->item(0);
             $this->matricula=$this->node->getElementsByTagName("MATRICULA")->item(0)->nodeValue ;
             //$this->getUser()->setSesion($this->matricula);
//              if($this->elements->length>0) {
//                  $node = $this->elements->item(0);
//                  $this->matricula = $node->getElementsByTagName("MATRICULA")->length!=0 ? $node->getElementsByTagName("MATRICULA")->item(0)->nodeValue : "";
////                  
////                  $this->getRequest()->setParameter('matricula', $matricula);
////                  $this->getRequest()->setParameter('internal', true);
                //$this->redirect("Inicio/index");
//              }
                $message = array(
              "error" => "succes"
              );
    //          $message["error"] = "Petición sin usuario y contraseña";
              $this->getResponse()->setHttpHeader('Content-type', 'application/json');
              return $this->renderText(json_encode($message));
          } else {
              $message = array(
              "error" => "Contrasenia o Usuario equivocado"
          );
          $this->getResponse()->setHttpHeader('Content-type', 'application/json');
          return $this->renderText(json_encode($message));
               $this->unavariable="NO SE logueo";
          }
          
      } else {
          $message = array(
              "error" => "Petición sin usuario y contraseña"
          );
          $this->getResponse()->setHttpHeader('Content-type', 'application/json');
          return $this->renderText(json_encode($message));
      }


      
 }

}
