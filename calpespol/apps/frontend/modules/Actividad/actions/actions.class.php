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
    
    /**
     * Descripción: Función que me permite conectarme a la base y obtener la lista de actividades
     * que pertenecen al curso almacenado en sesión.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     * @param sfWebRequest $request
     */
      public function executeIndex(sfWebRequest $request){
          
          //Me da el termino actual
          $termino = Utility::getTermino();  
          //Me devuelve la lista de las actividades del usuario
          $this->a = Doctrine_Query::create()
                ->select('a.idactividad')
                ->from('Actividad a')
                ->innerjoin('a.Tipoactividad ta ON a.id_tipo_actividad = ta.idtipoactividad')
                ->innerjoin('ta.Curso c ON ta.id_curso = c.idcurso')
                ->innerjoin('c.Materia m ON c.id_materia = m.idmateria')
                ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
                ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
                ->Where('u.usuario_espol=?',$this->getUser()->getUserEspol())
                ->andWhere('c.paralelo=?',$this->getUser()->getParaleloActual())
                ->andWhere('m.nombre=?',$this->getUser()->getMateriaActual())
                ->execute();
//          $this->a = Doctrine_Query::create()
//            ->from('Actividad a')
//            ->innerJoin('a.Tipoactividad ta on a.id_tipo_actividad = ta.idtipoactividad')
//            ->innerJoin('ta.Curso c on ta.id_curso = c.idCurso')
//            ->innerJoin('c.Materia m on c.id_materia = m.idMateria')
//            ->where('m.nombre=?',$this->getUser()->getMateriaActual())        
//            ->execute();
      }
      
    /**
     * Descripción: Función que me permite obtener
     * y grupos, que pertenecen al curso almacenado en sesión.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     * @param sfWebRequest $request
     */
     public function executeNewactividad(sfWebRequest $request){
        $this->ta=Tipoactividad::getTipoActividadbyMateriaAndParalelo
            ($this->getUser()->getMateriaActual(), $this->getUser()->getParaleloActual());    
     }
  
     public function executeNewtipoactividad(sfWebRequest $request){}
  
    /**
     * Descripción: Función que me permite ingresar los datos
     * del form a la base da datos.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     *  - Si no ingresa correctamente los datos muestra mensaje de error correspondiente.
     * @param sfWebRequest $request
     */
     public function executeProcess(sfWebRequest $request){
      
        $tiact = $request->getParameter('nombre');
        $tireal = $request->getParameter('realizacion');
        $extra= $request->getParameter('tipo');
        $parcial=$request->getParameter('parcial');
        $grade = $request->getParameter('ponderacion');
        //Obteniendo datos de la DB
        $this->c=Curso::getCursoByParaleloAndMateria
            ($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
        /*$this->c = Doctrine_Query::create()
            ->select ('c.idcurso')
            ->from('Curso c')
            ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
            ->innerjoin('c.Materia m ON c.id_materia = m.idmateria')
            ->innerjoin('uc.Usuario u ON uc.id_usuario = u.idusuario')
            ->Where('u.usuario_espol=?',$this->getUser()->getUserEspol())
            ->andWhere('c.paralelo=?',$this->getUser()->getParaleloActual())
            ->andWhere('m.nombre=?',$this->getUser()->getMateriaActual())
            ->execute();*/
        //Ingresando los datos a la base
        $newtipoacti = new Tipoactividad();
        $newtipoacti ->setCurso($this->c);
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
  
    /**
     * Descripción: Función que me permite ingresar los datos
     * del form a la base da datos.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     *  - Si no ingresa correctamente los datos muestra mensaje de error correspondiente.
     * @param sfWebRequest $request
     */
     public function executeCreate(sfWebRequest $request){
        $tipo = $request->getParameter("tipo");
        $descripcion = $request->getParameter("descripcion");
        $fecha_entrega = explode("-",$request->getParameter("fecha"));

        //descomponer fecha_entrega en dia, mes y anio para cambiar al formato de la base
        $anio_fecha_entrega = $fecha_entrega[0];
        $mes_fecha_entrega = $fecha_entrega[1];
        $dia_fecha_entrega = $fecha_entrega[2];
        $nueva_fecha_entrega = $anio_fecha_entrega.'-'.$mes_fecha_entrega.'-'.$dia_fecha_entrega;

        $nota=$request->getParameter("nota");
        $t=Doctrine_Query::create()//esto te devuelve objetos de TipoActividad
              ->from('Tipoactividad ta')
              ->where('ta.idtipoactividad=?',$tipo)
              ->fetchOne();
        $actividad=new Actividad();
        $actividad->setTipoactividad($t);
        $actividad->setNombre($descripcion);
        $actividad->setFechaEntrega($nueva_fecha_entrega);
        $actividad->setNota(0);
        //$actividad->setNota($nota);
        $actividad->save();

        $this->getUser()->setFlash('actividad_grabada', 'Actividad Guardada Exitosamente');

        $this->redirect("Actividad/index");
      }
      
    /**
     * Descripción: Función que me permite editar e ingresar los datos
     * del form a la base da datos.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     *  - Si no ingresa correctamente los datos muestra mensaje de error correspondiente.
     * @param sfWebRequest $request
     */
     public function executeEdit(sfWebRequest $request){
        $this->actividad = Doctrine_Query::create()
                ->from('Actividad a')
                ->where('a.idactividad = ?', $request->getParameter("id"))
                ->fetchOne();

        $this->tipo=Tipoactividad::getTipoActividadbyMateriaAndParalelo
                  ($this->getUser()->getMateriaActual(), $this->getUser()->getParaleloActual());

        $this->forward404Unless($this->actividad);
     }

    /**
     * Descripción: Función que me permite actualizar los datos de una actividad
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     *  - Si no ingresa correctamente los datos muestra mensaje de error correspondiente.
     * @param sfWebRequest $request
     */
  public function executeUpdate(sfWebRequest $request){
      $id=$request->getParameter("id");
      $tipo=$request->getParameter("tipo");
      $descripcion=$request->getParameter("descripcion");
      $fecha_entrega = explode("/",$request->getParameter("fecha"));
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
      //descomponer fecha_entrega en dia, mes y anio para cambiar al formato de la base
      $anio_fecha_entrega = $fecha_entrega[2];
      $mes_fecha_entrega = $fecha_entrega[0];
      $dia_fecha_entrega = $fecha_entrega[1];
      $nueva_fecha_entrega = $anio_fecha_entrega.'-'.$mes_fecha_entrega.'-'.$dia_fecha_entrega;
      
      $actividad->setNombre($descripcion);     
      $actividad->setTipoactividad($t);
      $actividad->setFechaEntrega($nueva_fecha_entrega);
      $actividad->setNota(0);
      //$actividad->setNota($nota);
      $actividad->save();
      
      $this->getUser()->setFlash('actividad_grabada', 'Actividad Actualizado Exitosamente');
      $this->redirect("Actividad/index");
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
        $mpdf->Output('Reporte_Actividades.pdf','D');
        throw new sfStopException();
     }

    public function executeNuevoTipo(sfWebRequest $request){}

    /**
     * Descripción: Función que me permite borrar los datos
     * del form a la base da datos.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     *  - Si no ingresa correctamente los datos muestra mensaje de error correspondiente.
     * @param sfWebRequest $request
     */
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
  
  /**
     * Descripción: Función que me permite ir al popup nuevo literal
     * @param sfWebRequest $request
     */
  public function executeNewliteral(sfWebRequest $request){  
      $this -> id_actividad_literal = $request->getParameter('idActividad');
  }
  
  /**
     * Descripción: Función que me permite guardar un literal
     * del form a la base da datos.
     * Escenarios Fallidos:
     *  - Si no se ingresa los valores correctos los datos no se guardan en base.
     * @param sfWebRequest $request
     */
  public function executeSaveLiteral(sfWebRequest $request)
  {
      $item = new Literal();
      $detalle = $request->getParameter('detalle');
      $puntos = $request->getParameter('puntos');
      if($detalle!="" && $puntos!=""){
          if(is_string($detalle) && is_numeric($puntos)){
              $item -> grabarLiteral($request);
          }
      }
      $this -> redirect('Actividad/index');
  }
  
  /**
     * Descripción: Función que me permite eliminar un literal de la base de datos
     * @param sfWebRequest $request
     */
  public function executeDeleteLiteral(sfWebRequest $request)
  {
      $id = $request->getParameter('id');
      $this->forward404Unless($literal = Doctrine_Core::getTable('Literal')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
      $literal -> delete(); 
      $this->getUser() -> setFlash('mensaje', 'Literal Eliminado Correctamente');
      $this->redirect('Actividad/index');
  }
  
  /**
     * Descripción: Función que me permite editar e ingresar los datos
     * del form a la base da datos.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     *  - Si no ingresa correctamente los datos muestra mensaje de error correspondiente.
     * @param sfWebRequest $request
     */
     public function executeEditar(sfWebRequest $request){
        $this->actividad = Doctrine_Query::create()
                ->from('Actividad a')
                ->where('a.idactividad = ?', $request->getParameter("id"))
                ->fetchOne();

        $this->tipo=Tipoactividad::getTipoActividadbyMateriaAndParalelo
                  ($this->getUser()->getMateriaActual(), $this->getUser()->getParaleloActual());

        $this->forward404Unless($this->actividad);
     }
     
     public function executeActualizarTipoActividad(sfWebRequest $request){
        $id=$request->getParameter("id");
        $tiact = $request->getParameter('nombre');
        $tireal = $request->getParameter('realizacion');
        $extra= $request->getParameter('tipo');
        $parcial=$request->getParameter('parcial');
        $grade = $request->getParameter('ponderacion');
        //Obteniendo datos de la DB
        $this->c=Curso::getCursoByParaleloAndMateria
            ($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
        //Obteniendo el id para modificar solo ese tipo de actividad
        $newtipoacti=Doctrine_Query::create()//esto te devuelve objetos de TipoActividad
              ->from('Tipoactividad ta')
              ->where('ta.idactividad=?',$id)
              ->fetchOne();
        //Ingresando los datos a la base
        $newtipoacti ->setCurso($this->c);
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

}
