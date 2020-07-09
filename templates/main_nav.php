<nav class="mein_nav">
    <ul>
        <li class="<?php echo is_home() ? 'active' : ''; ?>">
            <a href="/">Početna</a>
            <div class="border"></div>
        </li>
     <?php if(is_user_logged_in()){ ?>
        <li class="<?php echo is_page(27) ? 'active' : ''; ?>">
            <a href="/profile">Profil</a>
            <div class="border"></div>
        </li>
      <?php } ?>
    </ul>
    <?php
     if(is_home()){
      include('filter.php');
      }
    
     ?>
</nav>