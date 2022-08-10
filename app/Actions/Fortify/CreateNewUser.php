<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Admin;
use App\Models\KostOwner;
use App\Models\KostSeeker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        //dd($input);
        if($input['role'] == 'admin'){
            $validator = Validator::make($input, [
                'first_name' => ['required', 'string', 'max:40'],
                'last_name' => ['required', 'string', 'max:40'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255'
                ],
                'password' => $this->passwordRules(),
                'password_confirmation' => ['required', 'string', 'min:8'],
            ]);

            $validator->validate();

            $user = new User;
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->save();

            $admin = new Admin;
            $admin->first_name = $input['first_name'];
            $admin->last_name = $input['last_name'];
            $admin->user_id = $user->id;
            $admin->save();
        }elseif($input['role'] == 'owner'){
            $validator = Validator::make($input, [
                'first_name' => ['required', 'string', 'max:40'],
                'last_name' => ['required', 'string', 'max:40'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255'
                ],
                'address' => ['required', 'string'],
                'handphone' => ['required', 'numeric', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                'password' => $this->passwordRules(),
                'password_confirmation' => ['required', 'string', 'min:8'],
            ]);
            
            $validator->validate();
            $user = new User;
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->save();
        
            $kost_owner = new KostOwner;
            $kost_owner->first_name = $input['first_name'];
            $kost_owner->last_name = $input['last_name'];
            $kost_owner->handphone = $input['handphone'];
            $kost_owner->address = $input['address'];
            $kost_owner->user_id = $user->id;
            $kost_owner->save();
        }elseif($input['role'] == 'customer'){
            $validator = Validator::make($input, [
                'first_name' => ['required', 'string', 'max:40'],
                'last_name' => ['required', 'string', 'max:40'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255'
                ],
                'handphone' => ['required', 'numeric', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                'password' => $this->passwordRules(),
                'password_confirmation' => ['required', 'string', 'min:8'],
            ]);

            $validator->validate();
            $user = new User;
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->save();
            
            $kostSeeker = new KostSeeker;
            $kostSeeker->first_name = $input['first_name'];
            $kostSeeker->last_name = $input['last_name'];
            $kostSeeker->gender = $input['gender'];
            $kostSeeker->birth_place = $input['cities'];
            $kostSeeker->birth_day = $input['birth_day'];
            $kostSeeker->handphone = $input['handphone'];
            $kostSeeker->emergency = $input['emergency'];
            $kostSeeker->job = $input['job'];
            $kostSeeker->job_name = $input['job_name'];
            $kostSeeker->job_description = $input['job_description'];
            $kostSeeker->address = $input['address'];
            $kostSeeker->user_id = $user->id;
            $kostSeeker->save();
        }
        
        $token = $user->createToken('myapptoken')->plainTextToken;
        // $user->token = $token;
        // return $user;
        
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return $user;
        
        
    }
}
