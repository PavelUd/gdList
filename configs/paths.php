<?php
namespace gdlist\www\configs;
use gdlist\www\Db;
$db = new Db();
$types = array(
    "exodium",
    "legend",
    "amethyst",
    "diamond",
    "ruby" ,
    "emerald",
    "gold" ,
    "silver" ,
    "bronze" ,
    "rock"
);
$paths = [''=>['controller' => 'index',
            'action' => 'get_header',
    ],
    'MainList' => [
    'controller' => 'mainList',
    'action' => 'get_main_list',
    ],
    'exit' =>[
        'controller' => 'view',
        'action' => 'login_exit',
    ],
    'add_record' =>[
        'controller' => 'service',
        'action' => 'get_record',
],
    'create_level' =>[
        'controller' => 'service',
        'action' => 'create_level',
]
    ];
foreach ($types as $type) {
    $key = 'MainList/'.$type;
    $paths[$key]=  [
        'controller' => 'mainList',
        'action' => 'get_main_list',
        'params' => $type
    ];
    $param = array(
        'type' => $type
    );
    $paths = get_levels($db->get_rows("select id from levels where type = :type", $param), $key, $paths);

}
function get_levels($levelsArray, $key, $paths) {
    foreach ($levelsArray as $levelArray) {
        $id = $levelArray["id"];
        $path = $key.'/'.$id;
        $paths[$path] = [
            'controller' => 'card',
            'action' => 'get_media',
            'params' => $id
        ];
    }
    return $paths;
}
return $paths

?>