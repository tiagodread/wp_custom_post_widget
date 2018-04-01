<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 01/04/2018
 * Time: 19:50
 */
?>
<table>
    <tr>
        <td>
            <label for="<?php echo $this->get_field_id('quantidade'); ?>"><b>Quantidade de posts:</b></label>
        </td>
        <td>
            <input required type="number" id="<?php echo $this->get_field_id('quantidade'); ?>"
                   name="<?php echo $this->get_field_name('quantidade'); ?>" min="1"
                   value="<?php echo esc_attr($quantidade); ?>">
        </td>
    </tr>

    <tr>
        <td>
            <label for="<?php echo $this->get_field_id('categoria'); ?>"><b>Selecione a categoria:</b></label>
        </td>
        <td>
            <select name="<?php echo $this->get_field_name('categoria'); ?>"
                    id="<?php echo $this->get_field_id('categoria'); ?>">
                <?php $categories = get_categories(array('orderby' => 'name', 'oder' => 'ASC')); ?>
                <?php foreach ($categories as $category): ?>
                    <?php echo '<option value=" ' . $category->cat_name . ' ">' . $category->cat_name . '</option>'; ?>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
</table>