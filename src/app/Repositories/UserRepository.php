<?php


namespace App\Repositories;


use App\Models\ShiftModel;

use App\Models\UserModel;
use Illuminate\Support\Facades\Log;

class userRepository
{
    /**
     * @param userModel $userModel
     *
     * @param ShiftModel $shiftModel
     */
    protected $userModel;

    function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    function emailExists($email)
    {
        return $this->userModel::whereEmail($email)->count() > 0 ? true : false;

    }

    function registUser($name,$email)
    {
       $user= $this->userModel->firstOrCreate([
            'name' => $name,
            'email' => $email
        ]);
       return $user ;

    }


}
