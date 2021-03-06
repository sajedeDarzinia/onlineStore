<?php namespace App\Models;

use App\Models\Model;

class User extends Model
{
    protected $table = 'users';

    // register
    /**
     * register and insert data in user table function
     *
     * @param [type] $data
     * @return array
     */
    public function register($data)
    {
        unset($data['confirmPassword']);
        $result = $this->create($data);

        if ($result) {
            return true;
        }

    }

    // login

    /**
     * check Equal password and email function
     *
     * @param [type] $data
     * @return object
     */
    public function login($data)
    {
        $email = $data['email'];
        $user = $this->where('email', $email)->first();

        $hashedPassword = $user->password;

        if (password_verify($data['password'], $hashedPassword)) {
            session()->add('user' , $user->id);
            session()->add('user_name' , $user->full_name);
            session()->add('is_login' , true);
            redirect('/');
        } else {
            return false;
        }

    }



    /**
     * this function grouping comment by parents
     *
     * @param [type] $productId
     * @return $array
     */
    public function groupCommentByParent($productId)
    {
        $comments = $this
            ->addQuery("right join comments on  users.id = comments.user_id")
            ->where('comments.product_id' , $productId)
            ->get();


        $array = array();

        foreach ($comments as $key => $value) {
            $array[$value['parent_comment']][] = $value;
        }

        return $array;

    }
    

}
