# silviamendez.net
repository de la web silviamendez.net

## Install
- `npm install`
- `gulp`

## local view osx
`php -S localhost:8000 -t public/`

## Deploy
El proyecto está asociado directamente con la web de hosting. 

Eso significa que todo lo que se pone en la carpeta `/public` será copiado en la carpeta `public_html` del hosting.

Este sistema funciona gracias al fichero `.cpanel.yml`que podéis ver en la root de este repositorio.
### Procedimento
- lanzar el `gulp`
- hacer el `__commit/push__ y `
- ir al panel de control de la web **(cpanel)**
- ir a la sección Git version control` 
- `gestión repositorio`
- `pull o deploy` 
- y hacer en orden:
    - `Update from remote` 
    - `Deploy HEAD Commit`
