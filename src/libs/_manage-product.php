<!-- start #manage -->
<section id="manage-product" class="py-3">
    <div class="container">
        <form method="POST" id="manage-product" enctype="multipart/form-data">
            <div class="form-group">
                <table class="table table-bordered table-data">
                    <thead>
                        <tr>
                            <th scope="colgroup rowgroup">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($manageData as $item): ?>
                            <tr data-id="<?php echo $item['MooncakeID'] ?>">
                                <td>
                                    <input type="number" value="<?php echo $item['MooncakeID'] ?>" readonly
                                        name="id-<?php echo $item['MooncakeID'] ?>">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $item['Name'] ?>"
                                        name="name-<?php echo $item['MooncakeID'] ?>">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $item['Description'] ?>" 
                                        name="desc-<?php echo $item['MooncakeID'] ?>">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $item['StockQuantity'] ?>" 
                                        name="stock-<?php echo $item['MooncakeID'] ?>">
                                </td>
                                <td>
                                    <input type="number" step="0.01" value="<?php echo $item['Price'] ?>"
                                        name="price-<?php echo $item['MooncakeID'] ?>">
                                </td>
                                <td>
                                    <div class="preview-image">
                                        <img src="assets/products/<?php echo $item['ImageURL'] ?>" alt="preview">
                                        <input type="file" name="image-<?php echo $item['MooncakeID'] ?>" accept="image/*">
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" name="manage-update"
                                        formaction="manage.php?id=<?php echo $item['MooncakeID'] ?>"
                                        class="btn btn-warning">Update</button>
                                </td>
                                <td>
                                    <button type="submit" name="manage-delete"
                                        formaction="manage.php?id=<?php echo $item['MooncakeID'] ?>"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-secondary addItem">Add Item</button>
            </div>
        </form>
    </div>
</section>
<!-- !start #manage -->