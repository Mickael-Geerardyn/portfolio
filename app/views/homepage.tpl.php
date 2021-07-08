    <!-- Pokemon card content -->
    <div class="cards-grid">
        <!-- div image content-->
        <?php foreach($viewVars as $pokemon): ?>
        <div class="card">
        <div class="picture-card">
            <picture>
                <img class="image" alt="image du pokemon" src="<?= $assetsBaseUri ?>img/<?= $pokemon->getNumero() ?>.png"/>
            </picture>
        </div>
        <!-- div title content -->
        <div class="title">
            <h2 class="title-name">#<?= $pokemon->getNumero() ?> <?= $pokemon->getNom() ?></h2>
        </div>
        </div>
        <?php endforeach; ?>
    </div>
    
