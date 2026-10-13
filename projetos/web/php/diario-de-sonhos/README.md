# Diário de sonhos e controle do sono

Projeto acadêmico em PHP e MySQL para registrar sonhos e acompanhar informações de sono. O código veio do material local e pode precisar de ajustes para executar em um ambiente atual.

## Estrutura

- `public/`: páginas, API e recursos web.
- `src/`: modelos, controladores, views e configuração do banco.
- `database/schema.sql`: estrutura inicial do banco.

## Configuração

1. Crie um banco MySQL e importe `database/schema.sql`.
2. Configure host, nome do banco, usuário e senha em `src/config/database.php` para seu ambiente local.
3. Sirva a pasta `public/` com PHP e habilite PDO MySQL.

Este é um registro de estudo, não uma aplicação revisada para produção. Não coloque credenciais reais no código.
