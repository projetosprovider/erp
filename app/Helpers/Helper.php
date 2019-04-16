<?php

namespace App\Helpers;

use Auth;
use Session;
use App\Models\Training\{Course};
use App\Models\People;

/**
 *
 */
class Helper
{
    public static function slug($key)
    {
        $user = Auth::user();
        return (string)$user->id.'-'.$key;
    }

    public static function has($key)
    {
        $slug = self::slug($key);
        return Session::exists($slug);
    }

    public static function get($key)
    {
        $slug = self::slug($key);
        return Session::get($slug);
    }

    public static function set($key, $value)
    {
        $slug = self::slug($key);
        return Session::put($slug, $value);
    }

    public static function drop($key)
    {
        $slug = self::slug($key);
        return Session::forget($slug);
    }

    public static function courses()
    {
        $key = 'courses';

        if(self::has($key)) {
            return self::get($key);
        }

        $courses = Course::all();

        self::set($key, $courses);
        return self::get($key);
    }

    public static function getRouteForModel($model, $subject)
    {
        $item = $model::find($subject);

        $route = null;
        $html = null;

        if($model == 'App\Models\Training\Course') {

          if($item) {
            $route = route('courses.edit', $item->uuid);
            $html = "<a href=".$route.">".$item->title."</a>";
          }
        }

        if($model == 'App\User') {

          if($item) {
            $route = route('user', $item->uuid);
            $html = "<a href=".$route.">".$item->person->name."</a>";
          }
        }

        if($model == 'App\Models\MessageBoard\Type') {
          if($item) {
            $route = route('message-types.edit', $item->uuid);
            $html = '<a href='.$route.'>'.$item->name.'</a>';
          }
        }

        if($model == 'App\Models\Client') {

          if($item) {
            $route = route('clients.show', $item->uuid);
            $html = '<a href='.$route.'>'.$item->name.'</a>';
          }
        }

        if($model == 'App\Models\People') {
          $route = route('user', $item->uuid);
          $html = '<a href='.$route.'>'.$item->name.'</a>';
        }

        if($model == 'App\Models\Client\Address') {

          if($item) {
            $route = route('clients.show', $item->client->uuid);
            $html = '<a href='.$route.'>'.$item->description.': '.$item->street.', '.$item->number.', '.$item->district.', '.$item->city.', '.$item->zip.'</a>';
          }

        }

        if($model == 'App\Models\Client\Employee') {

          if($item || $item->client !== null) {
            $route = route('client_employees', $item->company->uuid);
            $html = '<a href='.$route.'>'.$item->description.'</a>';
          }

        }

        if($model == 'App\Models\MessageBoard') {
          $route = route('message-board.show', $item->uuid);
          $html = '<a href='.$route.'>'.$item->subject.'</a>';
        }

        return [
          'route' => $route,
          'html' => $html
        ];
    }

    public static function getTagHmtlForModel($model, $subject)
    {
        if(!$subject) {
          return null;
        }

        $itens = self::getRouteForModel($model, $subject);

        echo $itens['html'];
    }

    public static function idade(People $person)
    {
        $date = $person->birthday;
        $interval = $date->diff(now());

        return $interval->format( '%y Anos' );
    }

}
