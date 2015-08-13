<p class="text">
    <?php $format_price = number_format($stock["price"], 2); ?>
    <?= htmlspecialchars("The price of one share of {$stock["name"]} is \$$format_price.") ?>
</p>

<a href="javascript:history.go(-1);">Back</a>
