<section id="blogs">
    <div class="container py-4">
        <h4 class="font-size-20">Blogs</h4>
        <hr>
        <div class="owl-carousel owl-theme">
            <?php
            $blogData = [
                [
                    "title" => "The Art of Mooncake Crafting",
                    "image" => "./assets/blog/blog1.png",
                    "content" => "Explore the ancient art of mooncake crafting and learn about the delicate skills and traditions that go into making these delectable treats. Discover the secrets behind the perfect mooncake and the cultural significance it holds.",
                    "link" => "#",
                ],
                [
                    "title" => "Taste the Moon: A Journey into Mooncake Flavours",
                    "image" => "./assets/blog/blog2.png",
                    "content" => "Embark on a flavorful journey as we dive into the diverse world of mooncake flavors. From traditional classics to innovative modern creations, this blog will tantalize your taste buds with the myriad of options available.",
                    "link" => "#",
                ],
                [
                    "title" => "Harvest Moon: The Significance of Mooncakes",
                    "image" => "./assets/blog/blog3.png",
                    "content" => "Uncover the profound cultural significance of mooncakes and their association with the Mid-Autumn Festival. Learn about the history, legends, and the special place mooncakes hold in the hearts of people during this lunar celebration.",
                    "link" => "#",
                ],
            ];

            foreach ($blogData as $blog) {
                echo '<div class="item">';
                echo '<div class="card border-1 me-5">';
                echo '<h5 class="card-title font-size-16 text-dark text-center mt-1">' . $blog["title"] . '</h5>';
                echo '<img src="' . $blog["image"] . '" class="card-img-top" alt="Blog Image">';
                echo '<p class="card-text font-size-14 text-black-50 px-2">' . $blog["content"] . '</p>';
                echo '<a href="' . $blog["link"] . '" class="color-second text-start ps-2 mb-2">Read More</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>
