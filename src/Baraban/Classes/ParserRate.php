<?php

namespace Baraban\Classes;

use Baraban\Helpers\HTMLPager;
use Baraban\Interfaces\ClassInterface;
use phpQuery;

class ParserRate implements ClassInterface {
   protected $config;
   protected $data;

   public function __construct(array $customConfig = []) {
      if (!empty($customConfig)) {
         $this->config = $customConfig;
      } else {
         $this->config = [
            'urlDonor' => 'https://www.coingecko.com/ru/%D0%9A%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%D1%8B/%D0%B1%D0%B8%D1%82%D0%BA%D0%BE%D0%B8%D0%BD/rub',
            'DOM' => '.col-lg-4 span[data-target="price.price"]'
         ];
      }
   }

   private function getConfig() {
      return $this->config;
   }

   private function parserCoin(string $coin = 'BTC') {
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
