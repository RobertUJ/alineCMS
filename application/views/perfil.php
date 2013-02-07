<?php $this->load->view('public/helper/head.php'); ?>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="fau.or_1347895661_biz@gmail.com">
<input type="hidden" name="lc" value="MX">
<input type="hidden" name="item_name" value="Mi Producto">
<input type="hidden" name="amount" value="50.00">
<input type="hidden" name="nombre_usuario" value="fau09">
<input type="hidden" name="id_usuario" value="15">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="shipping" value="5.00">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<?php $this->load->view('public/helper/footer.php'); ?>