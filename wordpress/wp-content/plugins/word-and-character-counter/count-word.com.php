<?php
/*
Plugin Name: count-word.com
Plugin URI: http://www.count-word.com
Description: Counts words and characters while writing new posts
Version: 1.00
Author: count-word.com
Author URI: http://www.count-word.com
*/

add_action('admin_footer-post.php', 'my_action_javascript');

function my_action_javascript() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
    //initial load
    jQuery("#wp-word-count").replaceWith(
    "<td style='padding: 2px 10px' id='wordcounternet'>Words: <span id='words'>0</span> Characters: <span id='characters'>0</span></td>"
    );
    
    //console.log(jQuery("#content"));
    count = wordcounter(document.getElementById("content"));
    jQuery("#wordcounternet > #words").text(count[0]);
    jQuery("#wordcounternet > #characters").text(count[1]);
    
    /* on key press */
    jQuery("#content").keypress(function() {
       count = wordcounter(this);
       jQuery("#wordcounternet > #words").text(count[0]);
       jQuery("#wordcounternet > #characters").text(count[1]);
    });
    
    function wordcounter(this_field) {
        show_word_count = true;
        show_char_count = false;
        var char_count = this_field.value.length;
        var fullStr = this_field.value + " ";
        var initial_whitespace_rExp = /^[^A-Za-z0-9]+/gi;
        var left_trimmedStr = fullStr.replace(initial_whitespace_rExp, "");
        var non_alphanumerics_rExp = rExp = /[^A-Za-z0-9']+/gi;
        var cleanedStr = left_trimmedStr.replace(non_alphanumerics_rExp, " ");
        var splitString = cleanedStr.split(" ");
        var word_count = splitString.length -1;
        if (fullStr.length <2) {
        word_count = 0;
        }
        if (word_count == 1) {
        wordOrWords = " word";
        }
        else {
        wordOrWords = " words";
        }
        if (char_count == 1) {
        charOrChars = " character";
        } else {
        charOrChars = " characters";
        }
        return [word_count, char_count];
    }
});
</script>
<?php
}
?>