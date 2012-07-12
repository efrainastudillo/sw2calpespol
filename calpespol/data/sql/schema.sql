CREATE TABLE actividad (idactividad INT AUTO_INCREMENT, nombre VARCHAR(70) DEFAULT 'Actividad sin Nombre' NOT NULL, es_grupal TINYINT NOT NULL, fecha_entrega DATETIME NOT NULL, id_tipo_actividad INT NOT NULL, INDEX id_tipo_actividad_idx (id_tipo_actividad), PRIMARY KEY(idactividad)) ENGINE = INNODB;
CREATE TABLE asistencia (idasistencia INT AUTO_INCREMENT, fecha DATETIME NOT NULL, id_tipo_asistencia INT NOT NULL, id_estudiante INT NOT NULL, INDEX id_tipo_asistencia_idx (id_tipo_asistencia), INDEX id_estudiante_idx (id_estudiante), PRIMARY KEY(idasistencia)) ENGINE = INNODB;
CREATE TABLE curso (idcurso INT AUTO_INCREMENT, paralelo INT NOT NULL, anio BIGINT NOT NULL, termino INT NOT NULL, factor_asist_1 INT DEFAULT '0' NOT NULL, factor_asist_2 INT DEFAULT '0' NOT NULL, id_materia INT NOT NULL, INDEX id_materia_idx (id_materia), PRIMARY KEY(idcurso)) ENGINE = INNODB;
CREATE TABLE estudiantegrupo (idgrupo INT, id_estudiante INT, PRIMARY KEY(idgrupo, id_estudiante)) ENGINE = INNODB;
CREATE TABLE estudianteliteral (id_estudiante INT, idliteral INT, nota_literal INT DEFAULT '0', id_calificador VARCHAR(45) DEFAULT NULL, fecha DATETIME NOT NULL, comentario VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id_estudiante, idliteral)) ENGINE = INNODB;
CREATE TABLE grupo (idgrupo INT AUTO_INCREMENT, numero INT, nombre VARCHAR(45) DEFAULT 'Grupo Anonimo' NOT NULL, PRIMARY KEY(idgrupo)) ENGINE = INNODB;
CREATE TABLE literal (idliteral INT AUTO_INCREMENT, nombre_literal VARCHAR(70) NOT NULL, valor_ponderacion DECIMAL(10, 2) NOT NULL, id_actividad INT NOT NULL, INDEX id_actividad_idx (id_actividad), PRIMARY KEY(idliteral)) ENGINE = INNODB;
CREATE TABLE materia (idmateria INT AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, codigo_materia VARCHAR(50) NOT NULL, PRIMARY KEY(idmateria)) ENGINE = INNODB;
CREATE TABLE rolusuario (idrolusuario INT AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, PRIMARY KEY(idrolusuario)) ENGINE = INNODB;
CREATE TABLE tipoactividad (idtipoactividad INT AUTO_INCREMENT, id_curso INT NOT NULL, valor_ponderacion BIGINT, nombre VARCHAR(45) NOT NULL, INDEX id_curso_idx (id_curso), PRIMARY KEY(idtipoactividad)) ENGINE = INNODB;
CREATE TABLE tipoasistencia (idtipoasistencia INT AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, PRIMARY KEY(idtipoasistencia)) ENGINE = INNODB;
CREATE TABLE usuario (idusuario INT AUTO_INCREMENT, usuario_espol VARCHAR(45) NOT NULL, nombre VARCHAR(45) NOT NULL, apellido VARCHAR(45) NOT NULL, mail VARCHAR(45) NOT NULL, matricula VARCHAR(45), PRIMARY KEY(idusuario)) ENGINE = INNODB;
CREATE TABLE usuariocurso (id_usuario_curso INT AUTO_INCREMENT, id_curso INT, id_usuario INT, id_rol INT, INDEX id_usuario_idx (id_usuario), INDEX id_curso_idx (id_curso), INDEX id_rol_idx (id_rol), PRIMARY KEY(id_usuario_curso)) ENGINE = INNODB;
ALTER TABLE actividad ADD CONSTRAINT actividad_id_tipo_actividad_tipoactividad_idtipoactividad FOREIGN KEY (id_tipo_actividad) REFERENCES tipoactividad(idtipoactividad);
ALTER TABLE asistencia ADD CONSTRAINT asistencia_id_tipo_asistencia_tipoasistencia_idtipoasistencia FOREIGN KEY (id_tipo_asistencia) REFERENCES tipoasistencia(idtipoasistencia);
ALTER TABLE asistencia ADD CONSTRAINT asistencia_id_estudiante_usuariocurso_id_usuario_curso FOREIGN KEY (id_estudiante) REFERENCES usuariocurso(id_usuario_curso);
ALTER TABLE curso ADD CONSTRAINT curso_id_materia_materia_idmateria FOREIGN KEY (id_materia) REFERENCES materia(idmateria);
ALTER TABLE estudiantegrupo ADD CONSTRAINT estudiantegrupo_idgrupo_grupo_idgrupo FOREIGN KEY (idgrupo) REFERENCES grupo(idgrupo);
ALTER TABLE estudiantegrupo ADD CONSTRAINT estudiantegrupo_id_estudiante_usuariocurso_id_usuario_curso FOREIGN KEY (id_estudiante) REFERENCES usuariocurso(id_usuario_curso);
ALTER TABLE estudianteliteral ADD CONSTRAINT estudianteliteral_idliteral_literal_idliteral FOREIGN KEY (idliteral) REFERENCES literal(idliteral);
ALTER TABLE estudianteliteral ADD CONSTRAINT estudianteliteral_id_estudiante_usuariocurso_id_usuario FOREIGN KEY (id_estudiante) REFERENCES usuariocurso(id_usuario);
ALTER TABLE literal ADD CONSTRAINT literal_id_actividad_actividad_idactividad FOREIGN KEY (id_actividad) REFERENCES actividad(idactividad);
ALTER TABLE tipoactividad ADD CONSTRAINT tipoactividad_id_curso_curso_idcurso FOREIGN KEY (id_curso) REFERENCES curso(idcurso);
ALTER TABLE usuariocurso ADD CONSTRAINT usuariocurso_id_usuario_usuario_idusuario FOREIGN KEY (id_usuario) REFERENCES usuario(idusuario);
ALTER TABLE usuariocurso ADD CONSTRAINT usuariocurso_id_rol_rolusuario_idrolusuario FOREIGN KEY (id_rol) REFERENCES rolusuario(idrolusuario);
ALTER TABLE usuariocurso ADD CONSTRAINT usuariocurso_id_curso_curso_idcurso FOREIGN KEY (id_curso) REFERENCES curso(idcurso);