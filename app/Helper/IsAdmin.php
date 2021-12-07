<?php namespace App\Helper;

use App\Core\Database;
class IsAdmin{
    /**
     * check user is admin or not function
     *
     * @return void
     */
    public static function checkUser()
    {

        $userIdSession = $_SESSION['user'];

        $db = new Database();

        $db->query("SELECT * FROM users WHERE id = :id");

        $db->bind(':id' , $userIdSession);

        $user = $db->single();
        
        if($user->is_admin == 0)
            header('Location:/dashboard');
    }
}