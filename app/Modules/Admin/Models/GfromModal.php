<?php

namespace App\Modules\Admin\Models;

class GfromModal
{
    public function getUsers()
    {
        return [
            UserEntity::of('PL0001', 'Mufid Jamaluddin'),
            UserEntity::of('PL0002', 'Andre Jhonson'),
            UserEntity::of('PL0003', 'Indira Wright'),
        ];
    }

    public function check_login()
    {
        $username = session()->get('user')->username ?? false;
        if (isset($username) && is_string($username)) {
            return true;
        }
        return false;
    }

    // public function login($username, $password)
    // {
    //     $db = db_connect();

    //     $user = $db->table('st_table_users')->where(['username' => $username, 'password' => $password])->get()->getRow();
    //     $lastLogin = $db->table('st_table_users')->update(['last_login' => time()], ['gfrom_id' => $user->gfrom_id]);
    //     return $user ?? false;
    // }

    public function newRecord($data)
    {
        $db = db_connect();
        $array = [
            'email' => $data['email'],
            'verified' => $data['verified'],
            'mobileno' => $data['mobileno'],
            'status' => '1',

        ];
        $result = $db->table('ggfrom')->insert($array);
        if ($result) {
            return session()->setFlashData('message', 'Insert successfull');
        } else {
            return session()->setFlashData('message', 'Insert failed');
        }
    }

    public function getRecord()
    {
        $db = db_connect();
        return $result = $db->table('ggfrom')->get()->getResult();
    }

    public function editRecord($gfrom_id, $data = [])
    {
        $db = db_connect();
        if (empty($data)) {
            return $result = $db->table('ggfrom')->where('gfrom_id', $gfrom_id)->get()->getRow();
        }
        $array = [
            
            'status' => '1',

        ];
        $result = $db->table('ggfrom')->update($array, ['gfrom_id' => $gfrom_id]);
        if ($result) {
            session()->setFlashData('message', 'Update success');
        } else {
            session()->setFlashData('message', 'Update failed');
        }
    }

    public function deleteRecord($gfrom_id)
    {
        $db = db_connect();

        $result = $db->table('ggfrom')->delete(['gfrom_id' => $gfrom_id]);
        if ($result) {
            session()->setFlashData('message', 'Delete success');
            return true;
        } else {
            session()->setFlashData('message', 'Delete failed');
            return false;
        }
    }
}
