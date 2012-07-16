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
    var $wsSAAC = "https://www.academico.espol.edu.ec/Services/wsSAAC.asmx?WSDL";
    var $directorioEspol = "https://www.academico.espol.edu.ec/Services/directorioEspol.asmx?WSDL";
    var $client;

    /**
     * Inicializa el Servicio Web del WSSAAC
     */
    public function initWSSAACHandler() {
        $this->client = new SoapClient($this->wsSAAC, array());
    }

    /**
     * Inicializa el Servicio Web de la Espol
     * @deprecated 
     */
    public function initDirectorioEspolHandler() {
        
        $this->client = new  SoapClient($this->directorioEspol, array());                
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
      
}
?>
