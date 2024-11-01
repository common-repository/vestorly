<?php
$isConnected = ( get_option('vestorly.advisor_connected') == true );
$errorMessage = get_option('vestorly.error_message');
if ((!isset($errorMessage) || trim($errorMessage) === '')) {
  $errorMessage = 'Not connected to Vestorly.';
}
?>
<div class="wrap">
  <a href="http://vestorly.com" target="_blank" class="ext">
  <div class="logo-container">
      <img class="logo" src=" <?=plugins_url('../assets/vestorly_logo.png', __FILE__) ?>">
    <img class="logo_pic" src="<?= plugins_url('../assets/vestorly_bkg.png', __FILE__) ?>">
  </div>
  </a>
  <p class="about">Vestorly is a data-driven marketing platform for financial advisors. With Vestorly you can automatically curate personalized news and content libraries for unlimited individuals and groups, while accessing business-building data on their online interaction with your firm. Once content experiences are created, you can embed them anywhere to automatically refresh based on your preferences, including websites, emails, and social media. Vestorly Standard is free. Advanced customization and data reporting is available upon request.</p>
  <div class="clearfix"></div>

  <?php if($isConnected): ?>
      <div class="updated" >
        <p><strong>Connected to Vestorly</strong></p>
      </div>
  <?php else: ?>
      <div class="error">
        <p><strong><span id="vestorly-advisor-error"><?php echo $errorMessage; ?></span></strong></p>
      </div>
  <?php endif; ?>
  <form method="post">
    <?php if(!$isConnected): ?>
      <p>
        <label for="vestorly-advisor-email">Advisor Email:</label><br>
        <input size=50 type="email" id="vestorly-advisor-email" name="advisor_email"  />
      </p>

       <p>
         <label for="vestorly-advisor-password">Advisor Password:</label><br>
         <input size=50 type="password" id="vestorly-advisor-password" name="advisor_password"  />
      </p>

    <?php endif; ?>
  <?php submit_button(($isConnected ? 'Disconnect' : 'Connect')); ?>
  </form>
</div>
