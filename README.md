## Sistema de Equivalências - [@joaobelone](https://github.com/belone0) 

# 😁

## Rodas esses comandos
(além dos comandos padrão do laravel)

Não esquecer de rodar para habilitar a geração de pdfs : ``` php artisan storage:link ```

Semear banco de dados ``` php artisan db:seed ```

## Erros comuns

Caso algum erro relacionado a storage logs ``` sudo chmod 775 -R storage ```

Caso algum erro relacionado a CORS do vite:

```
//vite config
server: {
        hmr: {
            host: 'localhost',
        },
    },

//OU ISSO (app.js) :
import { createApp } from 'vue/dist/vue.runtime.esm-bundler'; ao invés de apenas vue
```
