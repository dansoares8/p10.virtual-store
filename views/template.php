<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Daniel Informática v2.0</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.structure.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.theme.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" type="text/css" />
</head>

<body>
	<nav class="navbar topnav">
		<div class="container">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo BASE_URL; ?>"><?php $this->lang->get('HOME'); ?></a></li>
				<li><a href="<?php echo BASE_URL; ?>contact"><?php $this->lang->get('CONTACT'); ?></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php $this->lang->get('LANGUAGE'); ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo BASE_URL; ?>lang/set/en">English</a></li>
						<li><a href="<?php echo BASE_URL; ?>lang/set/pt-br">Português</a></li>
					</ul>
				</li>
				<li><a href="<?php echo BASE_URL; ?>login"><?php $this->lang->get('LOGIN'); ?></a></li>
			</ul>
		</div>
	</nav>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-2 logo">
					<a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/3logo.png" /></a>
				</div>
				<div class="col-sm-7">
					<div class="head_help">(11) 9999-9999</div>
					<div class="head_email">contato@<span>danielinformatica.com.br</span></div>

					<div class="search_area">
						<form action="<?php echo BASE_URL; ?>busca" method="GET">
							<input type="text" name="s" value="<?php echo (!empty($viewData['searchTerm']))?$viewData['searchTerm']:''; ?>" required placeholder="<?php $this->lang->get('SEARCHFORITEM'); ?>" />
							<select name="category">
								<option value=""><?php $this->lang->get('ALLCATEGORIES'); ?></option>


								<?php foreach ($viewData['categories'] as $cat): ?>
									<option <?php echo ($viewData['category']==$cat['id'])?'selected="selected"':''; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
								
								<?php
								if (count($cat['subs']) > 0) {
									$this->loadView('search_subcategory', array(
										'subs' => $cat['subs'],
										'level' => 1,
										'category' => $viewData['category']
									));
								}
								?>
							<?php endforeach; ?>





							</select>
							<input type="submit" value="" />
						</form>
					</div>

				</div>
				<div class="col-sm-3">
					<a href="<?php echo BASE_URL; ?>cart">
						<div class="cartarea">
							<div class="carticon">
								<div class="cartqt">9</div>
							</div>
							<div class="carttotal">
								<?php $this->lang->get('CART'); ?>:<br />
								<span>R$ 999,99</span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</header>
	<div class="categoryarea">
		<nav class="navbar">
			<div class="container">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php $this->lang->get('SELECTCATEGORY'); ?>
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php foreach ($viewData['categories'] as $cat): ?>
								<li>
									<a href="<?php echo BASE_URL . 'categories/enter/' . $cat['id']; ?>">
										<?php echo $cat['name']; ?>
									</a>
								</li>
								<?php
								if (count($cat['subs']) > 0) {
									$this->loadView('menu_subcategory', array(
										'subs' => $cat['subs'],
										'level' => 1
									));
								}
								?>
							<?php endforeach; ?>
						</ul>
					</li>
					<?php if (isset($viewData['category_filter'])): ?>
						<?php foreach ($viewData['category_filter'] as $cf): ?>
							<li><a href="<?php echo BASE_URL; ?>categories/enter/<?php echo $cf['id']; ?>"><?php echo $cf['name']; ?></a></li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</nav>
	</div>


	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<aside>
						<h1><?php $this->lang->get('FILTER'); ?></h1>
						<div class="filterarea">

							<form method="GET">

								<input type="hidden" name="s" value="<?php echo htmlspecialchars($viewData['searchTerm'] ?? ''); ?>" />
								<input type="hidden" name="category" value="<?php echo htmlspecialchars($viewData['category'] ?? ''); ?>" />

								<div class="filterbox">
									<div class="filtertittle"><?php $this->lang->get('BRANDS'); ?></div>
									<div class="filtercontent">
										<?php foreach ($viewData['filters']['brands'] as $bitem): ?>
											<div class="filteritem">
												<input type="checkbox" <?php echo (isset($viewData['filters_selected']['brand']) && in_array($bitem['id'], $viewData['filters_selected']['brand'])) ? 'checked="checked"' : ''; ?> name="filter[brand][]" value="<?php echo $bitem['id']; ?>" id="filter_brand<?php echo $bitem['id']; ?>" />
												<label for="filter_brand<?php echo $bitem['id']; ?>"><?php echo $bitem['name']; ?></label><span style="float: right">(<?php echo $bitem['count']; ?>)</span>
											</div>
										<?php endforeach; ?>
									</div>
								</div>

								<div class="filterbox">
									<div class="filtertittle"><?php $this->lang->get('PRICE'); ?></div>
									<div class="filtercontent">
										<input type="hidden" id="slider0" name="filter[slider0]" value="<?php echo $viewData['filters']['slider0']; ?>" />
										<input type="hidden" id="slider1" name="filter[slider1]" value="<?php echo $viewData['filters']['slider1']; ?>" />
										<input type="text" id="amount" readonly>
										<div id="slider-range"></div>


									</div>
								</div>

								<div class="filterbox">
									<div class="filtertittle"><?php $this->lang->get('RATING'); ?></div>
									<div class="filtercontent">

										<div class="filteritem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_selected']['star']) && in_array('0', $viewData['filters_selected']['star'])) ? 'checked="checked"' : ''; ?> value="0" id="filter_star0" style="display:;">
											<label for="filter_star0">
												(<?php $this->lang->get('NO_STAR'); ?>)
											</label>
											<span style="float: right">(<?php echo $viewData['filters']['stars']['0']; ?>)</span>
										</div>

										<div class="filteritem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_selected']['star']) && in_array('1', $viewData['filters_selected']['star'])) ? 'checked="checked"' : ''; ?> value="1" id="filter_star1" style="display:;">
											<label for="filter_star1">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
											</label>
											<span style="float: right">(<?php echo $viewData['filters']['stars']['1']; ?>)</span>
										</div>

										<div class="filteritem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_selected']['star']) && in_array('2', $viewData['filters_selected']['star'])) ? 'checked="checked"' : ''; ?> value="2" id="filter_star2" style="display: ">
											<label for="filter_star2">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
											</label>
											<span style="float: right">(<?php echo $viewData['filters']['stars']['2']; ?>)</span>

										</div>
										<div class="filteritem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_selected']['star']) && in_array('3', $viewData['filters_selected']['star'])) ? 'checked="checked"' : ''; ?> value="3" id="filter_star3" style="display: ">
											<label for="filter_star3">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
											</label>
											<span style="float: right">(<?php echo $viewData['filters']['stars']['3']; ?>)</span>
										</div>

										<div class="filteritem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_selected']['star']) && in_array('4', $viewData['filters_selected']['star'])) ? 'checked="checked"' : ''; ?> value="4" id="filter_star4" style="display:">
											<label for="filter_star4">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
											</label>
											<span style="float: right">(<?php echo $viewData['filters']['stars']['4']; ?>)</span>
										</div>

										<div class="filteritem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_selected']['star']) && in_array('5', $viewData['filters_selected']['star'])) ? 'checked="checked"' : ''; ?> value="5" id="filter_star5" style="display: ">
											<label for="filter_star5">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">
												<img src="<?php echo BASE_URL; ?>assets/images/star.svg" height="15" border="1" style="cursor:pointer">

											</label>
											<span style="float: right">(<?php echo $viewData['filters']['stars']['5']; ?>)</span>
										</div>

									</div>
								</div>


								<div class="filterbox">
									<div class="filtertittle"><?php $this->lang->get('SALE'); ?></div>
									<div class="filtercontent">
										<div class="filteritem">
											<input type="checkbox" name="filter[sale]" <?php echo (isset($viewData['filters_selected']['sale']) && $viewData['filters_selected']['sale'] == '1') ? 'checked="checked"' : ''; ?> value="1" id="filter_sale" />
											<label for="filter_sale">Em promoção</label>
											<span style="float: right">(<?php echo $viewData['filters']['sale']; ?>)</span>
										</div>
									</div>
								</div>


								<div class="filterbox">
									<div class="filtertittle"><?php $this->lang->get('OPTIONS'); ?></div>
									<div class="filtercontent">

										<?php foreach ($viewData['filters']['options'] as $option): ?>
											<strong><?php echo $option['name']; ?></strong><br />
											<?php foreach ($option['options'] as $op): ?>
												<div class="filteritem">
													<input type="checkbox" name="filter[options][]" <?php echo (isset($viewData['filters_selected']['options']) && in_array($op['value'], $viewData['filters_selected']['options'])) ? 'checked="checked"' : ''; ?> value="<?php echo $op['value']; ?>" id="filter_options<?php echo $op['id']; ?>" />
													<label for="options<?php echo $op['id']; ?>"><?php echo $op['value']; ?></label><span style="float: right">(<?php echo $op['count']; ?>)</span>
												</div>
											<?php endforeach; ?>
											<br />
										<?php endforeach; ?>

									</div>
								</div>

							</form>

						</div>

						<div class="widget">
							<h1><?php $this->lang->get('FEATUREDPRODUCTS'); ?></h1>
							<div class="widget_body">
								<?php $this->loadView('widget_item', array('list'=>$viewData['widget_featured1'])); ?>
							</div>
						</div>
					</aside>
				</div>
				<div class="col-sm-9"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
			</div>
		</div>
	</section>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="widget">
						<h1><?php $this->lang->get('FEATUREDPRODUCTS'); ?></h1>
						<div class="widget_body">
							
							<?php $this->loadView('widget_item', array('list'=>$viewData['widget_featured2'])); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="widget">
						<h1><?php $this->lang->get('ONSALEPRODUCTS'); ?></h1>
						<div class="widget_body">
							
							<?php $this->loadView('widget_item', array('list'=>$viewData['widget_sale'])); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="widget">
						<h1><?php $this->lang->get('TOPRATEDPRODUCTS'); ?></h1>
						<div class="widget_body">
							<?php $this->loadView('widget_item', array('list'=>$viewData['widget_toprated'])); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="subarea">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
						<form method="POST">
							<input class="subemail" name="email" placeholder="<?php $this->lang->get('SUBSCRIBETOOURNEWSLETTER'); ?>">
							<input type="submit" value="<?php $this->lang->get('SUBSCRIBEBUTTON'); ?>" />
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="links">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<a href="<?php echo BASE_URL; ?>"><img width="150" src="<?php echo BASE_URL; ?>assets/images/3logo.png" /></a><br /><br />
					</div>
					<div class="col-sm-8 linkgroups">
						<div class="row">
							<div class="col-sm-4">
								<h3><?php $this->lang->get('CATEGORIES'); ?></h3>
								<ul>
									<li><a href="#">Categoria X</a></li>
									<li><a href="#">Categoria X</a></li>
									<li><a href="#">Categoria X</a></li>
									<li><a href="#">Categoria X</a></li>
									<li><a href="#">Categoria X</a></li>
									<li><a href="#">Categoria X</a></li>
								</ul>
							</div>
							<div class="col-sm-4">
								<h3><?php $this->lang->get('INFORMATION'); ?></h3>
								<ul>
									<li><a href="#">Menu 1</a></li>
									<li><a href="#">Menu 2</a></li>
									<li><a href="#">Menu 3</a></li>
									<li><a href="#">Menu 4</a></li>
									<li><a href="#">Menu 5</a></li>
									<li><a href="#">Menu 6</a></li>
								</ul>
							</div>
							<div class="col-sm-4">
								<h3><?php $this->lang->get('INFORMATION'); ?></h3>
								<ul>
									<li><a href="#">Menu 1</a></li>
									<li><a href="#">Menu 2</a></li>
									<li><a href="#">Menu 3</a></li>
									<li><a href="#">Menu 4</a></li>
									<li><a href="#">Menu 5</a></li>
									<li><a href="#">Menu 6</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">© <span><?php $this->lang->get('STORE'); ?> <?php $this->lang->get('DANIELINFORMATICA'); ?> </span> - <?php $this->lang->get('ALLRIGHTRESERVED'); ?>.</div>
					<div class="col-sm-6">
						<div class="payments">
							<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript">
		var BASE_URL = '<?php echo BASE_URL; ?>';
		var maxslider = <?php echo $viewData['filters']['maxslider']; ?>;
		var slidervalues = [0, maxslider];
	</script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>

</html>