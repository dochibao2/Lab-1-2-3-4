<?php
// Khởi tạo các biến
$productName = "";
$description = "";
$quantity = "";
$price = "";

if (isset($_POST["btnsubmit"])) {
    //Get value from form
    $productName = isset($_POST["txtname"]) ? $_POST["txtname"] : "";
    $cateID = isset($_POST["txtcateid"]) ? $_POST["txtcateid"] : "";
    $price = isset($_POST["txtprice"]) ? $_POST["txtprice"] : "";
    $quantity = isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : "";
    $description = isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : "";
    $picture = $_FILES["txtpic"];

    //Initialize the product object
    $newProduct = new Product($productName, $cateID, $price, $quantity, $description, $picture);

    // Save to the database
    $result = $newProduct->save();

    if (!$result) {
        //Error query
        header("Location: product-add.php?status=failure");
    } else {
        header("Location: product-add.php?status=inserted");
    }
}
?>


<?php require 'header.php'; ?>

<?php
if (isset($_GET["status"])) {
    if ($_GET["status"] == 'inserted') {
        echo "<h2>Add successful product.</h2>";
    } else {
        echo "<h2>Add failed product.</h2>";
    }
}
?>

<!-- Form Add products -->
<form method="post" enctype="multipart/form-data">
    <!-- Product's name -->
    <div class="row">
        <div class="lbltitle">
            <label> Product's name </label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtname" value="<?php echo $productName; ?>">
        </div>
    </div>
    <!-- Product Description -->
    <div class="row">
        <div class="lbltitle">
            <label> Product Description </label>
        </div>
        <div class="lblinput">
            <textarea name="txtdesc" cols="21" rows="10"><?php echo $description; ?></textarea>
        </div>
    </div>
    <!-- The number of products -->
    <div class="row">
        <div class="lbltitle">
            <label> The number of products </label>
        </div>
        <div class="lblinput">
            <input type="number" name="txtquantity" value="<?php echo $quantity; ?>">
        </div>
    </div>
    <!-- Product price -->
    <div class="row">
        <div class="lbltitle">
            <label> Product price </label>
        </div>
        <div class="lblinput">
            <input type="number" name="txtprice" value="<?php echo $price; ?>">
        </div>
    </div>
    <!-- Product Type -->
    <div class="row">
        <div class="lbltitle">
            <label> Product Type </label>
        </div>
        <div class="lblinput">
            <select name="txtcateid">
                <option value="" selected>-- Select type --</option>
                <?php 
                $cates = Category::list_category();
                foreach ($cates as $item) {
                    echo '<option value="' . $item['CateID'] . '">' . $item['CategoryName'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <!-- Product Image -->
    <div class="row">
        <div class="lbltitle">
            <label>Url Image</label>
        </div>
        <div class="lblinput">
            <input type="file" name="txtpic" accept=".PNG,.GIF,.JPG,.JPGEG">
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            Click more
        </div>
        <div class="submit">
            <button type="submit" name="btnsubmit"> More products </button>
        </div>
    </div>
</form>

<!-- Footer -->
<?php require 'footer.php'; ?>
