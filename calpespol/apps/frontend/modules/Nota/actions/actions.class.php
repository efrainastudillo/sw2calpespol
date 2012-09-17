<?php

/**
 * Nota actions.
 *
 * @package    CALPESPOL
 * @subpackage Nota
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NotaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    
    $user=$this->getUser()->getUserDB();
    if(isset ($user) && $user)
        //$this->curso = Curso::getParalelosOfUsuarioByMateria($this->getUser()->getMateriaActual(), $user->getIdusuario());
        $this->curso =  $this->getUser ()->getParalelos();
        $this->usuario = Doctrine_Query::create()
                ->from('Usuario u')
                ->innerJoin('u.UsuarioCurso uc on uc.id_usuario=u.idUsuario')
                ->innerJoin('uc.Curso c on uc.id_curso=c.idCurso')
                ->innerJoin('c.Materia m on c.id_materia=m.idMateria')
                ->innerJoin('uc.Rolusuario ru on uc.id_rol=ru.idrolusuario') 
                ->where('m.nombre=?',$this->getUser()->getMateriaActual())
                ->andWhere('c.anio=?', '2012')
                ->andWhere('c.termino=?', '1')
                ->andWhere('ru.nombre=?', 'Estudiante')
                ->execute();
        
        $this->grupos = Doctrine_Query::create()
                ->from('Grupo g')
                ->innerJoin('g.Estudiantegrupo eg on eg.idgrupo=g.idgrupo')
                ->innerJoin('eg.UsuarioCurso uc on eg.id_estudiante=uc.id_usuario_curso')
                ->innerJoin('uc.Curso c on uc.id_curso = c.idCurso')
                ->innerJoin('c.Materia m on c.id_materia=m.idMateria')
                ->where('m.nombre=?',$this->getUser()->getMateriaActual())
                ->execute();

        $this->tipo_actividad = Doctrine_Query::create()
                ->from('TipoActividad ta')
                ->innerJoin('ta.Curso c on c.idCurso = ta.id_curso')
                ->innerJoin('c.Materia m on c.id_materia = m.idMateria')
                ->where('m.nombre=?',$this->getUser()->getMateriaActual())        
                ->execute();           

        $this->id_tipo_actividad = 
        Tipoactividad::getIdTipoActividadByName($this->getUser()->getMateriaActual(),
                                                $this->getUser()->getTipoActividadActual());
      
        $this->actividad = Doctrine_Query::create()
                ->from('Actividad a')
                ->innerJoin('a.Tipoactividad ta on a.id_tipo_actividad ='.$this->id_tipo_actividad[0]->getIdTipoActividad())
                ->innerJoin('ta.Curso c on ta.id_curso = c.idCurso')
                ->innerJoin('c.Materia m on c.id_materia = m.idMateria')
                ->where('m.nombre=?',$this->getUser()->getMateriaActual())        
                ->execute();

        $this->esgrupal = Doctrine_Query::create()
                ->from('tipoActividad ta')
                ->innerJoin('ta.Curso c ON ta.id_curso = c.idCurso')
                ->innerJoin('c.Materia m ON c.id_materia = m.idMateria')
                ->where('m.nombre=?',$this->getUser()->getMateriaActual())        
                ->execute();

        if($this->actividad->count() < 2){
            $this->literal = 
                Literal::getLiteralesXTipoActividadMateria(
                $this->id_tipo_actividad[0]->getIdTipoActividad(),
                $this->actividad[0]->getNombre(), 
                $this->getUser()->getMateriaActual());
        }else{
            $this->literal = 
                Literal::getLiteralesXTipoActividadMateria(
                $this->id_tipo_actividad[0]->getIdTipoActividad(),
                $this->getUser()->getActividadActual(),
                $this->getUser()->getMateriaActual());
        }
             
    }

  public function executeTiposactividad(sfWebRequest $request){
      $this->variable=(isset($_POST['lista_tipos'])) ? $_POST['lista_tipos'] : '';
      $this->getUser()->setTipoActividadActual($this->variable);
      
      $modulo=$_POST['modulo'];
      $action=$_POST['accion'];
      $this->redirect($modulo."/".$action);
  }
  
  public function executeActividad(sfWebRequest $request){
      $this->variable1=(isset($_POST['lista_actividades'])) ? $_POST['lista_actividades'] : '';
      $this->getUser()->setActividadActual($this->variable1);
      
      $modulo=$_POST['modulo'];
      $action=$_POST['accion'];
      $this->redirect($modulo."/".$action);
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new estudianteliteralForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new estudianteliteralForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($estudianteliteral = Doctrine_Core::getTable('estudianteliteral')->find(array($request->getParameter('id_estudiante'),
         $request->getParameter('idliteral'))), sprintf('Object estudianteliteral does not exist (%s).', $request->getParameter('id_estudiante'),
         $request->getParameter('idliteral')));
    $this->form = new estudianteliteralForm($estudianteliteral);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($estudianteliteral = Doctrine_Core::getTable('estudianteliteral')->find(array($request->getParameter('id_estudiante'),
         $request->getParameter('idliteral'))), sprintf('Object estudianteliteral does not exist (%s).', $request->getParameter('id_estudiante'),
         $request->getParameter('idliteral')));
    $this->form = new estudianteliteralForm($estudianteliteral);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($estudianteliteral = Doctrine_Core::getTable('estudianteliteral')->find(array($request->getParameter('id_estudiante'),
         $request->getParameter('idliteral'))), sprintf('Object estudianteliteral does not exist (%s).', $request->getParameter('id_estudiante'),
         $request->getParameter('idliteral')));
    $estudianteliteral->delete();

    $this->redirect('Nota/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $estudianteliteral = $form->save();

      $this->redirect('Nota/edit?id_estudiante='.$estudianteliteral->getIdEstudiante().'&idliteral='.$estudianteliteral->getIdliteral());
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
        $mpdf->Output('Reporte_Notas.pdf','D');
        throw new sfStopException();
     }
     
     public function executeGuardarNota(sfWebRequest $request){

//         if (!empty($_GET['notas'])){ 
             
            $usuarios = $_GET['usuarios'];
            $literales = $_GET['literales'];
            $notas = $_GET['notas'];
            $calificador = $this->getUser()->getUserEspol();
            $fechaActual = date("Y-m-d");
//        }else{ 
//            $notas = "empty"; 
//        }  
        
        $calificacion = new Estudianteliteral();
        
        for($i=0; $i<count($notas); $i++){
            $calificacion -> grabarNota($usuarios[$i], $literales[$i], $notas[$i], $calificador, $fechaActual);
        }
         
         $this->getUser()->setFlash('nota_grabada', 'Notas Guardadas Exitosamente');
         
         $this -> redirect('Nota/index');
     }
}
