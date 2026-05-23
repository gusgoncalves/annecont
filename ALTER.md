# CodeIgniter 4 Application Starter

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