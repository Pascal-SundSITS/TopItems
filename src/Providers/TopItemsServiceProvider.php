<?php
namespace TopItems\Providers;

use Plenty\Plugin\ServiceProvider;

class TopItemsServiceProvider extends ServiceProvider
{
  public function register()
  {
      $this->getApplication()->register(TopItemsRouteServiceProvider::class);
  }
}

 ?>
