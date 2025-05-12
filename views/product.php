<div class="row">
    <div class="col-sm-5">
        Photos
    </div>
    <div class="col-sm-7">
        <h2><?php echo $product_info['name']; ?> </h2>
        <br/>
        <h5><b>Marca:</b> <?php echo $product_info['brand_name']; ?></h5>

        <br/>
        <?php if($product_info['rating'] != '0'): ?>

            <?php for($q=0;$q<intval($product_info['rating']); $q++): ?>
                <img src="<?php echo BASE_URL; ?>assets/images/star.svg" border="0" height="15"/>
            <?php endfor; ?>

        <?php endif; ?>

        <hr/>
        <p><b>Descrição: </b><?php echo $product_info['description']; ?></p>
        <hr/>

        <h5 class="price_from"><b>De R$:  </b><strike><?php echo number_format($product_info['price_from'], 2); ?></strike></h5>
        <h4 class="original_price"><b>Por R$:  </b><?php echo number_format($product_info['price'], 2); ?></h4>        

        <form class="addtocartform" method="post">
            <button data-action="decrease">-</button>
            <input type="text" name="qt" value="1" class="addtocart_qt" disabled />
            <button data-action="increase">+</button>
            <input class="addtocart_submit" type="submit" value="<?php $this->lang->get('ADD_TO_CART'); ?>">
        </form>


    </div>
</div>