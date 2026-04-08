<?php
/**
 * Feed list partial.
 * Accepts $feed_items via set_query_var('feed_items', [...]) before get_template_part().
 * Each item: [ 'title' => '', 'url' => '', 'date' => 'Y-m-d' ]
 */
$items    = get_query_var( 'feed_items', [] );
$more_url = get_query_var( 'feed_more_url', '' );
$more_lbl = get_query_var( 'feed_more_label', 'Kaikki tiedotteet →' );

if ( empty( $items ) ) {
    echo '<p style="color:#888;">Syötteen lataus epäonnistui. <a href="' . esc_url( $more_url ) . '">Katso uutishuoneesta »</a></p>';
    return;
}
?>
<ul class="feed-list" role="list">
  <?php foreach ( $items as $item ) : ?>
    <li class="feed-item">
      <?php if ( ! empty( $item['date'] ) ) : ?>
        <span class="feed-item__date"><?php echo esc_html( date( 'j.n.Y', strtotime( $item['date'] ) ) ); ?></span>
      <?php endif; ?>
      <span class="feed-item__title">
        <a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank" rel="noopener noreferrer">
          <?php echo esc_html( $item['title'] ); ?>
        </a>
      </span>
    </li>
  <?php endforeach; ?>
</ul>
<?php if ( $more_url ) : ?>
  <p class="mt-2">
    <a class="btn btn--outline" href="<?php echo esc_url( $more_url ); ?>" target="_blank" rel="noopener noreferrer">
      <?php echo esc_html( $more_lbl ); ?>
    </a>
  </p>
<?php endif; ?>
