<?php
/**
 * @var string $title
 * @var string $subtitle
 * @var string $card_text
 * @var string $card_links
 */

?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= $title ?></h5>
        <div class="card-subtitle text-muted mb-3"><?= $subtitle ?></div>
        <p class="card-text"><?= $card_text ?></p>
        <?= $card_links ?>
    </div>
</div>