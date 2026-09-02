/**
 * Blog category filter with AJAX numbered pagination.
 *
 * @package Enterprise_Content_Hub
 */

( function () {
	'use strict';

	if ( typeof echAjax === 'undefined' ) {
		return;
	}

	var containers = document.querySelectorAll( '[data-filter-list]' );

	containers.forEach( function ( container ) {
		initFilterList( container );
	} );

	/**
	 * Wire up one filter/pagination container.
	 *
	 * @param {HTMLElement} container Filter container.
	 */
	function initFilterList( container ) {

		var action       = container.dataset.action;
		var paramName    = container.dataset.param;
		var selectEl     = container.querySelector( '[data-filter-select]' );
		var resultsEl    = container.querySelector( '[data-filter-results]' );
		var paginationEl = container.querySelector( '[data-filter-pagination]' );
		var filterEl     = container.querySelector( '.archive-filter' );
		var loaderEl     = container.querySelector( '.progress-loader' );

		if ( ! action || ! paramName || ! resultsEl ) {
			return;
		}

		var filterValue = selectEl ? selectEl.value : 'all';

		if ( selectEl ) {

			selectEl.addEventListener( 'change', function () {

				filterValue = selectEl.value;

				// Filter change: update results without scrolling.
				fetchPage( 1, false );
			} );
		}

		if ( paginationEl ) {

			paginationEl.addEventListener( 'click', function ( event ) {

				var link = event.target.closest( '[data-page]' );

				if ( ! link ) {
					return;
				}

				event.preventDefault();

				// Pagination: update results and scroll to filter.
				fetchPage(
					parseInt( link.dataset.page, 10 ),
					true
				);
			} );
		}

		/**
		 * Fetch filtered page.
		 *
		 * @param {number}  page         Page number.
		 * @param {boolean} shouldScroll Whether to scroll to the filter.
		 */
		function fetchPage( page, shouldScroll ) {

			resultsEl.setAttribute( 'aria-busy', 'true' );
			if ( loaderEl ) {
				loaderEl.style.display = 'block';
			}

			var params = new URLSearchParams();

			params.append( 'action', action );
			params.append( 'nonce', echAjax.nonce );
			params.append( 'page', page );
			params.append( paramName, filterValue );

			fetch(
				echAjax.ajaxUrl,
				{
					method: 'POST',
					credentials: 'same-origin',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded',
					},
					body: params.toString(),
				}
			)
				.then( function ( response ) {
					return response.json();
				} )
				.then( function ( response ) {

					if ( ! response.success ) {
						return;
					}

					resultsEl.innerHTML = response.data.html;
					resultsEl.dataset.page = page;

					if ( paginationEl ) {
						paginationEl.innerHTML = response.data.pagination;
					}

					if ( shouldScroll && filterEl ) {

						var scrollTop =
							filterEl.getBoundingClientRect().top +
							window.pageYOffset -
							50;

						window.scrollTo(
							{
								top: scrollTop,
								behavior: 'smooth',
							}
						);
					}
				} )
				.catch( function () {
					// Leave current results unchanged on failure.
				} )
				.finally( function () {
					resultsEl.removeAttribute( 'aria-busy' );
					if ( loaderEl ) {
						loaderEl.style.display = 'none';
					}
				} );
		}
	}

} )();
