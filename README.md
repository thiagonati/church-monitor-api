# ChurchMonitor API

API RESTful para monitoramento de níveis de decibéis em igrejas. Administradores podem acompanhar múltiplas igrejas, e usuários registram leituras de som.

## Índice

- [Visão Geral](#visão-geral)
- [Tecnologias](#tecnologias)
- [Arquitetura](#arquitetura)
- [Autenticação](#autenticação)
- [Endpoints](#endpoints)
- [Exemplos de Requests e Responses](#exemplos-de-requests-e-responses)
- [Instalação](#instalação)
- [Testes](#testes)
- [Convenções de Commit](#convenções-de-commit)

## Visão Geral

O ChurchMonitor API foi criado para:

- Permitir que administradores gerenciem igrejas e usuários
- Registrar e monitorar leituras de decibéis enviadas pelos usuários
- Validar automaticamente se o usuário pertence à igreja informada
- Garantir segurança e integridade dos dados usando UUID, DTOs e Requests validados

A arquitetura segue camadas bem definidas:

- **Controllers**: Recebem requests e chamam services
- **Services**: Lógica de negócio centralizada
- **Repositories**: Persistência de dados com Doctrine ORM
- **DTOs/Requests**: Validação e transferência de dados

## Tecnologias

- PHP 8.1+
- Doctrine ORM + DBAL
- PHP-DI (Injeção de dependência)
- Respect/Validation (Validações de Requests)
- FastRoute (Roteamento)
- Monolog (Logs)
- Firebase JWT (Autenticação)
- Dotenv (Variáveis de ambiente)
- PHPUnit + Mockery (Testes)

## Arquitetura

### Estrutura do Projeto

```
project-root/
├─ src/
│  ├─ Controller/          # Controladores da API
│  ├─ Service/             # Lógica de negócio
│  ├─ Repository/          # Acesso a dados
│  ├─ Model/               # Entidades/Models
│  ├─ DTO/                 # Data Transfer Objects
│  ├─ Resource/            # Formatação de resposta (opcional)
│  ├─ Middleware/          # JWT/Auth middleware
│  ├─ Exceptions/          # Tratamento de exceções
│  └─ Infrastructure/      # DB, Logger, bootstrap
│     └─ bootstrap.php
├─ public/
│  └─ index.php            # Front controller
├─ tests/                  # Unitários e integração
├─ migrations/             # Arquivos de migrations
├─ composer.json           # Dependências
└─ .env                    # Configurações do ambiente
```

## Autenticação

### JWT (JSON Web Token)

**Cabeçalho:**
```
Authorization: Bearer {token}
```

**Roles:**
- **admin**: CRUD completo de igrejas e usuários
- **user**: Registrar leituras e consultar dados da própria igreja

## Endpoints

### Usuários

| Método | Endpoint        | Descrição              |
|--------|-----------------|------------------------|
| POST   | /users          | Criar usuário          |
| GET    | /users/{id}     | Buscar usuário por ID  |
| PUT    | /users/{id}     | Atualizar usuário      |
| DELETE | /users/{id}     | Deletar usuário        |

### Igrejas

| Método | Endpoint        | Descrição              |
|--------|-----------------|------------------------|
| POST   | /churches       | Criar igreja           |
| GET    | /churches       | Listar todas as igrejas|
| GET    | /churches/{id}  | Buscar igreja por ID   |
| PUT    | /churches/{id}  | Atualizar igreja       |
| DELETE | /churches/{id}  | Deletar igreja         |

### Leituras de Decibéis

| Método | Endpoint               | Descrição                      |
|--------|------------------------|--------------------------------|
| POST   | /decibels              | Registrar leitura              |
| GET    | /decibels/church/{id}  | Listar leituras de uma igreja  |
| GET    | /decibels/user/{id}    | Listar leituras de um usuário  |

## Exemplos de Requests e Responses

### Criar Igreja

**Request:**
```http
POST /churches
Content-Type: application/json
Authorization: Bearer {token}
```

```json
{
  "name": "Igreja Central",
  "address": "Rua das Flores, 123",
  "latitude": -8.052,
  "longitude": -34.932
}
```

**Response:**
```json
{
  "id": "b9f7a8d2-5f48-4c9e-b9e4-0d4f3b7f8c20",
  "name": "Igreja Central",
  "address": "Rua das Flores, 123",
  "latitude": -8.052,
  "longitude": -34.932
}
```

### Registrar Decibéis

**Request:**
```http
POST /decibels
Content-Type: application/json
Authorization: Bearer {token}
```

```json
{
  "user_id": "f2c8e9d1-1234-4bcd-8f2a-abcdef123456",
  "church_id": "b9f7a8d2-5f48-4c9e-b9e4-0d4f3b7f8c20",
  "decibels": 78.5
}
```

**Response:**
```json
{
  "id": "e1f7a9b0-9876-4c9e-a3b1-abcdef987654",
  "user_id": "f2c8e9d1-1234-4bcd-8f2a-abcdef123456",
  "church_id": "b9f7a8d2-5f48-4c9e-b9e4-0d4f3b7f8c20",
  "decibels": 78.5,
  "created_at": "2025-11-02T12:30:45Z"
}
```

## Instalação

```bash
git clone https://github.com/thiagonatividade/church-monitor-api.git
cd church-monitor-api
composer install
cp .env.example .env
```

Ajustar variáveis: DB, JWT_SECRET, etc.

```bash
php vendor/bin/doctrine-migrations migrate
php -S localhost:8000 -t public
```

## Testes

```bash
composer test
```

Testes unitários e de integração usando PHPUnit e Mockery.

## Convenções de Commit

- **feat**: nova funcionalidade
- **fix**: correção de bug
- **chore**: ajustes de configuração ou build
- **docs**: documentação
- **test**: adição ou alteração de testes
