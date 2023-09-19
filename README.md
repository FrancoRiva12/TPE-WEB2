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
    -Relaciones:
        Una Placa de Video tiene muchas Especificaciones (relación 1:N)
    

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
        
    -Relaciones:
        Pertenecerá a una Placa de Video (relación N:1)

Exportamos el archivo placas_de_video desde phpMyAdmin en formato .sql.

