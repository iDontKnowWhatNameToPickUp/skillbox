<?php
    $searchRoot = '/Users/rufina/Documents/PHP/Задание 7.5/test_search';
    $searchName = 'test.txt';
    $searchResult = [];

    function search($searchRoot, $searchName, &$searchResult) {
        $arr = scandir($searchRoot);
      
        for($i = 0; $i < count($arr); $i++) {
            if($arr[$i] == '.' || $arr[$i] == '..') {
                continue;
            }

            if(is_dir($searchRoot . '/' . $arr[$i])) {
                search($searchRoot . '/' . $arr[$i], $searchName, $searchResult);
            } else {
                if($searchName == $arr[$i]) {
                    $searchResult[] = $searchRoot .'/'. $arr[$i];
                }
            }
        }
    }

    function sizeFileNotZero($i) {
        return filesize($i) != 0 ;
    }

    echo "Searched files" . PHP_EOL;
    search($searchRoot, $searchName, $searchResult);
    
    if(!empty($searchResult)) {
        print_r($searchResult);
    } else {
        echo 'Нет результатов поиска';
    }

    echo "Filtered data" . PHP_EOL;
    $filteredArray = array_filter($searchResult, 'sizeFileNotZero');
    print_r($filteredArray);
?>