<?php

/**
 * Inicio actions.
 *
 * @package    CALPESPOL
 * @subpackage Inicio
 * @author     Efrain Astudillo
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InicioActions extends sfActions
{
 /**
  * Executes index action
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      if($this->getUser()->isAdmin()){
        
      }

     // $this->processForm($request, $this->fecha);
//      $segunda="18/10/2012";
//      $tercera="14/01/2013";
//        $result=Utility::fechaEstaEnRango($primera, $segunda, $tercera);
//        if($result){
           // $this->variable=$request->getOptions();
            //$this->getUser()->setMateriaActual($this->variable);           
  }
  
  /**
   * Ejecuta la sincronizacion de la Aplicacion
   * @param sfWebRequest $request 
   */
  public function executeSincronizar(sfWebRequest $request){
        $handler = new WSDLHandler();
        $handler->initWSSAACHandler();
        $this->variable=$handler->cargarPlanificacion("null", Utility::getAnio(), Utility::getTermino()."S");
        $this->redirect("Inicio/index");
  }

 /**
  * Realiza el Login del Administrador
  * @param sfWebRequest $request 
  */
  public function executeAdminlogin(sfWebRequest $request){
      $user = $request->getParameter("userID");
      $password = $request->getParameter("userPASS");
      if(isset($user) && isset ($password)){    
          //$estado= $this->getAuthentication($user, $password);
              $this->getUser()->setUserEspol("Administrador"); 
               $this->getUser()->setRol("Administrador");
               $this->getUser()->addCredentials("Administrador");
              $this->getUser()->setAuthenticated(true);
              $this->redirect("Inicio/index");
             
      }//fin del if externo
  }
  /**
   * Cambia la materia actual del Usuario del sistema y lo almacena 
   * en la sesion del usuario
   * @param sfWebRequest $request 
   */
  public function executeMateria(sfWebRequest $request){
      
      $this->variable=(isset($_POST['lista_materias'])) ? $_POST['lista_materias'] : '';
      $this->getUser()->setMateriaActual($this->variable);
      
      $modulo=$_POST['modulo'];
      $action=$_POST['accion'];
      $this->redirect($modulo."/".$action);
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
          
          $estado= $this->getAuthentication($user, $password);
 
          if(is_bool($estado) && $estado){//actualiza los datos en la base
              $this->getUser()->setUserEspol($user); 
             // $this->getUser()->setRol($this->getUser()->getUserDB()->getUsuarioCurso()->item(0)->getRolUsuario());
               $this->getUser()->addCredentials("Estudiante","Profesor");
              $this->getUser()->setAuthenticated(true);
              $this->redirect("Inicio/index");
          }else{

              
          }
      }//fin del if externo
  }
  /**
   * Cierra la Sesion y nos redirige a la pagina de Login
   * @param sfWebRequest $request 
   */
  public function executeLogout(sfWebRequest $request){
      $this->getUser()->logout();
      $this->redirect("Inicio/login");
  }
  
   /**
   * El usuario se autentica con el Usuario y password de la Espol si lo logra,
   * lo siguiente que se preguntara es si esta registado en alguna materia de la Espol,
   * Si lo esta lo proximo que se pregunta es SI se encuentra en la base de datos del 
   * Sistema. SI lo esta, retorna TRUE sino crea un Usuario con toda la informacion del 
   * Curso a la que pertenece y retorna TRUE, de alguna otra manera retornara FALSE
   * @param type $user      String
   * @param type $password  String
   * @return type           Boolean
   */
  private function getAuthentication($user,$password){
        //$handler = new WSDLHandler();
        $handler = new WSDLHandler();
        $estado=false;
        //$handler->initDirectorioEspolHandler();
        if(!$handler->initDirectorioEspolHandler()){
            return false;
        }
        $handler2 = new WSDLHandler();
        if(!$handler2->initWSSAACHandler()){
            return false;
        }
        $exists = $handler->authenticate($user, $password);
        if(isset($exists) && $exists) {
            $results = $handler->userData($user, $password);
            $doc = new DOMDocument();
            $doc->loadXML($results);
            $elements = $doc->getElementsByTagName("DATOS_USUARIO");
            $node = $elements->item(0);
            $matricula=$node->getElementsByTagName("MATRICULA") ->length!=0 ?  $node->getElementsByTagName("MATRICULA")->item(0)->nodeValue:"" ;
            $nombres=$node->getElementsByTagName("NOMBRES") ->length!=0 ?  $node->getElementsByTagName("NOMBRES")->item(0)->nodeValue:"" ;
            $apellidos=$node->getElementsByTagName("APELLIDOS")->length!=0 ?   $node->getElementsByTagName("APELLIDOS")->item(0)->nodeValue:"" ;
            $mail=$node->getElementsByTagName("CORREO")  ->length!=0 ? $node->getElementsByTagName("CORREO")->item(0)->nodeValue:"" ;
            $cedula=$node->getElementsByTagName("CEDULA") ->length!=0 ?  $node->getElementsByTagName("CEDULA")->item(0)->nodeValue:"" ;
            if(Usuario::existeUsuario($cedula)){
                if(Usuario::existeUsuario($user)){
                    //ya esta actulizado sus datos
                }else{
                    $usuario_temp=Usuario::getUsuarioByCedula($cedula);
                    $usuario_temp->setNombre($nombres);
                    $usuario_temp->setApellido($apellidos);
                    $usuario_temp->setUsuarioEspol($user);
                    $usuario_temp->setMail($mail);
                    $usuario_temp->setCedula($cedula);
                    $usuario_temp->setMatricula($matricula);
                    $usuario_temp->save();
                    return true;
                }
            }
            $userEspol=$user;
            $results = $handler2->scheduler($matricula);
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc->loadXML($results);
            $elements = $doc->getElementsByTagName("V_MAT_REGISTRADAS");
            for ($i = 0; $i < $elements->length; $i++) {
                $node = $elements->item($i);
                //$idcurso = $node->getElementsByTagName("IDCURSO")->length!=0 ? $node->getElementsByTagName("IDCURSO")->item(0)->nodeValue : "";
                //$profesor = $node->getElementsByTagName("PROFESOR")->length!=0 ? $node->getElementsByTagName("PROFESOR")->item(0)->nodeValue : "";
                //$materia = $node->getElementsByTagName("NOMBREMATERIA")->length!=0 ? $node->getElementsByTagName("NOMBREMATERIA")->item(0)->nodeValue : "";
                $paralelo = $node->getElementsByTagName("PARALELO")->length!=0 ? $node->getElementsByTagName("PARALELO")->item(0)->nodeValue : "";
                $cod_materia = $node->getElementsByTagName("CODIGOMATERIA")->length!=0 ? $node->getElementsByTagName("CODIGOMATERIA")->item(0)->nodeValue : "";
                $temp_materia=Utility::getMateria($cod_materia);
                if($temp_materia->count()==0){
                    continue;
                }else{
                    return true;
                }
            }
            $this->getUser()->setFlash('notice', 'Sus Datos son Correctos pero NO se encuentra Registrado en alguna Materia del Sistema');
            return false;
            
        } else {
            $this->getUser()->setFlash('notice', 'Usuario o Contrasenia son Inválidas');
            return false;
        }
     }//fin la funcion getAuthentication
}
