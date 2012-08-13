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

  /**
     * Descripción: Función que me permite crear PDF
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     * @param sfWebRequest $request
     */
     public function executeGuardarPdf(sfWebRequest $request){
        //accedemos al parametro html
        $html = $request->getPostParameter('html');
        $mpdf = new mPDF('es_ES','Letter','','',25,25,15,25,16,13);
        $mpdf->useOnlyCoreFonts = true;


        $mpdf->WriteHTML($html,2);

        //Parametro “D” indica que se va a descargar.
        $mpdf->Output('Reporte_Asistencia.pdf','D');
        throw new sfStopException();
     }

  public function executeNewasistencia(sfWebRequest $request){
      $this->estudiantes=Usuario::getEstudiantesByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
  }

}
