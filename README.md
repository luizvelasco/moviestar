# Banco de Dados

Este projeto contém a estrutura inicial do banco de dados com as tabelas `users`, `movies` e `reviews`.

## 🎯 Objetivo

Criar a estrutura básica para armazenar informações de usuários, filmes e avaliações feitas pelos usuários.

---

## 🧱 Estrutura

### 🔹 Tabela: `users`

| Coluna   | Tipo         | Atributos                    | Descrição                          |
|----------|--------------|------------------------------|------------------------------------|
| id       | INT(11)      | UNSIGNED, AUTO_INCREMENT, PRIMARY KEY | Identificador único do usuário      |
| name     | VARCHAR(100) | NOT NULL                     | Primeiro nome do usuário            |
| lastname | VARCHAR(100) | NOT NULL                     | Sobrenome do usuário                |
| email    | VARCHAR(200) | NOT NULL                     | Endereço de e-mail do usuário       |
| password | VARCHAR(200) | NOT NULL                     | Senha criptografada do usuário      |
| image    | VARCHAR(200) | NULL                         | Caminho da imagem de perfil         |
| token    | VARCHAR(200) | NULL                         | Token para autenticação ou recuperação |
| bio      | TEXT         | NULL                         | Biografia ou descrição do usuário   |

### 🔹 Tabela: `movies`

| Coluna     | Tipo         | Atributos                        | Descrição                         |
|------------|--------------|----------------------------------|-----------------------------------|
| id         | INT(11)      | UNSIGNED, AUTO_INCREMENT, PRIMARY KEY | Identificador único do filme     |
| title      | VARCHAR(100) | NOT NULL                         | Título do filme                   |
| description| TEXT         | NULL                             | Descrição do filme                |
| image      | VARCHAR(200) | NULL                             | Caminho da imagem do filme        |
| trailer    | VARCHAR(150) | NULL                             | Link para o trailer               |
| category   | VARCHAR(50)  | NULL                             | Categoria ou gênero do filme      |
| length     | VARCHAR(50)  | NULL                             | Duração do filme                  |
| users_id   | INT(11)      | UNSIGNED, FOREIGN KEY            | Referência ao usuário criador     |

### 🔹 Tabela: `reviews`

| Coluna     | Tipo         | Atributos                        | Descrição                              |
|------------|--------------|----------------------------------|----------------------------------------|
| id         | INT(11)      | UNSIGNED, AUTO_INCREMENT, PRIMARY KEY | Identificador da avaliação           |
| rating     | INT          | NOT NULL                         | Avaliação numérica (ex: 1 a 5)         |
| review     | TEXT         | NULL                             | Comentário textual do usuário          |
| users_id   | INT(11)      | UNSIGNED, FOREIGN KEY            | Referência ao autor da avaliação       |
| movies_id  | INT(11)      | UNSIGNED, FOREIGN KEY            | Referência ao filme avaliado           |

---

## 🛠️ Scripts SQL para criação das tabelas

```sql
CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(200) NOT NULL,
    image VARCHAR(200),
    token VARCHAR(200),
    bio TEXT
);

CREATE TABLE movies (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    image VARCHAR(200),
    trailer VARCHAR(150),
    category VARCHAR(50),
    length VARCHAR(50),
    users_id INT(11) UNSIGNED,
    FOREIGN KEY (users_id) REFERENCES users(id)
);

CREATE TABLE reviews (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rating INT NOT NULL,
    review TEXT,
    users_id INT(11) UNSIGNED,
    movies_id INT(11) UNSIGNED,
    FOREIGN KEY (users_id) REFERENCES users(id),
    FOREIGN KEY (movies_id) REFERENCES movies(id)
);
