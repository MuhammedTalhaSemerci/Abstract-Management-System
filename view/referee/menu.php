<nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="/referee_index?sayfa=profile_update" class="nav-link" >
      
              <i class="nav-icon fas fa-th"></i>
              <p>
                Profilim
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Kayıt İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
        
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/referee_index?sayfa=congress_register" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kongre Ön Kayıt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/referee_index?sayfa=congress_document_upload" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Belge Gönder</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/referee_index?sayfa=congress_register_status&islem=index" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kayıt Durum Sorgula</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Bildiri İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php
                if($abstract_websites[0]["abstract_time_limit"] > date('U'))
                {
                  echo ' 
                  <li class="nav-item">
                    <a href="./referee_index?sayfa=abstract_upload&islem=index" class="nav-link">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <i class="far fa-circle nav-icon"></i>
                      <p>Bildiri Yükle</p>
                    </a>
                  </li>';
                }

                else
                {
                  echo ' 
                  <li class="nav-item" >
                    <a href="#" class="nav-link" onclick="abstract_limit_warning()">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <i class="far fa-circle nav-icon"></i>
                      <p style="text-decoration: line-through;">Bildiri Yükle</p>
                    </a>
                  </li>';
                }
              ?>
              <li class="nav-item">
                <a href="./referee_index?sayfa=my_abstracts&islem=index" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bildirilerim</p>
                </a>
              </li>

            
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Bilim kurulu İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">


              <li class="nav-item">
                <a href="/referee_index?sayfa=all_abstracts" class="nav-link" style="word-wrap:break; text-align:center;">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Değerlendirilecek </p><br><p>Bildiriler</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/referee_index?sayfa=all_abstracts" class="nav-link" style="word-wrap:break; text-align:center;">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="far fa-circle nav-icon"></i>
                  <p>Değerlendirdiğim </p><br><p>Bildiriler</p>
                </a>
              </li>

            

            </ul>

          </li>
         
          <?php
              
              if($abstract_websites[0]["scientific_program_time"] < date('U'))
              {
                echo ' 
                <li class="nav-item" >
                  <a href="/referee_index?sayfa=scientific_program_viewer" class="nav-link" >
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Bilimsel Program</p>
                  </a>
                </li>';
            
                echo ' 
                  
                <li class="nav-item">
                  <a href="/referee_index?sayfa=session_abstract_info" class="nav-link" >
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Oturum Bilgileri</p>
                  </a>
                </li>';

                echo ' 
                <li class="nav-item">
                  <a href="./referee_index?sayfa=main_author_abstracts&islem=index" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Sunumlarım</p>
                  </a>
                </li>';

              }

              if($user_index["sponsor_company"] != null)
              {
                echo '
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                  Sponsor İşlemleri
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./referee_index?sayfa=virtual_congress_sponsor_pages" class="nav-link">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <i class="far fa-circle nav-icon"></i>
                      <p>Görseller</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./referee_index?sayfa=virtual_congress_sponsor_documents" class="nav-link">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dökümanlar</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./referee_index?sayfa=virtual_congress_sponsor_videos" class="nav-link">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <i class="far fa-circle nav-icon"></i>
                      <p>Videolar</p>
                    </a>
                  </li>
                </ul>
              </li>';
              }
              

                      
              if($abstractwebsites[0]["congress_start_time"] < date("U"))
              {
                echo '
                <li class="nav-item">
                  <a href="/" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Kongre Ana Sayfası</p>
                  </a>
                </li>
                ';
              }

            ?>

          <script>
            function abstract_limit_warning ()
            {
              alert("Kongre bildiri kabulü son bulmuştur "); 
              return false;
            }
          </script>
          
        </ul>
      </nav>