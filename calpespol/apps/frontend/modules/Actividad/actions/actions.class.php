<?php

/**
 * Actividad actions.
 *
 * @package    CALPESPOL
 * @subpackage Actividad
 * @author     Andrea Cáceres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ActividadActions extends sfActions{
    
   public function executeMateria(sfWebRequest $request) {
        $this->materia= Doctrine_Core::getTable('Materia')
                ->createQuery('m')
                ->execute();
    } 
    
  public function executeIndex(sfWebRequest $request){
      
      //Me da el termino actual
      $termino = Utility::getTermino();  
      //Me devuelve la lista de paralelos del usuario de acuerdo a la materia
      //seleccionada <?php echo "<p>".$sf_user->getMateriaActual()."</p>";

      $this->q=  Doctrine_Query::create()
          ->select('c.paralelo')
          ->from('Curso c')
          ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
          ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
          ->innerjoin('c.Materia m ON c.id_materia = m.idmateria')
          ->where('u.usuario_espol=?',$this->getUser()->getUserEspol())//este es el usuario espol $this->getUser()->getUserEspol()
          ->andWhere('c.termino =?',$termino)
          ->andWhere('m.nombre=?',$this->getUser()->getMateriaActual())
          ->execute();
      
    //Me devuelve la lista de las actividades del usuario
    $this->a = Doctrine_Query::create()
            ->select('a.idactividad')
            ->from('Actividad a')
            ->innerjoin('a.Tipoactividad ta ON a.id_tipo_actividad = ta.idtipoactividad')
            ->innerjoin('ta.Curso c ON ta.id_curso = c.idcurso')
            ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
            ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
            ->where('u.usuario_espol=?',$this->getUser()->getUserEspol())
            ->execute();
    
    //Me devuelve la lista de materia del usuario
    $this->m=Doctrine_Query::create()
            ->select('m.idmateria')
            ->from('Materia m')
            ->innerjoin('m.Curso c ON m.idmateria = c.id_materia')
            ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
            ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
            ->where('u.usuario_espol=?',$this->getUser()->getUserEspol())
            ->andwhere('c.termino=?',$termino)
            ->execute();    
  }
  
  public function executeNewView(sfWebRequest $request){
     
      $termino = Utility::getTermino();  
      $this->ta=  Doctrine_Query::create()
              ->select('ta.nombre')
              ->from('Tipoactividad ta')
              ->innerjoin('ta.Curso c ON ta.id_curso = c.idcurso')
              ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
              ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
              ->where('u.usuario_espol=?',$this->getUser()->getUserEspol())
              ->execute();
  }
  
  public function executeActividad(sfWebRequest $request){}
  
  public function executeProcess(sfWebRequest $request){
      //Obteniedo parametros del form
      $this->form = new TipoactividadForm();
      $tiact = $request->getParameter('tipoactividad');
      $tireal = $request->getParameter('tiporealizacion');
      $extra= $request->getParameter('extra');
      $parcial=$request->getParameter('parcial');
      $grade = $request->getParameter('ponderacion');
      
      //Obteniendo datos de la DB
      $this->c = Doctrine_Query::create()
              ->select('c.idcurso')
              ->from('Curso c')
              ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
              ->innerjoin('c.Materia m ON c.id_materia = m.idmateria')
              ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
              ->Where('u.usuario_espol=?',$this->getUser()->getUserEspol())
              ->andWhere('m.nombre=?',$this->getUser()->getMateriaActual())
              ->execute();
     
        //Ingresando los datos a la base
        $newtipoacti = new Tipoactividad();
        $newtipoacti ->setCurso($this->c[0]);
        $newtipoacti ->setNombre($tiact);
        $newtipoacti ->setValorPonderacion($grade);
        $newtipoacti ->setParcial($parcial);
        //Ingresando 0 si es individual o 1 si es grupal
        if (strcmp($tireal, 'Individual'))
            $newtipoacti ->setEsGrupal(1);
        else
            $newtipoacti ->setEsGrupal(0);       
        //Ingresando 0 si es Ordinaria o 1 si es Extra
        if (strcmp($tireal, 'Extra'))
            $newtipoacti ->setEsExtra(1);
        else
            $newtipoacti ->setEsExtra(0);
        //Ingresando datos por default
        $newtipoacti ->setTieneFactor1(0);
        $newtipoacti ->setTieneFactor2(0);
        //Guardando el tipo actividad en la DB
        $newtipoacti->save();   
        $this->redirect("Actividad/index");
        
  }
 

  public function executeNew(sfWebRequest $request){
    //Obteniendo parametros del form
    $this->form = new ActividadForm();
    $idact = $request->getParameter('tipoactivid');
    $nombre = $request->getParameter('descripcion');
    $date = $request->getParameter('fecha');
    $grade = $request->getParameter('nota');
    
    $termino = Utility::getTermino();
    $this->ta=  Doctrine_Query::create()//esto te devuelve objetos de TIpoActividad
              ->select('ta.idtipoactividad')
              ->from('Tipoactividad ta')
              ->innerjoin ('ta.Curso c ON ta.id_curso = idcurso')
              ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
              ->innerjoin('c.Materia m ON c.id_materia = m.idmateria')
              ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
              ->where('ta.nombre =?',$idact)
              ->andWhere('u.usuario_espol=?',$this->getUser()->getUserEspol())
              ->andWhere('m.nombre=?',$this->getUser()->getMateriaActual())
              ->execute();
    
    //Ingresando los datos a la base
    $newact = new Actividad();
    $newact ->setNombre($nombre);
    $newact->setTipoactividad($this->ta[0]);
    $newact ->setFechaEntrega($date);
    $newact ->setNota($grade);
    $newact->save();
    $this->getUser()->setFlash('mensaje', 'Actividad Guardada Exitosamente');
    $this->redirect("Actividad/index");
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
    $this->actividad = Doctrine_Query::create()
            ->select("*")
            ->from('Actividad a')
            ->where('a.idactividad = ?', $request->getParameter("id"))
            ->execute();
    
    $this->ta = Doctrine_Query::create()
          ->select('ta.nombre')
          ->from('TipoActividad ta')
          ->innerjoin('ta.Actividad a ON ta.idtipoactividad = a.id_tipo_actividad')
          ->where('a.idactividad=?',$request->getParameter("id"))
          ->execute();
    
    $this->forward404Unless($this->actividad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
      $id=$request->getParameter("id");
      $ta = Doctrine_Query::create()
              ->select('ta.nombre')
              ->from('TipoActividad ta')
              ->innerjoin('ta.Actividad a ON ta.idtipoactividad = a.id_tipo_actividad')
              ->where('a.idactividad=?',$id)
              ->execute();
      
      $descrip=$request->getParameter("descripcion");
      $date=$request->getParameter("fecha");
      $grade=$request->getParameter("nota");
      
      $actividad = Doctrine_Query::create()
            ->select("*")
            ->from('Actividad a')
            ->where('a.idactividad = ?', $id)
            ->execute();
      $actividad->setNombre($ta);
      $actividad->setApellido($descrip);
      $actividad->setMail($date);
      $actividad->setMatricula($grade);
      $actividad->save();
      $this->getUser()->setFlash('mensaje', 'Actividad Actualizado Exitosamente');
      $this->redirect("Actividad/index");
  }

  public function executeDelete(sfWebRequest $request)
  {
      $id=$request->getParameter('id');
      $this->forward404Unless($actividad = Doctrine_Core::getTable('Actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
      $actividad->delete();
      $this->getUser()->setFlash('mensaje', 'Actividad Eliminada Correctamente');
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
  
    /* LITERALES */ 
  public function executeNewLiteral(sfWebRequest $request){     
  }
  
  public function executeSaveLiteral(sfWebRequest $request)
  {
      $item = new Literal();
      $item -> grabarEstudiante($request);
      $this -> redirect('Actividad/index');
  }
}
