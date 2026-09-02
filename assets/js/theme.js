( function () {
	'use strict';

	var backToTop = document.querySelector( '[data-back-to-top]' );

	if ( backToTop ) {
		var showAfter = 400;
		var ticking = false;

		function updateBackToTop() {
			backToTop.classList.toggle( 'is-visible', window.scrollY > showAfter );
			ticking = false;
		}

		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				window.requestAnimationFrame( updateBackToTop );
				ticking = true;
			}
		}, { passive: true } );

		updateBackToTop();
	}

	var menuToggle = document.querySelector( '.menu-toggle' );
	var navigation = document.querySelector( '.main-navigation' );
	var overlay = document.querySelector( '.navigation-overlay' );

	if ( ! menuToggle || ! navigation || ! overlay ) {
		return;
	}

	function closeMenu( restoreFocus ) {
		navigation.classList.remove( 'is-open' );
		menuToggle.classList.remove( 'is-active' );
		overlay.classList.remove( 'is-active' );
		menuToggle.setAttribute( 'aria-expanded', 'false' );
		document.body.classList.remove( 'menu-open' );

		if ( restoreFocus ) {
			menuToggle.focus();
		}
	}

	function openMenu() {
		navigation.classList.add( 'is-open' );
		menuToggle.classList.add( 'is-active' );
		overlay.classList.add( 'is-active' );
		menuToggle.setAttribute( 'aria-expanded', 'true' );
		document.body.classList.add( 'menu-open' );
	}

	menuToggle.addEventListener( 'click', function () {
		if ( navigation.classList.contains( 'is-open' ) ) {
			closeMenu( false );
		} else {
			openMenu();
		}
	} );

	overlay.addEventListener( 'click', function () {
		closeMenu( false );
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'Escape' && navigation.classList.contains( 'is-open' ) ) {
			closeMenu( true );
		}
	} );

	window.addEventListener( 'resize', function () {
		if ( window.innerWidth > 991 && navigation.classList.contains( 'is-open' ) ) {
			closeMenu( false );
		}
	} );
} )();
