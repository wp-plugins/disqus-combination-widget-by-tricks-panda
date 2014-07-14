<?php
/*
Plugin Name: Combination Widget For Disqus
Plugin URI: http://www.trickspanda.com
Description: Add a Disqus combination widget to your WordPress blog's sidebar
Version: 1.0
Author: Hardeep Asrani
Author URI: http://www.hardeepasrani.com
*/

class tp_disquscombination extends WP_Widget
{
    function tp_disquscombination()
    {
        $widget_ops = array(
            'classname' => 'tp_disquscombination',
            'description' => 'Add Disqus combination widget to WordPress sidebar.'
        );
        
        $this->WP_Widget('tp_disquscombination', 'Disqus Combination Widget', $widget_ops);
    }
    
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance);
        
        if ($instance['itemnumbers'] == "") {
            $instance['itemnumbers'] = "5";
        }
?>

<p>
<label for="<?php
        echo $this->get_field_id('siteid');
?>">
Disqus Site ID:
<br/>
<input id="<?php
        echo $this->get_field_id('siteid');
?>" 
name="<?php
        echo $this->get_field_name('siteid');
?>" type="text" value="<?php
        echo $instance['siteid'];
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('itemnumbers');
?>">
Number of Items:
<br/>
<input id="<?php
        echo $this->get_field_id('itemnumbers');
?>" 
name="<?php
        echo $this->get_field_name('itemnumbers');
?>" type="number" value="<?php
        echo $instance['itemnumbers'];
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('taboption');
?>">
Default Tab:
<br/>
<select id="<?php
        echo $this->get_field_id('taboption');
?>" name="<?php
        echo $this->get_field_name('taboption');
?>">
  <option value="people" <?php
        if ($instance['taboption'] == people)
            echo 'selected="selected"';
?>>People</option>
  <option value="recent" <?php
        if ($instance['taboption'] == recent)
            echo 'selected="selected"';
?>>Recent</option>
  <option value="popular" <?php
        if ($instance['taboption'] == popular)
            echo 'selected="selected"';
?>>Popular</option>
</select> 
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('coloroption');
?>">
Widget Color:
<br/>
<select id="<?php
        echo $this->get_field_id('coloroption');
?>" name="<?php
        echo $this->get_field_name('coloroption');
?>">
  <option value="grey" <?php
        if ($instance['coloroption'] == grey)
            echo 'selected="selected"';
?>>Grey</option>
  <option value="red" <?php
        if ($instance['coloroption'] == red)
            echo 'selected="selected"';
?>>Red</option>
  <option value="green" <?php
        if ($instance['coloroption'] == green)
            echo 'selected="selected"';
?>>Green</option>
  <option value="blue" <?php
        if ($instance['coloroption'] == blue)
            echo 'selected="selected"';
?>>Blue</option>
  <option value="orange" <?php
        if ($instance['coloroption'] == orange)
            echo 'selected="selected"';
?>>Orange</option>
</select> 
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('hideavataroption');
?>">
Hide Avatars:
<br/>
<input type="hidden" name="<?php
        echo $this->get_field_name('hideavataroption');
?>" value="0" /> <input id="<?php
        echo $this->get_field_id('hideavataroption');
?>" 
name="<?php
        echo $this->get_field_name('hideavataroption');
?>" type="checkbox" value="1" <?php
        if (1 == $instance['hideavataroption'])
            echo 'checked="checked"';
?> />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('hidemodsoption');
?>">
Hide Moderators:
<br/>
<input type="hidden" name="<?php
        echo $this->get_field_name('hidemodsoption');
?>" value="0" /> <input id="<?php
        echo $this->get_field_id('hidemodsoption');
?>" 
name="<?php
        echo $this->get_field_name('hidemodsoption');
?>" type="checkbox" value="1" <?php
        if (1 == $instance['hidemodsoption'])
            echo 'checked="checked"';
?> />
</label>
</p>

<?php
    }
    function update($new_instance, $old_instance)
    {
        $instance                     = $old_instance;
        $instance['siteid']           = $new_instance['siteid'];
        $instance['itemnumbers']      = $new_instance['itemnumbers'];
        $instance['taboption']        = $new_instance['taboption'];
        $instance['coloroption']      = $new_instance['coloroption'];
        $instance['hideavataroption'] = $new_instance['hideavataroption'];
        $instance['hidemodsoption']   = $new_instance['hidemodsoption'];
        
        return $instance;
    }
    
    function widget($args, $instance) // widget sidebar output
    {
        extract($args, EXTR_SKIP);
        
        echo $before_widget;
        echo $before_title;
        echo 'Community';
        echo $after_title;
        
        $siteid           = $instance['siteid'];
        $itemnumbers      = $instance['itemnumbers'];
        $taboption        = $instance['taboption'];
        $coloroption      = $instance['coloroption'];
        $hideavataroption = $instance['hideavataroption'];
        $hidemodsoption   = $instance['hidemodsoption'];
        
        echo "<script type='text/javascript' src='http://$siteid.disqus.com/combination_widget.js?num_items=$itemnumbers&hide_mods=$hidemodsoption&hide_avatars=$hideavataroption&color=$coloroption&default_tab=$taboption&excerpt_length=30'></script>";
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'return register_widget("tp_disquscombination");'));

?>