# desis-php
Sistema de votación para Desis

# Pasos para instalar el proyecto:

1. Clona el repositorio desde GitHub.
2. Configura la conexión a la base de datos en el archivo de configuración "bd.php".
3. Importa la estructura de la base de datos desde el archivo SQL proporcionado.
4. Inicia un servidor web o un entorno de desarrollo local para ejecutar el proyecto. Yo use XAMPP.

Información de versión:

- Versión de PHP: 8.2.0 que viene instalado con el XAMPP release 8.2.0
- Versión de la base de datos:  MySQL Ver 8.0.32 for macos12.6 on arm64 (Homebrew)
- Versión de XAMPP: 8.2.0
- Versión Servidor Apache 2.4.54

# Diseño de la interfaz
Se creó una carpeta llamada "Votacion" y dentro de ella, crea un archivo PHP llamado "index.php".
En el archivo PHO, se creo una estructura estándar con las etiquetas html, head y body.
En el body, se crearon los elementos que corresponden al formulario de votación con los campos que se describen en las instrucciones. Se utilizaron los elementos de formulario de PHP como input, select, option y checkbox.
Se agregó un botón para enviar el formulario con la etiqueta button y el atributo type="submit".

# Validación de la interfaz
Para validar la información del formulario, utiliza JavaScript y/o JQuery para validar cada campo y mostrar los errores en caso de que no se cumplan las validaciones.
Se creó una función que se ejecuta cuando se hace clic en el botón enviar. Dentro de la función, se utiliza las funciones de validación correspondientes a cada campo del formulario.
En caso de que existan errores en la validación, muestra un mensaje de error y no permite que se envíe el formulario.
En caso de que la validación sea correcta, se envian los datos del formulario a un archivo PHP.

# Conexión de base de datos
Se creó una base de datos utilizando y gestionádola con MySQL / MySQL Workbench para el visionado gráfico, ejecuciones de SQL.
Se crea una tabla en la base de datos llamada "votación" con los campos que corresponden al formulario de votación.
Se conecta el archivo PHP con la base de datos utilizando las funciones de conexión correspondientes.

# Servidor
Se usó la herramiento Xampp 8.2.0-0, para levantar la base de datos de MySQL y el servidor Apache para visualizar el entorno web.

# Procesamiento de formulario
Crea un archivo PHP llamado "votar.php".
En el archivo PHP, recibe los datos del formulario utilizando las variables $_POST correspondientes.
Utiliza las funciones de validación de PHP para validar la información recibida y mostrar errores en caso de que existan.
Verifica que el RUT no haya votado anteriormente. Para ello, realiza una consulta a la base de datos para verificar si ya existe un registro con el mismo RUT.
Si el RUT no ha votado, inserta los datos del formulario en la base de datos utilizando una consulta SQL correspondiente.





