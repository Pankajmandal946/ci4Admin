<?php namespace App\Modules\Admin\Models;

class UserEntity
{
    protected $gfrom_id;
    protected $name;

    public function __construct()
    {

    }

    public static function of($ugfrom_id, $uname)
    {
        $user = new UserEntity();
        $user->setgfrom_id($ugfrom_id);
        $user->setName($uname);

        return $user;
    }

    /**
     * @return mixed
     */
    public function getgfrom_id()
    {
        return $this->gfrom_id;
    }

    /**
     * @param mixed $gfrom_id
     */
    public function setgfrom_id($gfrom_id): void
    {
        $this->gfrom_id = $gfrom_id;
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