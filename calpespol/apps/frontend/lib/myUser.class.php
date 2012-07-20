<?php
/**
 * Objeto myUser que guarda los datos de Sesión de la aplicacion
 * Cuando se quiera guardar algún dato específico en la sesión, se tendrá
 * que crear los getter y setter correspondiente al objeto
 * 
 * @example Guardar el Nombre 
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
        //si no tiene nigun nombre en la sesion
        if($this->getAttribute('usuario_espol')=="")
                return 'Anónimo';
        //obtiene el Usuario de la base
         $usuario = $this->getUserDB();
         
         //si existe ese Usuario en la base, muestra los nombres y apellidos
        if($usuario)
            return $usuario->getNombre()." ".$usuario->getApellido();
        
        //retorna lo que contenga en la sesion mas Usuario Desconocido
        return $this->getAttribute('usuario_espol') . " <Usuario desconocido>";
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
        $this->setAuthenticated(true);
    }
    /**
     * ESTO NO ES RECOMENDABLE HACER POR EL CONCEPTO DE SERIALIZACION
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
     /**
     * Retorna el Usuario que se encuentra en la Sesion
     * @return type Usuario
     */
    public function getUsuario(){
        return $this->getAttribute('usuario');
        
    }
    
    public function getMaterias(){
        
        $materias=$this->getAttribute("materias");
        if($materias=="" || is_null($materias)){
            return array('No tiene materias');
        }
        else{
            
        }
         $usuario = $this->getUserDB();

        if($usuario){
            return $usuario->getNombres()." ".$usuario->getApellidos();
        }
        return $this->getAttribute('usuario') . " <Usuario desconocido>";
    }

  /**
   * Cierra la sesion 
   */
  public function logout(){
      $this->getAttributeHolder()->clear();
      $this->setAuthenticated(false);
      $this->clearCredentials();
  }
}
