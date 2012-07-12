<?php

/**
 * Grupo actions.
 *
 * @package    CALPESPOL
 * @subpackage Grupo
 * @author     ABEJJA
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GrupoActions extends sfActions {

    public function executeMateria(sfWebRequest $request) {
        $this->cursos = Doctrine_Core::getTable('Curso')
                ->createQuery('a')
                ->execute();
        $this->materias = array();
        foreach ($this->cursos as $curso) {
            if($curso->getAnio()==$request->getParameter('anio')  &&  $curso->getTermino()==$request->getParameter('termino')){
                $bandera = true;
                foreach ($this->materias as $materia)
                    if(strcmp($materia->getNombre(),$curso->getMateria()->getNombre())==0)
                            $bandera = false;
                if($bandera)
                    array_push($this->materias,$curso->getMateria());
            }
        }
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

    public function executeConsulta(sfWebRequest $request) {
        $this->materias = Doctrine_Core::getTable('Materia')
                ->createQuery('a')
                ->execute();
        foreach ($this->materias as $materia) 
            if(strcasecmp($materia->getNombre(), $request->getParameter('materia')))
                $cod_materia = $materia->getIdCodigo();
        $this->cursos = Doctrine_Core::getTable('Curso')
                ->createQuery('a')
                ->execute();
        foreach ($this->cursos as $curso) 
            if($curso->getAnio()==$request->getParameter('anio')  &&  $curso->getTermino()==$request->getParameter('termino') && strcasecmp($curso->getIdMateria(),$cod_materia)==0 &&  $curso->getParalelo()==$request->getParameter('paralelo'))
                $id_curso = $curso->getId();
        $this->estudiantes_cursos = Doctrine_Core::getTable('Estudiantecurso')
                ->createQuery('a')
                ->execute();
        $this->estudiantes = array();
        foreach ($this->estudiantes_cursos as $estudiante)
            if($estudiante->getIdCurso()==$id_curso)
                array_push($this->estudiantes,$estudiante);
    }

    public function executeIndex(sfWebRequest $request) {
        $this->grupos = Doctrine_Core::getTable('Grupo')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new GrupoForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new GrupoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id')));
        $this->form = new GrupoForm($grupo);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id')));
        $this->form = new GrupoForm($grupo);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id')));
        $grupo->delete();

        $this->redirect('Grupo/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $grupo = $form->save();

            $this->redirect('Grupo/edit?id=' . $grupo->getId());
        }
    }

}
