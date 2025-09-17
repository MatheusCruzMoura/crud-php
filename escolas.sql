CREATE TABLE "escolas" (
    "id" SERIAL PRIMARY KEY,
    "nome" VARCHAR(255) NOT NULL,
    "cnpj" VARCHAR(18) NOT NULL,
    "imagem" VARCHAR(255) NOT NULL,
    "delete" BOOLEAN DEFAULT FALSE NOT NULL
);

CREATE TABLE "auditoria_escolas" (
    "id" SERIAL PRIMARY KEY,
    "escola_id" int references escolas(id),
    "nome" VARCHAR(255) NOT NULL,
    "cnpj" VARCHAR(18) NOT NULL,
    "imagem" VARCHAR(255) NOT NULL,
    "delete" BOOLEAN DEFAULT FALSE NOT NULL,
    "user_ip" VARCHAR(15) NOT NULL,
    "data_hora" TIMESTAMPTZ NOT NULL
);