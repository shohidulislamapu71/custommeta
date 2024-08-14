<?php
/**
 * Plugin Name: WeDevs
 * Plugin URI: https://wedevs.com
 * Description: Plugin for WeDevs
 * Version: 1.0.0
 * Author: WeDevs
 */

class WeDevs
{
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('add_meta_boxes', array($this, 'wedevs_meta_box'));
        add_action('save_post', array($this, 'wedevs_save'));
    }

    public function init() {
        register_post_type( 'wedevs',
            array(
                'labels' => array(
                    'name' => 'WeDevs',
                    'singular_name' => 'WeDevs'
                ),
                'public' => true,
                'has_archive' => true
            )
        );
    }

    public function wedevs_meta_box() {
        add_meta_box( 'wedevs-meta-box', 'WeDevs', array($this, 'wedevs_meta_box_content'), 'wedevs', 'normal', 'high' );
    }

    public function wedevs_meta_box_content() {
        global $post;
        $get_Post = get_posts([
            'post_type' => 'page',
        ]);

        $wedevs = get_post_meta($post->ID, 'wedevs', true);
        $get_post_id = get_post_meta($post->ID, 'titleid', true);
        echo '<input type="text" name="wedevs" value="' . $wedevs . '" />';

        ?>
        <select name="titleid" id="" >
            <?php foreach($get_Post as $title): ?>
            <option value="<?php echo $title->ID; ?>" <?php if($get_post_id == $title->ID){ echo 'selected';} ?>><?php echo $title->ID; ?></option>
            <?php endforeach; ?>
        </select>
        <?php
        
    }

    public function wedevs_save() {
       global $post;
       if(isset($_POST['wedevs'])){
           $text = $_POST['wedevs'];
           update_post_meta($post->ID, 'wedevs', sanitize_text_field($text));
       }
       if(isset($_POST['titleid'])){
           $textid = $_POST['titleid'];
           update_post_meta($post->ID, 'titleid',  sanitize_text_field($textid));
       }
    }
}
new WeDevs();





?>