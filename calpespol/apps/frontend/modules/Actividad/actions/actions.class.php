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
//        $this->materias = array();
//        foreach ($this->cursos as $curso) {
//            if(strcasecmp($cursos->getAnio(), $request->getParameter('anio'))&& strcasecmp($cursos->getTermino(), $request->getParameter('termino'))){
//                  $cod_materia = $curso->getIdCodigo();  
//            }
//        }
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
    public function executeParalelo(sfWebRequest $request) {
        $this->materias = Doctrine_Core::getTable('Materia')
                ->createQuery('a')
                ->execute();
        foreach ($this->materias as $materia) 
            if(strcasecmp($materia->getNombre(), $request->getParameter('materia')))
                $cod_materia = $materia->getIdCodigo();
        $this->cursos = Doctrine_Core::getTable('Curso')
                ->createQuery('a')
                ->execute();
        $this->paralelos = array();
        foreach ($this->cursos as $curso) 
            if($curso->getAnio()==$request->getParameter('anio')  &&  $curso->getTermino()==$request->getParameter('termino') && strcasecmp($curso->getIdMateria(),$cod_materia)==0)
                array_push($this->paralelos,$curso);
    }
    
    
  public function executeIndex(sfWebRequest $request)
  {
    $this->q = Doctrine::getTable('Curso')
                ->createQuery('select (id_materia)')
                ->execute();
    $this->a = Doctrine::getTable('Actividad')
            ->createQuery('select (nombre)')
            ->execute();
  }
  
  public function executeCreatenew (sfWebRequest $request){
      $this->ta = Doctrine::getTable('TipoActividad')
            ->createQuery('select (nombre)')
            ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    
    //$this->form = new ActividadForm();
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
