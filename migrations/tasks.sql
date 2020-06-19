CREATE TABLE `tasks` (
 `id` INT NOT NULL AUTO_INCREMENT , 
 `username` VARCHAR(255) NOT NULL , 
 `email` VARCHAR(255) NOT NULL , 
 `status` VARCHAR(5) NOT NULL , 
 `text` TEXT NOT NULL , 
 `image` VARCHAR(255) NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;