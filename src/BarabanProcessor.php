<?php

namespace Baraban;

use Baraban\Classes\ParserRate;
use Baraban\Configs\Config;

class BarabanProcessor {
   public $rate;

   public function __construct(object $config) {
      $this->rate = new ParserRate($config);
   }
}
