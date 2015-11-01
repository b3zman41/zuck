<?php
/**
 * Created by IntelliJ IDEA.
 * User: teren
 * Date: 10/31/2015
 * Time: 8:54 PM
 */

namespace App;

use \Laravel\Socialite\Two;


class FacebookService
{
    public static function userForFacebookUser(Two\User $twoUser)
    {

        $user = User::where('id', intval($twoUser->getId()))->first();

        if (!$user) return;

        $user->access_token = $twoUser->token;

        $user->save();

        return $user;
    }

    public static function createUserForFacebookUser(Two\User $user)
    {
        return User::forceCreate([
            'id' => $user->getId(),
            'username' => $user->getName(),
            'avatar' => $user->getAvatar(),
            'access_token' => $user->token,
        ]);
    }

    public function getGroupMembers($user)
    {
        return json_decode(file_get_contents('http://graph.facebook.com/v2.5/333743493454130/members?access_token=' . $user->access_token));
    }

}