<?php
namespace TopItems\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;

class ContentController extends Controller
{
    public function showTopItems(Twig $twig, ItemDataLayerRepositoryContract $itemRepository):string
    {
        $itemColumns =  [
                            'itemDescription'       => [
                                                          'name1',
                                                          'description'
                            ],
                            'variationBase'         => [
                                                          'id'
                            ],
                            'variationRetailPrice'  => [
                                                          'price'
                            ],
                            'variationImageList'    => [
                                                          'path',
                                                          'cleanImageName'
                            ]
        ];

        $itemFilter = [
                          'itemBase.isStoreSpecial' =>  [
                                                          'shopAction' => [3]
                                                        ]
                      ];

        $itemParams = [
                          'language' => 'en'
                      ];

        $resultItems = $itemRepository
          ->search($itemColumns, $itemFilter, $itemParams);

        $items = array();

        foreach ($resultItems as $item)
        {
            $items[] = $item;
        }

        $templateData = array(
            'resultCount' => $resultItems->count(),
            'currentItems' => $items
        );

var_dump($templateData);
/*
        foreach($templateData as $key => $value)
        {
            if (is_array($value))
            {
                //Self::traverseArray($value);
                traverseArray($value);
            }else {
                echo $key . " = " . $value . "<br />\n";
            }
        }
*/
        return $twig->render('TopItems::content.TopItems', $templateData);
      }
}

 ?>
