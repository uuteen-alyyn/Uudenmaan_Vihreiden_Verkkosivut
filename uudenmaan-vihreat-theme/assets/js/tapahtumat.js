/* Uudenmaan Vihreät — Tapahtumakalenteri filtterit */

document.addEventListener( 'DOMContentLoaded', function () {
    const container = document.getElementById( 'uuvi-tapahtumat' );
    if ( ! container ) return;

    const active = { category: '', city: '' };

    // Rekisteröi kaikki filter-button-ryhmät
    container.querySelectorAll( '.uuvi-tapahtumat__filter-buttons' ).forEach( function ( group ) {
        const filterKey = group.dataset.filter;
        group.querySelectorAll( '.uuvi-filter-btn' ).forEach( function ( btn ) {
            btn.addEventListener( 'click', function () {
                group.querySelectorAll( '.uuvi-filter-btn' ).forEach( function ( b ) {
                    b.classList.remove( 'is-active' );
                } );
                this.classList.add( 'is-active' );
                active[ filterKey ] = this.dataset.value;
                applyFilters();
            } );
        } );
    } );

    function applyFilters() {
        const events = container.querySelectorAll( '.uuvi-event' );
        let visible = 0;

        events.forEach( function ( ev ) {
            const catOk  = ! active.category || ev.dataset.category === active.category;
            const cityOk = ! active.city     || ev.dataset.city     === active.city;
            const show   = catOk && cityOk;
            ev.style.display = show ? '' : 'none';
            if ( show ) visible++;
        } );

        const none = container.querySelector( '.uuvi-tapahtumat__none' );
        if ( none ) none.style.display = visible === 0 ? '' : 'none';
    }
} );
