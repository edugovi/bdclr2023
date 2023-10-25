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

$imageUrl = img('biblioteca-digital.png');
$description = option('description');
$author = option('author');

echo head(array('description' => $description, 'author' => $author, 'page' => 'home', 'imageUrl' => $imageUrl));
?>

<main>
    <section>
        <div class="container p-3">
            <h1 class="display-4">
            <?php echo option('site_title'); ?>
            </h1>
            <p class="lead">
                <?php echo option('site_description'); ?>
            </p>
            
            <?php if (get_theme_option('display_collections_home') === "1"): ?>
            <div class="row text-muted">
                <div class="col-md">
                    <?php set_loop_records('collections', get_records('Collection', array('sort_field' => 'added', 'sort_dir' => 'd'), -1)); ?>
                    <?php if (has_loop_records('collections')): ?>
                    <p class="text-muted">El projecte en el qual s&#39;est&agrave; treballant contempla les seg&uuml;ents col&middot;leccions:</p>
                    <ul class="card-columns">
                        <?php foreach (loop('collections') as $collection): ?>
                        <?php $collectionDescription = do_shortcode(metadata('collection', array('Dublin Core', 'Description'))); ?>
                        <li>
                            <?php echo link_to_collection(null, array('class' => 'text-dark')); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?>
                        <p>No hi ha col&middot;leccions disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    
    <?php if (get_theme_option('display_featured_item') === "1"): ?>
    <section>
        <div class="container px-5 py-md-3">
            <div class="my-4">
                <h3>&Iacute;tems destacats</h3>
            </div>
    <?php set_loop_records('items', get_random_featured_items(5, true)); ?>
        <?php if (has_loop_records('items')) : ?>
            <?php echo common('featured-items', array('loopRecordVarName' => 'items', 'numItems' => 5), 'common'); ?>
        <?php else: ?>
            <p>No hi ha &iacute;tems destacats disponibles.</p>
        <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (get_theme_option('display_recently_added_items') === "1"): ?>
        <section>
            <div class="container px-5 py-md-3">
                <div class="my-4">
                    <h3><?php echo __('Recently Added Items'); ?></h3>
                </div>
                <?php set_loop_records('items', get_recent_items(8)); ?>
                <?php if (has_loop_records('items')) : ?>
                    <?php echo common('grid-items-preview', array('loopRecordVarName' => 'items', 'maxCols' => 3), 'common'); ?>
                <?php else: ?>
                    <p>No hi ha &iacute;tems disponibles.</p>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
    
    <section class="bg-secondary">
        <div class="container p-5 text-light">
            <?php echo get_theme_option('footer_text'); ?>
            <p>
                <?php echo option('site_title'); ?> - Any <?php echo date("Y"); ?> |
                <a href="#modalAvisLegal" style="color: white;" data-toggle="modal" title="Av&iacute;s legal">Av&iacute;s legal</a> |
                <a href="#modalPoliticaPrivacitat" style="color: white;" data-toggle="modal" title="Pol&iacute;tica de privacitat">Pol&iacute;tica de privacitat</a> |
                <a href="https://github.com/edugovi/bdclr2023" target="_blank" style="color: white;" title="BDCLR2023">BDCLR2023</a>
            </p>
            <p>
                &copy; El Centre de Lectura és propietari únic del contingut d'aquest lloc web.
            </p>
        </div>
    </section>
</main>
<?php echo foot();
