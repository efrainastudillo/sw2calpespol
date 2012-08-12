<?php

/**
 * Actividad actions.
 *
 * @package    CALPESPOL
 * @subpackage Actividad
 * @author     Andrea Cáceres y Jefferson Rubio
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
  
  public function executeNewactividad(sfWebRequest $request){
      $this->ta=Tipoactividad::getTipoActividadbyMateriaAndParalelo
              ($this->getUser()->getMateriaActual(), $this->getUser()->getParaleloActual());  
              
  }
  
  public function executeNewtipoactividad(sfWebRequest $request){}
  
  public function executeProcess(sfWebRequest $request){
      
    $tiact = $request->getParameter('nombre');
    $tireal = $request->getParameter('realizacion');
    $extra= $request->getParameter('tipo');
    $parcial=$request->getParameter('parcial');
    $grade = $request->getParameter('ponderacion');
      
    //Obteniendo datos de la DB
    $this->c = Doctrine_Query::create()
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
    if (strcmp($tireal, 'Extraordinaria'))
       $newtipoacti ->setEsExtra(1);
    else
       $newtipoacti ->setEsExtra(0);
    //Ingresando datos por default //Preguntar
    /*$newtipoacti ->setTieneFactor1(0);
    $newtipoacti ->setTieneFactor2(0);*/
    //Guardando el tipo actividad en la DB
    $newtipoacti->save();
    $this->getUser()->setFlash('actividad_grabada', 'Tipo Actividad Guardada Exitosamente');
    $this->redirect("Actividad/newactividad");
  }
 
  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request){}

  public function executeCreate(sfWebRequest $request)
  {
      $tipo=$request->getParameter("tipo");
      $descripcion=$request->getParameter("descripcion");
      $fecha_entrega=$request->getParameter("fecha");
     // $this->f=( $fecha_entrega);
      $nota=$request->getParameter("nota");
      $t=Doctrine_Query::create()//esto te devuelve objetos de TipoActividad
              ->from('Tipoactividad ta')
              ->where('ta.idtipoactividad=?',$tipo)
              ->fetchOne();
      $actividad=new Actividad();
      $actividad->setTipoactividad($t);
      $actividad->setNombre($descripcion);
      $actividad->setFechaEntrega($f);
      $actividad->setNota($nota);
      $actividad->save();
       $this->getUser()->setFlash('actividad_grabada', 'Actividad Guardada Exitosamente');
      $this->redirect("Actividad/index");
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->actividad = Doctrine_Query::create()
            ->from('Actividad a')
            ->where('a.idactividad = ?', $request->getParameter("id"))
            ->fetchOne();
    $this->tipo=Tipoactividad::getTipoActividadbyMateriaAndParalelo
              ($this->getUser()->getMateriaActual(), $this->getUser()->getParaleloActual());

    $this->forward404Unless($this->actividad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
      $id=$request->getParameter("id");
      $tipo=$request->getParameter("tipo");
      $descripcion=$request->getParameter("descripcion");
      $fecha_entrega=$request->getParameter("fecha");
     // $this->f=( $fecha_entrega);
      $nota=$request->getParameter("nota");
      $t=Doctrine_Query::create()//esto te devuelve objetos de TipoActividad
              ->from('Tipoactividad ta')
              ->where('ta.idtipoactividad=?',$tipo)
              ->fetchOne();
      $actividad=Doctrine_Query::create()//esto te devuelve objetos de TipoActividad
              ->from('Actividad a')
              ->where('a.idactividad=?',$id)
              ->fetchOne();
      
      $actividad->setNombre($descripcion);     
      $actividad->setTipoactividad($t);
      $actividad->setFechaEntrega($fecha_entrega);
      $actividad->setNota($nota);
      $actividad->save();
      
      $this->getUser()->setFlash('actividad_grabada', 'Actividad Actualizado Exitosamente');
      $this->redirect("Actividad/index");
  }

  public function executeGuardarPdf(sfWebRequest $request){
    //accedemos al parametro html
    $html = $request->getPostParameter('html');
    $mpdf = new mPDF('es_ES','Letter','','',25,25,15,25,16,13);
    $mpdf->useOnlyCoreFonts = true;


    $mpdf->WriteHTML($html,2);

    //Parametro “D” indica que se va a descargar.
    $mpdf->Output('Reporte_Actividades.pdf','D');
    throw new sfStopException();
}

public function executeNuevoTipo(sfWebRequest $request){}

  public function executeDelete(sfWebRequest $request){
      $id=$request->getParameter('id');
      $this->forward404Unless($actividad = Doctrine_Core::getTable('Actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
      $actividad->delete();
      $this->getUser()->setFlash('actividad_grabada', 'Actividad Eliminada Correctamente');
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
  
    /*                      LITERALES                 */ 
  
  public function executeNewliteral(sfWebRequest $request){  
      $this -> id_actividad_literal = $request->getParameter('idActividad');
  }
  
  public function executeSaveLiteral(sfWebRequest $request)
  {
      $item = new Literal();
      $detalle = $request->getParameter('detalle');
      $puntos = $request->getParameter('puntos');
      if($detalle!="" && $puntos!="" && is_string($detalle) && is_int($puntos)){
          $item -> grabarLiteral($request);
      }
      $this -> redirect('Actividad/index');
  }
  
  public function executeDeleteLiteral(sfWebRequest $request)
  {
      $id = $request->getParameter('id');
      $this->forward404Unless($literal = Doctrine_Core::getTable('Literal')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
      $literal -> delete(); 
      $this->getUser() -> setFlash('mensaje', 'Literal Eliminado Correctamente');
      $this->redirect('Actividad/index');
  }
}
