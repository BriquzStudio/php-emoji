<?php
/***************************************************************************
 * 
 * Copyright (c) 2014 <Yin> gzsgcs@gmail.com. All Rights Reserved
 * 
 **************************************************************************/
/**
 * @file Emoji.php
 * @author Yin(gzsgcs@gmail.com)
 * @date 2014/12/09 3:27:02
 * @remark 截止iOS 8,共有845个Emoji表情(there are 845 emojis in iOS 8 and OS X)
 **/

class Emoji
{
	/**
	 * Encode emoji in text
	 * @param string $text text to encode
	 */
	public static function Encode($text) {
		return self::convertEmoji($text,"ENCODE");
	}

	/**
	 * Decode emoji in text
	 * @param string $text text to decode
	 */
	public static function Decode($text) {
		return self::convertEmoji($text,"DECODE");
	}

	private static function convertEmoji($text,$op) {
		if($op=="ENCODE"){
			return preg_replace_callback('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{1F000}-\x{1FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{1F000}-\x{1FEFF}]?/u',array('self',"encodeEmoji"),$text);
		}else{
			return preg_replace_callback('/(\\\u[0-9a-f]{4})+/',array('self',"decodeEmoji"),$text);
		}
	}

	private static function encodeEmoji($match) {
		return str_replace(array('[',']','"'),'',json_encode($match));
	}
	
	private static function decodeEmoji($text) {
		if(!$text) return '';
		$text = $text[0];
		$decode = json_decode($text,true);
		if($decode) return $decode;
		$text = '["' . $text . '"]';
		$decode = json_decode($text);
		if(count($decode) == 1){
		   return $decode[0];
		}
		return $text;
	}
}
?>
