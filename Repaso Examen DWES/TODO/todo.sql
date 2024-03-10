CREATE DATABASE todo;
CREATE USER 'todo'@'localhost' IDENTIFIED BY 'todo';
GRANT ALL PRIVILEGES ON todo.* TO 'todo'@'localhost';
FLUSH PRIVILEGES;


DROP TABLE IF EXISTS tareas;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    deberes VARCHAR(255) NOT NULL,
    fecha_entrega DATE NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
);



-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Comprar', 'Ir', '2023-12-01');
-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Revisión', 'Llevar', '2023-12-05');
-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Cita', 'Cita ', '2023-12-07');
-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Entrega', 'Finalizar', '2023-12-10');
-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Reunión', 'Reunión', '2023-12-11');
-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Pago', 'Pagar', '2023-12-15');
-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Altar', 'Comprar', '2023-12-20');
-- INSERT INTO tareas (nombre, deberes, fecha_entrega) VALUES ('Preparación', 'Asustar', '2023-12-24');

