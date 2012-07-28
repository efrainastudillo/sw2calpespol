<?php
/**
 * Description de WSDLHandler
 * Calpespol
 * 
 * @name WSDLHandler
 * @author Allan
 * Modified:  Efrain Astudillo
 */
class WSDLHandler {
    //put your code here
    var $wsSAAC = "https://www.academico.espol.edu.ec/services/wsSAAC.asmx?WSDL";
    var $directorioEspol = "https://www.academico.espol.edu.ec/Services/directorioEspol.asmx?WSDL";
    var $client;

    /**
     * Inicializa el Servicio Web del WSSAAC
     */
    public function initWSSAACHandler() {
        try {
             $this->client = new SoapClient($this->wsSAAC, array());
             return true;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            return false;
        }
    }

    /**
     * Inicializa el Servicio Web de la Espol
     * @deprecated 
     */
    public function initDirectorioEspolHandler() {
        try {
            $this->client = new  SoapClient($this->directorioEspol, array()); 
            return true;
        } catch (Exception $exc) {
           // echo $exc->getTraceAsString();
            return false;
        }
    }

    /**
     *  Autenticacion de los Usuarios por medio del Servicio Web proporcionado
     *  Devuelve true si el Usuario existe con sus respectivos datos 
     *  ingreados de otra manera devolvera false
     *  por la Espol
     * @param type $user            usuario espol
     * @param type $password        contrasenia espol
     * @return type                 boolean     
     */
    public function authenticate($user,$password) {
        $results = (array) $this->client->autenticacion(array("varUser" => $user,"varContrasenia" => $password));
        $results = (array) ($results['autenticacionResult']);
        return $results[0];
    }
    
    /**
     *  Obtiene los datos del Usuario de Espol como los nombres, apellidos, etc
     * @param type $user            usuiario espol
     * @param type $password        contrasenia espol
     * @return type                 XML como String        
     */
    public function userData($user,$password) {
        $results = (array) $this->client->datosUsuario(array("varUser" => $user,"varContrasenia" => $password));
        $results = (array)($results['datosUsuarioResult']);
        //return $results['any'];
        return $this->cleanUserDataResult($results['any']);
    }
    
    public function getDataUser($codigo,$es_matricula){
        
        
        if($es_matricula)
            $results = (array) $this->client->InformacionAcademicaEstudianteGet(array("identificacion" => "","matricula" => $codigo));
        else
            $results = (array) $this->client->InformacionAcademicaEstudianteGet(array("identificacion" => $codigo,"matricula" => ""));
        
        $results = (array)($results['InformacionAcademicaEstudianteGetResult']);
        $results = $this->cleanWSPlanificacion($results['any']);
        
        
        return $this->getUsuarioWebService($results);
    }
    
    /**
     *  Obtiene la informacion de las materias del Usuario registrado en el 
     *  presente termino
     * @param type $matricula   matricula del Estudiante
     * @return type             XML como String
     */
    public function scheduler($matricula) {
        $results = (array) $this->client->HorarioClasesScheluder(array("matricula" => $matricula));
        $results = (array) ($results['HorarioClasesScheluderResult']);
        return $this->cleanSchedulerResult($results['any']);
    }


    /**
     * Obtiene Los datos del Estudiante y lois almacena en la base
     */
    public function getUsuarioWebService($results){
        $doc = new DOMDocument('1.0', 'utf-8');
        $doc->loadXML($results);
       
        $cedula     =   $doc->getElementsByTagName("IDENTIFICACION")->length!=0 ? $doc->getElementsByTagName("IDENTIFICACION")->item(0)->nodeValue : "";
        $matricula  =   $doc->getElementsByTagName("COD_ESTUDIANTE")->length!=0 ? $doc->getElementsByTagName("COD_ESTUDIANTE")->item(0)->nodeValue : "";
        $nombres    =   $doc->getElementsByTagName("NOMBRES")->length!=0 ? $doc->getElementsByTagName("NOMBRES")->item(0)->nodeValue : "";
        $apellidos  =   $doc->getElementsByTagName("APELLIDOS")->length!=0 ? $doc->getElementsByTagName("APELLIDOS")->item(0)->nodeValue : "";
        $correo     =   $doc->getElementsByTagName("EMAIL")->length!=0 ? $doc->getElementsByTagName("EMAIL")->item(0)->nodeValue : "";
        $cedula     =   trim($cedula);
        $matricula  =   trim($matricula);
        $correo     =   trim($correo);
        preg_match('/\w*/', $correo, $user_espol);
        $user_espol=implode($user_espol);
        
        $usuario=new Usuario();
        $usuario->setNombre($nombres);
        $usuario->setApellido($apellidos);
        $usuario->setMail($correo);
        $usuario->setMatricula($matricula);
        $usuario->setUsuarioEspol($user_espol);        
        $usuario->setCedula($cedula);
        $usuario->save();
        return $usuario;
    }
    
    /**
     *
     * @param type $matricula 
     */
    public function processScheduler($matricula){

    $doc = new DOMDocument('1.0', 'utf-8');
    $doc->loadXML($results);
    //$elements = $doc->getElementsByTagName("V_HORARIO_CLASES");
    $elements = $doc->getElementsByTagName("V_MAT_REGISTRADAS");

    for ($i = 0; $i < $elements->length; $i++) {
        $node = $elements->item($i);
        $idcurso = $node->getElementsByTagName("IDCURSO")->length!=0 ? $node->getElementsByTagName("IDCURSO")->item(0)->nodeValue : "";
        if($idcurso == $paralelo->codigoparalelo) {
            $profesor = $node->getElementsByTagName("PROFESOR")->length!=0 ? $node->getElementsByTagName("PROFESOR")->item(0)->nodeValue : "";
            $materia = $node->getElementsByTagName("NOMBREMATERIA")->length!=0 ? $node->getElementsByTagName("NOMBREMATERIA")->item(0)->nodeValue : "";
            $paralelo = $node->getElementsByTagName("PARALELO")->length!=0 ? $node->getElementsByTagName("PARALELO")->item(0)->nodeValue : "";
            $cod_materia = $node->getElementsByTagName("CODIGOMATERIA")->length!=0 ? $node->getElementsByTagName("CODIGOMATERIA")->item(0)->nodeValue : "";
        }
    }        
  }
  
  public function getInfoProfesor($elementosProfesor,$codigoMateria,$paralelo){
      
      for ($i = 0; $i < $elementosProfesor->length; $i++) {
        $node = $elementosProfesor->item($i);
        $identificacion= $node->getElementsByTagName("IDENTIFICACION")->length!=0 ? $node->getElementsByTagName("IDENTIFICACION")->item(0)->nodeValue : "";
        $codigo_materia = $node->getElementsByTagName("CODIGOMATERIA")->length!=0 ? $node->getElementsByTagName("CODIGOMATERIA")->item(0)->nodeValue: "";
        $paralelo       = $node->getElementsByTagName("PARALELO")->length!=0 ? $node->getElementsByTagName("PARALELO")->item(0)->nodeValue: "";
        $codigo_materia = trim($codigo_materia);
        $paralelo       = trim($paralelo);
        $identificacion = trim($identificacion);
        
      }
  }
  
   /**
     * Carga o actualiza la planificación del periodo dado
     * El superuser es el usuario administrador
     * @param <type> $superuser
     * @param <type> $periodo
     * @return <type>
     */
    public function cargarPlanificacion($superuser, $anio,$termino) {
        ini_set('max_execution_time', 1800); //300 seconds = 5 minutes

            $results = (array) ($this->client->InformacionPlanficacion(array("anio" => $anio, "termino" => $termino)));
            $results = (array) ($results['InformacionPlanficacionResult']);            
            $results = $this->cleanWSPlanificacion($results['any']);

            $doc = new DOMDocument('1.0', 'utf-8');
            $doc->loadXML($results);
            $elements_materia_paralelo = $doc->getElementsByTagName("MATERIA_PARALELO");
            $elements_paralelo_profesor= $doc->getElementsByTagName("PARALELO_PROFESOR");
            $elements_paralelo_estudiante=$doc->getElementsByTagName("PARALELO_ESTUDIANTE");
//          // RECORREMOS LOS CURSOS
            for ($i = 0; $i < $elements_materia_paralelo->length; $i++) {
                
                    $node = $elements_materia_paralelo->item($i);
                    
                    $codigo_materia = $node->getElementsByTagName("CODIGOMATERIA")->length!=0 ? $node->getElementsByTagName("CODIGOMATERIA")->item(0)->nodeValue : "";
                    $nombre_materia = $node->getElementsByTagName("NOMBREMATERIA")->length!=0 ? $node->getElementsByTagName("NOMBREMATERIA")->item(0)->nodeValue: "";
                    $paralelo       = $node->getElementsByTagName("PARALELO")->length!=0 ? $node->getElementsByTagName("PARALELO")->item(0)->nodeValue: "";
                    $codigo_materia = trim($codigo_materia);
                    $paralelo       = trim($paralelo);
                    
                    if(Materia::existeMateria(($codigo_materia))){
                        $curso=new Curso();
                        $curso->setAnio(Utility::getAnio());
                        $curso->setTermino(Utility::getTermino());
                        $curso->setMateria(Materia::getMateriaByCodigo(($codigo_materia)));
                        $curso->setParalelo($paralelo);
                        $curso->save();                    
                        for($j=0; $j < $elements_paralelo_estudiante->length ; $j++){
                            $nodo_p_e = $elements_paralelo_estudiante->item($j);    
                            
                            $matricula_e        =   $nodo_p_e->getElementsByTagName("MATRICULA")->length!=0 ? $nodo_p_e->getElementsByTagName("MATRICULA")->item(0)->nodeValue : "";
                            $paralelo_e         =   $nodo_p_e->getElementsByTagName("PARALELO")->length!=0 ? $nodo_p_e->getElementsByTagName("PARALELO")->item(0)->nodeValue : "";
                            $codigo_materia_e   =   $nodo_p_e->getElementsByTagName("CODIGOMATERIA")->length!=0 ? $nodo_p_e->getElementsByTagName("CODIGOMATERIA")->item(0)->nodeValue : "";
                            
                            $matricula_e        =   trim($matricula_e);
                            $paralelo_e         =   trim($paralelo_e);
                            $codigo_materia_e   =   trim($codigo_materia_e);
                            //Si el Estudiante consta en el Curso del Sistema strcasecmp($var1, $var2) == 0
                            if(strcasecmp($paralelo_e,$paralelo)==0 && strcasecmp($codigo_materia,$codigo_materia_e)==0 ){
                                //Usuario existe en la base
                                $usuario=null;
                                if(Usuario::existeUsuario($matricula_e)){                                
                                    $usuario = Usuario::getUsuarioByMatricula($matricula_e);
                                }
                                //No se encuentra en la Base del Sistema, lo obtenemos del WebService y lo alamacenmos en la base
                                else{
                                    //$usuario=$this->getDataUser($matricula_e, true);
                                    $handler=new WSDLHandler();
                                    $handler->initWSSAACHandler();
                                    $usuario = $handler->getDataUser($matricula_e, true);
                                }
                                $usuario_curso=new UsuarioCurso();
                                $usuario_curso->setCurso($curso);
                                $usuario_curso->setUsuario($usuario);
                                $usuario_curso->setRolusuario(Rolusuario::getRolUsuario("Estudiante"));
                                $usuario_curso->save();
                            }
                        }//fin del for que recorre paralelo estudiante
                    }//fin del if existe materia
            }
       // return true;
        return "TOdo Bien";
    }
    
     private function cleanWSPlanificacion($xmlstr){        
        $results = "<?xml version='1.0' encoding='utf-8'?>" . $xmlstr;
//        $results = str_replace('<xs:schema xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" id="NewDataSet"><xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="MATERIA_PARALELO"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="NOMBREMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/><xs:element name="EXAMENPARCIAL" type="xs:dateTime" minOccurs="0"/><xs:element name="EXAMENFINAL" type="xs:dateTime" minOccurs="0"/><xs:element name="EXAMENMEJORAMIENTO" type="xs:dateTime" minOccurs="0"/><xs:element name="NUMCREDITOS" type="xs:short" minOccurs="0"/><xs:element name="CODUNIDAD" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="PARALELO_PROFESOR"><xs:complexType><xs:sequence><xs:element name="IDENTIFICACION" type="xs:string" minOccurs="0"/><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="PARALELO_ESTUDIANTE"><xs:complexType><xs:sequence><xs:element name="MATRICULA" type="xs:string" minOccurs="0"/><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="HORARIO_PARALELO"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:string" minOccurs="0"/><xs:element name="NUMDIA" type="xs:string" minOccurs="0"/><xs:element name="HI" type="xs:duration" minOccurs="0"/><xs:element name="HF" type="xs:duration" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="REQUISITOS_MATERIA"><xs:complexType><xs:sequence><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="NUMCREDITOS" type="xs:short" minOccurs="0"/><xs:element name="CODIGOMATREQ" type="xs:string" minOccurs="0"/><xs:element name="NOMBREMATREQ" type="xs:string" minOccurs="0"/><xs:element name="TIPO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1"><NewDataSet xmlns="">', "<NewDataSet>", $results);
//        $results = str_replace('</diffgr:diffgram>', "", $results);
//        $results = str_replace('</InformacionPlanficacionResult>', "", $results);
//        $results = str_replace('</InformacionPlanficacionResponse>', "", $results);
//        $results = str_replace('</soap:Body>', "", $results);
//        $results = str_replace('</soap:Envelope>', "", $results);
//        $results = str_replace('msdata:', "", $results);
//        $results = str_replace('diffgr:', "", $results);
        return $results;
    }
      
     /**
     *  Formatea el response del Servicio Web a un XML  valido
     * @param string $results       XML devuelto del Servicio Web
     * @return string               XML como String
     */
    private function cleanUserDataResult($results) {
        $results = "<?xml version=\"1.0\" encoding=\"utf-8\"?>".$results;
//        $results = str_replace('<xs:schema xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" id="NewDataSet">', "<NewDataSet>", $results);
//        $results = str_replace('<xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="DATOS_USUARIO">', "", $results);
//        $results = str_replace('<xs:complexType><xs:sequence><xs:element name="MATRICULA" type="xs:string" minOccurs="0"/><xs:element name="CEDULA" type="xs:string" minOccurs="0"/><xs:element name="APELLIDOS" type="xs:string" minOccurs="0"/><xs:element name="NOMBRES" type="xs:string" minOccurs="0"/>', "", $results);
//        $results = str_replace('<xs:element name="NOMBRE_COMPLETO" type="xs:string" minOccurs="0"/><xs:element name="UNIDAD" type="xs:string" minOccurs="0"/><xs:element name="ROL" type="xs:string" minOccurs="0"/><xs:element name="CORREO" type="xs:string" minOccurs="0"/><xs:element name="DIRECCION" type="xs:string" minOccurs="0"/><xs:element name="TELEFONO" type="xs:string" minOccurs="0"/>', "", $results);
//        $results = str_replace('<xs:element name="CELULAR" type="xs:string" minOccurs="0"/><xs:element name="SEXO" type="xs:string" minOccurs="0"/><xs:element name="CARRERA" type="xs:string" minOccurs="0"/><xs:element name="ESPECIALIZACION" type="xs:string" minOccurs="0"/><xs:element name="FECHANACIMIENTO" type="xs:string" minOccurs="0"/><xs:element name="PROMEDIO" type="xs:decimal" minOccurs="0"/><xs:element name="MATERIASAPROBADAS" type="xs:int" minOccurs="0"/><xs:element name="LASTCHANGED" type="xs:dateTime" minOccurs="0"/></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1">', "", $results);
//        $results = str_replace('<NewDataSet xmlns="">', "", $results);
//        $results = str_replace('</diffgr:diffgram>', "", $results);
//        $results = str_replace('diffgr:id="DATOS_USUARIO1"', "", $results);
//        $results = str_replace('msdata:rowOrder="0"', "", $results);
        return $results;
    }

    /**
     *  Limpia el response obtenido del metodo scheduler y lo formatea a un 
     *  XML valido
     * @param type $results     Response del Servicio Web
     * @return type             XML como String
     */
    private function cleanSchedulerResult($results){
        $results = "<?xml version=\"1.0\" encoding=\"utf-8\"?>".$results;
//        $results = str_replace('<xs:schema xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" id="NewDataSet"><xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:UseCurrentLocale="true"><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="V_MAT_REGISTRADAS"><xs:complexType><xs:sequence><xs:element name="IDCURSO" type="xs:int" minOccurs="0"/><xs:element name="CODIGOMATERIA" type="xs:string" minOccurs="0"/><xs:element name="NOMBREMATERIA" type="xs:string" minOccurs="0"/><xs:element name="PARALELO" type="xs:short" minOccurs="0"/><xs:element name="PROFESOR" type="xs:string" minOccurs="0"/><xs:element name="NUMHORAS" type="xs:int" minOccurs="0"/><xs:element name="TIPOCURSO" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element><xs:element name="V_HORARIO_CLASES"><xs:complexType><xs:sequence><xs:element name="IDCURSO" type="xs:int" minOccurs="0"/><xs:element name="DIA" type="xs:short" minOccurs="0"/><xs:element name="HORAINICIO" type="xs:string" minOccurs="0"/><xs:element name="HORAFIN" type="xs:string" minOccurs="0"/><xs:element name="AULA" type="xs:string" minOccurs="0"/><xs:element name="BLOQUE" type="xs:string" minOccurs="0"/><xs:element name="CAMPUS" type="xs:string" minOccurs="0"/></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1">', "<NewDataSet>", $results);
//        $results = str_replace('<NewDataSet xmlns="">', "", $results);
//        $results = str_replace('</diffgr:diffgram>', "", $results);
//        $results = str_replace('</soap:Body>', "", $results);
//        $results = str_replace('</soap:Envelope>', "", $results);
//        $results = str_replace('msdata:', "", $results);
//        $results = str_replace('diffgr:', "", $results);
//        $results = str_replace('diffgr:id="DATOS_USUARIO1"', "", $results);
//        $results = str_replace('msdata:rowOrder="0"', "", $results);
        return $results;
    }
}
?>
