<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# LRVL-MasterMind

## Descripción

Aprovechando la estructura de [Laravel](https://laravel.com/), se lleva a cabo una recreación del clásico juego de mesa **Master Mind**, en su versión "***Super***".

## Requisitos para la Ejecución

* Servidor web como [Apache](https://www.apachelounge.com/download/), [Nginx](http://nginx.org/en/download.html), ...
* [PHP](http://php.net/downloads.php).

## Modo de Acceso

* Una vez descargado el proyecto en local, se abre una terminal de consola desde la carpeta raíz.
* Por medio del siguiente comando de [Artisan](https://laravel.com/docs/5.7/artisan), se podrá arrancar el proyecto en el servidor:
  * `php artisan serve`

* Una vez ejecutado el comando anterior, se habrá obtenido una URL con la que acceder a la página de inicio del proyecto:
  * Laravel development server started: <http://127.0.0.1:8000>

## Modo de Uso

* Para entrar en el juego, bastará con acceder a la raíz de la ruta suministrada por el comando anterior:
  * http://127.0.0.1:8000
* En la pantalla de inicio del juego, el usuario deberá suministrar o elegir una serie de datos para configurar la partida a jugar:
  * nombre del jugador que protagonizará la partida.
  * longitud de la clave secreta a descifrar.
  * número de colores posibles optativos para llegar a descifrar la clave secreta.
  * si se permiten colores repetidos o no.
  * números de intentos para descifrar la clave secreta.

## Instrucciones del Juego

* En la pantalla del juego:
  * en la parte izquierda, aparecerán los datos de la configuración de la partida establecidos por el usuario.
    * se dispone de un botón para volver a "Reconfigurar" las opciones de la partida.
  * en la parte derecha, el tablero de juego dónde hacer la próxima jugada con la intención de descifrar la clave secreta.

### Modo de Juego

Según los parámetros elegidos por el usuario/jugador, éste tendrá como objetivo descifrar la clave secreta.

Para llevar a cabo una jugada, se dispone de tantos menús desplegables como longitud de clave haya sido elegida.

Cada menú desplegable tendrá el número de colores posibles elegidos en la configuración de la partida.

#### Resultados de la Jugada

Cuando el jugador pulse en el botón de "Comprobar", se enviará la jugada establecida y será comparada con la clave secreta. Esto gastará uno de los intentos de los que dispone el jugador.

La forma en el que se le indique el resultado de la jugada al usuario será la siguiente:

* Se colocará una clavija NEGRA por cada bola seleccionada que coincida, en color y posición, con una de las bolas de la clave secreta.
* Se colocará una clavija BLANCA por cada bola seleccionada que coincida, solamente, en el color pero NO en la posición con una de las bolas de la clave secreta.
* Se dejará un hueco de clavija vacío por cada bola de color que no exista en la clave secreta.

#### Fin de la Partida

La partida terminará:

* si el jugador termina descifrando la clave secreta antes de cumplir los intentos que tenga disponibles:
  * se mostrará un panel con fondo VERDE indicando que ha ganado.
  * su puntuación aumentará en **5 puntos**.
* si el jugador gasta todos sus intentor sin llegar a descifrar la clave secreta:
  * se mostrará un panel con fondo ROJO indicando que ha perdido.

En ambos casos, se desvelará la clave secreta para ver, realmente, la descifró o por qué no llegó a descifrarla.
  * se presenta, igualmente, un nuevo botón para dispone de un botón para "Volver a jugar" una nueva partida con las mismas opciones establecidas
    * si desea establecer otras opciones, pulsar en "Reconfigurar".

## Consideración de Errores

* El usuario deberá suministrar/elegir una serie de datos obligatorios a la hora de establecer las opciones de la partida en la pantalla de inicio del juego como, por ejemplo, el nombre del jugador.
    * condición especial:
      * Si no se permiten las repeticiones, no se podrá elegir una longitud de clave MAYOR que el número de colores posibles.
* De no cumplirse con alguna de las condiciones, se mostrarán una serie de mensajes para indicar los errores cometidos a corregir.

## Otros

* El proyecto está estructurado con un sistema de plantillas.
