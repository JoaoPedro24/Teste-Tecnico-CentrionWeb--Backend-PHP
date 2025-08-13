# 📌 Sincronização de Posts com Laravel e Docker

Este projeto é uma aplicação **Laravel** que consome uma **API externa** (`https://jsonplaceholder.typicode.com/posts`) e salva os dados no banco de dados.  
Além disso, fornece uma rota para listar os posts salvos no formato **JSON**.

---

## 🚀 Como rodar o projeto

### 1️⃣ Configurar variáveis de ambiente
Crie o arquivo `.env` na raiz do projeto e copie o conteúdo do `.env.example`:
```bash
cp .env.example .env
```

---

### 2️⃣ Subir os containers com Docker
```bash
docker compose up -d --build
```

---

### 3️⃣ Acessar o container Laravel
```bash
docker exec -it laravel_app bash
```

---

### 4️⃣ Gerar a chave da aplicação
```bash
php artisan key:generate
```

---

### 5️⃣ Rodar as migrations para criar as tabelas no banco de dados
```bash
php artisan migrate
```

---

### 6️⃣ Sincronizar posts da API externa
Para consumir a API e salvar os dados no banco de dados:
```bash
php artisan sync:posts
```

---

### 7️⃣ Listar posts em JSON
Utilize **Insomnia** ou **Postman** para fazer uma requisição GET para:
```
http://localhost:8000/api/posts
```

---

## 🛠 Tecnologias utilizadas
- **Laravel 11**
- **PHP 8**
- **Docker**
- **MySQL**
- **GuzzleHTTP** (para consumo da API externa)
