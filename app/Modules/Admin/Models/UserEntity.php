<?php namespace App\Modules\Admin\Models;

class UserEntity
{
    protected $record_id;
    protected $name;

    public function __construct()
    {

    }

    public static function of($urecord_id, $uname)
    {
        $user = new UserEntity();
        $user->setrecord_id($urecord_id);
        $user->setName($uname);

        return $user;
    }

    /**
     * @return mixed
     */
    public function getrecord_id()
    {
        return $this->record_id;
    }

    /**
     * @param mixed $record_id
     */
    public function setrecord_id($record_id): void
    {
        $this->record_id = $record_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}