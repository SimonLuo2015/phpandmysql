<?php
    $table_width = '580';

    function reformat_date($datetime){
        // put date in US format, discard seconds
        list($year, $month, $day, $hour, $min, $sec) = preg_split('/[: -]+/', $datetime);
        return "$hour:$min $month/$day/$year";
    }

    function display_tree($expanded, $row = 0, $start = 0){
        // display the tree view of conversations
        global $table_width;
        echo "<table width = $table_width>";
        // see if we are displaying the whole list or a sublist
        if($start > 0){
            $sublist = true;
        }else{
            $sublist = false;
        }

        //construct tree structure to represent conversation summary.
        $tree = new treenode($start, '', '', '', 1, true, -1, $expanded, $sublist);
        // tell tree to display itself
        $tree->display($row, $sublist);
        echo '</table>';
    }

    function do_html_header($title = ''){
        // print an HTML header including cute logo
        global $table_width;
?>
        <html>
            <head>
                <title>
                    <?php echo $title?>
                </title>
                <style>
                    h1 {font-family: 'Times New Roman', Times, serif; font-size: 32;}
                </style>
            </head>
        </html>
}
