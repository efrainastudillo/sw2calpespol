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
//      $handler = new WSDLHandler();
//      $handler->initWSSAACHandler();
//      $this->variable=$handler->scheduler("200801033");
      $primera=date("13/01/2013");
      $this->fecha=  Utility::getTermino();
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
  }
  /**
   * Vista para hacer Login con el Usuario de la espol
   * @param sfWebRequest $request 
   */
  public function executeLogin(sfWebRequest $request){
      $this->mensaje="";
     // $this->estilo="visible";

      $user = $request->getParameter("userID");
      $password = $request->getParameter("userPASS");
      if(isset($user) && isset ($password)){
          
          $estado=$this->getAuthentication($user, $password);
 
          if(is_bool($estado) && $estado){//actualiza los datos en la base
              $usuario=  Utility::getUsuario($user);
              $this->getUser()->setUserEspol($usuario[0]->getNombre()." ".$usuario[0]->getApellido()); 
              $this->getUser()->setUsuario($usuario);
              $this->getUser()->setAuthenticated(true);
              $this->redirect("Inicio/index");
          }else{

              
          }
      }//fin del if externo
  }
  /**
   *   
   * @param sfWebRequest $request 
   */
  public function executeLogout(sfWebRequest $request){
      $this->getUser()->logout();
      $this->redirect("Inicio/login");
  }
  /**
   *
   * @param type $user
   * @param type $password
   * @return type 
   */
 private function getAuthentication($user,$password){
        $handler = new WSDLHandler();
        $handler->initDirectorioEspolHandler();
        $handler2 = new WSDLHandler();
        $handler2->initWSSAACHandler();
        $exists = $handler->authenticate($user, $password);
        if(isset($exists) && $exists) {                        
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
            
            $results = $handler2->scheduler($matricula);
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc->loadXML($results);
            $elements = $doc->getElementsByTagName("V_MAT_REGISTRADAS");
            for ($i = 0; $i < $elements->length; $i++) {
                $node = $elements->item($i);
                //$idcurso = $node->getElementsByTagName("IDCURSO")->length!=0 ? $node->getElementsByTagName("IDCURSO")->item(0)->nodeValue : "";
//                $profesor = $node->getElementsByTagName("PROFESOR")->length!=0 ? $node->getElementsByTagName("PROFESOR")->item(0)->nodeValue : "";
//                $materia = $node->getElementsByTagName("NOMBREMATERIA")->length!=0 ? $node->getElementsByTagName("NOMBREMATERIA")->item(0)->nodeValue : "";
//                $paralelo = $node->getElementsByTagName("PARALELO")->length!=0 ? $node->getElementsByTagName("PARALELO")->item(0)->nodeValue : "";
                $cod_materia = $node->getElementsByTagName("CODIGOMATERIA")->length!=0 ? $node->getElementsByTagName("CODIGOMATERIA")->item(0)->nodeValue : "";
                $temp_materia=Utility::getMateria($cod_materia);
                if($temp_materia->count()==0){
                    continue;
                }else{
                    //agrego todos los datos correspondientes
//                    $termino=Utility::getTermino();
//                    $curso=new Curso();
//                    $curso->setAnio(date("Y"));
//                    $curso->setParalelo($paralelo);
//                    $curso->setTermino($termino);
//                    $curso->setMateria($temp_materia[0]);
                   // $curso->save();
                    $u=  Utility::getUsuario($userEspol);
                    if($u->count()==0){
                        $usuario=new Usuario();
                        $usuario->setNombre($nombres);
                        $usuario->setApellido($apellidos);
                        $usuario->setMail($mail);
                        $usuario->setUsuarioEspol($userEspol);
                        $usuario->setMatricula($matricula);
                        $usuario->save();
                    }
                    
                    //break;
                    //$usuario->save();
//                    $r=new UsuarioCurso();
//                    $r->setRolusuario(Utility::getRolUsuario("Estudiante"));
//                    $r->setCurso($curso);
//                    $r->setUsuario($usuario);
//                    $r->save();
                    return true;
                }
                $this->getUser()->setFlash('notice', 'Sus Datos son Correctos pero no se encuentra a alguna materia del Sistema');
                return false;
            }
            
        } else {
            $this->getUser()->setFlash('notice', 'Usuario o Contrasenia son Inválidas');
            return false;
        }
     }
}
