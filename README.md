# silviamendez.net
repository de la web silviamendez.net

## Install
- `npm install`
- `gulp`

## local view osx
`php -S localhost:8000 -t public/`

## Deploy
El proyecto está asociado directamente con la web de hosting. Eso significa que todo lo que se pone en la carpeta `/public` será copiado en la carpeta `public_html` del hosting.
Este sistema funciona gracias al fichero `.cpanel.yml`que podéis ver en la root de este repositorio.
Solo hay que lanzar el `gulp`, hacer el __commit/push__ y luego ir al panel de control de la web (cpanel), seción Git-->gestión repositorio-->pull o deploy y hacer en orden `Update from remote` y `Deploy HEAD Commit`
