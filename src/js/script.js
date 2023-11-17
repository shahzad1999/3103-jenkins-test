$(document).ready(function () {

    // banner owl carousel
    $("#banner-area .owl-carousel").owlCarousel({
        dots: true,
        items: 1
    });

    // top sale owl carousel
    $("#top-sale .owl-carousel").owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    // isotope filter
    var $productFilter = $(".product-filter").isotope({
        itemSelector: '.product-filter-item',
        layoutMode: 'fitRows'
    });

    // filter items on button click
    $(".button-group").on("click", "button", function () {
        var filterValue = $(this).attr('data-filter');
        $productFilter.isotope({ filter: filterValue });
    });


    // new mooncakes owl carousel
    $("#new-mooncakes .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    // blogs owl carousel
    $("#blogs .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }
    });

    // are you sure to delete
    $(".btn-danger").click(function (event) {
        if (!confirm("Are you sure?")) {
            // Prevent default behavior of the button if user clicks "Cancel"
            event.preventDefault();
            return;
        }
    });

    // select all input type file
    var imgInputs = $('input[type="file"][accept="image/*"]');
    imgInputs.each(function () {
        $(this).change(function () {
            var img = $(this).get(0).files[0];
            if (img) {
                var reader = new FileReader();
                reader.onload = function () {
                    $(this).parent().find('img').attr("src", reader.result);
                }.bind(this);
                reader.readAsDataURL(img);
            }
        });
    });

    // insert product row << This needs to go man
    $manageProductTable = $("#manage-product .table-data");
    $manageProductTableBtn = $("#manage-product .btn.addItem");
    $manageProductItems = $("#manage-product .table-data tr[data-id]").length;
    $manageProductTableBtn.on("click", function () {
        $manageProductItems++;
        var html =
            `<tr data-id="${$manageProductItems}">
                    <td>
                        <input type="number" value="" readonly name="id-${$manageProductItems}">
                    </td>
                    <td>
                        <input type="text" value="" name="name-${$manageProductItems}">
                    </td>
                    <td>
                        <input type="text" value="" name="desc-${$manageProductItems}">
                    </td>
                    <td>
                        <input type="text" value="" name="stock-${$manageProductItems}">
                    </td>
                    <td>
                        <input type="number" step="0.01" value="" name="price-${$manageProductItems}">
                    </td>
                    <td>
                        <div class="preview-image">
                            <img src="#" alt="preview">
                            <input type="file" name="image-${$manageProductItems}" accept="image/*">
                        </div>
                    </td>
                    <td>
                        <button type="submit" name="manage-insert" formaction="manage.php?id=${$manageProductItems}"
                        class="btn btn-success">Insert</button>
                    </td>
                    <td>
                        <button type="submit" name="manage-delete"
                            formaction="manage.php?id=${$manageProductItems}"
                            class="btn btn-danger">Delete</button>
                    </td>
                </tr>`;

        $manageProductRow = $("#manage-product .table-data tbody").get(0).insertRow(-1);
        $manageProductRow.innerHTML = html;
    });

    // insert product row
    $accMemberTable = $("#account-member .table-data");
    $accMemberTableBtn = $("#account-member .btn.addItem");
    $accMemberItems = $("#account-member .table-data tr[data-id]").length;
    $accMemberTableBtn.on("click", function () {
        $accMemberItems++;
        var html =
            `<tr data-id="${$accMemberItems}">
                <td>
                    <input type="number" placeholder="-" value="-" readonly	">
                </td>
                <td>
                    <input type="text" value="" placeholder="Username" name="username-${$accMemberItems}" class="text-center">
                </td>
				<td>
                    <input type="text" value="" placeholder="Name" name="fullname-${$accMemberItems}" class="text-center">
                </td>
                <td>
                    <input type="text" value="" placeholder="Email" name="email-${$accMemberItems}" class="text-center">
                </td>
                <td>
                    <input type="text" value="" placeholder="Address" name="address-${$accMemberItems}" class="text-center">
                </td>
				<td>
                    <input type="text" value="" placeholder="Phone" name="phone-${$accMemberItems}" class="text-center">
                </td>
                <td>
                    <button type="submit" name="admin-account-insert" formaction="account.php?id=${$accMemberItems}"
                        class="btn btn-success">Insert</button>
                </td>
                <td>
                    <button type="submit" name="account-delete" formaction="account.php?id=${$accMemberItems}"
                        class="btn btn-danger">Delete</button>
                </td>
            </tr>`;

        $accMemberRow = $("#account-member .table-data tbody").get(0).insertRow(-1);
        $accMemberRow.innerHTML = html;
    });
    
    // Update the quantity and price based on the selected option
    const quantitySelect = $('#quantity-select');
    const priceSpan1 = $('#product-price1');
    const priceSpan2 = $('#product-price2');

    quantitySelect.on('change', function () {
        const selectedQuantity = parseFloat(quantitySelect.val());
        const basePrice1 = parseFloat(priceSpan1.data('base-price'));
        const basePrice2 = parseFloat(priceSpan2.data('base-price'));

        let newPrice1, newPrice2;

        if (selectedQuantity === 4) {
            newPrice1 = (basePrice1 * 4) - 5.0;
            newPrice2 = (basePrice2 * 4) - 5.0;
        } else if (selectedQuantity === 6) {
            newPrice1 = (basePrice1 * 6) - 12.0;
            newPrice2 = (basePrice2 * 6) - 12.0;
        } else {
            newPrice1 = basePrice1 * selectedQuantity;
            newPrice2 = basePrice2 * selectedQuantity;
        }
        priceSpan1.text('$' + newPrice1.toFixed(2));
        priceSpan2.text('$' + newPrice2.toFixed(2));
    });
    
});