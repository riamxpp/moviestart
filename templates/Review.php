<div class="col-md-12 review">
  <div class="row">
    <div class="col-md-2">
      <div class="profile-image-container review-image" style="background-image: url('<?= $review->img_user ?>')"></div>
    </div>
    <div class="col-md-9 author-details-container">
      <h4 class="author-name">
        <a href=""><?= $userData->name ?></a>
      </h4>
      <p><i class="fas fa-star"></i></p>
    </div>
    <div class="col-md-12">
      <p class="comment-title">Comentário:</p>
      <p><?= $review->review ?></p>
    </div>
  </div>
</div>