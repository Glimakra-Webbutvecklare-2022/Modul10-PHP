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