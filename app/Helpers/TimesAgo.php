<?php

namespace App\Helpers;

/**
 *
 */
class TimesAgo
{
    const TIMEBEFORE_NOW = 'agora';
    const TIMEBEFORE_MINUTE = '{num} minuto atrás';
    const TIMEBEFORE_MINUTES = '{num} minutos atrás';
    const TIMEBEFORE_HOUR = '{num} hora atrás';
    const TIMEBEFORE_HOURS = '{num} horas atrás';
    const TIMEBEFORE_YESTERDAY = 'ontem';
    const TIMEBEFORE_FORMAT = '%e %b';
    const TIMEBEFORE_FORMAT_YEAR = '%e %b, %Y';

    public static function render($time)
    {
         if(!$time) {
             return '';
         }

         if(!$time instanceof \DateTime) {
            return '';
         }

         $out    = '';
         $now    = time(); // current time
         $diff   = $now - date_timestamp_get($time); // difference between the current and the provided dates

         if( $diff < 60 ) {
             return self::TIMEBEFORE_NOW;
         } elseif( $diff < 3600 ) {
            return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? self::TIMEBEFORE_MINUTE : self::TIMEBEFORE_MINUTES );
         } elseif( $diff < 3600 * 24 ) {
            return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? self::TIMEBEFORE_HOUR : self::TIMEBEFORE_HOURS );
         } elseif( $diff < 3600 * 24 * 2 ) {
            return self::TIMEBEFORE_YESTERDAY;
         } else {
            return strftime( $time->format('Y') == date( 'Y' ) ? self::TIMEBEFORE_FORMAT : self::TIMEBEFORE_FORMAT_YEAR, $time->format('Y') );
         }
     }

     public static function diffBetween($time, $end)
     {
          if(!$time) {
              return '';
          }

          if(!$end) {
              return 'Não Finalizada';
          }

          if(!$time instanceof \DateTime) {
             return '';
          }

          $out    = '';
          $now    = $end; // current time
          $diff   = date_timestamp_get($end) - date_timestamp_get($time); // difference between the current and the provided dates

          if( $diff < 60 ) {
              return self::TIMEBEFORE_NOW;
          } elseif( $diff < 3600 ) {
             return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? self::TIMEBEFORE_MINUTE : self::TIMEBEFORE_MINUTES );
          } elseif( $diff < 3600 * 24 ) {
             return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? self::TIMEBEFORE_HOUR : self::TIMEBEFORE_HOURS );
          } elseif( $diff < 3600 * 24 * 2 ) {
             return self::TIMEBEFORE_YESTERDAY;
          } else {
             return strftime( $time->format('Y') == date( 'Y' ) ? self::TIMEBEFORE_FORMAT : self::TIMEBEFORE_FORMAT_YEAR, $time->format('Y') );
          }
      }

}
