<?php
/*
 * MIT License
 *
 * Copyright (c) Eduardo Gonzalez
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

if (!isset($loopRecordVarName) && !isset($numItems))
    return;
?>


<!-- Carousel external wrapper -->
<div id="carouselHome" class="carousel slide" data-bs-ride="carousel">
    <!-- Carousel indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselHome" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 0"></button>
        <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
        <?php for($i = 1; $i < $numItems; $i++): ?>
            <button type="button" data-bs-target="#carouselHome" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i; ?>"></button>  
        <?php endfor; ?>
        </div>
    <!-- END Carousel indicators -->

    <!-- BEGIN Carousel inner -->
    <div class="carousel-inner">
        <?php
        $i = 0;
        foreach (loop($loopRecordVarName) as $record):
            if (is_a($record, 'Item')) {
                $item = $record;
            } else {
                return;
            }

            $itemTitle =  snippet_by_word_count(metadata($item, array('Dublin Core', 'Title')), $maxWords = 25, $ellipsis = '...');
            $itemDescription = snippet_by_word_count(metadata($item, array('Dublin Core', 'Description')), $maxWords = 35, $ellipsis = '...');
            $itemImg = item_image('fullsize', array('class' => 'd-block w-100', 'alt' => 'Fotografia ítem ' . $itemTitle), 0, $item);
            ?>

            <div class="carousel-item <?php echo ($i === 0 ? 'active' : ''); ?>" data-bs-interval="5000">
                <?php echo $itemImg; ?>
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo link_to_item($itemTitle, array('rel' => 'bookmark', 'class' => 'u-url')); ?></h5>
                    <p><?php echo $itemDescription; ?></p>
                </div>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>
    <!-- END Carousel-inner -->

    <a class="carousel-control-prev" data-bs-target="#carouselHome" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" data-bs-target="#carouselHome" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- END Carousel external wrapper -->