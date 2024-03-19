CREATE TABLE IF NOT EXISTS tasks (
  id int(10) PRIMARY KEY auto_increment,
  name VARCHAR(255) NOT NULL,
  deadline VARCHAR(255),
  created_at VARCHAR(255) NOT NULL,
  updated_at VARCHAR(255) NOT NULL,
  status tinyint(1) NOt NULL
);