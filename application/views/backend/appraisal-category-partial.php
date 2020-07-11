<?php
if ($status == 'add') {
    foreach ($appraisal_category as $key => $record) {
        ?>
        <div class="row">
            <div class="col-md-3">
                <span><?php echo $record->category_name; ?></span>
                <input type="hidden" name="category_id[]" value="<?php echo $record->id ?>">
            </div>
            <?php $rating_text = explode(',', $record->rating_text); ?>
            <?php $rating_value = explode(',', $record->rating_value); ?>
            <?php foreach ($rating_text as $index => $item) {
                ?>
                <div class="col-md-1 pl-0">
                    <input type="radio" name="category_rating_<?php echo $key; ?>" id="<?php echo $key; echo $item; ?>" value="<?php echo $item; ?>">
                    <label for="<?php echo $key; echo $item; ?>"><?php echo $item; ?></label>
                </div>
                <input type="hidden" name="category_rating_array_<?php echo $key; ?>[]"
                       value="<?php echo $item; ?>">
                <?php
            } ?>
            <?php
            foreach ($rating_value as $item) {
                ?>
                <input type="hidden" name="category_value_<?php echo $key; ?>[]"
                       value="<?php echo $item; ?>">
                <?php
            }
            ?>
        </div>
        <?php
    }
} elseif ($status == 'update') {
    foreach ($appraisal_category as $key => $record) {
        ?>
        <div class="row">
            <div class="col-md-3">
                <span><?php echo $record->category_name; ?></span>
                <input type="hidden" name="category_id[]" value="<?php echo $record->id ?>">
            </div>
            <?php $rating_text = explode(',', $record->rating_text); ?>
            <?php $rating_value = explode(',', $record->rating_value); ?>
            <?php
                $checked = '';
                foreach ($appraisal_exists as $value) {
                    if ($value['category_id'] == $record->id) {
                        $checked = $value['category_rating'];
                    }
                }
            ?>
            <?php foreach ($rating_text as $index => $item) {
                ?>
                <div class="col-md-1 pl-0">
                    <input type="radio" name="category_rating_<?php echo $key; ?>" id="<?php echo $key; echo $item; ?>"
                           value="<?php echo $item; ?>" <?php echo $item == $checked ? 'checked' : ''; ?>>
                    <label for="<?php echo $key; echo $item; ?>"><?php echo $item; ?></label>
                </div>
                <input type="hidden" name="category_rating_array_<?php echo $key; ?>[]"
                       value="<?php echo $item; ?>">
                <?php
            } ?>
            <?php
            foreach ($rating_value as $item) {
                ?>
                <input type="hidden" name="category_value_<?php echo $key; ?>[]"
                       value="<?php echo $item; ?>">
                <?php
            }
            ?>
        </div>
        <?php
    }
}
?>