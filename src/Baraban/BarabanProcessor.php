<?php

namespace Baraban;

use Baraban\Classes\ParserRate;

class BarabanProcessor {
   public $rate;
   private $rateConfig = [];

   public function __construct() {
      $this->rate = new ParserRate($this->rateConfig);
   }

   /**
    * @param array $config Массив конфигурационых данных (строго по примеру!)
    * @example $config ["urlDonor"=> "http://example.org", "DOM"=> "JS DOM (table > tr > td)"]
    * @return void
    */

   public function configurateRate(array $config) {
      $this->rateConfig = $config;
      $this->rate = new ParserRate($this->rateConfig);

      return $this;
   }
}
