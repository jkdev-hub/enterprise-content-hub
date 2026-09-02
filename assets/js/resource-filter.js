/**
 * Resource archive filter and AJAX pagination.
 *
 * @package Enterprise_Content_Hub
 */

( function () {
	'use strict';

	var filterEl     = document.querySelector( '[data-resource-filter]' );
	var listEl       = document.querySelector( '[data-resource-list]' );
	var paginationEl = document.querySelector( '[data-resource-pagination]' );
	var filterWrapEl = document.querySelector( '.resource-filter' );
    var loaderEl     = document.querySelector( '.progress-loader' );

	if (
		! filterEl ||
		! listEl ||
		typeof echResourceFilter === 'undefined'
	) {
		return;
	}

	var topic = filterEl.value;

	filterEl.addEventListener( 'change', function () {

		topic = filterEl.value;

		// Filter change: update resources without scrolling.
		fetchPage( 1, false );
	} );

	if ( paginationEl ) {

		paginationEl.addEventListener( 'click', function ( event ) {

			var link = event.target.closest( '[data-page]' );

			if ( ! link ) {
				return;
			}

			event.preventDefault();

			// Pagination: update resources and scroll to filter.
			fetchPage(
				parseInt( link.dataset.page, 10 ),
				true
			);
		} );
	}

	/**
	 * Fetch resource page.
	 *
	 * @param {number}  page         Page number.
	 * @param {boolean} shouldScroll Whether to scroll to the filter.
	 */
	function fetchPage( page, shouldScroll ) {

		listEl.setAttribute( 'aria-busy', 'true' );

        if ( loaderEl ) {
            loaderEl.style.display = 'block';
        }

		var params = new URLSearchParams();

		params.append( 'action', echResourceFilter.action );
		params.append( 'nonce', echResourceFilter.nonce );
		params.append( 'topic', topic );
		params.append( 'page', page );

		fetch(
			echResourceFilter.ajaxUrl,
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

				listEl.innerHTML = response.data.html;

				if ( paginationEl ) {
					paginationEl.innerHTML = response.data.pagination;
				}

				if ( shouldScroll && filterWrapEl ) {

					var scrollTop =
						filterWrapEl.getBoundingClientRect().top +
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
				listEl.removeAttribute( 'aria-busy' );
                if ( loaderEl ) {
                    loaderEl.style.display = 'none';
                }
			} );
	}

} )();