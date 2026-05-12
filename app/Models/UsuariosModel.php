<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table            = 'users';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'username',
        'firstname',
        'email',
        'password',
        'phone',
        'gender',
    ];
    // =============== BUSCAR DADOS DE USUÁRIOS PARA A DATATABLE =================
    public function getUserGrupo()
    {
        return $this->db->table('users u')
            ->select('u.*, g.group_name')
            ->join('user_group ug', 'ug.user_id = u.id', 'left')
            ->join('groups g', 'g.id = ug.group_id', 'left')
            ->get()
            ->getResultArray();
    }
    // ============================== CRIAR USUÁRIO ==============================
    public function createUser(array $data)
    {
        $group_id = $data['group_id'] ?? null;
        unset($data['group_id']);
        $this->db->transStart();
        $this->insert($data);
        $user_id = $this->getInsertID();
        $db = \Config\Database::connect();
        $db->table('user_group')->insert([
            'user_id' => $user_id,
            'group_id' => $group_id
        ]);
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return false;
        }
        return $user_id;
    }
}
