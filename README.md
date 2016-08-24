php-emoji
=========

Simple PHP libiary to convert Emoji(iOS 6,7,8,OS X) to unicode

-------
iOS 9 Support : @desexy

>usage

``` php
<?php
    require_once('path/to/Emoji.php');
    //encode
    $text = '😄,hi';
    echo Emoji::Encode($text);
    //decode
    $text='\ud83d\ude04,hi';
    echo Emoji::Decode($text);
?>
```
