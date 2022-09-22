<?php

namespace App\Models;

use CodeIgniter\Model;


use Config\Services;

class UserModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'users';
    // protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'App\Entities\User';
    protected $useSoftDeletes   = true;
    // protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phoneNumber',
        'email',
        'password',
        'reset_hash',
        'reset_expires',
        'avatar',
    ];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        // 'name' => 'required|min_lenght[5]|max_lenght[126]',
        // 'email' => 'required|valid_email|is_unique[users.email,id,{id}]|max_lenght[200]',
        // 'password' => 'required|min_lenght[8]',
        // 'password_confirmation' => 'required_width[password]|matches[password]',
    ];

    protected $validationMessages = [
        // 'name' => [
        //     'required' => 'Desculpe. O campo nome é obrigatório.',
        // ],
    ];


    // Callbacks
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            // removemos dos dados a serem salvos
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        };

        return $data;
    }
}
