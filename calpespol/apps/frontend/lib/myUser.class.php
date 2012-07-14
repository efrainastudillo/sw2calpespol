<?php
/**
 * Objeto myUser que guarda los datos de Sesión de la aplicacion
 * Cuando se quiera guardar algún dato específico en la sesión, se tendrá
 * que crear los getter y setter correspondiente al objeto
 * 
 * @example Guardar el nombre 
 *          public function getNombre(){
 *              return $this->getAttribute('nombre')
 *          }
 *          public function setNombre($nombre){
 *              $this->setAttribute('nombre',$nombre)
 *          }
 * @version 1.0
 * @author Efrain Astudillo 
 */
class myUser extends sfBasicSecurityUser
{
    /**
     *  Devuelve el nombre completo (Nombres y Apellidos) del Usuario actual
     *  de la aplicacion
     * @return type String
     */
    public function getFullName(){
        if($this->getAttribute('nombre_usuario')=="")
                return 'Anónimo';

         $usuario = $this->getUserDB();

        if($usuario)
        return $usuario->getNombres()." ".$usuario->getApellidos();
        return $this->getAttribute('nombre_usuario') . " <Usuario desconocido>";
    }
   
    /**
     *  Obtiene el Usuario de la base de datos correspondiente al nombre 
     * de usuario de la Espol
     * @return type Usuario
     */
    public function getUserDB(){
          $user = Doctrine_Core::getTable('Usuario')
            ->createQuery('u')
            ->where('u.usuario_espol= ?', $this->getUserEspol())
            ->fetchOne();
        return $user;
    }
    
    /**
     * Obtiene el nombre del user de Espol
     * @return type String
     */
    public function getUserEspol(){
        return $this->getAttribute('usuario_espol');
    }
    
    /**
     * Este nombre del Usuario de Espol se lo debe setear al iniciar la sesion
     * @param type $user_espol nombre de usuario de la espol
     */
    public function setUserEspol($user_espol){
        $this->setAttribute('usuario_espol',$user_espol);
    }
    /**
     * Guarda el Objeto Usuario en la sesion
     * @param type $us Usuario
     */
    public function setUsuario($us)
    {
        $ids = $this->getAttribute('usuario');
        if (is_null($ids)){
            $this->setAttribute('usuario',$us);
            $this->setAuthenticated(true);
        }
    }
    
    public function getMaterias(){
        
        $materias=$this->getAttribute("materias");
        if($materias=="" || is_null($materias)){
            return array('No tiene materias');
        }
        else{
            
        }
         $usuario = $this->getUserDB();

        if($usuario)
        return $usuario->getNombres()." ".$usuario->getApellidos();
        return $this->getAttribute('usuario') . " <Usuario desconocido>";
    }
    /**
     * Retorna el Usuario que se encuentra en la Sesion
     * @return type Usuario
     */
    public function getUsuario(){
        return $this->getAttribute('usuario');
        
    }
    
    /**
     *  Si el Usuario se ha logeado correctamente y si se ha almacenado en la
     *  sesion
     *  @return type Boolean
     */
    public function hasSesion(){
      $ids = $this->getAttribute('usuario');
      if (is_null($ids))
        {
          return false;
        }else{
            return true;
        }
  }

  public function logout(){
      $this->setUserEspol(null);
      $this->setUsuario(null);
  }
}
