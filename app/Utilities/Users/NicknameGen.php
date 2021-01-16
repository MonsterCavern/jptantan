<?php
namespace App\Utilities\Users
{
  class NicknameGen
  {
      public static function random()
      {
          $rank = ["超神聖", "新世紀", "究極"];
          $decorate = ["閃光", "雷霆", "兔耳"];
          $object = ["香菇", "守護者", "終結者"];

          $name = $rank[rand(0, sizeof(($rank))-1)]
          . $decorate[rand(0, sizeof(($decorate))-1)]
          . $object[rand(0, sizeof(($object))-1)] ;

          return $name;
      }
  }

}
