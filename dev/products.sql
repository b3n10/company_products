DROP TABLE IF EXISTS products;

CREATE TABLE IF NOT EXISTS products (
  id INTEGER NOT NULL PRIMARY KEY,
  name TEXT NOT NULL,
  description TEXT NOT NULL,
  price INTEGER NOT NULL,
  created TEXT NOT NULL,
  modified TEXT NOT NULL
);
