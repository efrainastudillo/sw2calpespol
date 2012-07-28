<?php

/**
 * Grupo actions.
 *
 * @package    CALPESPOL
 * @subpackage Grupo
 * @author     Brick Reyes Zambrano
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GrupoActions extends sfActions {

    /**
     * 
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            $id_rol = $this->getIDRol("Estudiante");
            $this->id_curso = Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual())->getIdcurso();
            $this->lista = Doctrine_Core::getTable('UsuarioCurso')
                    ->createQuery('uc')
                    ->where('uc.id_curso = ?',$this->id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
            $this->rol = $this->getActualRol()->getNombre();
        }
    }

    public function executeNew(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            $id_rol = $this->getIDRol("Estudiante");
            $this->id_curso = Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual())->getIdcurso();
            $estudiantes = Doctrine_Core::getTable('UsuarioCurso')
                    ->createQuery('uc')
                    ->where('uc.id_curso = ?',$this->id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
            $this->lista = array();
            foreach ($estudiantes as $objeto)
                if(Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())==null)
                    array_push ($this->lista, $objeto);
            $this->rol = $this->getActualRol()->getNombre();
        }
    }

    public function executeEdit(sfWebRequest $request) {
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

    /**
     * Dado el nombre de un rol en forma de string devuelve
     * el id del mismo en caso que no exista retornará -1
     * @param string $nombre_rol Contiene el nombre del rol
     * @return integer contiene el id del rol
     */
    private function getIDRol($nombre_rol){
        try {
            $roles = Doctrine_Core::getTable('Rolusuario')
                    ->createQuery('r')
                    ->where('r.nombre = ?',$nombre_rol)
                    ->execute();
            return $roles[0]->getIdrolusuario();
        }  catch (Exception $e){
            return -1;
        }
    }
    
    /**
     * 
     * @return Rolusuario
     */
    private function getActualRol(){
        $id_curso = Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual())->getIdcurso();
        $id_usuario = $this->getUser()->getUserDB()->getIdusuario();
        $temp =  Doctrine_Core::getTable('UsuarioCurso')
                ->createQuery('uc')
                ->where('uc.id_curso = ?', $id_curso)
                ->andWhere('uc.id_usuario = ?', $id_usuario)
                ->execute();
        return $temp[0]->getRolusuario();
    }
}
