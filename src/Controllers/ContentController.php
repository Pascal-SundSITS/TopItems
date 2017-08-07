<?php
namespace TopItems\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Item\DataLayer\Contracts\ItemsDataLayerRepositoryContract;

class ContentController extends Controller
{
    public function showTopItems(Twig $twig, ItemDataLayerRepositoryContract $itemRepository):string
    {
        $itemColumns = [
                          "itemDescription"       =>  [
                                                        "name1",
                                                        "description"
                          ],
                          "variationBase"         =>  [
                                                        "id"
                          ],
                          "variationRetailPrice"  =>  [
                                                        "price"
                          ],
                          "variationImageList"    =>  [
                                                        "path",
                                                        "cleanImageName"
                          ]
                        ];

        $itemFilter = [
                        "itemBase.isStoreSpecial" => [
                                                        "shopAction" => [3]
                        ]
        ];

        $itemParams = [
                        "language" => "en"
        ];

        $resultsItems = $itemRepository
          ->search($itemColumns, $itemFilter, $itemParams);

          $items = array();

          foreach($resultsItems as $item)
          {
              $items[] = $item;
          }

          $templateData = array(
                                  "resultCount"   =>  $resultsItems->count(),
                                  "currentItems"  =>  $items
                          );

          return $twig->render('TopItems::content:TopItems', $templateData);
    }
}

 ?>
