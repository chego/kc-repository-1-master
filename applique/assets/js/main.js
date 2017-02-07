/**
 * DF-Main - 1.0.0
 * Copyright © 2015 Dahz
 * Licensed under the GNU General Public License v3.0.
 * http://www.daffyhazan.com
 */

var DAHZ = DAHZ || {};

( function( $ ) { 'use strict';

 	DAHZ.init = {
 		initSite: function() {
 			var init = this;

 			init.backTop();
 			init.moreLink();
 			init.stickyNav();
 			$( window ).load( function() {
	 			init.postHeight();

	 			var galleryHeight = $( '.format-gallery .owl-item:first-child .gal-items' ).height(),
	 				bannerHeight = $( '.banner-wrapper' ).height();

	 			$( '.format-gallery .owl-item:first-child .gal-items' ).css( 'height', galleryHeight + 'px' );
	 			$( '.banner-wrapper .banner-inner-img' ).css( 'height', bannerHeight + 'px' );
 			});
 			$( window ).resize( function( e ) {
		        init.postHeight();
			});
 			init.ajaxArchive();
 			init.globalSearch();
 			init.globalSubs();
 			init.dropDownToggle();
 			init.widgetTitle();
 			init.addPostActiveCLass();
 			init.setParallax();
 			init.infiniteScroll();
 			init.gridSystem();
 			init.fitvids();
 			init.pageLoader();
 			init.scrolldepth();
 		},
 		stickyNav: function() {

 			if ( $( window ).width() > 768 ) {

 				$( window ).load( function() {
		        	var navHeight = $( '.df-header-inner .nav-wrapper-inner' ).innerHeight();

	            	$( '.df-header-inner .main-navigation' ).css( 'height', navHeight + 'px' );
				});

	 			$( '#masthead .main-navigation' ).each( function( i ) {

			        $( '#masthead .main-navigation' ).waypoint( function( direction ) {

			            if ( direction === 'down' ) {

			                if ( $('#wpadminbar').length ) {

			                    $( '#masthead .nav-wrapper-inner' ).attr( 'class', 'nav-wrapper-inner df-sticky-admin ' + df.navClass );
			                    $( '#masthead .nav-wrapper-inner' ).removeClass( 'border-top' );

			                } else {

			                    $( '#masthead .nav-wrapper-inner' ).attr( 'class', 'nav-wrapper-inner df-sticky ' + df.navClass );
			                    $( '#masthead .nav-wrapper-inner' ).removeClass( 'border-top' );

			                }

			            } else if ( direction === 'up' ) {

			                $( '#masthead .nav-wrapper-inner' ).attr( 'class', 'nav-wrapper-inner ' + df.navClass );

			            }

			        }, { offset: '0' } );

			    } );
	 		} else {
	 			// Global Mobile Show
				$( '.df-ham-menu .col-left a' ).click( function( e ) {
					e.preventDefault();

					if ( $( '.df-menu-content' ).css( 'display' ) == 'none' ) {
						$( '.df-ham-menu .col-left' ).css( 'z-index', '9999999' ).addClass( 'close' );
						$( '.df-menu-content' ).fadeIn( 'slow' );
					} else {
						$( '.df-ham-menu .col-left' ).css( 'z-index', '1' ).removeClass( 'close' );
						$( '.df-menu-content' ).fadeOut( 'slow' );
					}
				});
	 		}

	 		if ( $( window ).width() > 768 ) {
		 		// sticky logo
		 		$( '.nav-wrapper-inner .sticky-logo' ).each( function( i ) {

			        $( '#masthead .main-navigation' ).waypoint( function( direction ) {

			            if ( direction === 'down' ) {

			                $( '.nav-wrapper-inner .sticky-logo' ).css( { 'top': '50%', 'opacity': '1' } );

			            } else if ( direction === 'up' ) {

			                $( '.nav-wrapper-inner .sticky-logo' ).css( { 'top': '-50%', 'opacity': '0' } );

			            }

			        }, { offset: '-51px' } );

			    } );

		 		// sticky back to top
		 		$( '.nav-wrapper-inner .sticky-btp' ).each( function( i ) {

		 			var heights = $('.site-branding').height();
		 			var countT = -heights - 150;
			        $( '#masthead .main-navigation' ).waypoint( function( direction ) {

			            if ( direction === 'down' ) {

			                $( '.nav-wrapper-inner .sticky-btp' ).addClass('active');

			            } else if ( direction === 'up' ) {

			                $( '.nav-wrapper-inner .sticky-btp' ).removeClass('active');

			            }

			        }, { offset: countT } );

			    } );

			    // floating element
		 		$( '.df-social-connect, .df-misc-section' ).each( function( i ) {

			        $( '#content-wrap' ).waypoint( function( direction ) {

			            if ( direction === 'down' ) {

			                $( '#content-wrap > .df-social-connect' ).addClass( 'scrolled' );
			                $( '.df-misc-section' ).addClass( 'scrolled' );

			            } else if ( direction === 'up' ) {

			                $( '#content-wrap > .df-social-connect' ).removeClass( 'scrolled' );
			                $( '.df-misc-section' ).removeClass( 'scrolled' );

			            }

			        }, { offset: '50%' } );

			    } );
			}


 		}, // end stickyNav()
 		backTop: function() {

 			$( '.scroll-top' ).click( function( e ) {
 				e.preventDefault();
 				$( 'html, body' ).animate( { scrollTop : 0 }, 800 );
 			} );

		}, // end backTop()
		postHeight: function() {
			var currentTallest = 0,
			    currentRowStart = 0,
			    currentDiv = 0,
			    rowDivs = new Array(),
			    $el,
			    topPosition = 0;

		    $( '.blog .df-sticky-post:not(.sticky)' ).remove();

			$( '.front-content .recent-small-widget .ver2 li, .front-content .recent-small-widget .ver1 li, .recent-medium-widget .ver2 li, .type-post[class*="col-"] .gallery-item, .type-post .gallery-item, .type-page[class*="col-"] .gallery-item' ).each( function() {

			   	$el 		= $(this);
			   	topPosition = $el.position().top;

			   	if ( currentRowStart != topPosition ) {

			     	// we just came to a new row.  Set all the heights on the completed row
			     	for ( currentDiv = 0 ; currentDiv < rowDivs.length; currentDiv++ ) {
			       		rowDivs[currentDiv].height( currentTallest );
			     	}

				    // set the variables for the new row
				    rowDivs.length 	= 0; // empty the array
				    currentRowStart = topPosition;
				    currentTallest 	= $el.height();
				    rowDivs.push($el);

			   	} else {

			     	// another div on the current row.  Add it to the list and check if it's taller
			     	rowDivs.push($el);
			     	currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

			 	}

			  	// do the last row
			   	for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
			    	rowDivs[currentDiv].height( currentTallest );
			   	}

			});

		}, // end postHeight()
		moreLink: function() {
			$( '.more-link' ).addClass( 'button outline small' );
		},
		ajaxArchive: function() {
			$( '#searchfrm' ).keypress( function( e ) {
				var value  = $(this).val(),
					length = value.length;

				if( length > 2 && e.keyCode == 13 ) {
					var str_cat = '', str_cal = '', text_search = '';
					text_search += $( '#searchfrm' ).val();
	                str_cat 	+= $( '#cat_select option:selected' ).val() + ' ';
	                str_cal 	+= $( '#cal_select option:selected' ).val() + ' ';

					$( '.custom-archive-top-element h4 span' ).text( text_search );

	                $.post( ajaxurl, { action: 'df_post_custom_archive', s: value, cat_select: str_cat, calendar_select: str_cal }, function( output ) {
	                    $( '.df-content .row' ).html( output );
	                    $( '.page-template-template-archive .df-pagination.df-pagenav' ).remove();
	                });
				}
			} );

			$( '#cat_select' ).change(function() {
				var str_cat = '', value = '', str_cal = '', text_category = '';

				$( '#cat_select option:selected' ).each(function() {
					str_cat 	  += $( this ).val() + ' ';
					text_category += $( this ).text();
					str_cal 	  += $( '#cal_select option:selected' ).val() + ' ';
					value 	  	  += $( '#searchfrm' ).val() + ' ';

					$( '.custom-archive-top-element h4 span' ).text( text_category );

					$.post( ajaxurl, { action: 'df_post_custom_archive', s: value, cat_select: str_cat, calendar_select: str_cal }, function( output ) {
						$( '.df-content .row' ).html( output );
	                    $( '.page-template-template-archive .df-pagination.df-pagenav' ).remove();
					});
				});
			});

			$( '#cal_select' ).change(function() {
				var str_cat = '', value = '', str_cal = '', text_calendar = '';

				$( '#cal_select option:selected' ).each(function() {
	                str_cal 	  += $( this ).val() + ' ';
                	text_calendar += $( this ).text() + ' ';
                	str_cat 	  += $( '#cat_select option:selected' ).val() + ' ';
                	value 		  += $( '#searchfrm' ).val() + ' ';

                	$( '.custom-archive-top-element h4 span' ).text( text_calendar );

	                $.post(ajaxurl, { action: 'df_post_custom_archive', s: value, cat_select: str_cat, calendar_select: str_cal }, function( output ) {
	                    $( '.df-content .row' ).html( output );
	                    $( '.page-template-template-archive .df-pagination.df-pagenav' ).remove();
	                });

            	});
        	});

		},
		globalSearch: function() {

			// Global Search Show
			$( '.df-misc-search, .mobile-search' ).click( function( e ) {
				e.preventDefault();
				$( '.df-floating-search' ).addClass( 'active' );
				if ( $( window ).width() > 768 ) {
		        	$( '.df-floating-search-form .df-floating-search-form-input' ).focus().val( '' );
				}
			} );

			// Global Search Close
			$( '.search-container-close, .df-floating-search-close' ).click( function( e ) {
				e.preventDefault();
				$( '.df-floating-search' ).removeClass( 'active' );
			} );

			// ajax search hide esc pressed
			$( document).keyup( function( e ) {
	            if ( e.keyCode == 27 ) {
					$( '.df-floating-search' ).removeClass( 'active' );
				}
			});

		},
		globalSubs: function() {

			// Global Search Show
			$( '.df-misc-mail, .mobile-subs' ).click( function(e) {
				e.preventDefault();
				$( '.df-floating-subscription' ).addClass( 'active' );

				if ( $( 'body' ).hasClass( 'ie' ) ) {
	 				var subscription = $( '.df-floating-subscription .flex-box' ).height();

	 				$( '.ie .df-floating-subscription .col-right .wrap' ).css( 'height', subscription + 'px' );
	 			}

			});

			$( '.container-close, .df-floating-close' ).click( function(e) {
				e.preventDefault();
				$( '.df-floating-subscription' ).removeClass( 'active' );
			});

			// ajax search hide esc pressed
			$( document ).keyup( function( e ) {
	            if ( e.keyCode == 27 ) {
					$( '.container-close, .df-floating-close' ).click( function(e) {
						e.preventDefault();
						$( '.df-floating-subscription' ).removeClass( 'active' );
					});
				}
			} );

		},
		dropDownToggle: function() {
	        $( '<span class="btnshow ion-chevron-down"></span>' ).insertBefore( '.df-mobile-menu .sub-menu' );

	        $( 'span.btnshow' ).click( function() {
				$(this).removeClass('onacc');
				$(this).next().slideUp('normal');
				if( $(this).next().is(':hidden') == true ) {
					$(this).addClass('onacc');
					$(this).next().slideDown('normal');
				}
			});
		},
		widgetTitle: function() {
			$( '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="55.724px" height="8px" viewBox="0 0 55.724 8" enable-background="new 0 0 55.724 8" xml:space="preserve">
				<polygon fill-rule="evenodd" clip-rule="evenodd" points="55.772,0.582 49.513,8 44.34,1.096 38.515,8 33.342,1.096 27.517,8
					22.345,1.096 16.519,8 11.347,1.096 5.521,8 -0.048,0.566 0.495,0.159 5.552,6.908 11.261,0.143 11.362,0.011 16.55,6.908
					22.378,0.007 27.548,6.908 33.376,0.01 38.545,6.908 44.374,0 49.543,6.908 55.252,0.143 "/>
				</svg>' ).insertAfter( $( '.widget h4' ) );
		},
		addPostActiveCLass: function() {
			$('.single, .page').each(function() {
				if ( $('.single .df-content-pagination a').length ) {
					$('.df-content-pagination a span.button').addClass('none');
				}
			});
		},
		setParallax: function() {
			//  Set Header Navbar Parallax
		 	$( '.site-branding' ).each(function() {
		 		$( this ).parallax( '50%', 0.5, 200 );
		 	});

		 	$( '.site-branding a' ).each( function( i ) {

		 		var	brandHeight = $( '.site-branding' ).height();

		        $( '.site-branding' ).waypoint( function( direction ) {

		            if ( direction === 'down' ) {

		                $( '.site-branding a' ).css( 'opacity', '0' );

		            } else if ( direction === 'up' ) {

		                $( '.site-branding a' ).css( 'opacity', '1' );

		            }

		        }, { offset: -brandHeight/2 } );

		    } );

		},
		infiniteScroll: function() {
			var url       = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
		    var url_match = url.match(/-2/);
		    var infi_url  = url_match ? [url, "/"] : '';

		    $( '.isotope_ifncsr' ).infinitescroll( {
		    	navSelector: '.df-infinite-scroll',
		        nextSelector: '.nav-next a',
		        itemSelector: '.type-post, .type-page',
		        path: infi_url,
		        loading: {
		        	msgText: '<div class="paging-loader" style="transform:scale(0.35);"><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div></div>',
					finishedMsg: '<div class="finish-load">' + inf.finishText + '</div>',
					speed: 'fast',
				},
				errorCallback: function(){
		        	$('.loading-pagination ').remove();
		        },
		    }, function( arrayOfNewElems ) {

		    	// Isotope
		        if ( $( '.df-content .fit_2_col, .df-content .fit_3_col' ).length ) {
		            jQuery( '.isotope_ifncsr' ).isotope( 'appended', arrayOfNewElems );
		            jQuery( '.df-content .fit_2_col, .df-content .fit_3_col' ).imagesLoaded( function() {
		                jQuery( '.df-content .fit_2_col, .df-content .fit_3_col' ).isotope( 'layout' );
		            });
		        }

		        $( '.type-post, .type-page' ).fitVids();
		        $( 'audio' ).mediaelementplayer();
				$( 'video' ).mediaelementplayer();
				$( '.more-link' ).addClass( 'button outline small' );
				$('.loading-pagination ').remove();
		    } );

		    jQuery( '.isotope_ifncsr' ).infinitescroll( 'retrieve' );
		    return false;
		},
		gridSystem: function() {
			/* Post Masonry */
			$( '.df-content .fit_2_col' ).prepend( '<div class="grid-sizer col-md-6"></div>' );
			$( '.df-content .fit_3_col' ).prepend( '<div class="grid-sizer col-md-4"></div>' );
			
			/* Post fitRows */
			$( '.df-content .new_fit_2_col' ).prepend( '<div class="grid-sizer col-md-6"></div>' );

			$( '.df-content .fit_2_col' ).isotope({
		        itemSelector: '.type-post, .type-page',
		        masonry: {
		            columnWidth: '.grid-sizer.col-md-6',
		            layoutMode: 'masonry',
		        }
		    });

		    $( '.df-content .fit_3_col' ).isotope({
		        itemSelector: '.type-post, .type-page',
		        masonry: {
		            columnWidth: '.grid-sizer.col-md-4',
		            layoutMode: 'masonry',
		        }
		    });

		    $( '.df-content .new_fit_2_col' ).isotope({
		        itemSelector: '.type-post, .type-page',
		        masonry: {
		            columnWidth: '.grid-sizer.col-md-6',
		            layoutMode: 'fitRows',
		        }
		    });

			$( '.df-content .fit_2_col, .df-content .fit_3_col, .df-content .new_fit_2_col' ).imagesLoaded( function() {
				$( '.df-content .fit_2_col, .df-content .fit_3_col, .df-content .new_fit_2_col' ).isotope( 'layout' );
			});

			/* Featured Area Grid */
			$( '.featured-area.grid' ).prepend( '<div class="grid-sizer"></div>' );

			$( '.featured-area.grid' ).isotope({
		        itemSelector: '.item',
		        masonry: {
		            columnWidth: '.grid-sizer',
		            layoutMode: 'masonry',
		        }
		    });

		    $( '.featured-area.grid' ).imagesLoaded( function() {
				$( '.featured-area.grid' ).isotope( 'layout' );
			});
		},
		fitvids:function() {
			$(".type-post, .type-page").fitVids();
		},
		pageLoader: function() {
			var ajax_loader = $( '.ajax_loader' );

			setTimeout( function() {
				jQuery('.ajax_loader').fadeOut( 300 );
			}, 1000 );
		},
		scrolldepth: function() {
			$.scrollDepth({
				elements: ['#df-content'],
				userTiming: false,
				percentage: false,
				pixelDepth: false,
			});
		}
	};

} ) ( jQuery );

( function( $ ) { 'use strict';

	DAHZ.init.initSite();

} ) ( jQuery );