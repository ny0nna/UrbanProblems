<?php

namespace app\models;

class RegForm extends User{

    public $confirm_password;
    public $agree;
   


    public function rules()
{
    return [
        [['name', 'surname','patronymic', 'login', 'email', 'password','confirm_password','agree'], 'required'],
        [['is_admin'], 'integer'],
        [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 100],
        [['name', 'surname', 'patronymic'],'match', 'pattern'=>'/[А-ЯЁа-яё]{2,}/u',
        'message'=>'Используйте минимум 2 русских букв'],
        [['password'], 'match', 'pattern'=>'/^[A-Za-z0-9\D]{5,}/',
        'message'=>'Используйте минимум 5 латинских букв и цифр'],
        [['login'],'match','pattern'=>'/^[A-Za-z]{3,}/','message'=>'Используйте минимум 3 латинские буквы'],
        [['login','email'],'unique'],
        [['email'],'email'],
        

    ];
}
/**
 * {@inheritdoc}
 */

public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'confirm_password' => 'Повторите пароль',
            'agree' => 'Подтвердите согласие на обработку персональных анных', 
            //'is_admin' => 'Is Admin',
        ];
    }


}
?>