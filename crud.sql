-- Adminer 4.8.1 PostgreSQL 10.21 dump

DROP TABLE IF EXISTS "manpower";
DROP SEQUENCE IF EXISTS manpower_manid_seq;
CREATE SEQUENCE manpower_manid_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."manpower" (
    "manid" integer DEFAULT nextval('manpower_manid_seq') NOT NULL,
    "name" character varying(100) NOT NULL,
    "skill_code" integer NOT NULL,
    "address" text NOT NULL,
    "mobileno" integer NOT NULL,
    "email" character varying(100) NOT NULL,
    "remarks" text NOT NULL,
    "date_of_birth" date NOT NULL,
    CONSTRAINT "manpower_pkey" PRIMARY KEY ("manid")
) WITH (oids = false);

INSERT INTO "manpower" ("manid", "name", "skill_code", "address", "mobileno", "email", "remarks", "date_of_birth") VALUES
(1,	'arul murugan',	1,	'chennai',	996542770,	'arulcse@hotmail.com',	'test',	'2022-07-04');

DROP TABLE IF EXISTS "mst_skillsets";
DROP SEQUENCE IF EXISTS mst_skillsets_sid_seq;
CREATE SEQUENCE mst_skillsets_sid_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."mst_skillsets" (
    "sid" integer DEFAULT nextval('mst_skillsets_sid_seq') NOT NULL,
    "skillset" character varying(500) NOT NULL,
    "remarks" character varying(500),
    CONSTRAINT "mst_skillsets_pkey" PRIMARY KEY ("sid")
) WITH (oids = false);

INSERT INTO "mst_skillsets" ("sid", "skillset", "remarks") VALUES
(1,	'Java,HTML5',	'Test Remark');

ALTER TABLE ONLY "public"."manpower" ADD CONSTRAINT "manpower_manid_fkey" FOREIGN KEY (manid) REFERENCES mst_skillsets(sid) ON DELETE RESTRICT NOT DEFERRABLE;

-- 2022-07-29 08:31:32.594839+05:30
