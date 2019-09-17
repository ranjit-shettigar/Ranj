            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_cart">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="business" value="business2@aloysius.com">
              <?php @for_paypal(); ?>
              <div class="plc-order-btn"><input type="image" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online"></div>
            </form>