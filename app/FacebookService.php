<?php
/**
 * Created by IntelliJ IDEA.
 * User: teren
 * Date: 10/31/2015
 * Time: 8:54 PM
 */

namespace App;

use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Service\Client;
use \Laravel\Socialite\Two;


class FacebookService
{

    private static $client;

    public function __construct()
    {
        FacebookService::$client = new Client();
    }

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

        try {
            $response = static::$client->get('/v2.5/333743493454130/members', null, [
                'query' => [
                    'access_token' => $user->access_token,
                ]
            ])->send();

            return json_decode($response->getBody(true));

        } catch (ClientErrorResponseException $e) {
            dd($e->getResponse()->getBody(true));
        }
    }

    public function updateMembers($user)
    {
        $members = [];
        $next = 'https://graph.facebook.com/v2.5/333743493454130/members?access_token=' . $user->access_token;

        while($next)
        {
            $response = static::$client->createRequest('GET', $next)->send();

            $results = json_decode($response->getBody(true));

            if(isset($results->paging->next))
                $next = $results->paging->next;
            else $next = null;

            $members = array_merge($members, $results->data);
        }

        foreach($members as $member)
        {
            $user = User::find($member->id);

            if(!$user)
            {
                User::forceCreate([
                    'id' => $member->id,
                    'username' => $member->name,
                    'avatar' => 'https://graph.facebook.com/v2.5/' . $member->id . '/picture?type=large',
                ]);
            }
        }
    }

}