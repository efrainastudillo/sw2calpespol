<?php

class myUser extends sfBasicSecurityUser
{
    public function getFullName(){

        if($this->getAttribute('usuario')=="")
                return 'Anónimo';

         $usuario = $this->getUserDB();

        if($usuario)
        return $usuario->getNombres()." ".$usuario->getApellidos();
        return $this->getAttribute('usuario') . " <Usuario desconocido>";
    }

    public function userLogin(sfWebRequest $request){
        $query = Doctrine_Query::create()
          ->from('UsuarioBase u')
          ->where('u.usuario = ?', $request->getParameter("usuario"))
          ->andWhere('u.password = ?', $request->getParameter("password"));
         $result=$query->execute();
         
        if($result->count()==0){
            return false;
        }
         else {
            $this->setAttribute('user',$result[0]->getUsuario());
            $this->setAuthenticated(true);
            return true;
        }
    }
   
    public function getUserDB(){
          $usuario = Doctrine_Core::getTable('Usuario')
            ->createQuery('u')
            ->where('u.nombre_usuario= ?', $this->getAttribute('usuario'))
            ->andWhere('u.activo = true')
            ->fetchOne();

        return $usuario;

    }
    public function getNombre(){
        return $this->getAttribute('user');
    }
//  static public function isFirstRequest( $boolean = null)
//  {
//    if (is_null($boolean))
//    {
//      return $this->getAttribute('first_request', true);
//    }
//    else
//    {
//      $this->setAttribute('first_request', $boolean);
//    }
//  }
// 
   public function setSesion($us)
  {
    $ids = $this->getAttribute('user');
 
    if (is_null($ids))
    {
      $this->setAttribute('user',$us);
      $this->setAuthenticated(true);
    }
  }
  public function hasSesion(){
      $ids = $this->getAttribute('user');
      if (is_null($ids))
        {
          return false;
        }else{
            return true;
        }
  }
//  static public function getSesion()
//  {
//    $ids = $this->getAttribute('user');
// 
//    if (is_null($ids))
//    {
//      return new UsuarioBase();
//    }else{
//        return $ids instanceof UsuarioBase;
//    }
//  }
}
