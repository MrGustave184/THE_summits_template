<?php
// Check if a post/page content is empty. 
// You can use it inside the loop by not passing it any parameters, or pass a parameter to check
function have_content($str=null) 
{
    if(!$str) {
        global $post;
        $str = $post->post_content;
    }

	// These tags will NOT be stripped, useful for things like image-only content and such
	$allowableTags = ['<img>'];

	return trim(str_replace('&nbsp;','',strip_tags($str, $allowable_tags))) != '';
}

/**
 * 
 * Console.log php string
 * @param string
 */
function consoleLog($message)
{?>
    <script>
        let message = "<?php echo $message; ?>";
        console.log(message);
    </script>
<?php
}

