<nav class="navbar">
  <div class="navbar-content">
    <ul class="navbar-nav left">
      <li class="nav-item float-left">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/home">
          <div class="logo"><span class="text1">Working</span><span class="text2">Hub.</span></div>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item dropdown nav-apps">
        <a class="nav-link" href="#" role="button">
          <iconify-icon icon="quill:inbox-newsletter" width="24" height="24"></iconify-icon>
          <span class="ms-1 me-1 d-none d-md-inline-block">Kotak Masuk</span>
        </a>
      </li>
      <li class="nav-item dropdown nav-notifications">
        <a class="nav-link" href="#" role="button">
          <iconify-icon icon="fluent:clipboard-bullet-list-ltr-16-regular" width="24" height="24"></iconify-icon>
          <span class="ms-1 me-1 d-none d-md-inline-block">Pesanan Saya</span>
        </a>
      </li>
      <li class="nav-item dropdown nav-profile">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <!-- <img src="https://via.placeholder.com/30x30" alt="profile"> -->
          <iconify-icon icon="carbon:user-avatar" width="24" height="24"></iconify-icon>
          <!-- <span class="ms-1 me-1 d-none d-md-inline-block"><?= $data->profile[0]->nama; ?></span> -->
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <div class="dropdown-header d-flex flex-column align-items-center">
            <div class="figure mb-3">
              <img src="https://via.placeholder.com/80x80" alt="">
            </div>
            <div class="info text-center">
              <!-- <p class="name font-weight-bold mb-0"><?= $data->profile[0]->nama; ?></p> -->
              <!-- <p class="email text-muted mb-3"><?= $data->profile[0]->email; ?></p> -->
            </div>
          </div>
          <div class="dropdown-body">
            <ul class="profile-nav p-0 pt-3">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>index.php/manageprofile" class="nav-link">
                  <i data-feather="user"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li class="nav-item">
                <form action="<?php echo base_url(); ?>index.php/authenticate/logged_out" id="loggedOut" method="post"></form>
                <a href="javascript:;" onclick="doLogout()" class="nav-link">
                  <i data-feather="log-out"></i>
                  <span>Log Out</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>

<script>
  function doLogout() {
    document.getElementById("loggedOut").submit();
  }
</script>