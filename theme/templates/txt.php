<?php
$text = get_sub_field('txt');

if ($text): ?>
  <section class="txt-block my-section lg:my-section-lg">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-12">
        <div class="col-span-12 md:col-span-10 md:col-start-2 lg:col-start-4 lg:col-span-6">
          <div class="prose">
            <?php echo $text; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>