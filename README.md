# silviamendez.net
repository de la web silviamendez.net

## Install
- `npm install`
- `gulp`

## local view osx
`php -S localhost:8000 -t public/`

Nota bene, il progetto non funziona se non vai direttamente al /es o al /eu, perché é questione del file HSTS che in locale non funziona, non fa la redirection da index a index/es. Quindi aprire direttamente localhost:8000/es

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
