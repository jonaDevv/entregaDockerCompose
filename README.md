# APLICACIONES MULTICAPA - JONATAN RAMÍREZ MORAGA


Debemos lanzar 3 contenedores, separando el front, back, y la base de datos:
--
**FRONT:**
Contenedor que escucha en el puerto 80, que debe de tener una estructura html, y el código javascript recoger los datos de html,
y enviarlos mediante una llamada ayax a la api de PHP, que los procesará.

**BACK:**
Contenedor que al ser lanzado debe descargar la imagen de php con apache, y PDO para poder hablar con la base de datos.

**BD:**
Contenedor con la imagen de mariaDb en el que tendremos nuestra base de datos para recoger lo enviado a traves de ayax y php. Este escuchara en el puerto 3036.
-------------------------------

En primer lugar crearemos nuestro repositorio donde alojar el código, en github. Una vez creado traeremos el proyecto a nuestro ordenador mediante el comando git clone, y tras clonarlo iniciarémos git flow.

![Alt](/)



