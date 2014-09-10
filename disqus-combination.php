<?php
/*
Plugin Name: Combination Widget For Disqus
Plugin URI: http://www.trickspanda.com
Description: Add a Disqus combination widget to your WordPress blog's sidebar
Version: 1.2
Author: Hardeep Asrani
Author URI: http://www.hardeepasrani.com
*/

class tp_disquscombination extends WP_Widget
{
    function tp_disquscombination()
    {
        $widget_ops = array(
            'classname' => 'tp_disquscombination',
            'description' => __( 'Add Disqus combination widget to WordPress sidebar', 'tp_disquscombination')
        );
        
        $this->WP_Widget('tp_disquscombination', __('Disqus Combination Widget', 'tp_disquscombination'), $widget_ops);
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
        echo $this->get_field_id('title'); 
?>">
<?php _e( 'Title:', 'tp_disquscombination'); ?>
<br/>
<input id="<?php
        echo $this->get_field_id('title');
?>" 
name="<?php
        echo $this->get_field_name('title');
?>" type="text" value="<?php
        echo $instance['title'];
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('siteid');
?>">
<?php _e( 'Disqus Site ID:', 'tp_disquscombination'); ?>
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
<?php _e( 'Number Of Items:', 'tp_disquscombination'); ?>
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
<?php _e( 'Default Tab:', 'tp_disquscombination'); ?>
<br/>
<select id="<?php
        echo $this->get_field_id('taboption');
?>" name="<?php
        echo $this->get_field_name('taboption');
?>">
  <option value="people" <?php
        if ($instance['taboption'] == people)
            echo 'selected="selected"';
?>><?php _e( 'People', 'tp_disquscombination'); ?></option>
  <option value="recent" <?php
        if ($instance['taboption'] == recent)
            echo 'selected="selected"';
?>><?php _e( 'Recent', 'tp_disquscombination'); ?></option>
  <option value="popular" <?php
        if ($instance['taboption'] == popular)
            echo 'selected="selected"';
?>><?php _e( 'Popular', 'tp_disquscombination'); ?></option>
</select> 
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('coloroption');
?>">
<?php _e( 'Widget Color:', 'tp_disquscombination'); ?>
<br/>
<select id="<?php
        echo $this->get_field_id('coloroption');
?>" name="<?php
        echo $this->get_field_name('coloroption');
?>">
  <option value="grey" <?php
        if ($instance['coloroption'] == grey)
            echo 'selected="selected"';
?>><?php _e( 'Grey', 'tp_disquscombination'); ?></option>
  <option value="red" <?php
        if ($instance['coloroption'] == red)
            echo 'selected="selected"';
?>><?php _e( 'Red', 'tp_disquscombination'); ?></option>
  <option value="green" <?php
        if ($instance['coloroption'] == green)
            echo 'selected="selected"';
?>><?php _e( 'Green', 'tp_disquscombination'); ?></option>
  <option value="blue" <?php
        if ($instance['coloroption'] == blue)
            echo 'selected="selected"';
?>><?php _e( 'Blue', 'tp_disquscombination'); ?></option>
  <option value="orange" <?php
        if ($instance['coloroption'] == orange)
            echo 'selected="selected"';
?>><?php _e( 'Orange', 'tp_disquscombination'); ?></option>
</select> 
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('hideavataroption');
?>">
<?php _e( 'Hide Avatars:', 'tp_disquscombination'); ?>
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
<?php _e( 'Hide Moderators:', 'tp_disquscombination'); ?>
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
        $instance['title']           = $new_instance['title'];
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
        echo $instance['title'];
        echo $after_title;
        
        $title           = $instance['title'];
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