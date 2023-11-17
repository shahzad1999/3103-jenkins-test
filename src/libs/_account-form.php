<!-- start #account -->
<section id="account" class="py-3">
    <?php if ($_SESSION['logged'] == false) {
        header("Location: login.php");
    } ?>
    <div class="container">
            <div class="col-9">
                <form method="POST" id="account-member">
                    <div class="form-group">
                        <table class="table table-striped table-bordered table-data center warpText">
                            <thead>
                                <tr class="text-center">
                                    <th scope="colgroup rowgroup">ID</th>
                                    <th scope="col">Username</th>
									<th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
									<th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($accData as $item): ?>
                                    <tr data-id="<?php echo $item['AdminID'] ?>">
                                        <td>
                                            <input type="number" value="<?php echo $item['AdminID'] ?>" readonly
                                                name="id-<?php echo $item['AdminID'] ?>">
                                       
									   </td>
                                        <td>
                                            <input type="text" value="<?php echo $item['Username'] ?>"
                                                name="username-<?php echo $item['AdminID'] ?>" class="text-center">
                                        </td>
										<td>
                                            <input type="text" value="<?php echo $item['FullName'] ?>"
                                                name="fullname-<?php echo $item['AdminID'] ?>" class="text-center">
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $item['Email'] ?>"
                                                name="email-<?php echo $item['AdminID'] ?>" class="text-center">
                                        </td>
										<td>
                                            <input type="text" value="<?php echo $item['Address'] ?>"
                                                name="address-<?php echo $item['AdminID'] ?>" class="text-center">
                                        </td>
										<td>
                                            <input type="text" value="<?php echo $item['Phone'] ?>"
                                                name="phone-<?php echo $item['AdminID'] ?>" class="text-center">
                                        </td>
                                        <td>
                                            <button type="submit" name="admin-account-update"
                                                formaction="account.php?id=<?php echo $item['AdminID'] ?>"
                                                class="btn btn-warning">Update</button>
                                        </td>
                                        <td>
                                            <button type="submit" name="admin-account-delete"
                                                formaction="account.php?id=<?php echo $item['AdminID'] ?>"
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
        </div>
    </div>
</section>
<!-- !start #account -->