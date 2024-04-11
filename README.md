# Symfony FizzBuzz isEazy challenge

This is a Symfony application that generates a text string containing the words "Fizz", "Buzz", and "FizzBuzz" based on the numbers provided through a form.

## Requirements
- PHP 8.1
- MySQL database

## Installation

1. Clone the repository:
    ```
    git clone https://github.com/SORIK28850/isEazy.git
    ```
2. Navigate to the project directory:
    ```
    cd isEazy
    ```
3. Configure your database connection in the `.env` file. You'll need to set the `DATABASE_URL` environment variable with
   your database connection details. It should look something like this:
    ```
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
    ```
    Replace `db_user`, `db_password`, and `db_name` with your actual database username, password, and database name.

4. Install dependencies using Composer:
    ```
    composer install
    ```
5. Create the database:
    ```
    php bin/console doctrine:database:create
    ```
6. Run migrations to create the database schema:
    ```
    php bin/console doctrine:migrations:migrate
    ```
7. Start the Symfony server:
    ```
    symfony server:start
    ```

## Usage

- Access the application through a web browser at [http://127.0.0.1:8000/](http://127.0.0.1:8000/).
- Fill out the form with the desired start and end numbers.
- Submit the form to generate the FizzBuzz result.

## Restrictions
- The difference between start and end numbers cannot be equal to or greater than 50.
- The start number cannot be greater than or equal to the end number.

## Running Tests

To run tests, execute the following command:
- php bin/phpunit

## Personal Comments

La prueba me ha llevado más de una hora y media realizarla. De hecho, añado el log de fallos (public/log) que he tenido durante el desarrollo para que se pueda comprobar el trabajo, el tiempo y que como comenté en la entrevista, he tenido que volver a familiarizarme con Symfony e incluso instalarlo en el ordenador. He trabajado el último año con Laravel.
Me ha resultado especialmente entretenida puesto que Symfony me gusta infinitamente más que Laravel y ha sido un verdadero gusto volver a trabajar con este framework.
Como herramienta de trabajo he usado Copilot, que me ha ayudado a completar código de manera más eficiente, pero añado que únicamente en la parte de los test de integración y del controlador he tenido que usar esta herramienta como apoyo total porque no recordaba como realizar ese tipo de test. En el resto tan solo ha sido un apoyo para corregir pequeños errores y, sobre todo, para recordar cómo se hacían las cosas en Symfony. He añadido cosas extras como el 403 personalizado y algún detalle más. También he intentado darle una estructura DDD básica y quiero resaltat que tuve un error que según he podido ir viendo parece que es por conflicto en las versiones de dependencias, pero no he querido dedicarle más tiempo ya que no era crítico para el funcinoamiento de la app, y tampoco quería entregar la prueba más tarde. El error era este:

[2024-04-10T10:29:41.542785+00:00] php.CRITICAL: Uncaught Error: Class "Doctrine\ORM\Tools\DisconnectedClassMetadataFactory" not found {"exception":"[object] (Error(code: 0): Class \"Doctrine\\ORM\\Tools\\DisconnectedClassMetadataFactory\" not found at C:\\laragon\\www\\iseazy\\vendor\\symfony\\maker-bundle\\src\\Doctrine\\DoctrineHelper.php:177)"} []

Tampoco he terminado la parte de Docker por el mismo motivo, para no retrasar más tiempo la entrega de la prueba, puesto que como comenté, Docker tampoco lo tengo fresco en la cabeza y me supondría unas cuantas horas enterarme de cómo funciona para esa parte, de manera que aunque no lo he visto esencial, aún así voy a dedicar el resto del día a hacerlo a modo personal, por lo que si quieres que te mande la prueba de nuevo cuando esté en un contenedor lo haré con gusto.
Espero FeedBack pronto y con ilusión.
