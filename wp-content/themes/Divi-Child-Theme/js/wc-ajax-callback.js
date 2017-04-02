// WooCommerce Ajax add to cart callback
(function($){
    $(document).ready(function(){
        var $btnAddToCart = $(".custom_wc_add_to_cart:not(.is_loading)");

        $btnAddToCart.on("click", function(e){
            var $this = $(this);
            
            e.preventDefault();
            e.stopImmediatePropagation();
            
            if($this.hasClass("is_loading")){
                return;
            };
            
            $this
                .addClass("is_loading")
                .closest(".msg")
                    .remove();
            
            $.ajax({
                url: this.href,
                data: {},
                type: "POST"
                
            }).done(function(response){
                $this
                    .after('<p class="msg"><a href="'+window.location.href+'carrito">Producto añadido al <i class="fa fa-cart-plus fa-2x"></i></a></p>')
                    .off("click")
                    .remove();
            }).fail(function(error){
                $this
                    .after('<p class="msg">Hubo un error con el pedido, intentalo nuevamente</p>');
            });
            
        });
    });
})(jQuery);