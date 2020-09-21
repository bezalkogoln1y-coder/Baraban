<?php

namespace Baraban\Helpers;

class HTMLPager {

   private static function generateCOOKIES($name = 'cookies') {
      if (!file_exists(__DIR__ . "/../tmp")) {
         mkdir('tmp', 0755, true);
      }

      if (!file_exists(__DIR__ . "/../tmp/$name.txt")) {
         echo '123';
         fopen(__DIR__ . "/../tmp/$name.txt", 'w');
      }
   }

   public static function getHTML($url) {
      self::generateCOOKIES();

      //Инициализация cURL
      $ch = curl_init($url);

      //Глобальные опции cURL
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_COOKIESESSION, true);

      //Изменяемые опции cURL
      curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/../tmp/cookies.txt');
      curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/../tmp/cookies.txt');
      curl_setopt($ch, CURLOPT_NOBODY, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36');
      curl_setopt($ch, CURLOPT_HEADER, false);

      //Вывод данных и закрытие cURL
      $html = curl_exec($ch);
      curl_close($ch);


      return $html;
   }
}
