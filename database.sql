-- Please import this statement to your database via PHPmyAdmin
DROP DATABASE IF EXISTS `aipim`;
-- Create database change value in ` ` to your needs
CREATE DATABASE IF NOT EXISTS `aipim` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
use aipim;

-- Table User
CREATE TABLE `Users` (
   user_id INT AUTO_INCREMENT NOT NULL,
   user_name VARCHAR(25) NOT NULL,
   email_address VARCHAR(50) UNIQUE NOT NULL,
   user_password VARCHAR(60) NOT NULL,
   password_change_date TIMESTAMP,
   CONSTRAINT PRIMARY KEY (user_id)
);

-- Table Pass Reset
CREATE TABLE Pass_reset (
    pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    pwdResetEmail TEXT NOT NULL,
    pwdResetSelector TEXT NOT NULL,
    pwdResetToken LONGTEXT NOT NULL,
    pwdResetExpires TEXT NOT NULL
);
