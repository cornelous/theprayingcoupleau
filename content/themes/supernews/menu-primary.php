<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<div id="primary-bar" class="clearfix">
				
		<a id="primary-mobile-menu" href="#"><i class="fa fa-bars"></i> <?php _e( 'Primary Menu', 'supernews' ); ?></a>

		<nav id="primary-nav" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

			<?php wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => '',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'sf-menu',
					'walker'         => new SuperNews_Custom_Nav_Walker
				)
			); ?>

		</nav><!-- #primary-nav -->
		
		<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<div class="header-cart">
				<ul class="sf-menu">
					<li>
						<?php global $woocommerce; ?>
						<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><i class="fa fa-shopping-cart"></i><?php echo sprintf( _n( '%d item', '%d items', (int) $woocommerce->cart->cart_contents_count, 'supernews'), (int) $woocommerce->cart->cart_contents_count ); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
						
						<ul>
							<?php if ( $woocommerce->cart->cart_contents_count > 0 ) : ?>
								<li class="desc"><?php echo sprintf( _n('%d item in the shopping cart', '%d items in the shopping cart', (int) $woocommerce->cart->cart_contents_count, 'supernews'), (int) $woocommerce->cart->cart_contents_count );?></li>
							<?php endif; ?>
							<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
								<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
									<?php
									$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
									?>
									<?php
									if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

										$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
										$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
										$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

									?>
										<li class="clearfix">
											<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
												<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
											</a>
											<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="product-title"><?php echo esc_attr( $product_name ); ?></a>
											<span class="quantity"><?php printf( __( 'Unit Price: %s', 'supernews' ), $product_price ); ?></span>
											<span class="quantity"><?php printf( __( 'Quantity: %s', 'supernews' ), $cart_item['quantity'] ); ?></span>
											<a href="<?php echo esc_url( WC()->cart->get_remove_url( $cart_item_key ) ) ?>" class="product-remove"><?php _e( '&times;', 'supernews' ); ?></a>
										</li>
									<?php } ?>
								<?php endforeach; ?>
							<?php else : ?>
								<li class="empty"><?php _e( 'No products in the cart.', 'supernews' ); ?></li>
							<?php endif; ?>
							<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
								<li class="clearfix">
									<p class="cart-total"><?php printf( __( 'Subtotal %s', 'supernews' ), '<strong class="amount">' . WC()->cart->get_cart_subtotal() . '</strong>' ); ?></p>
									<p>
										<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
											<button class="add_to_cart_button"><?php _e( 'View Shopping Cart', 'supernews' ); ?></button>
										</form>
										<form action="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>">
											<button class="button"><?php _e( 'Proceed to Checkout', 'supernews' ); ?></button>
										</form>
									</p>
								</li>
							<?php endif; ?>
						</ul>
					</li>
				</ul>
			</div>
		<?php endif; ?>

	</div><!-- #primary-bar -->

<?php endif; // End check for menu. ?>