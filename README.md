# 📌 Teste Tecnico - Backend PHP (Laravel) 

Este projeto é uma aplicação **Laravel** que consome uma **API externa** (`https://jsonplaceholder.typicode.com/posts`) e salva os dados no banco de dados.  
Além disso, fornece uma rota para listar os posts salvos no formato **JSON**.

---

## 🚀 Como rodar o projeto

### 1️⃣ Clonar o projeto para a máquina
Clone o projeto para sua máquina utilizando o comando:
```bash
git clone https://github.com/JoaoPedro24/Teste-Tecnico-CentrionWeb--Backend-PHP.git
```
### 2️⃣ Entrar no diretório do projeto
Já dentro do repositório na máquina, entre no diretório do projeto utilizando o comando:
```bash
cd teste-centrionweb
```

### 3️⃣ Configurar variáveis de ambiente
Crie o arquivo `.env` na raiz do projeto e copie o conteúdo do `.env.example`:
```bash
cp .env.example .env
```

---

### 4️⃣ Subir os containers com Docker
```bash
docker compose up -d --build
```

---

### 5️⃣ Acessar o container Laravel
```bash
docker exec -it laravel_app bash
```

---

### 6️⃣ Gerar a chave da aplicação
```bash
php artisan key:generate
```

---

### 7️⃣ Rodar as migrations para criar as tabelas no banco de dados
```bash
php artisan migrate
```

---

### 8️⃣ Sincronizar posts da API externa
Para consumir a API e salvar os dados no banco de dados:
```bash
php artisan sync:posts
```

---

### 9️⃣ Listar posts em JSON
Utilize **Insomnia** ou **Postman** para fazer uma requisição GET para:
```
http://localhost:8000/api/posts
```

---

## 🛠 Tecnologias utilizadas
- **Laravel 12**
- **PHP 8.3**
- **Docker**
- **MySQL**
- **GuzzleHTTP** (para consumo da API externa)

<p align="center"> 👨🏻‍💻 Desenvolvido por: <b>João Pedro K. Rodrigues</b> </p> ```
