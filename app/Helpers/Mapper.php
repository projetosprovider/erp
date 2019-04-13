<?php

namespace App\Helpers;

use App\Models\Task;
use App\Models\Mapper as MapperModel;

/**
 *
 */
class Mapper
{
    public static function getDoneTime($mapper)
    {
        $tasksDone = Task::where('status_id', Task::STATUS_FINALIZADO)
        ->where('user_id', $mapper->user->id)
        ->where('mapper_id', $mapper->id)
        ->get();

        $doneTime = $tasksDone->map(function($task) {
          return $task->end->diff($task->begin);
          return [
            'day' => $formated->d,
            'hours' => $formated->h,
            'minutes' => $formated->i,
            'seconds' => $formated->s,
          ];
        });

        $day = $hours = $minutes = $seconds = 0;

        foreach ($doneTime as $key => $time) {
          $day += $time->d;
          $hours += $time->h;
          $minutes += $time->i;
          $seconds += $time->s;
        }

        if($seconds > 60) {
          $minutes += floor($seconds/60);
          $seconds = $seconds % 60;
        }

        if($minutes > 60) {
          $hours += floor($minutes/60);
          $minutes = $minutes % 60;
        }

        if($hours > 24) {
          $day += floor($hours/24);
          $hours = $hours % 24;
        }

        $day = (int)$day;
        $hours = (int)$hours;
        $minutes = (int)$minutes;
        $seconds = (int)$seconds;

        $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        $seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);

        if($day > 0) {
          return $day . ' dia(s) ' . $hours . ':' . $minutes . ':' . $seconds;
        }

        return $hours . ':' . $minutes . ':' . $seconds;
    }

    public static function getDoneTimeByUser($user)
    {
          $mapper = MapperModel::where('user_id', $user)->get()->first();

          $tasksDone = Task::where('status_id', Task::STATUS_FINALIZADO)
          ->where('user_id', $mapper->user->id)
          ->where('mapper_id', $mapper->id)
          ->get();

          $doneTime = $tasksDone->map(function($task) {
            return $task->end->diff($task->begin);
            return [
              'day' => $formated->d,
              'hours' => $formated->h,
              'minutes' => $formated->i,
              'seconds' => $formated->s,
            ];
          });

          $day = $hours = $minutes = $seconds = 0;

          foreach ($doneTime as $key => $time) {
            $day += $time->d;
            $hours += $time->h;
            $minutes += $time->i;
            $seconds += $time->s;
          }



        if($seconds > 60) {
          $minutes += floor($seconds/60);
          $seconds = $seconds % 60;
        }

        if($minutes > 60) {
          $hours += floor($minutes/60);
          $minutes = $minutes % 60;
        }

        if($hours > 24) {
          $day += floor($hours/24);
          $hours = $hours % 24;
        }

        $day = (int)$day;
        $hours = (int)$hours;
        $minutes = (int)$minutes;
        $seconds = (int)$seconds;

        $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        $seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);

        if($day > 0) {
          return $day . ' dia(s) ' . $hours . ':' . $minutes . ':' . $seconds;
        }

        return $hours . ':' . $minutes . ':' . $seconds;
    }

}
