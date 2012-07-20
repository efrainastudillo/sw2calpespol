<?php

/**
 * Actividad actions.
 *
 * @package    CALPESPOL
 * @subpackage Actividad
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ActividadActions extends sfActions{
    
   public function executeMateria(sfWebRequest $request) {
        $this->materia= Doctrine_Core::getTable('Materia')
                ->createQuery('m')
                ->execute();
    }
    
    /**
     * Funcion que ejecuta la Vista Prueba
     * @param sfWebRequest $request
     * @return type
     */
    public function executePrueba(sfWebRequest $request){
    //-- Aquí podríamos ejecutar lo necesario para trabajar con la base de datos,
    //   archivos, arrays, lógica de negocios, etc.
 
    $response.= "<?xml version=\"1.0\"?>\n";
//    $response.= "<response>\n";
//    $response.= "\t<status>1</status>\n";
//    //$message['msg'] = htmlspecialchars(stripslashes($message['msg']));
//    $response.= "\t<opcion>\n";
//    $response.= "\t\t<author>".$request->getParameter("user")."</author>\n";
//    $response.= "\t\t<text>Hola Hello World</text>\n";
//    $response.= "\t</message>\n";	
//
//    $response.= "</response>";
    
    $response.= "<response>\n";
    $response.= "\t<status>1</status>\n";
    //$message['msg'] = htmlspecialchars(stripslashes($message['msg']));
    $response.= "\t<materia>\n";
    $response.= "\t\t<nombre>".$request->getParameter("user")."</nombre>\n";
    $response.= "\t</materia>\n";	

    $response.= "</response>";
    //$this->getResponse()->setContent($response);
    return $this->renderText($response);
    //return sfView::NONE;
    }
   
    
  public function executeIndex(sfWebRequest $request){
      
      //Me da el termino actual
      $termino = Utility::getTermino();  
      //Me devuelve la lista de paralelos del usuario
      $this->q=  Doctrine_Query::create()
          ->select('c.paralelo')
          ->from('Curso c')
          ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
          ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
          ->where('u.usuario_espol=?','alcacere')//este es el usuario espol $this->getUser()->getUserEspol()
          ->andWhere('c.termino =?',$termino)
          ->execute();
//      $nombre = $this->getUser()->getUserEspol();
//      return $nombre;
      
    //Me devuelve la lista de las actividades del usuario
    $this->a = Doctrine_Query::create()
            ->select('a.idactividad')
            ->from('Actividad a')
            ->innerjoin('a.Tipoactividad ta ON a.idactividad = ta.idtipoactividad')
            ->innerjoin('ta.Curso c ON ta.id_curso = c.idcurso')
            ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
            ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
            ->where('u.usuario_espol=?','alcacere')
            ->andwhere('c.termino=?',$termino)
            ->execute();
    
    //Me devuelve la lista de materia
    $this->m = Doctrine::getTable('Materia')
            ->createQuery('select *')
            ->execute();
  }
  
  public function executeNewView(){
     
      $termino = Utility::getTermino();  
      $this->ta=  Doctrine_Query::create()
              ->select('ta.nombre')
              ->from('Tipoactividad ta')
              ->innerjoin('ta.Curso c ON ta.id_curso = c.idcurso')
              ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
              ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
              ->where('u.usuario_espol=?','alcacere') //este es el usuario espol
              ->andWhere('c.termino =?',$termino)
              ->execute();
  }
  

  public function executeNew(sfWebRequest $request){
    $this->form = new ActividadForm();
    $tipoactividad = $request->getParameter("tipoactividad");
    $descrip = $request->getParameter("descripcion");
    $opcion = $request->getParameter("opcion");
    if ($option = "Individual")
        $tipoact->setEsGrupal("0");
    else
        $tipoact->setEsGrupal("1");
    $fecha = $request->getParameter("fecha");
    $ponde = $request->getParameter("ponderacion");
    $para = $request->getParameter("paralelo");
    //Ingresando datos a la tabla actividad
    $actividad = new Actividad();
    $actividad->setNombre($descrip);
    $actividad->setFechaEntrega($fecha);
    //$actividad->save();
    
    //Ingresando datos a la tabla tipo actividad
    $tipoact = new Tipoactividad();
    $tipoact->setNombre($tipoactividad);
    
    $tipoact->setValorPonderacion($ponde);
    $c = Doctrine_Query::create()
                 ->select("*")
                 ->from("Curso m")
                 ->where("m.idcurso=?",1)
                 ->execute();
    $tipoact->setCurso($c[0]);
    $tipoact->save();
    $actividad->setTipoactividad($tipoact);
    $actividad->save();
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ActividadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($actividad = Doctrine_Core::getTable('Actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
    $this->form = new ActividadForm($actividad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($actividad = Doctrine_Core::getTable('Actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
    $this->form = new ActividadForm($actividad);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($actividad = Doctrine_Core::getTable('Actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
    $actividad->delete();

    $this->redirect('Actividad/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $actividad = $form->save();

      $this->redirect('Actividad/edit?id='.$actividad->getId());
    }
  }
}
