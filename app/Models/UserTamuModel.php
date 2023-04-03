<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTamuModel extends Model
{
    protected $table      = 'user_tamu';
    protected $primaryKey = 'id';


    protected $useAutoIncrement = true;
    protected $allowedFields = ['uniq_code', 'nama_tamu', 'alamat'];
}
