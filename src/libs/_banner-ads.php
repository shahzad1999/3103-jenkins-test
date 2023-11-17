<section id="banner_adds">
    <div class="container py-5 text-center">
        <?php
        $banners = [
            './assets/discount.png',
            './assets/freeship.png',
        ];

        foreach ($banners as $banner) {
            echo '<img src="' . $banner . '" alt="banner1" class="img-fluid px-3 py-2">';
        }
        ?>
    </div>
</section>
