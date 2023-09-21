# TPE-WEB2
Trabajo Práctico Especial de Web 2

Integrantes:
    -RIVA, Franco
    -LORENZO, Nicolas

El sitio permite ver a los visitantes info detallada sobre las diferentes placas de video a la venta, incluyendo especificaciones tecnicas, los administradores podran agregar, quitar y editar las placas de video y administrar las especificaciones asociadas a ellas.

Creamos dos tablas, "Producto" para almacenar la informacion sobre las placas, y "Especificacion" para almacenar las especificaciones tecnicas relacionadas con cada placa de video.
La clave primaria de la tabla "Producto" es "ID", y la tabla "Especificacion" tiene una clave primaria "ID" y una clave foránea "Producto_ID" que se relaciona con el campo "ID" de la tabla "Producto".

Nuestro modelo de datos permite la relacion 1:N Entre productos y especificaciones, lo que significa que cada placa de video puede tener multiples especificaciones asociadas.


Diagrama de Entidad relacion:

Producto (Placa de Video):

    -Atributos:
        ID (Clave Primaria)
        Marca
        Modelo
        Descripción
        Precio
        Admin_ID
    -Relaciones:
        Una Placa de Video tiene muchas Especificaciones (relación 1:N)
        Puede ser creado o modificado por un Usuario (relación N:1)

Especificación:

    -Atributos:
        ID (Clave Primaria)
        Marca
        Modelo
        Valor
        Memoria
        GPU Clock
        Memory Clock
        Fabricante
        Producto_ID
    -Relaciones:
        Pertenecerá a una Placa de Video (relación N:1)

    Usuarios

    -Atributos:
        ID (Clave Primaria)
        Username
        Password
    -Relaciones:
        Puede tener uno o varios Roles (relación N:N)
    

    Roles

    -Atributos:
        ID (Clave Primaria)
        Nombre
    -Relaciones:
        Asociado a uno o varios Usuarios (relación N:N)

Nuestra BD tambien tendra su seccion para usuarios y sus debidos roles para que estos puedan modificar borrar y agregar nuevos items.

Esta parte contendra:
    -Tabla de Usuarios: esta almacenara informacion sobre los usuarios que pueden acceder al sitio, tiene username y password para autenticación.
    -Tabla de Roles: Esta tabla define los roles disponibles en el sistema, como "usuario" y "administrador".
    -Tabla de relacion entre usuarios y roles, esta establece una relacion n:n entre usuarios y roles, nos permite asignar roles especificos a los usuarios lo que facilita la gestion de permisos y roles en nuestra app.



Exportamos el archivo placas_de_video desde phpMyAdmin en formato .sql.



 //codigo sql con el cual creamos las tablas.
CREATE TABLE Usuarios (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE Roles (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL
);

CREATE TABLE Usuarios_Roles (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario_ID INT,
    Rol_ID INT,
    FOREIGN KEY (Usuario_ID) REFERENCES Usuarios(ID),
    FOREIGN KEY (Rol_ID) REFERENCES Roles(ID)
);
CREATE TABLE Producto (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Marca VARCHAR(255) NOT NULL,
    Modelo  VARCHAR(255) NOT NULL,
    Descripcion TEXT,
    Precio DECIMAL(10, 2) NOT NULL,
    Admin_ID INT,
    FOREIGN KEY (Admin_ID) REFERENCES Usuarios(ID)
);

CREATE TABLE Especificacion (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Marca VARCHAR(255) NOT NULL,
    Modelo  VARCHAR(255) NOT NULL,
    Valor VARCHAR(255) NOT NULL,
    Memoria INT NOT NULL,
    GPU_Clock INT NOT NULL,
    Memory_Clock INT NOT NULL,
    Fabricante  VARCHAR(255) NOT NULL,
    Producto_ID INT,
    FOREIGN KEY (Producto_ID) REFERENCES Producto(ID)
);




