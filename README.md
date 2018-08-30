# HSM-teste
Projeto para teste na HSM

Monitora durante tempo determinado tweets de São Paulo e Belo Horizonte, contabilizando quantos tem erros ortográficos.

Resolvido compatibilidade com o PHP 7.2.

Utiliza o banco PostgreSQL devido a incompatibilidade do Laravel com o MariaDB 10.1.

Altera o arquivo .env com a conexão com o banco de dados de sua preferência.

É preciso criar as seguintes variáveis de sistema em .env, com os dados de acesso do Twitter.

```php
TWITTER_ACCESS_TOKEN=
TWITTER_ACCESS_TOKEN_SECRET=
TWITTER_CONSUMER_KEY=
TWITTER_CONSUMER_SECRET=
```

Para ouvir os tweets da região metropolitana de São Paulo basta executar os dois comandos:

```php
php artisan twitter:track
php artisan queue:listen
```

Isso já deve ser suficiente para popular o banco de dados e apresentar no index.

Lista do que faltou finalizar.
TODO: posibilitar a captura de duas regiões diferentes ao mesmo tempo;
TODO: possiblitar a escolha de cada região;
TODO: processo rodar por tempo determinado e possibilitar a escolha desse tempo;
TODO: contador de erros ortográficos;
TODO: utilizar REST na transmissão de dados.
