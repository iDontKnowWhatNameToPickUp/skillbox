<?php
    $textStorage = [
        // 0 => [
        //     'title_0' => 'text_0'
        // ],
        // 1 => [
        //     'title_1' => 'text_1'
        // ],
        // 2 => [
        //     'title_2' => 'text_2'
        // ]
    ];

    // print_r($textStorage[0]['title_0']);

    function add(&$arr, $title, $text) 
    {
        $arr[][$title] = $text;
    }

    function remove(&$arr, $index) 
    {
        if(isset($arr[$index]))
        {
            unset($arr[$index]);
        } else
            echo 'false';
    }

    function edit(&$arr, $index, $title, $text = '') {
        if(isset($arr[$index])) {
            $title_val = array_keys($arr[$index])[0];
            if(($title_val == $title && $text != '')){
                $arr[$index][$title] = $text;
            } elseif($title_val != $title && $text != '') {
                remove($arr, $index);
                $arr[$index][$title] = $text;
                $arr = array_reverse($arr, true);
            } elseif($title_val != $title && $text == '') {
                $oldText = $arr[$index][$title_val];
                remove($arr, $index);
                $arr[$index][$title] = $oldText;
                $arr = array_reverse($arr, true);
            }

        } else {
            echo 'false' . PHP_EOL;
        }
    }
    
    add($textStorage, 'Овощи', 'Огурцы, помидоры, ревень');
    add($textStorage, 'Ягоды', 'Ежевика, малина, крыжовник');
    add($textStorage, 'Список дел', 'Помыть посуду, Убрать вещи, Выбросить мусор');
    
    echo 'После добавления '. PHP_EOL;
    print_r($textStorage);

    print_r(remove($textStorage, 1));
    echo 'После удаления '. PHP_EOL;
    print_r($textStorage);

    # Тестирование редактирования 4 варианта
    // новый тайтл и новый текст
    // print_r(edit($textStorage, 0, 'Овощиb', 'Баклажаны, цукини'));

    // Новый тайтл и без текста
    // print_r(edit($textStorage, 0, 'ОвощиЩ'));

    // Старый тайтл и без текста
    // print_r(edit($textStorage, 0, 'Овощи'));

    // Старый тайтл и новый текст
    // print_r(edit($textStorage, 0, 'Овощи', 'Какие-то новые овощи'));

    echo 'После редактирования '. PHP_EOL;
    print_r($textStorage);

?>