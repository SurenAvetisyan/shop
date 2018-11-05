<ul>
    <li><?= $data['full_name'] ?></li>
    <li><?= $data['email'] ?></li>
    <li><?= $data['phone'] ?></li>
    <li><?= $data['town'] ?></li>
    <li><?= $data['address'] ?></li>

</ul>

<table class="timetable_sub">
    <thead>
    <tr>
        <th>SL No.</th>
        <th>Product</th>
        <th>Quality</th>
        <th>Product Name</th>
    </tr>
    </thead>
    <tbody>+
    <?php
    if ($cart) {
        $index = 1;
        foreach ($cart as $item)
        {
            ?>
            <tr data-id="<?= $item['id'] ?>" class="rem1">
                <td class="invert"><?= $index;?></td>
                <td class="invert-image">
                    <a href="http://yii-shop.com/single.html">
                        <img src="http://yii-shop.com/frontend/web/images/products/<?= $item['product']['image'] ?>" alt=" "
                                                                    class="img-responsive"></a>
                </td>
                <td class="invert"><?= $item['qty'] ?></td>
                <td class="invert"><?=$item['product']['title'] ?></td>
                <td class="invert">$<?= $item['product']['price'] ?></td>
            </tr>
            <?php
            $index++;
        }
    }
    ?>
    </tbody>
</table>
<div>
<?php
if(!empty($note)){
   echo $note;
}
?>
</div>
