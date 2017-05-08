-- Login to psql and run the following
-- What is the result?
SELECT MAX(id) FROM your_table;

-- Then run...
-- This should be higher than the last result.
SELECT nextval('your_table_id_seq');

-- If it's not higher... run this set the sequence last to your highest pid it. 
-- (wise to run a quick pg_dump first...)
SELECT setval('your_table_id_seq', (SELECT MAX(id) FROM your_table));
-- if your tables might have no rows
-- false means the set value will be returned by the next nextval() call    
SELECT setval('your_table_id_seq', COALESCE((SELECT MAX(id)+1 FROM your_table), 1), false);
Source - Ruby Forum