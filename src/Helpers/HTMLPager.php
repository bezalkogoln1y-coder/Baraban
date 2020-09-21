<?php

namespace Baraban\Helpers;

class HTMLPager {

   const SRCPATH = __DIR__ . '/../';
   const DIRCOOK = __DIR__ . '/../tmp/';

   public static function generateCOOKIES($name = 'cookies') {

      if (realpath(self::DIRCOOK) === false) {
         mkdir(realpath(self::SRCPATH) . '/tmp', 0755, true);
      }

      if (!file_exists(realpath(self::DIRCOOK) . "/$name.txt")) {
         fopen(realpath(self::DIRCOOK) . "/$name.txt", 'w');
      }
   }

   public static function getHTML($url) {
      $dirCook = realpath(self::DIRCOOK);
      $nameCook = 'cookies';
      self::generateCOOKIES($nameCook);

      //Инициализация cURL
      $ch = curl_init($url);

      //Глобальные опции cURL
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_COOKIESESSION, true);

      //Изменяемые опции cURL
      curl_setopt($ch, CURLOPT_COOKIEJAR, $dirCook . "/$nameCook.txt");
      curl_setopt($ch, CURLOPT_COOKIEFILE, $dirCook . "/$nameCook.txt");
      curl_setopt($ch, CURLOPT_NOBODY, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36');
      curl_setopt($ch, CURLOPT_HEADER, false);

      //Вывод данных и закрытие cURL
      $html = curl_exec($ch);
      curl_close($ch);


      return $html;
   }
}
