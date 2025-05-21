<div class="row">
    <div class="col-sm-5">
        
        <div class="mainphoto">
            <img src="<?php echo BASE_URL; ?>media/products/<?php echo $product_images[0]['url']; ?>" />

        </div>
        <div class="gallery">

            <?php foreach($product_images as $img): ?>
                <div class="photo_item">
                    <img src="<?php echo BASE_URL; ?>media/products/<?php echo $img['url']; ?>" />
                </div>
            <?php endforeach; ?>
        </div>





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

<hr/>

<div class="row">
    <div class="col-sm-6">
        <h3><?php $this->lang->get('PRODUCT_SPECIFICATIONS'); ?></h3>
        <?php foreach ($product_options as $po): ?>
        <strong><?php echo $po['name']; ?></strong>: <?php echo $po['value']; ?><br>
        <?php endforeach; ?>
    </div>
    <div class="col-sm-6">
        <h3><?php $this->lang->get('PRODUCT_REVIEWS'); ?></h3>
        <?php foreach($product_rates as $rate): ?>
            <strong><?php echo $rate['user_name']; ?></strong>:<br/>
            "<?php echo $rate['comment']; ?>"<br/>
            <strong>
                <?php for($q=0;$q<intval($rate['points']);$q++): ?>
                    <img src="<?php echo BASE_URL; ?>assets/images/star.svg" border="0" height="15"/>
                <?php endfor; ?>
            </strong>

            <hr/>
        <?php endforeach; ?>

    </div>
</div>