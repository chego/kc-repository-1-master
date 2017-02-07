/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work?
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */!function(a){var c,d,b=a.event;c=b.special.debouncedresize={setup:function(){a(this).on("resize",c.handler)},teardown:function(){a(this).off("resize",c.handler)},handler:function(a,e){var f=this,g=arguments,h=function(){a.type="debouncedresize",b.dispatch.apply(f,g)};d&&clearTimeout(d),e?h():d=setTimeout(h,c.threshold)},threshold:150}}(jQuery);