<?php

namespace App\Models;

use CodeIgniter\Model;

class GruposModel extends Model
{
    protected $table            = 'groups';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['group_name','permission'];

    public function getUserGroupByUserId($id)
    {
        return $this->db->table('user_group')
            ->select('user_group.*, groups.*')
            ->join('groups', 'groups.id = user_group.group_id')
            ->where('user_group.user_id', $id)
            ->get()
            ->getRowArray();
    }
}
