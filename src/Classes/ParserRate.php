<?php

namespace Baraban\Classes;

use Baraban\Helpers\HTMLPager;
use Baraban\Interfaces\ClassInterface;
use Baraban\Configs\RateConfig;
use phpQuery;

class ParserRate implements ClassInterface {
   protected $config;
   protected $data;

   public function __construct(object $config) {
      $this->config = [
         'urlDonor' => $config->getConfig('rate')['urlDonor'],
         'DOM' => $config->getConfig('rate')['DOM']
      ];
   }

   private function getConfig() {
      return $this->config;
   }

   private function parserCoin() {
      $config = $this->getConfig();
      $html = HTMLPager::getHTML($config['urlDonor']);
      $pq = phpQuery::newDocument(HTMLPager::getHTML($config['urlDonor']));
      $rows = $pq->find($config['DOM'])->html();

      $this->data = $rows;

      return $this;
   }

   private function getData() {
      return $this->data;
   }

   private function getFormattedData() {
      $data = $this->getData();
      $data = preg_replace('#\D+#', '', $data);

      return $data;
   }


   public function render(bool $formated = true) {
      if (!$formated) {
         return $this->parserCoin()->getData();
      }

      return $this->parserCoin()->getFormattedData();
   }
}
