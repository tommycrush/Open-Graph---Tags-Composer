<?php

class OpenGraph {

	// These property => content assignments are added to every initial composeTags call
	// Note: these attributes can be overriden. For example, if "type" appears in the $tags
	//   given to composeTags, then the "og:type" parameter given here is passed over.
	// Also: Notice how the prefixes are attached here, this is for custom uses (like 'fb')
	public static $universal_tags = array(
		"og:type" => "website",
		"fb:admins" => "YOUR_USER_ID",
		"fb:app_id" => "APP_ID"
	);


	// If all tags should begin with something (like 'og:'), delcare here. 'og:' is default
	public static $prefix = "og:";


	// call this function to compose the meta tags
	// pass an array of tags, see below for example
	// This returns a string of meta tags
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
			foreach(self::$universal_tags as $property => $content){
				if(!array_key_exists($property, $tags)){
					$html .= self::composeTag($content, $property);
				}
			}
		}

		return $html;
	} 

	//helper function to compose individual tag
	public static function composeTag($value, $name){
		return '<meta property="'.$name.'" content="'.$value.'" />';
	}

}



/*
*	the array is formatted in a 'property' => 'content' manner
*/
$data = array(
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


echo OpenGraph::composeTags($data);;

/*
*
* This example returns:

<meta property="og:title" content="This is this title" />
<meta property="og:url" content="http://fierce-ocean-1626.herokuapp.com/og/OpenGraph.class.php" />
<meta property="og:image:url" content="http://mydomain.com/image.jpg" />
<meta property="og:image:secure" content="https://mydomain.com/image.jpg" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="300" />
<meta property="og:video:url" content="http://fierce-ocean-1626.herokuapp.com/og/OpenGraph.class.php" />
<meta property="og:video:actor" content="Tommy" />
<meta property="og:video:role" content="Main Character" />
<meta property="og:video:director" content="Tommy Crush" />
<meta property="og:video:writer" content="Tommy Crush" />
<meta property="og:video:tag" content="best,movie,ever" />
<meta property="og:video:release_date" content="2012-11-30" />
<meta property="og:type" content="website" />
<meta property="fb:admins" content="USER_ID" />
<meta property="fb:app_id" content="APP_ID" />

*/

?>



