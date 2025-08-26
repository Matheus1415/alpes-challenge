# Desafio Alpes – API Laravel

Este repositório contém a implementação do Desafio Alpes, utilizando **Laravel 12**, **PHP 8.2** e **PostgreSQL/MySQL**.

A aplicação importa dados de uma API externa, salva no banco, expõe endpoints RESTful para CRUD.
> [!WARNING]
> Como a API externa (https://hub.alpes.one/api/v1/integrator/export/1902) esteve fora do ar durante parte do prazo, alguns pontos não puderam ser totalmente validados.

Mesmo assim, no período de 2 dias de execução, foram concluídos os seguintes critérios:

---

### Etapa 1: Aplicação Laravel

-   ✅ Criação de uma aplicação **Laravel 12** configurada com **MySQL/PostgreSQL**.
-   ✅ Criação do comando Artisan `vehicles:dispatch-job` que dispara um **Job** responsável por:
    -   Baixar e ler o JSON da API.
    -   Validar e salvar os dados no banco.
    -   Atualizar itens existentes via `updateOrCreate`.
-   ✅ Configuração do **Scheduler** para rodar a verificação a cada hora, respeitando o fuso horário configurável.
-   ✅ Implementação de uma **API REST** com CRUD completo sobre os dados importados.
-   ✅ Autenticação por token para consumo seguro dos endpoints.
-   ❌ Testes automatizados:
    -   **Unitários**: validações dos dados e lógica do comando de importação.
    -   **Integração**: testes dos endpoints da API (autenticação, paginação, CRUD).
-   ✅ Documentação completa, incluindo:
    -   Instalação e configuração do ambiente.
    -   Como rodar o comando de importação.
    -   Como executar os testes.
    -   Collection do Postman pronta para testes.

---

### Etapa 2: Configuração de Infraestrutura

-   ❌ Não foi possível configurar **AWS EC2** dentro do prazo.
-   ✅ Foi realizado deploy alternativo no **Render**, permitindo testes públicos via endpoint.
-   ❌ Configuração de domínio, **Route 53** e **HTTPS** ficaram pendentes.

---

### Etapa 3: Deploy Automatizado

-   ❌ Não foi configurado pipeline **CI/CD** completo.
-   ✅ Deploy funcional no **Render** via **Dockerfile** com **PHP 8.2** e **PostgreSQL** drivers.

---

# Usando a Collection do Postman
Para facilitar os testes da API, o projeto já inclui uma coleção pronta do Postman localizada em:
```bash
   postman/Desafio Alpes - Collection.json
```
Essa coleção contém todos os endpoints implementados, com suporte a variáveis de ambiente para facilitar a troca entre deploy e ambiente local.

## Como importar a Collection no Postman
1. Abra o Postman.
2. Clique em Import (canto superior esquerdo).
3. Arraste o arquivo Desafio Alpes - Collection.json ou selecione-o pelo explorador de arquivos.
4. A coleção será adicionada automaticamente no painel lateral.

## Variáveis de Ambiente
A coleção utiliza duas variáveis de ambiente:

`base_url`  Define o endpoint base da API.

Exemplo em produção (deploy):
```bash
   https://alpes-challenge.onrender.com/api
```

Exemplo em ambiente local:
```bash
   http://localhost:8000/api
```

`auth_token` Armazena o token de autenticação para as requisições protegidas.
</br>
Devido à limitação de tempo, não foi possível implementar a automação para que a variável `auth_token` do Postman fosse preenchida automaticamente após a execução da requisição de autenticação.
Isso significa que, após gerar o token com a rota /token-generate, é necessário copiar manualmente o valor retornado e colá-lo na variável auth_token no ambiente do Postman.

---
# Instalação e Configuração do Ambiente

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/Matheus1415/alpes-challenge
   ```

2. **Acesse o diretório do projeto:**
   ```bash
   cd alpes-challenge
   ```

3. **Instale as dependências:**
   ```bash
   composer install
   ```

4. **Copie o arquivo .env.example para .env:**
   ```bash
   cp .env.example .env
   ```
   
5. **Gere a key da aplicação**
   ```bash
   php artisan key:generate
   ```

6. **Edite as variáveis de conexão com o banco de dados:**
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=alpes_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
7. **No arquivo .env, ajuste para o timezone local:**
   ```bash
   APP_TIMEZONE=America/Sao_Paulo
   ```
8. **Rode as migrations e seeders**
   ```bash
   php artisan migrate --seed
   ```
---

# Agendamento do Job de Atualização de Veículos
A aplicação utiliza o Laravel Scheduler para rodar automaticamente um job que importa e atualiza os dados dos veículos no banco de dados a partir do JSON remoto.

Foi criado o comando:
```bash
    php artisan vehicles:dispatch-job
```

Esse comando dispara o Job UpdateVehiclesFromJson, responsável por buscar os dados e atualizar o banco de dados.
Arquivo: `app/Console/Commands/DispatchVehicleJob.php`

O Job `(app/Jobs/UpdateVehiclesFromJson.php)` executa a lógica de atualização.
Ele acessa o serviço `VehicleService::getVehicles()` e sincroniza os dados com a tabela vehicles, utilizando updateOrCreate:

1. Executar manualmente (teste local):
```bash
    php artisan vehicles:dispatch-job
```

2. Rodar continuamente com o Scheduler:
Para que o agendamento funcione, é necessário executar o scheduler:
```bash
    php artisan schedule:work
```
