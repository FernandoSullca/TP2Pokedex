SELECT * FROM pokedex.pokemon__pokemon_type;
SELECT * FROM pokedex.pokemon_type;
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (1,1 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (1,2 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (2,1 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (2,2 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (3,1 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (3,2 );

#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (4,3 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (5,3 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (6,3 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (6,4 );

#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (7,5 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (8,5 );
#INSERT INTO pokemon__pokemon_type (pokemon_id, pokemon_type_id) VALUES (9,5 );


#SELECT * FROM pokedex.pokemon__pokemon_type
#ORDER BY pokemon_id , pokemon_type_id ;

#delete from pokedex.pokemon__pokemon_type
#where pokemon_id;

#Delete from pokedex.pokemon__pokemon_type where pokemon_id IN (Select c1.pokemon_id FROM pokedex.pokemon__pokemon_type as c1
#INNER JOIN pokedex.pokemon__pokemon_type as c2 ON c1.pokemon_id < c2.pokemon_id AND c1.pokemon_type_id = c2.pokemon_type_id);