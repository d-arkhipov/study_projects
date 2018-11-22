USE `employees`;

#TASK 1: 
#Создать на основе запросов ДЗ к уроку 3, VIEW.

#Выбрать среднюю зарплату по отделам.
CREATE VIEW `average_salary` AS
SELECT `departments`.`depart` AS `department`, AVG(`salary`) AS `average_salary` FROM `employees`
INNER JOIN `departments` ON `employees`.`depart_id` = `departments`.`id`
GROUP BY `department`;

SELECT * FROM `average_salary`;

#Выбрать максимальную зарплату у сотрудника.
CREATE VIEW `max_salary` AS
SELECT `id`, CONCAT(`firstname`, ' ', `lastname`) AS `name`, `salary` FROM `employees` 
ORDER BY `salary` DESC LIMIT 1;

SELECT * FROM `max_salary`;

DROP VIEW `max_salary`;

#Удалить одного сотрудника, у которого максимальная зарплата.
CREATE VIEW `select_employees` AS
SELECT `id`, CONCAT(`firstname`, ' ', `lastname`) AS `name`, `salary` FROM `employees`;

DELETE FROM `select_employees`
ORDER BY `salary` DESC LIMIT 1;

#Посчитать количество сотрудников во всех отделах.
CREATE VIEW `count_empl_by_dep` AS
SELECT `departments`.`depart` AS `department`, COUNT(`employees`.`id`) AS `count` FROM `employees`
LEFT JOIN `departments` ON `employees`.`depart_id` = `departments`.`id`
GROUP BY `employees`.`depart_id`;

SELECT * FROM `count_empl_by_dep`;

#Найти количество сотрудников в отделах и посмотреть, сколько всего денег получает отдел.
CREATE VIEW `salary_by_dep` AS
SELECT `departments`.`depart` AS `department`,
COUNT(`employees`.`id`) AS `count`,
SUM(`employees`.`salary`) AS `salary` FROM `employees`
LEFT JOIN `departments` ON `employees`.`depart_id` = `departments`.`id`
GROUP BY `employees`.`depart_id`;

SELECT * FROM `salary_by_dep`;


#TASK 2:
#Создать функцию, которая найдет менеджера по имени и фамилии.
CREATE FUNCTION `search_by_name`(fn VARCHAR(15), ln VARCHAR(15))
RETURNS TEXT DETERMINISTIC
RETURN (SELECT `id` FROM `employees` WHERE `firstname`=fn AND `lastname`=ln);
    
SELECT * FROM `employees` WHERE `id`=search_by_name('Билл', 'Гейтс');


#TASK 3:
#Создать триггер, который при добавлении нового сотрудника будет выплачивать ему вступительный бонус, занося запись в таблицу salary.
