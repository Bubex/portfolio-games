<?
class FUNC
{
     public static function convert_datetime($datetime)
     {
          $date = explode(' ', $datetime);
          $dates = explode('-', $date[0]);

          return $dates[2] . '/' . $dates[1] . '/' . $dates[0];
     }
}
