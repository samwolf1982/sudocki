<?php

namespace App\models\control;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Customer extends User
{
    protected $fillable = [
        'name', 'email', 'password','phone','fname','sname',
        //'verify_token'
    ];

    protected $table = 'users';

    /**
     * @param $name
     * @param $fname
     * @param $sname
     * @param $email
     * @param $phone
     * @param $password
     * @return static
     */
    public  static  function newUserByAdmin($name, $fname, $sname, $email, $phone, $password) :self {

        return self::create(
            [
                'name' => $name,
                'fname' => $fname,
                'sname' => $sname,
                'email' => $email,
                'password' => bcrypt($password),
                'verify_token' => Str::random(),
                'phone'=>$phone,
            ]
        );
    }


    public function withRequestData(Request $request){
          $this->name=   $request->input('name');
          $this->fname=   $request->input('fname');
          $this->sname=   $request->input('sname');
          $this->email=   $request->input('email');
          $this->phone=   $request->input('phone');
          $password=$request->input('password');
          if(!empty($password)){
              $this->password =  bcrypt( $password);
              //$this->verify_token =  Str::random();
          }
          return $this;
    }
}
