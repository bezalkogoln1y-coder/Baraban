<?php

namespace Baraban\Configs;

use Baraban\Interfaces\ConfigInterface;

class Config implements ConfigInterface {
   private $config = [];

   public function __construct() {
      $this->config = [
         'rate' => [
            'urlDonor' => 'https://www.coingecko.com/en/coins/bitcoin/rub',
            'DOM' => '.col-lg-4 span[data-target="price.price"]'
         ]
      ];
   }

   public function getConfig(string $type) {
      $type = strtolower($type);

      return $this->config[$type];
   }

   public function setCustomConfig(array $data, string $type) {
      $type = strtolower($type);
      $default = $this->getConfig($type);

      $this->config[$type] = array_merge($default, $data);

      return $this;
   }
}
