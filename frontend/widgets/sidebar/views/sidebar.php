<?php

function categoryList($array,$parent_id = 0,$parents = array())
{
    if($parent_id==0)
    {
        foreach ($array as $element)
        {
            if (($element['parent_id'] != 0) && !in_array($element['parent_id'],$parents))
            {
                $parents[] = $element['parent_id'];
            }
        }
    }
    $sidebar_html = '';
    foreach($array as $category)
    {
        if($category['parent_id']==$parent_id)
        {
            $is_parent = false;
            if(in_array($category['id'],$parents)){
                $is_parent = true;
            }

            $sidebar_html .= '<li '.(($is_parent)?'class="dropdown mega-dropdown"':'').'>';
            $sidebar_html.='<a '.(($is_parent)?'class="dropdown-toggle" data-toggle="dropdown"':'').' href="/category/'.$category['slug'].'">';
            if($is_parent){
                $sidebar_html .= '<span class="caret"></span>'; 
            }
            $sidebar_html.= $category['title'].'</a>';
            if($is_parent){
                $sidebar_html .= '<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">';
                    $sidebar_html .= '<div class="w3ls_vegetables">';
                        $sidebar_html .= '<ul>'.categoryList($array, $category['id'], $parents).'</ul>';
                    $sidebar_html .= '</div>';
                $sidebar_html .= '</div>';
            }
            $sidebar_html .= '</li>';
        }
    }
    $sidebar_html .= '';
    return $sidebar_html;
}

?>
<nav class="navbar nav_bottom">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header nav_2">
        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
            <?= categoryList($categories);?>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>