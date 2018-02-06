<?php
// functions for loading, constructing and 
// displaying the tree are in this file.
class treenode{
    //each node in the tree has member variables containing
    // all the data for a post except the body of the message.
    public $m_postid;
    public $m_title;
    public $m_poster;
    public $m_posted;
    public $m_children;
    public $m_childlist;
    public $m_depth;

    public function __construct($postid, $title, $poster, $posted,
                    $children, $expand, $depth, $expanded, $sublist){
        // the constructor sets up the member variables, but more
        // importantly recursively creates lower parts of the tree.
        $this->m_postid = $postid;
        $this->m_title = $title;
        $this->m_poster = $poster;
        $this->m_posted = $posted;
        $this->m_children = $children;
        $this->m_childlist = $array();
        $this->m_depth = $depth;
        // we only care what is below this node if it
        // has children and is marked to be expanded
        // sublists are always expanded.
        if (($sublist || $expand) && ($children)){
            $conn = db_connect();
            $query = "select * from header where parent=$postid order by posted";
            $result = $conn->query($query);
            for ($count=0; $row=@$result->fetch_assoc(); $count++){
                if ($sublist || @$expanded[$row['postid']]==true){
                    $expand = true;
                }else{
                    $expand = false;
                }
                $this->m_childlist[$count] = new treenode($row['postid'], $row['title'], $row['poster'], $row['posted'], $row['children'], $expand, $depth+1, $expanded, $sublist);
            }
        }                

    }

    function display($row, $sublist=false){
        // as this is an object, it is responsible for displaying itself.
        // $row tells us what row of the display we are up to, 
        // so we know what color it should be.
        // $sublist tells us whether we are on the main page
        // or the message page. Message pages should have $sublist=true.
        // On a sublist, all messages are expanded and there are no "+" or "-" symbols.

        // If this is the empty root node, skip displaying.
        if ($this->m_depth > -1){
            
        }


    }
}

?>