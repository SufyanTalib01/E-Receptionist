<?php $firstName = explode(" ", $_SESSION['name'])[0]; ?>


<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="upload-images/<?php echo (isset($_SESSION['profilePicture']) ? $_SESSION['profilePicture'] : 'user.jpg') ?>" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo isset($firstName) ? $firstName : 'David' ?></span>
                  <span class="text-secondary text-small"><?php echo isset($_SESSION['role_name'])  ? $_SESSION['role_name'] : 'unknown user' ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            

              <!-- DROP DOWM MENU  -->
             <!-- create user  -->
             
              <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="/create-roles.php">Create Role</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/list-role-permissions.php">List Role Permission</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/add-user.php">Create User</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/users.php">List All</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/patients.php">
                <span class="menu-title">Patients</span>
                <i class="fa-solid fa-hospital-user menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/doctors.php">
                <span class="menu-title">Doctors</span>
                <i class="fa-solid fa-user-doctor menu-icon"></i>
              </a>
            </li>
            
            
          </ul>
        </nav>