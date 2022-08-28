CREATE DATABASE doinngsdone DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
  
USE doinngsdone;

CREATE TABLE user (
    dt_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Идентификатор пользователя',
    password_hash VARCHAR(128) NOT NULL COMMENT 'Хэш пароля',
    avatar_path VARCHAR(128) COMMENT 'Путь аватарки',
    name VARCHAR(128) COMMENT 'Имя пользователя',
    email VARCHAR(128) UNIQUE COMMENT 'Емаил адрес'
);

CREATE TABLE project (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Идентификатор проекта',
    user_id INT NOT NULL COMMENT 'Пользователь, которому принадлежит проект',
    project_name VARCHAR(128) NOT NULL COMMENT 'Название проекта',
    INDEX (user_id)
);

CREATE TABLE task (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Идентификатор задачи',
    user_id INT NOT NULL COMMENT 'Пользователь, которому принадлежит задача',
    project_id INT NOT NULL COMMENT 'Проект, которому принадлежит задача',
    task_name VARCHAR(128) NOT NULL COMMENT 'Название задачи',
    status_ready TINYINT DEFAULT 0 COMMENT 'Статус готовности',
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Таймстэмп заведения задачи',
    dt_deadline VARCHAR(128) COMMENT 'Таймстэмп дедлайна',
    file_path VARCHAR(128) COMMENT 'Путь файла',
    INDEX (user_id),
    INDEX (project_id)
);

