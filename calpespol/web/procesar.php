<?php
  
//   $matricula="";
//      $handler = new WSDLHandler();
//      $handler->initDirectorioEspolHandler();
//
//      $user = "ejastudi";
//      $password = "091005371";
//
//      if(isset($user) && isset($password)) {
//
//          $exists = $handler->authenticate($user, $password);
//
//          if(isset($exists) && $exists) {
//              $results = $handler->userData($user, $password);
//              echo "SE logueo";
//              $doc = new DOMDocument();
//              $doc->loadXML($results);
//              //$doc->saveXML();
//             $otra=$results;
//             $elements = $doc->getElementsByTagName("DATOS_USUARIO");
//             $node = $elements->item(0);
//           echo $node->getElementsByTagName("MATRICULA")->item(0)->nodeValue ;
////              if($this->elements->length>0) {
////                  $node = $this->elements->item(0);
////                  $this->matricula = $node->getElementsByTagName("MATRICULA")->length!=0 ? $node->getElementsByTagName("MATRICULA")->item(0)->nodeValue : "";
//////                  
//////                  $this->getRequest()->setParameter('matricula', $matricula);
//////                  $this->getRequest()->setParameter('internal', true);
//////                  $this->forward('Inicio', 'prueba');
////              }
//
//          } else {
////              $message = array();
////              $message["error"] = "El usuario o la contraseña introducidos no son correctos";
////              $this->getResponse()->setHttpHeader('Content-type', 'application/json');
////              return $this->renderText(json_encode($message));
//               echo "NO SE logueo";
//          }
//          
//      } else {
////          $message = array();
////          $message["error"] = "Petición sin usuario y contraseña";
////          $this->getResponse()->setHttpHeader('Content-type', 'application/json');
////          return $this->renderText(json_encode($message));
//      }
    
?>
<a href="frontend_dev.php/Inicio/index">Inicio</a>