-- Database: db_cencomoda

-- DROP DATABASE IF EXISTS db_cencomoda;

CREATE DATABASE db_cencomoda
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Colombia.1252'
    LC_CTYPE = 'Spanish_Colombia.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

-- public.id_tab_inventario_productos_no_terminados definition

-- DROP SEQUENCE public.id_tab_inventario_productos_no_terminados;

CREATE SEQUENCE public.id_tab_inventario_productos_no_terminados
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;

-- public.tab_inventario_productos_no_terminados definition

-- Drop table

-- DROP TABLE public.tab_inventario_productos_no_terminados;

CREATE TABLE public.tab_inventario_productos_no_terminados (
	id_invpnt int4 NOT NULL DEFAULT nextval('id_tab_inventario_productos_no_terminados'::regclass),
	tipo_de_tela varchar(50) NOT NULL,
	cant_de_tela varchar(100) NOT NULL,
	color varchar(20) NOT NULL,
	tipo_de_insumo varchar(30) NOT NULL,
	cant_insumo varchar(100) NOT NULL,
	fecha_invpnt date NULL,
	CONSTRAINT tab_inventario_productos_no_terminados_pkey PRIMARY KEY (id_invpnt)
);

-- public.id_tab_inventario_productos_terminados definition

-- DROP SEQUENCE public.id_tab_inventario_productos_terminados;

CREATE SEQUENCE public.id_tab_inventario_productos_terminados
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;

-- public.tab_inventario_productos_terminados definition

-- Drop table

-- DROP TABLE public.tab_inventario_productos_terminados;

CREATE TABLE public.tab_inventario_productos_terminados (
	id_invp int4 NOT NULL DEFAULT nextval('id_tab_inventario_productos_terminados'::regclass),
	tipo_uniforme varchar(25) NOT NULL,
	cant_uniforme varchar(100) NOT NULL,
	color varchar(20) NOT NULL,
	talla varchar(3) NOT NULL,
	fecha_invp date NULL,
	CONSTRAINT tab_inventario_productos_terminados_pkey PRIMARY KEY (id_invp)
);

-- public.id_tab_materia_prima definition

-- DROP SEQUENCE public.id_tab_materia_prima;

CREATE SEQUENCE public.id_tab_materia_prima
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;

-- public.tab_materia_prima definition

-- Drop table

-- DROP TABLE public.tab_materia_prima;

CREATE TABLE public.tab_materia_prima (
	id_mp int4 NOT NULL DEFAULT nextval('id_tab_materia_prima'::regclass),
	tipo_de_tela varchar(50) NOT NULL,
	cant_de_tela varchar(100) NOT NULL,
	color varchar(20) NOT NULL,
	tipo_de_insumo varchar(30) NOT NULL,
	cant_insumo varchar(100) NOT NULL,
	CONSTRAINT tab_materia_prima_pkey PRIMARY KEY (id_mp)
);

-- public.id_tab_productos definition

-- DROP SEQUENCE public.id_tab_productos;

CREATE SEQUENCE public.id_tab_productos
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;

-- public.tab_productos definition

-- Drop table

-- DROP TABLE public.tab_productos;

CREATE TABLE public.tab_productos (
	id_product int4 NOT NULL DEFAULT nextval('id_tab_productos'::regclass),
	tipo_uniforme varchar(25) NOT NULL,
	color varchar(20) NOT NULL,
	cant_uniforme varchar(100) NOT NULL,
	talla varchar(3) NOT NULL,
	CONSTRAINT tab_productos_pkey PRIMARY KEY (id_product)
);

-- public.id_tab_proovedores definition

-- DROP SEQUENCE public.id_tab_proovedores;

CREATE SEQUENCE public.id_tab_proovedores
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;

-- public.tab_proovedores definition

-- Drop table

-- DROP TABLE public.tab_proovedores;

CREATE TABLE public.tab_proovedores (
	id_prov int4 NOT NULL DEFAULT nextval('id_tab_proovedores'::regclass),
	nombre_prov varchar(30) NOT NULL,
	tipo_de_tela varchar(50) NOT NULL,
	color varchar(20) NOT NULL,
	cant_de_tela varchar(100) NOT NULL,
	tipo_de_insumo varchar(30) NOT NULL,
	cant_insumo varchar(100) NOT NULL,
	fecha date NULL,
	CONSTRAINT tab_proovedores_pk PRIMARY KEY (id_prov)
);

-- public.id_tab_registrousu definition

-- DROP SEQUENCE public.id_tab_registrousu;

CREATE SEQUENCE public.id_tab_registrousu
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;

-- public.tab_registrousu definition

-- Drop table

-- DROP TABLE public.tab_registrousu;

CREATE TABLE public.tab_registrousu (
	id_usuario int4 NOT NULL DEFAULT nextval('id_tab_registrousu'::regclass),
	usuario varchar(30) NOT NULL,
	contrasena varchar(100) NOT NULL,
	correo varchar(200) NOT NULL,
	telefono varchar(30) NOT NULL,
	CONSTRAINT tab_registrousu_pk PRIMARY KEY (id_usuario)
);