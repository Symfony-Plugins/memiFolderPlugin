INSERT INTO formulario (id_form, pagina, credencial) VALUES (7, 'iniciousuario', 'iniciousuario');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (11, 'formu', 'formu');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (12, 'grupo', 'grupo');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (13, 'permiso', 'permiso');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (14, 'rol', 'rol');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (8, 'home_tics', 'home_tics');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (9, 'share_videos', 'share_videos');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (16, 'post_ge_folder', 'post_ge_folder');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (18, 'post_videos', 'post_videos');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (15, 'user', 'user');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (19, 'music2', 'music2');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (10, 'home_ge_folder_', 'home_ge_folder_');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (6, 'home_admin', 'home_admin');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (24, 'holitas', 'holitas');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (17, 'post_tic', 'post_tic');
INSERT INTO formulario (id_form, pagina, credencial) VALUES (27, 'bien', 'bien');

INSERT INTO tipo_obj (id_tipo_obj, nombre_tipo_obj) VALUES (1, 'archivo');
INSERT INTO tipo_obj (id_tipo_obj, nombre_tipo_obj) VALUES (2, 'comentario');
INSERT INTO tipo_obj (id_tipo_obj, nombre_tipo_obj) VALUES (3, 'busqueda');


INSERT INTO tipo_relacion (id_tiporelacion, nombre) VALUES (1, 'comentario y archivo');
INSERT INTO tipo_relacion (id_tiporelacion, nombre) VALUES (3, 'busqueda y comentario');
INSERT INTO tipo_relacion (id_tiporelacion, nombre) VALUES (4, 'busqueda y busqueda');
INSERT INTO tipo_relacion (id_tiporelacion, nombre) VALUES (5, 'archivo y archivo');
INSERT INTO tipo_relacion (id_tiporelacion, nombre) VALUES (6, 'comentario y comentario');
INSERT INTO tipo_relacion (id_tiporelacion, nombre) VALUES (2, 'busqueda y archivo');


INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (3, 'm3u', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (4, 'vlt', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (5, 'log', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (6, 'mp3', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (7, 'doc', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (8, 'zip', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (9, 'jpeg', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (10, 'pdf', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (11, 'jpg', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (12, 'deb', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (13, 'png', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (14, 'sql', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (15, 'txt', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (16, 'odp', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (17, 'odt', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (18, 'gif', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (19, 'xspf', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (20, 'xls', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (21, 'flv', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (22, 'ppt', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (23, 'ott', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (24, 'ods', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (25, 'xml', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (26, 'html', NULL);
INSERT INTO tipo_file (id_tipo_file, nombre_tipo, so) VALUES (27, 'tgz', NULL);


INSERT INTO permiso (id_permiso, nombre_permiso, descripcionper) VALUES (4, 'borrado', 'puede borar datos');
INSERT INTO permiso (id_permiso, nombre_permiso, descripcionper) VALUES (3, 'escritura', '<p>puede escribir muchisimo</p>');
INSERT INTO permiso (id_permiso, nombre_permiso, descripcionper) VALUES (2, 'lectura', '<p>puede leer muchos datos</p>');


INSERT INTO rol (id_rol, nombre) VALUES (3, 'tics_user');
INSERT INTO rol (id_rol, nombre) VALUES (2, 'administradores');



INSERT INTO usuario (id_usuario, id_rol, login, password, created_at, updated_at, is_active, ip, remenber_key, nombre, apellidos, ultima_entrada) VALUES (2, 2, 'admin', '2a2e9a58102784ca18e2605a4e727b5f', '2008-11-20', '2009-03-03', true, NULL, 'rol que usas', 'Jonathan', 'Claros Santander', NULL);
INSERT INTO usuario (id_usuario, id_rol, login, password, created_at, updated_at, is_active, ip, remenber_key, nombre, apellidos, ultima_entrada) VALUES (3, 3, 'andrew', 'c1f80eddea77f14650a2062dda3eb15c', '2008-11-20', '2009-03-03', true, NULL, 'tu nick', 'Andrew', 'Claros Santander', NULL);
INSERT INTO usuario (id_usuario, id_rol, login, password, created_at, updated_at, is_active, ip, remenber_key, nombre, apellidos, ultima_entrada) VALUES (4, 2, 'marcelo', 'ca42c5cc74cef67aa6d6840234e7af2b', '2008-11-27', '2009-03-03', true, NULL, 'nombre ', 'Juan Marcelo', 'Flores Soliz', NULL);
INSERT INTO usuario (id_usuario, id_rol, login, password, created_at, updated_at, is_active, ip, remenber_key, nombre, apellidos, ultima_entrada) VALUES (5, 3, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '2009-03-13', '2009-03-13', true, NULL, 'login demo
paswd demo', 'demo', 'demo', NULL);

INSERT INTO grupo (id_group, id_rol, nombre, descripcion) VALUES (32, 2, 'Memi', '<p>Grupo de los usuarios Memi</p>');
INSERT INTO grupo (id_group, id_rol, nombre, descripcion) VALUES (33, 3, 'demo', '<p>grupo demo</p>');
INSERT INTO grupo (id_group, id_rol, nombre, descripcion) VALUES (34, 3, 'Matemáticos', '<p>grupo de los usuarios del &aacute;rea de matem&aacute;ticas</p>');
INSERT INTO grupo (id_group, id_rol, nombre, descripcion) VALUES (3, 3, 'tics', '<p>Grupo de usuarios de tics</p>');
INSERT INTO grupo (id_group, id_rol, nombre, descripcion) VALUES (31, 3, 'Investigadores', '<p><em>Grupo de Investigadores<br /></em></p>');
INSERT INTO grupo (id_group, id_rol, nombre, descripcion) VALUES (2, 2, 'Administradores', '<p><em><strong>Grupo de administradores</strong></em></p>');


INSERT INTO user_group (id_usuario, id_group) VALUES (5, 3);
INSERT INTO user_group (id_usuario, id_group) VALUES (5, 33);
INSERT INTO user_group (id_usuario, id_group) VALUES (4, 2);
INSERT INTO user_group (id_usuario, id_group) VALUES (4, 31);
INSERT INTO user_group (id_usuario, id_group) VALUES (4, 32);
INSERT INTO user_group (id_usuario, id_group) VALUES (2, 2);
INSERT INTO user_group (id_usuario, id_group) VALUES (2, 32);
INSERT INTO user_group (id_usuario, id_group) VALUES (3, 2);
INSERT INTO user_group (id_usuario, id_group) VALUES (3, 3);
INSERT INTO user_group (id_usuario, id_group) VALUES (3, 31);
INSERT INTO user_group (id_usuario, id_group) VALUES (3, 32);


INSERT INTO permiso_user (id_rol, id_form) VALUES (2, 6);
INSERT INTO permiso_user (id_rol, id_form) VALUES (2, 11);
INSERT INTO permiso_user (id_rol, id_form) VALUES (2, 12);
INSERT INTO permiso_user (id_rol, id_form) VALUES (2, 13);
INSERT INTO permiso_user (id_rol, id_form) VALUES (2, 14);
INSERT INTO permiso_user (id_rol, id_form) VALUES (2, 15);
INSERT INTO permiso_user (id_rol, id_form) VALUES (3, 7);
INSERT INTO permiso_user (id_rol, id_form) VALUES (3, 16);


INSERT INTO permiso_grupo (id_rol, id_form, id_permiso) VALUES (2, 8, 2);
INSERT INTO permiso_grupo (id_rol, id_form, id_permiso) VALUES (2, 9, 2);
INSERT INTO permiso_grupo (id_rol, id_form, id_permiso) VALUES (2, 10, 2);
INSERT INTO permiso_grupo (id_rol, id_form, id_permiso) VALUES (2, 15, 2);
INSERT INTO permiso_grupo (id_rol, id_form, id_permiso) VALUES (3, 8, 2);
INSERT INTO permiso_grupo (id_rol, id_form, id_permiso) VALUES (3, 17, 2);



INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 2, 2, NULL, 'Jonathan Claros Santander', 10);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (3, 3, 3, NULL, 'Andrew Claros Santander', 10);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (4, 5, 4, NULL, 'Juan Marcelo Flores Soliz', 10);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 7, 2, 2, 'Mis Imagenes', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 8, 2, 2, 'Mis Videos', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 10, 2, 8, 'imagenes de muestra', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 11, 2, 10, 'icpc', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 12, 2, 10, 'viaje a Arica', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (3, 13, 3, 3, 'Videos', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (3, 14, 3, 3, 'Imagenes', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (3, 15, 3, 3, 'Mis pdf''s', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (3, 17, 3, 13, 'videos comicos', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (4, 18, 4, 5, 'Mis imagenes', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (4, 19, 4, 5, 'Mi musica', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 26, 2, 7, 'Hola como estas', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (5, 27, 5, NULL, 'demo demo', 10);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (5, 28, 5, 27, 'Nuevo folder', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (5, 29, 5, 27, 'Mis imagenes', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (4, 31, 4, 5, 'Imagenes de Muestra', 0);
INSERT INTO folder (id_usuario, id_folder, fol_id_usuario, fol_id_folder, nombre_folder, quote) VALUES (2, 32, 2, 7, 'hola', 0);

INSERT INTO obj_concreto (id_usuario, id_folder, id_obj_concreto, id_tipo_obj, nombre_obj, is_digital, created_at, descripcion, texto, texto_tsv) VALUES (2, 2, 401, 1, 'Que_tiene_dvd4.txt', true, '2009-05-07', '<p>que es lo que tiene el DVD 4</p>', 'traidos de laboratorio 
// del disco Jonathan
media files
mercado
andrew_hhb1
cd - Arquitectura II
// de Familia y de entrada Andrew', '''4'':11 ''cd'':23 ''ii'':25 ''dvd'':10 ''fil'':19 ''tra'':12 ''disc'':16 ''hhb1'':22 ''medi'':18 ''merc'':20 ''andrew'':21 ''entrad'':30 ''famili'':27 ''jonath'':17 ''dvd4.txt'':3 ''andrew138'':31 ''laboratori'':14 ''arquitectur'':24');

INSERT INTO obj_digital (id_usuario, id_folder, id_obj_concreto, id_tipo_file, binary_data, tamanio) VALUES (2, 2, 401, 15, 'traidos de laboratorio \\015\\012// del disco Jonathan\\015\\012media files\\015\\012mercado\\015\\012andrew_hhb1\\015\\012cd - Arquitectura II\\015\\012// de Familia y de entrada Andrew', 138);

INSERT INTO session_temp (session_id, session_data, session_time, process_id, created_at, id_usuario, nombre_usuario, ip_user) VALUES ('15df4f5954f4a65d3d96a17fac197a9d', 'symfony/user/sfUser/lastRequest|i:1241545326;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";', 1241545327, 6385, '2009-05-05 13:42:06.493284', NULL, NULL, NULL);
INSERT INTO session_temp (session_id, session_data, session_time, process_id, created_at, id_usuario, nombre_usuario, ip_user) VALUES ('f6033704d14720b746a9993d43446db9', 'symfony/user/sfUser/lastRequest|i:1239814296;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";', 1239814296, 8051, '2009-04-15 12:50:52.97551', NULL, NULL, NULL);

INSERT INTO shared_group (id_usuario, id_folder, id_obj_concreto, id_group) VALUES (2, 2, 401, 2);

INSERT INTO shared_usuario (id_folder, id_obj_concreto, id_usuario) VALUES (2, 401, 3);


SELECT pg_catalog.setval('file_data_seq', 100, false);

SELECT pg_catalog.setval('file_info_seq', 100, false);

SELECT pg_catalog.setval('folder_id_form_seq', 43, true);

SELECT pg_catalog.setval('formulario_id_form_seq', 27, true);

SELECT pg_catalog.setval('grupo_id_form_seq', 34, true);

SELECT pg_catalog.setval('log_delete_seq', 116, true);

SELECT pg_catalog.setval('log_insert_seq', 202, true);

SELECT pg_catalog.setval('log_update_seq', 48, true);

SELECT pg_catalog.setval('obj_concreto_id_form_seq', 402, true);

SELECT pg_catalog.setval('permiso_id_form_seq', 4, true);

SELECT pg_catalog.setval('rol_id_form_seq', 3, true);

SELECT pg_catalog.setval('sesion_id_form_seq', 2, false);

SELECT pg_catalog.setval('session_temp_form_seq', 1, false);

SELECT pg_catalog.setval('tipo_file_id_form_seq', 29, true);

SELECT pg_catalog.setval('tipo_log_id_form_seq', 2, false);

SELECT pg_catalog.setval('tipo_obj_id_form_seq', 2, false);

SELECT pg_catalog.setval('tipo_relacion_id_form_seq', 2, false);

SELECT pg_catalog.setval('usuario_id_form_seq', 7, true);