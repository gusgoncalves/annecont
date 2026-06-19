ALTER TABLE anneco90_db.clientes MODIFY COLUMN whatsapp varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;

ALTER TABLE user_group
ADD CONSTRAINT fk_user_group_user
FOREIGN KEY (user_id)
REFERENCES users(id)
ON DELETE CASCADE;

ALTER TABLE user_group
ADD CONSTRAINT fk_user_group_group
FOREIGN KEY (group_id)
REFERENCES `groups`(id)
ON DELETE CASCADE;

ALTER TABLE anneco90_db.pagar ADD id_usuario_estornou INT NULL;

CREATE INDEX idx_quitado_vencimento
ON pagar (quitado, dt_vencimento);

CREATE INDEX idx_quitado_recebimento
ON receber (quitado, dt_recebimento);

ALTER TABLE movimentacao_conta ADD COLUMN id_pagar INT NULL;
ALTER TABLE movimentacao_conta ADD COLUMN id_receber INT NULL;

ALTER TABLE movimentacao_conta ADD CONSTRAINT fk_mov_pagar FOREIGN KEY (id_pagar) REFERENCES pagar(id) ON DELETE SET NULL;
ALTER TABLE movimentacao_conta ADD CONSTRAINT fk_mov_receber FOREIGN KEY (id_receber) REFERENCES receber(id) ON DELETE SET NULL;

SELECT COUNT(*)
FROM movimentacao_conta mc
JOIN pagar p ON mc.id_conta = p.id
WHERE mc.tipo = 'D';

SELECT COUNT(*)
FROM movimentacao_conta mc
JOIN receber r ON mc.id_conta = r.id
WHERE mc.tipo = 'C';

#coloca todos os valores do id_conta que forem da tabela pagar
UPDATE movimentacao_conta mc
JOIN pagar p ON mc.id_conta = p.id
SET mc.id_pagar = p.id
WHERE mc.tipo = 'D';

#coloca todos os valores do id_conta que forem da tabela receber
UPDATE movimentacao_conta mc
JOIN receber r ON mc.id_conta = r.id
SET mc.id_receber = r.id
WHERE mc.tipo = 'C';

alter table movimentacao_conta drop column id_conta

ALTER TABLE anneco90_db.obrigacoes_realizadas ADD valor_obrigacoes DECIMAL NULL;
ALTER TABLE anneco90_db.obrigacoes_realizadas ADD valor_cliente DECIMAL NULL;
ALTER TABLE anneco90_db.obrigacoes_realizadas ADD descricao varchar(100) NULL;
ALTER TABLE anneco90_db.obrigacoes_realizadas ADD id_usuario_enviou varchar(100) NULL;
ALTER TABLE anneco90_db.obrigacoes_realizadas CHANGE `data` data_cobranca date NOT NULL;

ALTER TABLE anneco90_db.obrigacoes_realizadas ADD status INT DEFAULT 0 NOT NULL;
ALTER TABLE anneco90_db.obrigacoes_realizadas ADD dt_pagamento DATE NULL;
ALTER TABLE anneco90_db.obrigacoes_realizadas ADD id_conta_receber INT NULL;
ALTER TABLE anneco90_db.obrigacoes_realizadas ADD CONSTRAINT obrigacoes_realizadas_receber_FK FOREIGN KEY (id_conta_receber) REFERENCES anneco90_db.receber(id) ON DELETE SET NULL ON UPDATE SET NULL;

--dia 19/06/2026
CREATE TABLE configuracoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chave VARCHAR(100) NOT NULL,
    valor TEXT NULL
);

INSERT INTO configuracoes (chave, valor)
VALUES ('ultima_geracao_mensalidade', '');

ALTER TABLE receber
ADD COLUMN referencia VARCHAR(7);

CREATE TABLE informacoes_cliente (
    id INT AUTO_INCREMENT NOT NULL,
    descricao TEXT NULL,
    dt_inclusao DATETIME NULL,
    id_usuario INT NULL,
    id_cliente INT NULL,
    PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
