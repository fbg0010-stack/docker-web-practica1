# Práctica 1: aplicación web con Docker

Ejemplo de una aplicación PHP servida por Nginx y conectada a MySQL mediante PDO.

## Iniciar y detener

Desde esta carpeta, inicia los servicios en segundo plano:

```bash
docker compose up --build -d
```

Abre [http://localhost:8080](http://localhost:8080). La página confirma la conexión con MySQL cuando la base de datos está lista.

Para detener los servicios sin borrar los datos:

```bash
docker compose down
```

Los datos de MySQL se guardan en el volumen nombrado `mysql_data`. Para borrar también ese volumen y los datos guardados:

```bash
docker compose down -v
```

## Arquitectura

- **web:** Nginx publica el puerto 80 del contenedor en `localhost:8080`, sirve los archivos de `src` y reenvía los PHP a `php:9000` mediante FastCGI.
- **php:** PHP 8.3-FPM ejecuta la aplicación. La imagen instala únicamente la extensión `pdo_mysql`; PDO se conecta al host `db`.
- **db:** MySQL 8.0 inicializa la base de datos `practica1`. Su almacenamiento persiste en `mysql_data`.

Las credenciales de ejemplo están declaradas en `docker-compose.yml` para que se vea cómo se comparten entre servicios; son solo para esta práctica local y no deben reutilizarse en producción.

## Comparación con XAMPP

XAMPP reúne Apache, PHP y MariaDB/MySQL en una instalación local que se administra como un conjunto. En esta práctica, Docker Compose ejecuta Nginx, PHP-FPM y MySQL en contenedores separados: la configuración hace explícita la comunicación entre servicios, facilita reproducir el mismo entorno en otros equipos y permite iniciar o detener cada conjunto con Compose. A cambio, hace falta tener Docker instalado y aprender a configurar imágenes, redes y volúmenes.

## Captura

Después de iniciar el proyecto y comprobar la página en el navegador, guarda una captura real como `capturas/practica-1.png` y añádela aquí. No se incluye una captura hasta que el proyecto se haya ejecutado.
