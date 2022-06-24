<?php



class User {
    
    private $users = [];
    
    public function __construct() {
        // Заполняем пользователей
        $emails = array(
            'test@test.com',
            'example@test.com',
            'test@testing.com',
            'testing@testing.com',
        );
        $names = array(
            'Вася',
            'Петя',
            'Иван',
            'Лариса',
            'Толя',
            'Катя',
        );
        foreach ($emails as $k => $v) {
            $user = array(
                'id' => $k + 1,
                'email' => $v,
                'name' => $names[random_int(0, count($names)-1)],
            );
            array_push($this->users, $user);
        }
    }
    
    public function searchUserByEmail($email) {
        $key = array_search($email, array_column($this->users, 'email'));
        $status = is_int($key)? true : false;
        Logger::logData($email, $status);
        return $status;
    }    
}
