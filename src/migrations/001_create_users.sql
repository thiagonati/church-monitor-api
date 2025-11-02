CREATE TABLE users (
    id CHAR(36) PRIMARY KEY,       -- UUID v4 (36 caracteres incluindo hífens)
    name VARCHAR(255) NOT NULL,    -- Nome do usuário
    email VARCHAR(255) UNIQUE NOT NULL, -- Login único
    password VARCHAR(255) NOT NULL,     -- Senha criptografada (bcrypt)
    role ENUM('admin','user') NOT NULL DEFAULT 'user', -- Permissões
    church_id CHAR(36) NULL,       -- FK para a igreja do usuário (nullable para admins globais)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (church_id) REFERENCES churches(id) ON DELETE SET NULL
);
