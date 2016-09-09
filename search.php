<?php
/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/
include "connect.php";
$db->set_charset("utf8");
/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<a target="" href="urlString">';
$html .= '<h3>nameString functionString</h3>';
//$html .= '<h4>functionString</h4>';
$html .= '</a>';
$html .= '</li>';

// Get Search
//$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = str_ireplace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = mb_convert_case ($search_string, MB_CASE_TITLE, "UTF-8" );
$search_string = $db->real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = 'SELECT * FROM members WHERE name LIKE "%'.$search_string.'%" OR lastname LIKE "%'.$search_string.'%"';

	// Do Search
	$result = $db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

			// Format Output Strings And Hightlight Matches
			$display_function = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['name']);
			$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['lastname']);
			$display_url = 'index.php?details=details&user_id='.urlencode($result['id']).'&lang=en';

			// Insert Name
			$output = str_replace('nameString', $display_name, $html);

			// Insert Function
			$output = str_replace('functionString', $display_function, $output);

			// Insert URL
			$output = str_replace('urlString', $display_url, $output);

			// Output
			echo($output);
		}
	}else{

		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<b>Nic nie znaleziono.</b>', $output);
		$output = str_replace('functionString', ' ', $output);

		// Output
		echo($output);
	}
}


/*
// Build Function List (Insert All Functions Into DB - From PHP)

// Compile Functions Array
$functions = get_defined_functions();
$functions = $functions['internal'];

// Loop, Format and Insert
foreach ($functions as $function) {
	$function_name = str_replace("_", " ", $function);
	$function_name = ucwords($function_name);

	$query = '';
	$query = 'INSERT INTO search SET id = "", function = "'.$function.'", name = "'.$function_name.'"';

	$db->query($query);
}
*/
?>