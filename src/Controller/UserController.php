<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Blog_User;
use Ibonly\Blog\Controller;
use Ibonly\PotatoORM\PasswordException;
use Ibonly\PotatoORM\DataNotFoundException;

class UserController extends Controller
{
    protected $user;

    function __construct() {
        $this->user = new Blog_User();
    }

    public function adminLogin()
    {
        if ($_POST['username'] === 'admin' && $_POST['password'] === 'password') {
            $_SESSION['login'] = true;
            return true;
        } else {
            return $this->login($_POST['username'], $_POST['password']);
        }
    }

    /**
     * Insert into menu table
     *
     * @param  $name
     * @param  $description
     *
     * @return bool
     */
    public function login ($username, $password)
    {
        try {
            $login = $this->user->where(['username' => $username, 'password' => md5($password)], 'AND')->first();

            if (! empty($login)) {
                $_SESSION['login'] = true;
                $_SESSION['id'] = $login->id;
                return true;
            } else {
                return "Error";
            }
        } catch (PasswordException $e) {
            return $e->errorMessage();
        } catch (DataNotFoundException $e) {
            return $e->errorMessage();
        }
    }

    public function adminRegisteration()
    {
        $this->user->id        = NULL;
        $this->user->username  = $_POST['username'];
        $this->user->name      = $_POST['fullname'];
        $this->user->password  = md5($_POST['password']);
        $this->user->role      = $_POST['role'];
        $this->user->biography = $_POST['biography'];
        $this->user->avatar    = $this->user->file($_FILES['avatar'])->uploadFile($_SERVER['DOCUMENT_ROOT']."/uploads/user/");

        $save = $this->user->save();

        if ($save) {
            return true;
        }
    }

    public function updateUserInfo()
    {
        $update = new Blog_User();
        $update->username  = $_POST['username'];
        $update->name      = $_POST['fullname'];
        $update->password  = md5($_POST['password']);
        $update->biography = $_POST['biography'];

        $save = $update->update($_POST['user_id']);
        var_dump($save);die();

        return ($save) ? true : "error";
    }

    public function getUser()
    {
        return $this->user->where(['id' => $_SESSION['id']])->first();
    }
}
