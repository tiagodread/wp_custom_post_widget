<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 29/03/2018
 * Time: 17:57
 */

class Post_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(false, "Post Widget", array('description' => 'Plugin para listar postagens em um carrosel'));
    }

    public function widget($args, $instance)
    {

        if(!empty($instance['quantidade'])){
            $qtd = $instance['quantidade'];
        }else{
            $qtd = 1;
        }
        $slides = array();
        $args = array('post_type' => 'post', 'category_name' => $instance['categoria'], 'nopaging' => false, 'posts_per_page' =>$qtd, 'order' =>'ASC' );
        $slider_query = new WP_Query($args);
        if ($slider_query->have_posts()) {
            while ($slider_query->have_posts()) {
                $slider_query->the_post();
                if (has_post_thumbnail()) {
                    $temp = array();
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
                    $thumb_url = $thumb_url_array[0];
                    $temp['title'] = get_the_title();
                    $temp['excerpt'] = get_the_excerpt();
                    $temp['image'] = $thumb_url;
                    $slides[] = $temp;
                }
            }
        }
        wp_reset_postdata();
        ?>

        <?php if (count($slides) > 0) { ?>

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($slides); $i++) { ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>"
                        <?php if ($i == 0) { ?>class="active"<?php } ?>></li>
                <?php } ?>
            </ol>

            <div class="carousel-inner" role="listbox">
                <?php $i = 0;
                foreach ($slides as $slide) {
                    extract($slide); ?>

                    <div class="item <?php if ($i == 0) { ?>active<?php } ?>">
                        <img src="<?php echo $slide['image']; ?>" alt="<?php echo esc_attr($slide['title']); ?>">
                        <div class="carousel-caption"><h3><?php echo $slide['title']; ?></h3>
                            <p><?php echo $slide['excerpt']; ?></p></div>
                    </div>
                    <?php $i++;
                } ?>
            </div>

            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"><span
                        class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"><span
                        class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span
                        class="sr-only">Next</span></a>
        </div>
        <?php
    }
    }

    public function form($instance)
    {
        if (isset($instance['quantidade'])) {
            $quantidade = $instance['quantidade'];
        }
        ?>

        <div class="row">
            <div class="col-sm-8">
                <label for="<?php echo $this->get_field_id('quantidade'); ?>"><b>Quantidade de posts:</b></label>
                <input  required type="number" id="<?php echo $this->get_field_id('quantidade'); ?>" name="<?php echo $this->get_field_name('quantidade'); ?>" min="1" value="<?php echo esc_attr( $quantidade ); ?>">

            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <label for="<?php echo $this->get_field_id('categoria'); ?>"><b>Selecione a categoria:</b></label>
                <select name="<?php echo $this->get_field_name('categoria'); ?>" id="<?php echo $this->get_field_id('categoria'); ?>">
                    <?php $categories = get_categories(array('orderby'=>'name','oder'=>'ASC'));?>
                    <?php foreach ($categories as $category): ?>
                        <?php echo '<option value=" '. $category->cat_name .' ">' . $category->cat_name  .'</option>';?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['quantidade'] = ( ! empty( $new_instance['quantidade'] ) ) ? strip_tags( $new_instance['quantidade'] ) : '';
        $instance['categoria'] = ( ! empty( $new_instance['categoria'] ) ) ? strip_tags( $new_instance['categoria'] ) : '';
        return $instance;
    }
}





