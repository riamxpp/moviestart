<?php 

  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  $user = new User();
  $userDao = new UserDAO($conn, $BASE_URL);

  $dateUser = $userDao->findById($review->users_id);

  $fullName = $user->getFullName($dateUser);

?>

<div class="col-md-12 review">
  <div class="row">
    <div class="col-md-2">
      <div class="profile-image-container review-image" style="background-image: url('<?= $review->img_user ?>')"></div>
    </div>
    <div class="col-md-9 author-details-container">
      <h4 class="author-name">
        <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->users_id ?>"><?= $fullName ?></a>
      </h4>
      <p><i class="fas fa-star"></i> <?= $review->rating?></p>
    </div>
    <div class="col-md-12">
      <p class="comment-title">Comentário:</p>
      <p><?= $review->review ?></p>
    </div>
  </div>
</div>