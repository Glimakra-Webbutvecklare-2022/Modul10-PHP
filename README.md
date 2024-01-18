# Modul10-PHP


---

2024-01-18

Merged branch *1-code-from-module6* to main

---



## Models


Create class Database - first step

File `_models/Database.php`

```php
class Database
{
    public function __construct()
    {

        // credentials
        $servername = "mysql";
        $database = "db_lecture";
        $username = "db_user";
        $password = "db_password";

        // data source name
        $dsn = "mysql:host=$servername;dbname=$database";

        try {

            // connect to database
            $pdo = new PDO($dsn, $username, $password);

            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
```

In order to use this Database class so other models can inherit - add public variable $db. Edit Database.php:

```php
class Database
{

    public $db;

    public function __construct()
    {

        // credentials
        $servername = "mysql";
        $database = "db_lecture";
        $username = "db_user";
        $password = "db_password";

        // data source name
        $dsn = "mysql:host=$servername;dbname=$database";

        try {

            // connect to database
            $this->db = new PDO($dsn, $username, $password);

            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            // ett fel som visar 'hemligheter' loggas till en fil för att inte visa för mycket
            // echo "Connection failed: " . $e->getMessage();
            echo "Connection failed: ";
        }
    }
}
```

Create a new class | model - and let this inherit class Database.

File `_models/Language.php`



```sql
class Language extends Database
{
    function __construct()
    {
        parent::__construct();
    }
    
}
```


---

Time to create functions to handle a CRUD application

```
select_all()

insert_one()

delete_one()

update_one()
```

**Check file Language.php for functions...**


---

## MySQL relations

A table names *languages* with a relation to table *user*. Match columns:

user.user_id = languages.user_id


```sql
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(25) NOT NULL,
  `language_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:computer, 2:spoken, 3:other',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `languages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
```



An example SQL joins

All but user password....

```sql
SELECT languages.*, user.username, user.user_id FROM languages INNER JOIN user ON languages.user_id = user.user_id;
```

An application should avoid errors if possible...

Added in class|model Language a function named **setup()**. This private function runs when the class is initiated. Since the model has a foreign key  - *user.user_id* - it might return an errror if no user i registrered in database.  

```php
class Language extends Database
{
    function __construct()
    {
        parent::__construct();
        $this->setup();
    }
    

    private function setup()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `languages` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `language` varchar(25) NOT NULL,
            `language_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:computer, 2:spoken, 3:other',
            `user_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `user_id` (`user_id`),
            CONSTRAINT `languages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
          ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    // ...
}
```