<section id="banner-area">
    <div class="owl-carousel owl-theme">
        <?php
        $bannerImages = [
            './assets/banner/Banner(0).png',
            './assets/banner/Banner(1).png',
            './assets/banner/Banner(2).png',
            './assets/banner/Banner(3).png',
        ];

        foreach ($bannerImages as $image) {
            echo '<div class="item">';
            echo '<img src="' . $image . '" alt="Banner0">';
            echo '</div>';
        }
        ?>
    </div>
</section>
