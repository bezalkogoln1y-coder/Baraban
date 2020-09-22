<?php

namespace Baraban\Interfaces;

interface ConfigInterface {
   public function getConfig(string $type);
   public function setCustomConfig(array $data, string $type);
   public function __construct();
}
