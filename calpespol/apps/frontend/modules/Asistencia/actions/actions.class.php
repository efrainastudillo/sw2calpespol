<?php

/**
 * Asistencia actions.
 *
 * @package    CALPESPOL
 * @subpackage Asistencia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AsistenciaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $fecha=$request->getParameter("fecha");
      $f= date_create($fecha);
      $this->asistencias=Asistencia::getAsistenciasByFecha(
              $this->getUser()->getMateriaActual(), $this->getUser()->getParaleloActual(), $fecha);
      if($this->asistencias->count()==0){
          $this->getUser()->setFlash('mensaje','No Existe Asistencias para la Fecha dada >> '.date_format($f, 'l jS F Y'));
      }
      else{
          $this->getUser()->setFlash('mensaje','');
      }
  }
  
  public function executeNewasistencia(sfWebRequest $request){
      $this->estudiantes=Usuario::getEstudiantesByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
  }
}
