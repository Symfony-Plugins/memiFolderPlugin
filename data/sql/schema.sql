--
-- PostgreSQL database dump
--

-- Started on 2009-05-07 21:25:55 BOT

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 361 (class 2612 OID 33382)
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: jonathan
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO jonathan;

SET search_path = public, pg_catalog;

--
-- TOC entry 21 (class 1255 OID 33470)
-- Dependencies: 3 361
-- Name: backup(); Type: FUNCTION; Schema: public; Owner: jonathan
--

CREATE FUNCTION backup() RETURNS trigger
    AS $$
DECLARE
           entidad  VARCHAR(40):= TG_RELNAME ;
           fecha   date := CURRENT_DATE ;
           hora TIMESTAMP:= CURRENT_TIMESTAMP;
           dato_old TEXT ;
           dato_new TEXT ;

BEGIN

    IF TG_OP = 'INSERT' THEN
         dato_new := NEW ;
         INSERT INTO log_insert VALUES (nextval('log_insert_seq'), (SELECT nombre_usuario FROM session_temp WHERE process_id = pg_backend_pid()), fecha , hora, dato_new, entidad, (SELECT ip_user FROM session_temp WHERE process_id = pg_backend_pid()));
    ELSIF      TG_OP = 'DELETE' THEN
		  dato_old := OLD ;
         INSERT INTO log_delete VALUES (nextval('log_delete_seq'), (SELECT nombre_usuario FROM session_temp WHERE process_id = pg_backend_pid()), fecha , hora, dato_old, entidad, (SELECT ip_user FROM session_temp WHERE process_id = pg_backend_pid()));
    ELSIF  TG_OP = 'UPDATE' THEN
	 dato_new := NEW ;
	 dato_old := OLD ;
         INSERT INTO log_update  VALUES (nextval('log_update_seq'), (SELECT nombre_usuario FROM session_temp WHERE process_id = pg_backend_pid()), fecha , hora, dato_new , dato_old , entidad , (SELECT ip_user FROM session_temp WHERE process_id = pg_backend_pid()));
    ELSE
    END IF;

    RETURN NULL ;
END
$$
    LANGUAGE plpgsql;


ALTER FUNCTION public.backup() OWNER TO jonathan;

--
-- TOC entry 20 (class 1255 OID 33767)
-- Dependencies: 361 3
-- Name: llenar(); Type: FUNCTION; Schema: public; Owner: jonathan
--

CREATE FUNCTION llenar() RETURNS trigger
    AS $$BEGIN
    IF TG_OP = 'INSERT' THEN
       UPDATE obj_concreto 
       set texto_tsv = (SELECT to_tsvector('spanish', (SELECT nombre_obj FROM obj_concreto WHERE id_obj_concreto = NEW.id_obj_concreto) || (SELECT descripcion FROM obj_concreto WHERE id_obj_concreto = NEW.id_obj_concreto) || (SELECT texto FROM obj_concreto WHERE id_obj_concreto = NEW.id_obj_concreto) || NEW.tamanio))
       WHERE id_obj_concreto = NEW.id_obj_concreto;
    ELSIF TG_OP = 'UPDATE' THEN
       UPDATE obj_concreto 
       set texto_tsv = (SELECT to_tsvector('spanish', (SELECT nombre_obj FROM obj_concreto WHERE id_obj_concreto = NEW.id_obj_concreto) || (SELECT descripcion FROM obj_concreto WHERE id_obj_concreto = NEW.id_obj_concreto) || (SELECT texto FROM obj_concreto WHERE id_obj_concreto = NEW.id_obj_concreto) || NEW.tamanio))
       WHERE id_obj_concreto = NEW.id_obj_concreto;
    END IF;   
       RETURN NULL ;
END
$$
    LANGUAGE plpgsql;


ALTER FUNCTION public.llenar() OWNER TO jonathan;

--
-- TOC entry 1553 (class 1259 OID 33471)
-- Dependencies: 3
-- Name: file_data_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE file_data_seq
    START WITH 100
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.file_data_seq OWNER TO jonathan;

--
-- TOC entry 1554 (class 1259 OID 33473)
-- Dependencies: 3
-- Name: file_info_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE file_info_seq
    START WITH 100
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.file_info_seq OWNER TO jonathan;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1533 (class 1259 OID 33383)
-- Dependencies: 3
-- Name: folder; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE folder (
    id_usuario integer NOT NULL,
    id_folder integer NOT NULL,
    fol_id_usuario integer,
    fol_id_folder integer,
    nombre_folder character varying(100),
    quote integer
);


ALTER TABLE public.folder OWNER TO jonathan;

--
-- TOC entry 1555 (class 1259 OID 33475)
-- Dependencies: 3
-- Name: folder_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE folder_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.folder_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1534 (class 1259 OID 33386)
-- Dependencies: 3
-- Name: formulario; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE formulario (
    id_form integer NOT NULL,
    pagina character varying(150),
    credencial character varying(100)
);


ALTER TABLE public.formulario OWNER TO jonathan;

--
-- TOC entry 1556 (class 1259 OID 33477)
-- Dependencies: 3
-- Name: formulario_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE formulario_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.formulario_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1535 (class 1259 OID 33389)
-- Dependencies: 3
-- Name: grupo; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE grupo (
    id_group integer NOT NULL,
    id_rol integer NOT NULL,
    nombre character varying(255),
    descripcion character varying(250)
);


ALTER TABLE public.grupo OWNER TO jonathan;

--
-- TOC entry 1557 (class 1259 OID 33479)
-- Dependencies: 3
-- Name: grupo_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE grupo_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.grupo_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1536 (class 1259 OID 33395)
-- Dependencies: 3
-- Name: log_delete; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE log_delete (
    id_log_delete integer NOT NULL,
    user_id_9 character varying(200),
    fecha date,
    hora time without time zone,
    dato_viejo text,
    tabla character varying(200),
    ip_user character varying(50)
);


ALTER TABLE public.log_delete OWNER TO jonathan;

--
-- TOC entry 1558 (class 1259 OID 33481)
-- Dependencies: 3
-- Name: log_delete_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE log_delete_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.log_delete_seq OWNER TO jonathan;

--
-- TOC entry 1537 (class 1259 OID 33401)
-- Dependencies: 3
-- Name: log_insert; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE log_insert (
    id_log_insert integer NOT NULL,
    user_id_1 character varying(200),
    fecha date,
    hora time without time zone,
    dato_nuevo text,
    tabla character varying(200),
    ip_user character varying(50)
);


ALTER TABLE public.log_insert OWNER TO jonathan;

--
-- TOC entry 1559 (class 1259 OID 33483)
-- Dependencies: 3
-- Name: log_insert_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE log_insert_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.log_insert_seq OWNER TO jonathan;

--
-- TOC entry 1538 (class 1259 OID 33407)
-- Dependencies: 3
-- Name: log_update; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE log_update (
    id_log_update integer NOT NULL,
    user_id_5 character varying(200),
    fecha date,
    hora time without time zone,
    dato_nuevo text,
    dato_viejo text,
    tabla character varying(200),
    ip_user character varying(50)
);


ALTER TABLE public.log_update OWNER TO jonathan;

--
-- TOC entry 1560 (class 1259 OID 33485)
-- Dependencies: 3
-- Name: log_update_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE log_update_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.log_update_seq OWNER TO jonathan;

--
-- TOC entry 1539 (class 1259 OID 33413)
-- Dependencies: 3
-- Name: obj_concreto; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE obj_concreto (
    id_usuario integer NOT NULL,
    id_folder integer NOT NULL,
    id_obj_concreto integer NOT NULL,
    id_tipo_obj integer NOT NULL,
    nombre_obj character varying(255),
    is_digital boolean,
    created_at date,
    descripcion text,
    texto text,
    texto_tsv tsvector
);


ALTER TABLE public.obj_concreto OWNER TO jonathan;

--
-- TOC entry 1561 (class 1259 OID 33487)
-- Dependencies: 3
-- Name: obj_concreto_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE obj_concreto_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.obj_concreto_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1540 (class 1259 OID 33419)
-- Dependencies: 3
-- Name: obj_digital; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE obj_digital (
    id_usuario integer NOT NULL,
    id_folder integer NOT NULL,
    id_obj_concreto integer NOT NULL,
    id_tipo_file integer,
    binary_data bytea,
    tamanio bigint
);


ALTER TABLE public.obj_digital OWNER TO jonathan;

--
-- TOC entry 1541 (class 1259 OID 33425)
-- Dependencies: 3
-- Name: permiso; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE permiso (
    id_permiso integer NOT NULL,
    nombre_permiso character varying(255),
    descripcionper character varying(255)
);


ALTER TABLE public.permiso OWNER TO jonathan;

--
-- TOC entry 1542 (class 1259 OID 33431)
-- Dependencies: 3
-- Name: permiso_grupo; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE permiso_grupo (
    id_rol integer NOT NULL,
    id_form integer NOT NULL,
    id_permiso integer NOT NULL
);


ALTER TABLE public.permiso_grupo OWNER TO jonathan;

--
-- TOC entry 1562 (class 1259 OID 33489)
-- Dependencies: 3
-- Name: permiso_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE permiso_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.permiso_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1543 (class 1259 OID 33434)
-- Dependencies: 3
-- Name: permiso_user; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE permiso_user (
    id_rol integer NOT NULL,
    id_form integer NOT NULL
);


ALTER TABLE public.permiso_user OWNER TO jonathan;

--
-- TOC entry 1544 (class 1259 OID 33437)
-- Dependencies: 3
-- Name: relaciones_obj_concretos; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE relaciones_obj_concretos (
    id_usuario integer NOT NULL,
    id_folder integer NOT NULL,
    id_obj_concreto integer NOT NULL,
    obj_id_usuario integer NOT NULL,
    obj_id_folder integer NOT NULL,
    obj_id_obj_concreto integer NOT NULL,
    id_tiporelacion integer NOT NULL
);


ALTER TABLE public.relaciones_obj_concretos OWNER TO jonathan;

--
-- TOC entry 1545 (class 1259 OID 33440)
-- Dependencies: 3
-- Name: rol; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE rol (
    id_rol integer NOT NULL,
    nombre character varying(255)
);


ALTER TABLE public.rol OWNER TO jonathan;

--
-- TOC entry 1563 (class 1259 OID 33491)
-- Dependencies: 3
-- Name: rol_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE rol_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.rol_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1564 (class 1259 OID 33493)
-- Dependencies: 3
-- Name: sesion_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE sesion_id_form_seq
    START WITH 2
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sesion_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1571 (class 1259 OID 33740)
-- Dependencies: 1838 1839 3
-- Name: session_temp; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE session_temp (
    session_id character varying(25500) NOT NULL,
    session_data text,
    session_time bigint,
    process_id integer DEFAULT pg_backend_pid(),
    created_at timestamp without time zone DEFAULT now(),
    id_usuario integer,
    nombre_usuario character varying(255),
    ip_user character varying(50)
);


ALTER TABLE public.session_temp OWNER TO jonathan;

--
-- TOC entry 1570 (class 1259 OID 33738)
-- Dependencies: 3
-- Name: session_temp_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE session_temp_form_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 5;


ALTER TABLE public.session_temp_form_seq OWNER TO jonathan;

--
-- TOC entry 1546 (class 1259 OID 33443)
-- Dependencies: 3
-- Name: shared_group; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE shared_group (
    id_usuario integer NOT NULL,
    id_folder integer NOT NULL,
    id_obj_concreto integer NOT NULL,
    id_group integer NOT NULL
);


ALTER TABLE public.shared_group OWNER TO jonathan;

--
-- TOC entry 1547 (class 1259 OID 33446)
-- Dependencies: 3
-- Name: shared_usuario; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE shared_usuario (
    id_folder integer NOT NULL,
    id_obj_concreto integer NOT NULL,
    id_usuario integer NOT NULL
);


ALTER TABLE public.shared_usuario OWNER TO jonathan;

--
-- TOC entry 1548 (class 1259 OID 33449)
-- Dependencies: 3
-- Name: tipo_file; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE tipo_file (
    id_tipo_file integer NOT NULL,
    nombre_tipo character varying(255),
    so character varying(255)
);


ALTER TABLE public.tipo_file OWNER TO jonathan;

--
-- TOC entry 1565 (class 1259 OID 33495)
-- Dependencies: 3
-- Name: tipo_file_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE tipo_file_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipo_file_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1566 (class 1259 OID 33497)
-- Dependencies: 3
-- Name: tipo_log_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE tipo_log_id_form_seq
    START WITH 2
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipo_log_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1549 (class 1259 OID 33455)
-- Dependencies: 3
-- Name: tipo_obj; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE tipo_obj (
    id_tipo_obj integer NOT NULL,
    nombre_tipo_obj character varying(255)
);


ALTER TABLE public.tipo_obj OWNER TO jonathan;

--
-- TOC entry 1567 (class 1259 OID 33499)
-- Dependencies: 3
-- Name: tipo_obj_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE tipo_obj_id_form_seq
    START WITH 2
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipo_obj_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1550 (class 1259 OID 33458)
-- Dependencies: 3
-- Name: tipo_relacion; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE tipo_relacion (
    id_tiporelacion integer NOT NULL,
    nombre character varying(255)
);


ALTER TABLE public.tipo_relacion OWNER TO jonathan;

--
-- TOC entry 1568 (class 1259 OID 33501)
-- Dependencies: 3
-- Name: tipo_relacion_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE tipo_relacion_id_form_seq
    START WITH 2
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipo_relacion_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1551 (class 1259 OID 33461)
-- Dependencies: 3
-- Name: user_group; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE user_group (
    id_usuario integer NOT NULL,
    id_group integer NOT NULL
);


ALTER TABLE public.user_group OWNER TO jonathan;

--
-- TOC entry 1552 (class 1259 OID 33464)
-- Dependencies: 3
-- Name: usuario; Type: TABLE; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE TABLE usuario (
    id_usuario integer NOT NULL,
    id_rol integer NOT NULL,
    login character varying(128),
    password character varying(128),
    created_at date,
    updated_at date,
    is_active boolean,
    ip character varying(50),
    remenber_key character varying(250),
    nombre character varying(255),
    apellidos character varying(255),
    ultima_entrada date
);


ALTER TABLE public.usuario OWNER TO jonathan;

--
-- TOC entry 1569 (class 1259 OID 33503)
-- Dependencies: 3
-- Name: usuario_id_form_seq; Type: SEQUENCE; Schema: public; Owner: jonathan
--

CREATE SEQUENCE usuario_id_form_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_form_seq OWNER TO jonathan;

--
-- TOC entry 1842 (class 2606 OID 33546)
-- Dependencies: 1533 1533 1533
-- Name: pk_folder; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY folder
    ADD CONSTRAINT pk_folder PRIMARY KEY (id_usuario, id_folder);


--
-- TOC entry 1847 (class 2606 OID 33548)
-- Dependencies: 1534 1534
-- Name: pk_formulario; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY formulario
    ADD CONSTRAINT pk_formulario PRIMARY KEY (id_form);


--
-- TOC entry 1850 (class 2606 OID 33550)
-- Dependencies: 1535 1535
-- Name: pk_grupo; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY grupo
    ADD CONSTRAINT pk_grupo PRIMARY KEY (id_group);


--
-- TOC entry 1854 (class 2606 OID 33552)
-- Dependencies: 1536 1536
-- Name: pk_log_delete; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY log_delete
    ADD CONSTRAINT pk_log_delete PRIMARY KEY (id_log_delete);


--
-- TOC entry 1857 (class 2606 OID 33554)
-- Dependencies: 1537 1537
-- Name: pk_log_insert; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY log_insert
    ADD CONSTRAINT pk_log_insert PRIMARY KEY (id_log_insert);


--
-- TOC entry 1860 (class 2606 OID 33556)
-- Dependencies: 1538 1538
-- Name: pk_log_update; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY log_update
    ADD CONSTRAINT pk_log_update PRIMARY KEY (id_log_update);


--
-- TOC entry 1863 (class 2606 OID 33558)
-- Dependencies: 1539 1539 1539 1539
-- Name: pk_obj_concreto; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY obj_concreto
    ADD CONSTRAINT pk_obj_concreto PRIMARY KEY (id_usuario, id_folder, id_obj_concreto);


--
-- TOC entry 1869 (class 2606 OID 33560)
-- Dependencies: 1540 1540 1540 1540
-- Name: pk_obj_digital; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY obj_digital
    ADD CONSTRAINT pk_obj_digital PRIMARY KEY (id_usuario, id_folder, id_obj_concreto);


--
-- TOC entry 1873 (class 2606 OID 33562)
-- Dependencies: 1541 1541
-- Name: pk_permiso; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY permiso
    ADD CONSTRAINT pk_permiso PRIMARY KEY (id_permiso);


--
-- TOC entry 1877 (class 2606 OID 33564)
-- Dependencies: 1542 1542 1542
-- Name: pk_permiso_grupo; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY permiso_grupo
    ADD CONSTRAINT pk_permiso_grupo PRIMARY KEY (id_rol, id_form);


--
-- TOC entry 1882 (class 2606 OID 33566)
-- Dependencies: 1543 1543 1543
-- Name: pk_permiso_user; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY permiso_user
    ADD CONSTRAINT pk_permiso_user PRIMARY KEY (id_rol, id_form);


--
-- TOC entry 1886 (class 2606 OID 34019)
-- Dependencies: 1544 1544 1544 1544 1544 1544 1544
-- Name: pk_relaciones_obj_concretos; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY relaciones_obj_concretos
    ADD CONSTRAINT pk_relaciones_obj_concretos PRIMARY KEY (obj_id_usuario, id_usuario, obj_id_folder, id_folder, id_obj_concreto, obj_id_obj_concreto);


--
-- TOC entry 1892 (class 2606 OID 33570)
-- Dependencies: 1545 1545
-- Name: pk_rol; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT pk_rol PRIMARY KEY (id_rol);


--
-- TOC entry 1921 (class 2606 OID 33750)
-- Dependencies: 1571 1571
-- Name: pk_session_temp; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY session_temp
    ADD CONSTRAINT pk_session_temp PRIMARY KEY (session_id);


--
-- TOC entry 1895 (class 2606 OID 33949)
-- Dependencies: 1546 1546 1546 1546 1546
-- Name: pk_shared_group; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY shared_group
    ADD CONSTRAINT pk_shared_group PRIMARY KEY (id_usuario, id_folder, id_obj_concreto, id_group);


--
-- TOC entry 1899 (class 2606 OID 33965)
-- Dependencies: 1547 1547 1547 1547
-- Name: pk_shared_usuario; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY shared_usuario
    ADD CONSTRAINT pk_shared_usuario PRIMARY KEY (id_folder, id_obj_concreto, id_usuario);


--
-- TOC entry 1903 (class 2606 OID 33576)
-- Dependencies: 1548 1548
-- Name: pk_tipo_file; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY tipo_file
    ADD CONSTRAINT pk_tipo_file PRIMARY KEY (id_tipo_file);


--
-- TOC entry 1906 (class 2606 OID 33578)
-- Dependencies: 1549 1549
-- Name: pk_tipo_obj; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY tipo_obj
    ADD CONSTRAINT pk_tipo_obj PRIMARY KEY (id_tipo_obj);


--
-- TOC entry 1909 (class 2606 OID 33580)
-- Dependencies: 1550 1550
-- Name: pk_tipo_relacion; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY tipo_relacion
    ADD CONSTRAINT pk_tipo_relacion PRIMARY KEY (id_tiporelacion);


--
-- TOC entry 1912 (class 2606 OID 33582)
-- Dependencies: 1551 1551 1551
-- Name: pk_user_group; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY user_group
    ADD CONSTRAINT pk_user_group PRIMARY KEY (id_usuario, id_group);


--
-- TOC entry 1917 (class 2606 OID 33584)
-- Dependencies: 1552 1552
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: jonathan; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id_usuario);


--
-- TOC entry 1840 (class 1259 OID 33505)
-- Dependencies: 1533 1533
-- Name: folder_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX folder_pk ON folder USING btree (id_usuario, id_folder);


--
-- TOC entry 1874 (class 1259 OID 33523)
-- Dependencies: 1542
-- Name: form_p_g_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX form_p_g_fk ON permiso_grupo USING btree (id_form);


--
-- TOC entry 1845 (class 1259 OID 33508)
-- Dependencies: 1534
-- Name: formulario_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX formulario_pk ON formulario USING btree (id_form);


--
-- TOC entry 1848 (class 1259 OID 33509)
-- Dependencies: 1535
-- Name: grupo_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX grupo_pk ON grupo USING btree (id_group);


--
-- TOC entry 1852 (class 1259 OID 33511)
-- Dependencies: 1536
-- Name: log_delete_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX log_delete_pk ON log_delete USING btree (id_log_delete);


--
-- TOC entry 1855 (class 1259 OID 33512)
-- Dependencies: 1537
-- Name: log_insert_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX log_insert_pk ON log_insert USING btree (id_log_insert);


--
-- TOC entry 1858 (class 1259 OID 33513)
-- Dependencies: 1538
-- Name: log_update_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX log_update_pk ON log_update USING btree (id_log_update);


--
-- TOC entry 1861 (class 1259 OID 33514)
-- Dependencies: 1539 1539 1539
-- Name: obj_concreto_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX obj_concreto_pk ON obj_concreto USING btree (id_usuario, id_folder, id_obj_concreto);


--
-- TOC entry 1867 (class 1259 OID 33518)
-- Dependencies: 1540 1540 1540
-- Name: obj_digital_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX obj_digital_pk ON obj_digital USING btree (id_usuario, id_folder, id_obj_concreto);


--
-- TOC entry 1875 (class 1259 OID 33521)
-- Dependencies: 1542 1542
-- Name: permiso_grupo_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX permiso_grupo_pk ON permiso_grupo USING btree (id_rol, id_form);


--
-- TOC entry 1871 (class 1259 OID 33520)
-- Dependencies: 1541
-- Name: permiso_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX permiso_pk ON permiso USING btree (id_permiso);


--
-- TOC entry 1880 (class 1259 OID 33525)
-- Dependencies: 1543 1543
-- Name: permiso_user_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX permiso_user_pk ON permiso_user USING btree (id_rol, id_form);


--
-- TOC entry 1851 (class 1259 OID 33510)
-- Dependencies: 1535
-- Name: re_g_r_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX re_g_r_fk ON grupo USING btree (id_rol);


--
-- TOC entry 1900 (class 1259 OID 33536)
-- Dependencies: 1547
-- Name: re_u_s_u_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX re_u_s_u_fk ON shared_usuario USING btree (id_usuario);


--
-- TOC entry 1887 (class 1259 OID 33529)
-- Dependencies: 1544 1544 1544
-- Name: rel2_o_c_rel_o_c_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel2_o_c_rel_o_c_fk ON relaciones_obj_concretos USING btree (id_usuario, id_folder, id_obj_concreto);


--
-- TOC entry 1864 (class 1259 OID 33516)
-- Dependencies: 1539 1539
-- Name: rel_f_o_c_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_f_o_c_fk ON obj_concreto USING btree (id_usuario, id_folder);


--
-- TOC entry 1883 (class 1259 OID 33527)
-- Dependencies: 1543
-- Name: rel_f_p_u_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_f_p_u_fk ON permiso_user USING btree (id_form);


--
-- TOC entry 1843 (class 1259 OID 33507)
-- Dependencies: 1533 1533
-- Name: rel_f_sf_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_f_sf_fk ON folder USING btree (fol_id_usuario, fol_id_folder);


--
-- TOC entry 1896 (class 1259 OID 33534)
-- Dependencies: 1546
-- Name: rel_g_s_g_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_g_s_g_fk ON shared_group USING btree (id_group);


--
-- TOC entry 1888 (class 1259 OID 33530)
-- Dependencies: 1544 1544 1544
-- Name: rel_o_c_rel_obj_con_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_o_c_rel_obj_con_fk ON relaciones_obj_concretos USING btree (obj_id_usuario, obj_id_folder, obj_id_obj_concreto);


--
-- TOC entry 1884 (class 1259 OID 33526)
-- Dependencies: 1543
-- Name: rel_p_u_r_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_p_u_r_fk ON permiso_user USING btree (id_rol);


--
-- TOC entry 1878 (class 1259 OID 33522)
-- Dependencies: 1542
-- Name: rel_r_p_g_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_r_p_g_fk ON permiso_grupo USING btree (id_rol);


--
-- TOC entry 1870 (class 1259 OID 33519)
-- Dependencies: 1540
-- Name: rel_t_o_d_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_t_o_d_fk ON obj_digital USING btree (id_tipo_file);


--
-- TOC entry 1865 (class 1259 OID 33515)
-- Dependencies: 1539
-- Name: rel_t_o_o_c_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_t_o_o_c_fk ON obj_concreto USING btree (id_tipo_obj);


--
-- TOC entry 1889 (class 1259 OID 33531)
-- Dependencies: 1544
-- Name: rel_t_r_r_o_c_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_t_r_r_o_c_fk ON relaciones_obj_concretos USING btree (id_tiporelacion);


--
-- TOC entry 1844 (class 1259 OID 33506)
-- Dependencies: 1533
-- Name: rel_u_f_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_u_f_fk ON folder USING btree (id_usuario);


--
-- TOC entry 1913 (class 1259 OID 33542)
-- Dependencies: 1551
-- Name: rel_u_g_g_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_u_g_g_fk ON user_group USING btree (id_group);


--
-- TOC entry 1918 (class 1259 OID 33544)
-- Dependencies: 1552
-- Name: rel_u_r_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_u_r_fk ON usuario USING btree (id_rol);


--
-- TOC entry 1914 (class 1259 OID 33541)
-- Dependencies: 1551
-- Name: rel_u_u_g_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX rel_u_u_g_fk ON user_group USING btree (id_usuario);


--
-- TOC entry 1890 (class 1259 OID 33528)
-- Dependencies: 1544 1544 1544 1544 1544 1544
-- Name: relaciones_obj_concretos_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX relaciones_obj_concretos_pk ON relaciones_obj_concretos USING btree (obj_id_usuario, id_usuario, obj_id_folder, id_folder, id_obj_concreto, obj_id_obj_concreto);


--
-- TOC entry 1879 (class 1259 OID 33524)
-- Dependencies: 1542
-- Name: relp_p_g_fk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX relp_p_g_fk ON permiso_grupo USING btree (id_permiso);


--
-- TOC entry 1893 (class 1259 OID 33532)
-- Dependencies: 1545
-- Name: rol_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX rol_pk ON rol USING btree (id_rol);


--
-- TOC entry 1922 (class 1259 OID 33748)
-- Dependencies: 1571
-- Name: session_temp_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX session_temp_pk ON session_temp USING btree (session_id);


--
-- TOC entry 1897 (class 1259 OID 33950)
-- Dependencies: 1546 1546 1546 1546
-- Name: shared_group_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX shared_group_pk ON shared_group USING btree (id_usuario, id_folder, id_obj_concreto, id_group);


--
-- TOC entry 1901 (class 1259 OID 33966)
-- Dependencies: 1547 1547 1547
-- Name: shared_usuario_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX shared_usuario_pk ON shared_usuario USING btree (id_folder, id_obj_concreto, id_usuario);


--
-- TOC entry 1866 (class 1259 OID 33913)
-- Dependencies: 1539
-- Name: textsearch_idx; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE INDEX textsearch_idx ON obj_concreto USING gin (texto_tsv);


--
-- TOC entry 1904 (class 1259 OID 33537)
-- Dependencies: 1548
-- Name: tipo_file_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX tipo_file_pk ON tipo_file USING btree (id_tipo_file);


--
-- TOC entry 1907 (class 1259 OID 33538)
-- Dependencies: 1549
-- Name: tipo_obj_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX tipo_obj_pk ON tipo_obj USING btree (id_tipo_obj);


--
-- TOC entry 1910 (class 1259 OID 33539)
-- Dependencies: 1550
-- Name: tipo_relacion_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX tipo_relacion_pk ON tipo_relacion USING btree (id_tiporelacion);


--
-- TOC entry 1915 (class 1259 OID 33540)
-- Dependencies: 1551 1551
-- Name: user_group_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX user_group_pk ON user_group USING btree (id_usuario, id_group);


--
-- TOC entry 1919 (class 1259 OID 33543)
-- Dependencies: 1552
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: jonathan; Tablespace: 
--

CREATE UNIQUE INDEX usuario_pk ON usuario USING btree (id_usuario);


--
-- TOC entry 1944 (class 2620 OID 33700)
-- Dependencies: 21 1533
-- Name: bitacora_folder; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_folder
    AFTER INSERT OR DELETE OR UPDATE ON folder
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1945 (class 2620 OID 33701)
-- Dependencies: 21 1534
-- Name: bitacora_form; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_form
    AFTER INSERT OR DELETE OR UPDATE ON formulario
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1946 (class 2620 OID 33702)
-- Dependencies: 21 1535
-- Name: bitacora_grupo; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_grupo
    AFTER INSERT OR DELETE OR UPDATE ON grupo
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1947 (class 2620 OID 33703)
-- Dependencies: 21 1539
-- Name: bitacora_obj_concreto; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_obj_concreto
    AFTER INSERT OR DELETE OR UPDATE ON obj_concreto
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1949 (class 2620 OID 33705)
-- Dependencies: 1541 21
-- Name: bitacora_permiso; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_permiso
    AFTER INSERT OR DELETE OR UPDATE ON permiso
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1950 (class 2620 OID 33708)
-- Dependencies: 21 1545
-- Name: bitacora_rol; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_rol
    AFTER INSERT OR DELETE OR UPDATE ON rol
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1951 (class 2620 OID 33711)
-- Dependencies: 21 1548
-- Name: bitacora_tipo_file; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_tipo_file
    AFTER INSERT OR DELETE OR UPDATE ON tipo_file
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1952 (class 2620 OID 33712)
-- Dependencies: 21 1549
-- Name: bitacora_tipo_obj; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_tipo_obj
    AFTER INSERT OR DELETE OR UPDATE ON tipo_obj
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1953 (class 2620 OID 33713)
-- Dependencies: 1550 21
-- Name: bitacora_tipo_relacion; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_tipo_relacion
    AFTER INSERT OR DELETE OR UPDATE ON tipo_relacion
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1954 (class 2620 OID 33714)
-- Dependencies: 1552 21
-- Name: bitacora_usuario; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER bitacora_usuario
    AFTER INSERT OR DELETE OR UPDATE ON usuario
    FOR EACH ROW
    EXECUTE PROCEDURE backup();


--
-- TOC entry 1948 (class 2620 OID 33782)
-- Dependencies: 20 1540
-- Name: llenar_tsv; Type: TRIGGER; Schema: public; Owner: jonathan
--

CREATE TRIGGER llenar_tsv
    AFTER INSERT OR UPDATE ON obj_digital
    FOR EACH ROW
    EXECUTE PROCEDURE llenar();


--
-- TOC entry 1923 (class 2606 OID 33585)
-- Dependencies: 1533 1533 1533 1533 1840
-- Name: fk_folder_rel_f_sf_folder; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY folder
    ADD CONSTRAINT fk_folder_rel_f_sf_folder FOREIGN KEY (fol_id_usuario, fol_id_folder) REFERENCES folder(id_usuario, id_folder) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1924 (class 2606 OID 33590)
-- Dependencies: 1552 1533 1919
-- Name: fk_folder_rel_u_f_usuario; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY folder
    ADD CONSTRAINT fk_folder_rel_u_f_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1925 (class 2606 OID 33595)
-- Dependencies: 1893 1545 1535
-- Name: fk_grupo_re_g_r_rol; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY grupo
    ADD CONSTRAINT fk_grupo_re_g_r_rol FOREIGN KEY (id_rol) REFERENCES rol(id_rol) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1926 (class 2606 OID 33605)
-- Dependencies: 1533 1533 1539 1840 1539
-- Name: fk_obj_conc_rel_f_o_c_folder; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY obj_concreto
    ADD CONSTRAINT fk_obj_conc_rel_f_o_c_folder FOREIGN KEY (id_usuario, id_folder) REFERENCES folder(id_usuario, id_folder) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1927 (class 2606 OID 33610)
-- Dependencies: 1549 1907 1539
-- Name: fk_obj_conc_rel_t_o_o_tipo_obj; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY obj_concreto
    ADD CONSTRAINT fk_obj_conc_rel_t_o_o_tipo_obj FOREIGN KEY (id_tipo_obj) REFERENCES tipo_obj(id_tipo_obj) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1928 (class 2606 OID 33615)
-- Dependencies: 1539 1539 1540 1861 1540 1540 1539
-- Name: fk_obj_digi_puede_ser_obj_conc; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY obj_digital
    ADD CONSTRAINT fk_obj_digi_puede_ser_obj_conc FOREIGN KEY (id_usuario, id_folder, id_obj_concreto) REFERENCES obj_concreto(id_usuario, id_folder, id_obj_concreto) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1929 (class 2606 OID 33620)
-- Dependencies: 1904 1540 1548
-- Name: fk_obj_digi_rel_t_o_d_tipo_fil; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY obj_digital
    ADD CONSTRAINT fk_obj_digi_rel_t_o_d_tipo_fil FOREIGN KEY (id_tipo_file) REFERENCES tipo_file(id_tipo_file) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1930 (class 2606 OID 33625)
-- Dependencies: 1845 1534 1542
-- Name: fk_permiso__form_p_g_formular; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY permiso_grupo
    ADD CONSTRAINT fk_permiso__form_p_g_formular FOREIGN KEY (id_form) REFERENCES formulario(id_form) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1933 (class 2606 OID 33640)
-- Dependencies: 1543 1845 1534
-- Name: fk_permiso__rel_f_p_u_formular; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY permiso_user
    ADD CONSTRAINT fk_permiso__rel_f_p_u_formular FOREIGN KEY (id_form) REFERENCES formulario(id_form) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1934 (class 2606 OID 33645)
-- Dependencies: 1545 1543 1893
-- Name: fk_permiso__rel_p_u_r_rol; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY permiso_user
    ADD CONSTRAINT fk_permiso__rel_p_u_r_rol FOREIGN KEY (id_rol) REFERENCES rol(id_rol) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1932 (class 2606 OID 33635)
-- Dependencies: 1893 1542 1545
-- Name: fk_permiso__rel_r_p_g_rol; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY permiso_grupo
    ADD CONSTRAINT fk_permiso__rel_r_p_g_rol FOREIGN KEY (id_rol) REFERENCES rol(id_rol) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1931 (class 2606 OID 33630)
-- Dependencies: 1542 1871 1541
-- Name: fk_permiso__relp_p_g_permiso; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY permiso_grupo
    ADD CONSTRAINT fk_permiso__relp_p_g_permiso FOREIGN KEY (id_permiso) REFERENCES permiso(id_permiso) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1935 (class 2606 OID 33650)
-- Dependencies: 1539 1539 1544 1544 1544 1861 1539
-- Name: fk_relacion_rel2_o_c__obj_conc; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY relaciones_obj_concretos
    ADD CONSTRAINT fk_relacion_rel2_o_c__obj_conc FOREIGN KEY (id_usuario, id_folder, id_obj_concreto) REFERENCES obj_concreto(id_usuario, id_folder, id_obj_concreto) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1936 (class 2606 OID 33655)
-- Dependencies: 1861 1544 1544 1539 1539 1544 1539
-- Name: fk_relacion_rel_o_c_r_obj_conc; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY relaciones_obj_concretos
    ADD CONSTRAINT fk_relacion_rel_o_c_r_obj_conc FOREIGN KEY (obj_id_usuario, obj_id_folder, obj_id_obj_concreto) REFERENCES obj_concreto(id_usuario, id_folder, id_obj_concreto) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1937 (class 2606 OID 33660)
-- Dependencies: 1550 1910 1544
-- Name: fk_relacion_rel_t_r_r_tipo_rel; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY relaciones_obj_concretos
    ADD CONSTRAINT fk_relacion_rel_t_r_r_tipo_rel FOREIGN KEY (id_tiporelacion) REFERENCES tipo_relacion(id_tiporelacion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1939 (class 2606 OID 33670)
-- Dependencies: 1546 1861 1539 1539 1539 1546 1546
-- Name: fk_shared_g_re_s_g_o__obj_conc; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY shared_group
    ADD CONSTRAINT fk_shared_g_re_s_g_o__obj_conc FOREIGN KEY (id_usuario, id_folder, id_obj_concreto) REFERENCES obj_concreto(id_usuario, id_folder, id_obj_concreto) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1938 (class 2606 OID 33665)
-- Dependencies: 1848 1546 1535
-- Name: fk_shared_g_rel_g_s_g_grupo; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY shared_group
    ADD CONSTRAINT fk_shared_g_rel_g_s_g_grupo FOREIGN KEY (id_group) REFERENCES grupo(id_group) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1940 (class 2606 OID 33680)
-- Dependencies: 1547 1552 1919
-- Name: fk_shared_u_re_u_s_u_usuario; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY shared_usuario
    ADD CONSTRAINT fk_shared_u_re_u_s_u_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1941 (class 2606 OID 33685)
-- Dependencies: 1535 1551 1848
-- Name: fk_user_gro_rel_u_g_g_grupo; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY user_group
    ADD CONSTRAINT fk_user_gro_rel_u_g_g_grupo FOREIGN KEY (id_group) REFERENCES grupo(id_group) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1942 (class 2606 OID 33690)
-- Dependencies: 1919 1551 1552
-- Name: fk_user_gro_rel_u_u_g_usuario; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY user_group
    ADD CONSTRAINT fk_user_gro_rel_u_u_g_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1943 (class 2606 OID 33695)
-- Dependencies: 1545 1552 1893
-- Name: fk_usuario_rel_u_r_rol; Type: FK CONSTRAINT; Schema: public; Owner: jonathan
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_rel_u_r_rol FOREIGN KEY (id_rol) REFERENCES rol(id_rol) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1959 (class 0 OID 0)
-- Dependencies: 3
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2009-05-07 21:25:56 BOT

--
-- PostgreSQL database dump complete
--

