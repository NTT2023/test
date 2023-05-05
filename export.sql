BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "post" (
	"id"	INTEGER,
	"name"	TEXT,
	"content"	TEXT,
	"date"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE "users" (
	"id"	INTEGER,
	"username"	TEXT,
	"mdp"	TEXT,
	"role"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO "post" ("id","name","content","date") VALUES (4274,'Premier','C''est nous les punks

On sert à rien

C''est nous les rats

C''est nous les chiens

C''est nous les punks

On n''aime rien

À part le punk

Ça on aime bien',1682247636),
 (4278,'Poésie zéro','Si tu es né dans une cité HLM

Je te dédicace ce poème

En espérant qu''au fond de tes yeux ternes

Tu puisses y voir un petit brin d''herbe

 

Oï !

 

Il est temps de faire la part des choses

Il est grand temps de faire une pause

De troquer cette vie morose

Contre le parfum d''une ros',1682256146),
 (4279,'tzste','Si tu es né dans une cité HLM

Je te dédicace ce poème

En espérant qu''au fond de tes yeux ternes

Tu puisses y voir un petit brin d''herbe

 

Oï !

 

Il est temps de faire la part des choses

Il est grand temps de faire une pause

De troquer cette vie morose

Contre le parfum d''une rose

https://lyricstranslate.com',1682256236),
 (4285,'Test construct','cfvqscqsc',1682325071);
INSERT INTO "users" ("id","username","mdp","role") VALUES (2,'admin','admin',1),
 (3,'toto','toto',2);
COMMIT;
