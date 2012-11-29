<?php


class OpenGraph {

	public static $generic_tags = array(
		"og:type" => "website",
		"fb:admins" => "USER_ID",
		"fb:app_id" => "APP_ID"
	);

	public static $prefix = "og:";


	public static function composeTags($tags, $prefix = self::$prefix){
		$html = "";

		foreach($tags as $property => $content){

			$prefix_property = $prefix.$property;

			if(is_array($content)){
				$html .= self::composeTags($content, $prefix_property.":");
			}else{
				$html .= self::composeTag($content, $prefix_property);
			}

		}

		if($prefix == self::$prefix){
			foreach(self::$generic_tags as $property => $content){
				if(!array_key_exists($property, $tags)){
					$html .= self::composeTag($content, $property);
				}
			}
		}

		return $html;
	} 


	public static function composeTag($value, $name){
		return '<meta property="'.$name.'" content="'.$value.'" />';
	}

}

$data = array(
	"type" => "website",
	"title" => "This is this title",
	"url" => "http://fierce-ocean-1626.herokuapp.com/og/OpenGraph.class.php",
	"image" => array(
		"url" => "http://mydomain.com/image.jpg",
		"secure" => "https://mydomain.com/image.jpg",
		"type" => "image/jpeg",
		"width" => 400,
		"height" => 300
		),
	"video" => array(
		"url" => "http://fierce-ocean-1626.herokuapp.com/og/OpenGraph.class.php",
		"actor" => "Tommy",
		"role" => "Main Character",
		"director" => "Tommy Crush",
		"writer" => "Tommy Crush",
		"tag" => "best,movie,ever",
		"release_date" => "2012-11-30"
		)

	);


echo "<html><head>".OpenGraph::composeTags($data)."</head><body>...</body></html>";
?>



