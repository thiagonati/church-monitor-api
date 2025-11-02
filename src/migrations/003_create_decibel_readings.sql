CREATE TABLE decibel_readings (
    id CHAR(36) PRIMARY KEY,           -- UUID da leitura
    church_id CHAR(36) NOT NULL,       -- Igreja informada pelo usuário
    user_id CHAR(36) NOT NULL,         -- Usuário que enviou
    decibel INT NOT NULL,              -- Valor da medição
    latitude DECIMAL(10,8) NULL,       -- Opcional, se leitura pontual
    longitude DECIMAL(11,8) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (church_id) REFERENCES churches(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_user_church CHECK (
        (SELECT church_id FROM users WHERE users.id = user_id) = church_id
    )
);
