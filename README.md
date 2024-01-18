# Modul10-PHP

Tabell languages

```sql
CREATE TABLE IF NOT EXISTS `languages` (`id` INT NOT NULL AUTO_INCREMENT , `language` VARCHAR(25) NOT NULL , `language_type` TINYINT NOT NULL DEFAULT '0' COMMENT '1:computer, 2:spoken, 3:other' , PRIMARY KEY (`id`)) ENGINE = InnoDB;
```


```sql
INSERT INTO `languages` (`language`, `language_type`) VALUES
('PHP', 2),
('JavaScript', 2),
('HTML', 2),
('CSS', 2),
('svenska', 1);
```

---

Branch *1-code-from-module6*

Create class Database - first step

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