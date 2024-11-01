<p>
    <label><input  id="<?= $this->get_field_id('slideshow') ?>" name="<?= $this->get_field_name('slideshow') ?>"  type="checkbox" <?= $slideshow == 'on' ? 'checked' : '' ?>> Slide show</label>
</p>

<p>
    <label for="<?= $this->get_field_id('library') ?>">Library:</label>
    <select class="widefat" id="<?= $this->get_field_id('library') ?>" name="<?= $this->get_field_name('library') ?>" >
        <?php foreach ($json->groups as &$group): ?>
            <option value="<?= $group->_id ?>" <?= $library == $group->_id ? 'selected' : ''; ?> ><?= $group->name ?></option>
        <?php endforeach; ?>
    </select>
</p>

<p>
    <label for="<?= $this->get_field_id('display') ?>">Type:</label>
    <select class="widefat" id="<?= $this->get_field_id('display') ?>" name="<?= $this->get_field_name('display') ?>" >
        <option value="basic" <?= $display == 'basic' ? 'selected' : ''; ?> >custom</option>
        <option value="carousel" <?= $display == 'carousel' ? 'selected' : ''; ?> >carousel</option>
        <option value="vertical" <?= $display == 'vertical' ? 'selected' : ''; ?> >vertical</option>
    </select>
</p>

<p>
    <label for="<?= $this->get_field_id('height') ?>">Height (px):</label>
    <input class="widefat" id="<?= $this->get_field_id('height') ?>" name="<?= $this->get_field_name('height') ?>" type="text" value="<?= esc_attr($height) ?>">
</p>

<p>
    <label for="<?= $this->get_field_id('width') ?>">Width (px):</label>
    <input class="widefat" id="<?= $this->get_field_id('width') ?>" name="<?= $this->get_field_name('width') ?>" type="text" value="<?= esc_attr($width) ?>">
</p>

<p>
    <label for="<?= $this->get_field_id('limit') ?>"># Posts:</label>
    <input class="widefat" id="<?= $this->get_field_id('limit'); ?>" name="<?= $this->get_field_name('limit') ?>" type="text" value="<?= esc_attr($limit) ?>">
</p>

<p>
   <label><input id="<?= $this->get_field_id('anonymous'); ?>"  name="<?= $this->get_field_name('anonymous') ?>" type="checkbox" <?= $anonymous == 'on' ? 'checked' : '' ?>> Allow anonymous login</label>
</p>
