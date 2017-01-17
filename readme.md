Api para gestion de tareas realizado con # Lumen PHP Framework por Ronny Freites

Pasos para instalación
1. Asegurate de tener instalado git en tu sistema operativo.
2. clona el repositorio hacia tu directorio de trabajo con el comando git clone git@github.com:rfreites/api-de-gestion-de-tareas.git
3. realiza un composer install de tu aplicación.
4. conectate a tu base motor de base local mysql y crea una base de datos llamada gestiontareas
5. corre el comando dentro del directorio de tu aplicacion "php artisan migrate --seed"
6. corre el comando "php -S localhost:8000 -t ./public" para levantar el servidor de php

Veras que se habra creado un usuario por defecto, el cual tiene privilegios de administrador con el que puede crear
y actualizar otros usuarios del sistema.

Por defecto existe un usuario en el sistema:

Para obtener el token de autenticación de este usuario realiza el siguiente postman:

Method: Post
ruta: /api/authenticate
Parametros:
email = ronnyangelo.freites@gmail.com
password = secret

http://localhost:8000/api/authenticate?email=ronnyangelo.freites@gmail.com&password=secret

Obtendrás un token con el cual podrás gestionar la api.

-Usuarios

Agregar usuario

Method: POST
ruta: /api/users/add
Parametros:
token = tu token de autenticación
firstname = nombre
lastname = apellido
email = correo electrónico
password = contraseña
admin = para asignarle privilegios de administrador (1 ó 0)

http://localhost:8000/api/users/add?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&firstname=Juan D.&lastname=Freites&email=jfreites@gmail.com&password=secret&admin=0&XDEBUG_START_SESSION=PHPSTORM

Actualizar usuario

Method: PUT
ruta: /api/users/{id_del_usuario}
Parametros:
token = tu token de autenticación
firstname = nombre
lastname = apellido
email = correo electrónico
password = contraseña
admin = para asignarle privilegios de administrador (1 ó 0)

http://localhost:8000/api/users/2?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&firstname=Jeffery A.&lastname=Sato&email=jfreites@gmail.com&password=secret&admin=0

Mostrar usuario en especifico

Method: GET
ruta: /api/users/{id_del_usuario}
Parametros:
token = tu token de autenticación

http://localhost:8000/api/users/2?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA

Mostrar todos los usuarios
Method: GET
ruta: /api/users
Parametros:
token = tu token de autenticación

http://localhost:8000/api/users?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA

Eliminar usuario
Method: DELETE
ruta: /api/users/{id_del_usuario}
Parametros:
token = tu token de autenticación

http://localhost:8000/api/users/2?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA

-Tareas

Agregar tarea
Method: POST
ruta: /api/api/tasks/add
Parametros:
token = tu token de autenticación
title = título de la tarea
description = description de la tarea
due_description = fecha formato admitido AAAA-MM-DD

http://localhost:8000/api/tasks/add?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&title=Mi primera tarea&description=descripcion de mi tarea&due_description=2017-07-24

Actualizar tarea
Method: PUT
ruta: /api/tasks/{id_tarea}
Parametros:
token = tu token de autenticación
title = título de la tarea
description = description de la tarea
due_description = fecha formato admitido AAAA-MM-DD

http://localhost:8000/api/tasks/1?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&title=Mi primera tarea&description=descripcion de mi tarea&due_description=2017-07-27

Mostrar tarea especifica
Method: GET
ruta: /api/tasks/{id_tarea}
Parametros:
token = tu token de autenticación

http://localhost:8000/api/tasks/1?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&title=Mi primera tarea&description=descripcion de mi tarea&due_description=2017-07-27

Mostrar todas las tareas
Method: GET
ruta: /api/tasks
Parametros:
token = tu token de autenticación

http://localhost:8000/api/tasks?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&title=Mi primera tarea&description=descripcion de mi tarea&due_description=2017-07-27

Emilinar tarea
Method: DELETE
ruta: /api/tasks/{id_tarea}
Parametros:
token = tu token de autenticación

http://localhost:8000/api/tasks/2?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA

-Prioridades

Agregar prioridad
Method: POST
ruta: /api/tasks/{id_tarea}/priorities/add
Agregar prioridad
token = tu token de autenticación
name = nombre de la prioridad

http://localhost:8000/api/tasks/1/priorities/add?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&name=Mi primera prioridad

Actualizar una prioridad
Method: PUT
ruta: /api/tasks/{id_tarea}/priorities/{id_prioridad}
Parametros:
token = tu token de autenticación
name = nombre de la prioridad

http://localhost:8000/api/tasks/1/priorities/1?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA&name=Mi primera prioridad modificada

Mostrar prioridad especifica
Method: GET
ruta: /api/tasks/{id_tarea}/priorities/{id_prioridad}
Parametros:
token = tu token de autenticación

http://localhost:8000/api/tasks/1/priorities/1?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA

Mostrar todas las prioridades
Method: GET
ruta: /api/tasks/{id_tarea}/priorities
Parametros:
token = tu token de autenticación

http://localhost:8000/api/tasks/1/priorities?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA


Eliminar prioridad
Method: DELETE
ruta: /api/tasks/{id_tarea}/priorities/{id_prioridad}
Parametros:
token = tu token de autenticación

http://localhost:8000/api/tasks/1/priorities/1?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2x1bWVuand0L3B1YmxpYy9hcGkvYXV0aGVudGljYXRlIiwiaWF0IjoxNDg0NjI2NzcwLCJuYmYiOjE0ODQ2MjY3NzAsImp0aSI6IjRiOGU4YTQxMjdkMmM1MzVmNjZiZDY1ZjNlNTUwMTk5Iiwic3ViIjoxfQ.ybBxlMH7BqIFPmvM1KLCTR5PcQISAiHQM1kulE-1pTA


