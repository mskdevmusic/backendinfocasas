/* CREATE DATABASE infocasaspreprod;


CREATE TABLE `tasks`(
	`id` INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nameTask` VARCHAR(255) NOT NULL,
	`descriptionTask` VARCHAR(255) NOT NULL,
    `completedTask` BOOLEAN NOT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL
); */


DROP PROCEDURE IF EXISTS sp_insertTask;

DELIMITER //
CREATE PROCEDURE sp_insertTask (
	IN _nameTask VARCHAR (255),
	IN _descriptionTask VARCHAR (255),
	OUT _message VARCHAR (255))
    
	BEGIN
		IF(_nameTask <> '') THEN
			IF(_descriptionTask <> '') THEN
				INSERT INTO tasks(id, nameTask, descriptionTask, completedTask, created_at, updated_at) VALUES (NULL, _nameTask, _descriptionTask, FALSE, NOW(), NULL);
					
				SET _message = 'REGISTRADO EXITOSAMENTE';
			ELSE
				SET _message = 'INGRESE DESCRIPCION';
			END IF;
        ELSE
			SET _message = 'INGRESE UN NOMBRE';
        END IF;
	END
//

CALL sp_insertTask('Activity 1', 'This activity is easy to do.', @message);
SELECT @message MSG;


DROP PROCEDURE IF EXISTS sp_updateTask;

DELIMITER //
CREATE PROCEDURE sp_updateTask (
    IN _id INT(255),
	IN _nameTask VARCHAR (255),
	IN _descriptionTask VARCHAR (255),
    IN _completedTask VARCHAR (255),
	OUT _message VARCHAR (255))
    
	BEGIN
		IF(SELECT COUNT(*) FROM tasks WHERE id = _id) <> 0 THEN
            UPDATE tasks
            SET
            	nameTask = _nameTask,
                descriptionTask = _descriptionTask,
                completedTask = _completedTask,
                updated_at = NOW()
            WHERE id = _id;
            
            SET _message = 'ACTUALIZADO EXITOSAMENTE';
        ELSE
			SET _message = 'ID NO EXISTE';
        END IF;
	END
//

CALL sp_updateTask(1, 'Activity 1', 'This activity is easy to do.', '1', @message);
SELECT @message MSG;


DROP PROCEDURE IF EXISTS sp_deleteTask;

DELIMITER //
CREATE PROCEDURE sp_deleteTask (
    IN _id INT(255),
	OUT _message VARCHAR (255))
    
	BEGIN
		IF(SELECT COUNT(*) FROM tasks WHERE id = _id) <> 0 THEN
            DELETE FROM tasks WHERE id = _id;
            
            SET _message = 'ELIMINADO EXITOSAMENTE';
        ELSE
			SET _message = 'ID NO EXISTE';
        END IF;
	END
//

CALL sp_deleteTask(1, @message);
SELECT @message MSG;


DROP PROCEDURE IF EXISTS sp_getAllTask;

DELIMITER //
CREATE PROCEDURE sp_getAllTask ()
    
	BEGIN
		SELECT * FROM tasks;
	END
//

CALL sp_getAllTask()


DROP PROCEDURE IF EXISTS sp_getTask;

DELIMITER //
CREATE PROCEDURE sp_getTask (
    IN _id INT(255))
    
	BEGIN
		SELECT * FROM tasks WHERE id = _id;
	END
//

CALL sp_getTask(1)
