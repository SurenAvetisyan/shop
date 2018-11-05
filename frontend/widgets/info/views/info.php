<ul class="phone_email">
    <?php
    if(!empty($phone)){
        ?>
        <li><i class="fa fa-phone" aria-hidden="true"></i><?= $phone;?></li>
        <?php
    }
    if(!empty($email)){
        ?>
        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com"><?= $email;?></a></li>
        <?php
    }
    ?>

</ul>