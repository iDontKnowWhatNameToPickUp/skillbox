<?php
    class TelegraphText 
    {
        public string $title, $text, $author, $published, $slug;
        const FILE_FORMAT = '.txt';

        public function __construct($title, $author, $text) 
        {
            $this->title = $title;
            $this->author = $author;
            $this->text = $text;
            $this->published = date('Y-m-d//H:i:s');
            $this->slug = str_replace(' ','-', trim($title)) . self::FILE_FORMAT;
        }

        public function storeText() 
        {
            $array = [];
            $array['text'] = $this->text;
            $array['title'] = $this->title;
            $array['author'] = $this->author;
            $array['published'] = $this->published;

            $prepareToFile = serialize($array);
            file_put_contents($this->slug, $prepareToFile);

            return $this->slug;
        }

        public static function loadText(string $slug): ?TelegraphText 
        {
            if(file_exists($slug.self::FILE_FORMAT) && filesize($slug.self::FILE_FORMAT) > 0) {
                $array = unserialize(file_get_contents($slug.self::FILE_FORMAT));
                
                $telegraphText = new self($array['title'], $array['author'], $array['text']);
                
                $telegraphText->published = $array['published'];
                $telegraphText->slug = $slug . self::FILE_FORMAT;

                return $telegraphText;
            }
            return null;

        }

        public function editText($title, $text) 
        {
            unlink($this->slug);
            $this->title = $title;
            $this->text = $text;
            $this->slug = str_replace(' ','-', trim($title)) . self::FILE_FORMAT;
        }
    }

    // создание записи
    $line = new TelegraphText('some title', 'Ruf', 'Today was nice day');
    $line->storeText();

    // редактирование запсии
    $line->editText('new title', 'Today was nice day');
    $line->storeText();

    $findTitle = TelegraphText::loadText('new-title');
    if($findTitle !== null) {
        print_r($findTitle);
    } else {
        echo 'Null - такого тайтла нет';
    }

    $findTitle = TelegraphText::loadText('new-title');
    if($findTitle !== null) {
        echo('Значение $findTitle[\'title\'] = ' . $findTitle->title . PHP_EOL);
    } else {
        echo 'Null - такого тайтла нет';
    }

    $line->editText('Fairy tail', 'Once upon a time');
    $line->storeText();
    
    print_r(TelegraphText::loadText(str_replace('.txt', '', $line->slug)));
    
?>